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

	echo $this->Form->create('EmailTemplate', array('id' => 'contentform', 'action' => '/email_template/admin_edit/' . $data['EmailTemplate']['id'], 'url' => '/email_template/admin_edit/' . $data['EmailTemplate']['id']));
	echo $this->Form->inputs(array(
					'legend' => null,
					'fieldset' => __('Email Templates Details'),
				   'EmailTemplate.id' => array(
				   		'type' => 'hidden',
						'value' => $data['EmailTemplate']['id']
	               )
		 ));
		
		echo $this->Form->inputs(array(
						'legend' => null,
	               'EmailTemplate.alias' => array(
   				   		'label' => __('Alias'),				   
   						'value' => $data['EmailTemplate']['alias']
	               )
				));
	
	echo $this->Admin->StartTabs();
			echo '<ul>';
	foreach($languages AS $language)
	{
			echo $this->Admin->CreateTab('language_'.$language['Language']['id'],$language['Language']['name'],$language['Language']['iso_code_2'].'.png');
	}
			echo '</ul>';
	
	foreach($languages AS $language)
	{
		$language_key = $language['Language']['id'];
		
		echo $this->Admin->StartTabContent('language_'.$language_key);
		
	   	echo $this->Form->inputs(array(
						'legend' => null,
	   				'EmailTemplateDescription.' . $language['Language']['id'].'.subject' => array(
				   	'label' => $this->Admin->ShowFlag($language['Language']) . '&nbsp;' . __('Subject'),
						'value' => $data['EmailTemplateDescription'][$language_key]['subject']
	            	  ) 	   																									
				));
		echo $this->Form->inputs(array(
					'legend' => null,
					'EmailTemplateDescription.' . $language['Language']['id'].'.content' => array(
			   	'label' => $this->Admin->ShowFlag($language['Language']) . '&nbsp;' . __('Content'),
					'type' => 'textarea',
					'class' => 'pagesmalltextarea',											
					'value' => $data['EmailTemplateDescription'][$language_key]['content']
            	  )));
	
	echo $this->Admin->EndTabContent();
	
	}
	
	echo $this->Admin->EndTabs();
	
	echo $this->Admin->formButton(__('Submit'), 'submit.png', array('type' => 'submit', 'name' => 'submit')) . $this->Admin->formButton(__('Cancel'), 'cancel.png', array('type' => 'submit', 'name' => 'cancelbutton'));
	echo '<div class="clear"></div>';
	echo $this->Form->end();
	
	echo $this->Admin->ShowPageHeaderEnd();
	
	?>