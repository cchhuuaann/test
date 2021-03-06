<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/

$this->Html->script(array(
	'modified.js',
	'jquery/plugins/jquery-ui-min.js',
	'tabs.js',
	'focus-first-input.js'
), array('inline' => false));

	echo $this->Html->css('ui.tabs', null, array('inline' => false));
	
	echo $this->Admin->ShowPageHeaderStart($current_crumb, 'edit.png');
	
	echo $this->Form->create('DefinedLanguage', array('id' => 'contentform', 'action' => '/defined_languages/admin_edit/'.$defined_key, 'url' => '/defined_languages/admin_edit/'.$defined_key));
	
		echo $this->Form->inputs(array(
					'legend' => null,
					'fieldset' => __('Defined Language Details'),
	               'DefinedLanguage.key' => array(
   				   		'label' => __('Alias'),				   
   						'value' => $defined_key
	               )
				));
	
	echo $this->Admin->StartTabs();
			echo '<ul>';
	foreach($languages AS $language)
	{
			echo $this->Admin->CreateTab('language_'.$language['Language']['id'],$language['Language']['name'],$language['Language']['iso_code_2'].'.png');
	}
			echo '</ul>';
	
	// Loop through the languages and display a name and descrition for each
	foreach($languages AS $language)
	{
		$language_key = $language['Language']['id'];
		
		echo $this->Admin->StartTabContent('language_'.$language_key);
		
		// Quick fix to avoid errors, change this later
		if(!isset($data[$language_key]['DefinedLanguage']['value']))
			$data[$language_key]['DefinedLanguage']['value'] = "";
			
		echo $this->Form->inputs(array(
					'legend' => null,
					'DefinedLanguage]['.$language['Language']['id'].'][value' => array(
			   	'label' => $this->Admin->ShowFlag($language['Language']) . '&nbsp;' . __('Value'),
					'type' => 'textarea',
					'class' => 'pagesmalltextarea',											
					'value' => $data[$language_key]['DefinedLanguage']['value']
            	  )));
            	  
	echo $this->Admin->EndTabContent();
	
	}
	
	echo $this->Admin->EndTabs();
	
	echo $this->Admin->formButton(__('Submit'), 'submit.png', array('type' => 'submit', 'name' => 'submit')) . $this->Admin->formButton(__('Cancel'), 'cancel.png', array('type' => 'submit', 'name' => 'cancelbutton'));
	echo '<div class="clear"></div>';
	echo $this->Form->end();
	
	echo $this->Admin->ShowPageHeaderEnd();
	
?>