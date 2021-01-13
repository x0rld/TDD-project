<?php

namespace App\Controller;

use App\Core\Security as Secu;
use App\Core\View;
use App\Models\User;

class Security{

	public function defaultAction(){
		echo "Controller security action default";
	}


	public function loginAction(){
		echo "Controller security action login";
	}

	public function registerAction() {

		$user = new User();
		$user->setFirstname('Yves');
		$user->setLastname('Lelong');
		$user->setEmail('yes@gmail.com');
		$user->setPwd('yes');
		$user->setCountry('fr');
		$user->save();

	}


	public function logoutAction(){

		$security = new Secu();
		if($security->isConnected()){
			echo "OK";
		}else{
			echo "NOK";
		}
		
	}


	

}