<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/

$this->Html->script(array(
	'modified.js',
	'focus-first-input.js'
), array('inline' => false));

	echo $this->Admin->ShowPageHeaderStart($current_crumb, 'license.png');

	echo $this->Form->create('License', array('id' => 'contentform', 'action' => '/license/admin_edit/', 'url' => '/license/admin_edit/'));
	echo $this->Form->inputs(array(
					'legend' => null,
					'fieldset' => __('Key:'),
				   'License.id' => array(
				   		'type' => 'hidden'
	               ),
				   'License.licenseKey' => array(
   				   		'label' => __('Key:')
	               )						   		     				   	   																									
			));
	echo $this->Admin->formButton(__('Submit'), 'submit.png', array('type' => 'submit', 'name' => 'submit')) . $this->Admin->formButton(__('Cancel'), 'cancel.png', array('type' => 'submit', 'name' => 'cancelbutton'));
	echo '<div class="clear"></div>';
	echo $this->Form->end();

	echo $this->Admin->ShowPageHeaderEnd();

?>