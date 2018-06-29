<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public $viewFolder = "";

	public function __construct()
	{
		parent::__construct();

		$this->viewFolder = "product_v";

		$this->load->model("product_model");
	}
	public function index()
	{
		$viewData = new stdClass();


// veri tabanından verilerin getirilmesi
		$items = $this->product_model->get_all();

// view e gönderilecek değişkenlerin belirlenmesi

		$viewData ->viewFolder 		= $this->viewFolder;
		$viewData ->subViewFolder 	= "list";
		$viewData ->items 			= $items;

		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}


	public function new_form()
	{

		$viewData = new stdClass();
	// view e gönderilecek değişkenlerin belirlenmesi
		$viewData ->viewFolder 		= $this->viewFolder;
		$viewData ->subViewFolder 	= "add";


		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}


	public function save(){

		$this->load->library("form_validation");


        // bir formda olmasını istediğimiz kuralları form validation kütüphanesi ile belirleriz.
        // Kurallar yazilir..
		$this->form_validation->set_rules("title", "Başlık", "required|trim");

        // bu da hata mesajlarını düzenlememize yarayan metod. required alanı doldurulmamışsa bu mesajı bas diye 
        //düzenledik. aslında mesajlar ingilizce olarak gelir. biz ellemezsek ingilizce mesajları ekrana basar. 
		$this->form_validation->set_message(
			array(
				"required"  => "<b>{field}</b> alanı doldurulmalıdır"
			)
		);

        // Form Validation Calistirilir..
        // TRUE - FALSE
        // eğer yukarıdaki kurallara göre form doldurulmuş ise bu değişken 1 döner değilse 0 döner.
		$validate = $this->form_validation->run();

		if($validate){


			$insert = $this->product_model->add(
                array(
                    "title"         => $this->input->post("title"),
                    "description"   => $this->input->post("description"),
                    "url"           => convertToSEO($this->input->post("title")),
                    "rank"          => 0,
                    "isActive"      => 1,
                    "createdAt"     => date("Y-m-d H:i:s")
                )
            );

            if($insert){

                echo "kayit işlemi başarılıdır...";

            } else {

                echo "işlem başarısızdır";

            }

		} else {

			$viewData = new stdClass();

			/** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
			$viewData->viewFolder = $this->viewFolder;
			$viewData->subViewFolder = "add";
			$viewData->form_error = true;

			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
		}

        // Başarılı ise
            // Kayit işlemi baslar
        // Başarısız ise
            // Hata ekranda gösterilir...

	}





}

