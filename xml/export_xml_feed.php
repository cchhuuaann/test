<?php
require_once 'CronJob.php';

/**
 *
 *
 * @package    SlevyKurzu
 * @author     Kurzor / Marek Gach
 */
class export_xml_feed extends Sk_CronJob {
    private $view;

    /**
     *
     *
     */
    protected function makeAction() {
        $config = Zend_Registry::get('config');

        $viewconfig['basePath'] = $config['resources']['frontController']['controllerDirectory'] . '/../views/';
        $viewconfig['helperPath'] = $config['includePaths']['library'] . '/Sk/View/Helper/';
        $viewconfig['helperPathPrefix'] = 'Sk_View_helper';

        $front = Zend_Controller_Front::getInstance();
        $router = $front->getRouter();
        $kurzdetail = new Zend_Controller_Router_Route_Regex('skola-([0-9A-Z-]*|-?)-([A-Z0-9]{6})/([0-9A-Z-]*|-?)-([A-Z0-9]{6})', array('controller'=>'kurz', 'action'=>'detail'), array(1=>"school", 2=>"school-hash", 3=>"course-name", 4=>"course-hash"), "skola-%s-%s/%s-%s");
        $router->addRoute('kurzdetail', $kurzdetail);


        $this->view = new Zend_View($viewconfig);

        $modelKurz = Sk_Model_Database::loadModel('kurz');

        // load expired courses list
        $list = $modelKurz->fetchEntries(
                    array(
                            '(sk_kurz.stav=1 OR sk_kurz.stav=6)',       // only two meaningfull states
                            'volnych_mist>0',                           // must have sufficient capacity
                            'sk_kurz.skola_id>1',                       // not a testing school course
                            'sk_skola.stav=?' => STATUS_SKOLA_AKTIVNI,  // school must be an active one
                            'je_inzerovany_paylo=?'=> 1
                        ),
                   true
                );
        $this->generateXml($list);
        
        // load expired courses list
        $list = $modelKurz->fetchEntries(
                    array(
                            '(sk_kurz.stav=1 OR sk_kurz.stav=6)',       // only two meaningfull states
                            'volnych_mist>0',                           // must have sufficient capacity
                            'sk_kurz.skola_id>1',                       // not a testing school course
                            'sk_skola.stav=?' => STATUS_SKOLA_AKTIVNI,  // school must be an active one
                            'je_inzerovany_rival=?'=> 1
                        ),
                   true
                );        
        $this->generateXmlRival($list);
        
        // load expired courses list
        $list = $modelKurz->fetchEntries(
                    array(
                            '(sk_kurz.stav=1 OR sk_kurz.stav=6)',       // only two meaningfull states
                            'volnych_mist>0',                           // must have sufficient capacity
                            'sk_kurz.skola_id>1',                       // not a testing school course
                            'sk_skola.stav=?' => STATUS_SKOLA_AKTIVNI,  // school must be an active one
                            'je_inzerovany_ehub=?'=> 1
                        ),
                   true
                );        
        $this->generateXmlEhub($list);        
    } // end: makeAction()



