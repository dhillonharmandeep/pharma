<?php
/** 
 * user.php
 * Description	: User model file
 *  
 * Created by	: Harman Dhillon
 * Created on 	: Oct 4, 2010
 */

class User extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('username', 'string', 255, array('unique' => 'true'));
		$this->hasColumn('password', 'string', 255);
		$this->hasColumn('email', 'string', 255, array('unique' => 'true'));

	}

	public function setUp() {
		$this->setTableName('user');
		$this->actAs('Timestampable');
		$this->hasMutator('password', '_encrypt_password');
	}

	protected function _encrypt_password($value) {
		$salt = '#*seCrEt!@-*%';
		$this->_set('password', md5($salt . $value));
	}
}