<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userop extends CI_Controller {

public $viewFolder ="";

public function __construct()
{
	parent::__construct();

	$this->viewFolder = "users_v";
	
}
 


public function login()
{
          $viewData = new stdClass();

         /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "login";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);  

}

	




}