    private function generateXmlRival($list)
    {
        $this->logMessage('Generating XML feed RIVAL containing ' . count($list) . ' records.');

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><SERVER></SERVER>');

        if(count($list)) {
            foreach($list as $k=>$v) {
                $deal = $xml->addChild('DEAL');

                if(!is_null($v['id_nabidek'])) {
                    $deal->addChild('ID', $v['id_nabidek']);
                } else {
                    $deal->addChild('ID', $v['id']);
                }

                // gen cities list
                $cities = $deal->addChild('CITIES');
                foreach($v['cities'] as $kk=>$vv) {
                    $cities->addChild('CITY', $vv['nazev']);
                }
                $deal->addChild('TITLE_SHORT', ($v['nazev_rival'])?$v['nazev_rival']:$v['nazev']);
                $deal->addChild('TITLE', (($v['nazev_rival'])?$v['nazev_rival']:$v['nazev']) . (!empty($v['perex'])?' - ' . strip_tags($v['perex']):''));
                $url = $this->view->getConstant('cron_base_uri');
                $deal->addChild('URL', substr($url, 0, strlen($url)-1) . $this->view->getCourseDetailUri($v['id'], $v, true));
                $images = $deal->addChild('IMAGES');
                $images->addChild('IMAGE', $this->view->getImageUri(305, 190, $v['logo']['token']));
                // set price values
                $deal->addChild('FINAL_PRICE', $v['cena_po_sleve']);
                $deal->addChild('ORIGINAL_PRICE', $v['cena_zakladni']);
                $deal->addChild('CURRENCY', 'CZK');

                if($v['pocet_zaku_min']) {
                    $deal->addChild('CUSTOMERS', $v['pocet_zaku_min']);
                } else {
                    $deal->addChild('CUSTOMERS', '0');
                }

                $deal->addChild('MIN_CUSTOMERS', '0');
                $deal->addChild('MAX_CUSTOMERS', $v['volnych_mist'] + $v['pocet_zaku_max']);
                $deal->addChild('DEAL_START', $v['datum_cas_nove_id']?$v['datum_cas_nove_id']:$v['datum_cas_zverejneni']);

                $now = strtotime(date('Y-m-d'));
                $end = strtotime($v['datum_zverejnovat_do']);
                $remain = round(($end - $now)/60/60/24);

                $mod = $remain % 4;

                switch($mod) {
                    case 1: $enddate = strtotime('+1 days', $now); break;
                    case 2: $enddate = strtotime('+2 days', $now); break;
                    case 3: $enddate = strtotime('+3 days', $now); break;
                    case 0: if($now != $end && date('G')>=19) {
                                $enddate = strtotime('+4 days', $now);
                            } else {
                                $enddate = $now;
                            }
                            break;
                }

                $deal->addChild('DEAL_END', date('Y-m-d ', $enddate) . '23:59:59');
                // set course tags / keywords if set and categories plural and singular form
                $tags = $deal->addChild('TAGS');
                if(!empty($v['klicova_slova'])) {
                    $v['klicova_slova'] = str_replace(', ', ',', $v['klicova_slova']);

                    $tagdata = explode(',', $v['klicova_slova']);
                    foreach($tagdata as $kk=>$vv) {
                        $tags->addChild('TAG', $vv);
                    }
                }

                if(!empty($v['cats'])) {
                    foreach($v['cats'] as $kk=>$vv) {
                        $tags->addChild('TAG', strtolower($vv['nazev']));
                        // dont include if singular the same
                        if($vv['nazev'] != $vv['nazev_singular']) {
                            $tags->addChild('TAG', strtolower($vv['nazev_singular']));
                        }
                    }
                }
                if(!empty($v['cats_special_nazev_list'])) {
                    foreach($v['cats_special_nazev_list'] as $kk=>$vv) {
                        $tags->addChild('TAG', strtolower($vv));
                    }
                }
                if(!empty($v['cats_special_nazev_list_normal'])) {
                    foreach($v['cats_special_nazev_list_normal'] as $kk=>$vv) {
                        $tags->addChild('TAG', strtolower($vv));
                    }
                }

                $deal->addChild('ADDRESS', $v['pobocka']['ulice'] . ', ' . $v['pobocka']['mesto_nazev']);

                if(!empty($v['pobocka']['www']))
                    $deal->addChild('WEB', $v['pobocka']['www']);

                $deal->addChild('EMAIL', $v['pobocka']['email']);
                if(!empty($v['pobocka']['telefon1']))
                    $deal->addChild('PHONE', $v['pobocka']['telefon1']);
                $deal->addChild('LANGUAGE', 'cs');
                $deal->addChild('ADULT', '0');

            }
        }

        $xml->saveXML(APPLICATION_PATH . '/../public/feed/rival.xml');
    }


