<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Post $Post
 */
class User extends AppModel {

	public $validate = array(
			'username' => array(
					'required' => array(
							'rule' => array(
									'notEmpty'
								),
							'message' => 'A username is required'
						)
				),
			'password' => array(
					'required' => array(
							'rule' => array(
									'notEmpty'
								),
							'message' => 'A password is required'
						)
				),
			'role' => array(
					'valid' => array(
							'rule' => array(
									'inList',
									array(
											'admin',
											'author'
										)
								),
							'message' => 'Please enter a valid code',
							'allowEmpty' => false
						)
				)
		);
	
	public function beforeSave($options = array()) {
		if(isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		
		return true;
	}

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
