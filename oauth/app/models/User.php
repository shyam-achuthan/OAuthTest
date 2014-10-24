<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface,RemindableInterface {

	use UserTrait, RemindableTrait;
            protected $primaryKey = "Id";
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	function display()
	{
		echo '123';
	}
        
        public function getRememberToken() {
   return $this->remember_token;
}


public function setRememberToken($value) {
   $this->remember_token = $value;
}


public function getRememberTokenName() {
   return 'remember_token';
}
        

}