    private function generateXml($list)
    {
        $this->logMessage('Generating XML feed PAYLO containing ' . count($list) . ' records.');

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><server></server>');

        if(count($list)) {
            foreach($list as $k=>$v) {
                $deal = $xml->addChild('deal');

                if(!is_null($v['id_nabidek'])) {
                    $deal->addChild('ID', $v['id_nabidek']);
                } else {
                    $deal->addChild('ID', $v['id']);
                }
                
                $deal->addChild('title_short', $v['nazev']);
                $deal->addChild('title', $v['nazev'] . ' - ' . strip_tags($v['perex']));

                // gen cities list
                $cities = $deal->addChild('cities');
                foreach($v['cities'] as $kk=>$vv) {
                    $cities->addChild('city', $vv['nazev']);
                }

                $url = $this->view->getConstant('cron_base_uri');
                $deal->addChild('url', substr($url, 0, strlen($url)-1) . $this->view->getCourseDetailUri($v['id'], $v));

                $images = $deal->addChild('images');
                $images->addChild('image', $this->view->getImageUri(305, 190, $v['logo']['token']));
                /** not working well for this sizes. Because crop is here set not to centering.
                    if(count($v['fotografie'])) {
                        foreach($v['fotografie'] as $kk=>$vv) {
                            $images->addChild('image', $this->view->getImageUri(305, 190, $vv['token']));
                        }
                    }
                */
                $deal->addChild('deal_start', $v['datum_cas_zverejneni']);

                $end = strtotime($v['datum_zverejnovat_do']);
              //  $end = $end + $v['zverejnovat_dnu']*24*60*60;

                $deal->addChild('deal_end', date('Y-m-d ', $end) . '23:59:59');
/*
                if($end < time() + 4*24*60*60) {
                    $deal->addChild('deal_end', date('Y-m-d H:i:s', $end));
                } else {
                    $deal->addChild('deal_end', date('Y-m-d H:i:s', time() + 4*24*60*60));
                }
*/

                // set categories
                $categories = $deal->addChild('categories');
                // adding here aliases of categories
                //$categories->addChild('category', 'kurzy a vzdělávání');

                $cats = array();

                if(!empty($v['cats'])) {
                    foreach($v['cats'] as $kk=>$vv) {
                        $aliasarr = explode('||', $vv['alias']);

                        if(count($aliasarr) && !empty($vv['alias'])) {
                            foreach($aliasarr as $kkk=>$vvv) {
                                $cats[$vvv] = '';
                            }
                        }
                    }
                }

                if(!empty($v['cats_special'])) {
                    foreach($v['cats_special'] as $kk=>$vv) {
                        $aliasarr = explode('||', $vv['alias']);

                        if(count($aliasarr) && !empty($vv['alias'])) {
                            foreach($aliasarr as $kkk=>$vvv) {
                                $cats[$vvv] = '';
                            }
                        }
                    }
                }

                if(count($cats)) {
                    foreach($cats as $kk=>$vv) {
                        $categories->addChild('category', $kk);
                    }
                }

                // $deal->addChild('voucher_valid_from_next', date('Y-m-d 00:00:00'));
                // $deal->addChild('voucher_valid_until_next', date('Y-m-d 00:00:00', time() + 14*24*60*60));
                $deal->addChild('voucher_issuer', $v['pobocka']['nazev'] . ', ' . $v['pobocka']['ulice'] . ', ' . $v['pobocka']['mesto_nazev']);

                // set course tags / keywords if set and categories plural and singular form
                $tags = $deal->addChild('tags');
                if(!empty($v['klicova_slova'])) {
                    $v['klicova_slova'] = str_replace(', ', ',', $v['klicova_slova']);

                    $tagdata = explode(',', $v['klicova_slova']);
                    foreach($tagdata as $kk=>$vv) {
                        $tags->addChild('tag', $vv);
                    }
                }

                if(!empty($v['cats'])) {
                    foreach($v['cats'] as $kk=>$vv) {
                        $tags->addChild('tag', strtolower($vv['nazev']));

                        if($vv['nazev'] != $vv['nazev_singular']) {
                            $tags->addChild('tag', strtolower($vv['nazev_singular']));
                        }
                    }
                }
                if(!empty($v['cats_special_nazev_list'])) {
                    foreach($v['cats_special_nazev_list'] as $kk=>$vv) {
                        $tags->addChild('tag', strtolower($vv));
                    }
                }
                if(!empty($v['cats_special_nazev_list_normal'])) {
                    foreach($v['cats_special_nazev_list_normal'] as $kk=>$vv) {
                        $tags->addChild('tag', strtolower($vv));
                    }
                }

                $deal->addChild('min_customers', '0');

                // set location where the course is
                $location = $deal->addChild('location');
                $location->addChild('address', $v['pobocka']['ulice'] . ', ' . $v['pobocka']['mesto_nazev']);
                $location->addChild('client', $v['pobocka']['nazev']);
                $location->addChild('street', $v['pobocka']['ulice']);
                $location->addChild('city', $v['pobocka']['mesto_nazev']);
                $location->addChild('email', $v['pobocka']['email']);
                if(!empty($v['pobocka']['telefon1']))
                    $location->addChild('phone', $v['pobocka']['telefon1']);
                if(!empty($v['pobocka']['www']))
                    $location->addChild('web', $v['pobocka']['www']);

                $provision = $deal->addChild('provision');
                $provision->addChild('click_price', !is_null($v['cena_paylo'])?$v['cena_paylo']:$this->view->getConstant('cena_paylo_default'));

                // set price values
                $deal->addChild('final_price', $v['cena_po_sleve']);
                $deal->addChild('original_price', $v['cena_zakladni']);
                $deal->addChild('max_customers', $v['volnych_mist'] + $v['pocet_zaku_max']);
                if($v['pocet_zaku_min'])
                    $deal->addChild('customers', $v['pocet_zaku_min']);
            }
        }

        $xml->saveXML(APPLICATION_PATH . '/../public/feed/paylo.xml');
    }
    
