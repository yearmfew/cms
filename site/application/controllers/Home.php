<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public $viewFolder = "";


	public function __construct(){
		parent::__construct();
		$this->viewFolder = "homepage";
	}




	public function index(){
		// Anasayfa
		echo $this->viewFolder;
		
	}

	public function product_list(){

		$this->load->helper("text");
		$this->load->model("product_model");
		
		$viewData = new stdClass();
		$viewData->viewFolder = "product_list_v";
		
		$viewData->products = $this->product_model->get_all(
			array(
				"isActive"  => 1
			), "rank ASC"
		);


		echo get_product_cover_image(35); die();

		$this->load->view($viewData->viewFolder, $viewData);

	}


}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */