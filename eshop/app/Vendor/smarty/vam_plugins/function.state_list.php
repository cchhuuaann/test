<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/

function smarty_function_state_list($params, &$smarty)
{
        global $content;

        App::import('Model', 'CountryZone');
        $CountryZone =& new CountryZone();
        $options = $CountryZone->find('all', array('fields' => array('id', 'name'),
                                                   'conditions' => array('iso_code_2' => $params['country'])
                                                  ));
        $List = '';

        foreach($options as $option) {
                $List .= "<option value=\"" . $option['CountryZone']['id'] . "\"";
                if (isset($params['selected'])) {
                        if ($option['CountryZone']['id'] == $params['selected']) {
                                $List .= 'selected ';
                        }
                }
                $List .= ">" . $option['CountryZone']['name'] . "</option>";
        }

        echo $List;
}

function smarty_help_function_state_list () {
	?>
	<h3><?php echo __('What does this tag do?') ?></h3>
	<p><?php echo __('Generates States list.') ?></p>
	<h3><?php echo __('How do I use it?') ?></h3>
	<p><?php echo __('Just insert the tag into your template like:') ?> <code>{state_list}</code></p>
	<h3><?php echo __('What parameters does it take?') ?></h3>
	<ul>
		<li><em>(<?php echo __('None') ?>)</em></li>
	</ul>
	<?php
}

function smarty_about_function_state_list () {
}
?>