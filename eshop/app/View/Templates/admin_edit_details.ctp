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

	echo $this->Admin->ShowPageHeaderStart($current_crumb, 'edit.png');

	echo $this->Form->create('Template', array('id' => 'contentform', 'action' => '/templates/admin_edit_details/'.$data['Template']['id'], 'url' => '/templates/admin_edit_details/'.$data['Template']['id']));
	echo $this->Form->inputs(array(
					'legend' => null,
					'fieldset' => __('Template Details'),
				   'Template.id' => array(
				   		'type' => 'hidden',
						'value' => $data['Template']['id']
	               ),
	               'Template.name' => array(
				   		'label' => __('Name'),
   						'value' => $data['Template']['name']
	               )																										
			));
	echo $this->Admin->formButton(__('Submit'), 'submit.png', array('type' => 'submit', 'name' => 'submit')) . $this->Admin->formButton(__('Cancel'), 'cancel.png', array('type' => 'submit', 'name' => 'cancelbutton'));
	echo '<div class="clear"></div>';
	echo $this->Form->end();
	echo $this->Admin->ShowPageHeaderEnd(); 
?>