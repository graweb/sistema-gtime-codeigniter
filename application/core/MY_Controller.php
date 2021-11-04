<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
		if(!isset($_SESSION['idusuario']) || !isset($_SESSION['logado'])) {
			redirect('login');
		}
	}
}