    private function generateXmlEhub($list)
    {
        $this->logMessage('Generating XML feed Ehub containing ' . count($list) . ' records.');

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><deals></deals>');

        if(count($list)) {
            foreach($list as $k=>$v) {
                $deal = $xml->addChild('deal');

                if(!is_null($v['id_nabidek'])) {
                    $deal->addChild('id', $v['id_nabidek']);
                } else {
                    $deal->addChild('id', $v['id']);
                }
                
                $deal->addChild('title', $v['nazev']);

                $cityarr = array();
                // gen cities list
                foreach($v['cities'] as $kk=>$vv) {
                    $cityarr[] = $vv['nazev'];
                }                
                $deal->addChild('city', implode(';', $cityarr));

                $url = $this->view->getConstant('cron_base_uri');
                $deal->addChild('dealUrl', substr($url, 0, strlen($url)-1) . $this->view->getCourseDetailUri($v['id'], $v));
                $deal->addChild('imageUrl', $this->view->getImageUri(305, 190, $v['logo']['token']));

                $deal->addChild('dealStart', $v['datum_cas_zverejneni']);
                $end = strtotime($v['datum_zverejnovat_do']);
                $deal->addChild('dealEnd', date('Y-m-d ', $end) . '23:59:59');

                $deal->addChild('voucherStart', date('Y-m-d ', $end) . '00:00:00');                
                $deal->addChild('voucherEnd', date('Y-m-d ', strtotime('+14 days')) . '23:59:59');                

                $deal->addChild('minCustomers', 0);
                /* $deal->addChild('maxCustomers', $v['volnych_mist']); */
                
                $deal->addChild('customers', $v['pocet_zaku_min'] && !$v['schovej_pocet'] ? $v['pocet_zaku_min'] : $v['pocet_prodeju']);
                
                $deal->addChild('originalPrice', $v['cena_zakladni']);  
                $deal->addChild('ourPrice', $v['cena_po_sleve']);
                
                $deal->addChild('currency', 'CZK');
                $deal->addChild('discount', $v['sleva']);
                
                $cats = array();

                if(!empty($v['cats'])) {
                    foreach($v['cats'] as $kk=>$vv) {
                        $aliasarr = explode('||', $vv['alias_ehub']);

                        if(count($aliasarr) && !empty($vv['alias_ehub'])) {
                            foreach($aliasarr as $kkk=>$vvv) {
                                $cats[$vvv] = '';
                            }
                        }
                    }
                }

                if(!empty($v['cats_special'])) {
                    foreach($v['cats_special'] as $kk=>$vv) {
                        $aliasarr = explode('||', $vv['alias_ehub']);

                        if(count($aliasarr) && !empty($vv['alias_ehub'])) {
                            foreach($aliasarr as $kkk=>$vvv) {
                                $cats[$vvv] = '';
                            }
                        }
                    }
                }

                if(count($cats)) {
                    $deal->addChild('categories', implode(';', array_keys($cats)));
                }
            }
        }

        $xml->saveXML(APPLICATION_PATH . '/../public/feed/ehub.xml');
    }    
} // end: export_xml_feed


// execute the cron job
define("CRON_JOB", 1);
$cronjob = new export_xml_feed();
$cronjob->execute();