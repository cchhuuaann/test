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

	echo $this->Form->create('PaymentMethod', array('id' => 'contentform', 'action' => '/payment_methods/admin_edit/' . $data['PaymentMethod']['id'], 'url' => '/payment_methods/admin_edit/' . $data['PaymentMethod']['id']));
	echo $this->Form->inputs(array(
					'legend' => null,
					'fieldset' => __('Payment Method Details'),
				   'PaymentMethod.id' => array(
				   		'type' => 'hidden',
						'value' => $data['PaymentMethod']['id']
	               ),
	               'PaymentMethod.name' => array(
				   		'label' => __('Name'),
   						'value' => $data['PaymentMethod']['name']
	               ),				     				   	   																									
	               'PaymentMethod.order' => array(
				   		'label' => __('Sort Order'),
   						'value' => $data['PaymentMethod']['order']
	               ),				     				   	   																									
	               'PaymentMethod.order_status_id' => array(
							'type' => 'select',
							'label' => __('Order Status'),
							'options' => $order_status_list,
							'selected' => $current_order_status
	               )				     				   	   																									
			));
	
	echo $this->requestAction( '/payment/'.$data['PaymentMethod']['alias'].'/settings/', array('return'));	
	
	echo $this->Admin->formButton(__('Submit'), 'submit.png', array('type' => 'submit', 'name' => 'submit')) . $this->Admin->formButton(__('Cancel'), 'cancel.png', array('type' => 'submit', 'name' => 'cancelbutton'));
	echo '<div class="clear"></div>';
	echo $this->Form->end();
	
	echo $this->Admin->ShowPageHeaderEnd();
	
	?>