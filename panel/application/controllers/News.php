<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

	public $viewFolder = "";
	public $conrollerName = "";

	public function __construct()
	{
		parent::__construct();

		$this->viewFolder = "news_v";
		$this->controllerName = "news";
		$this->load->model("news_model");
	}
	public function index()
	{
		$viewData = new stdClass();
// veri tabanından verilerin getirilmesi
		$items = $this->news_model->get_all(
			array(), "rank ASC");

// view e gönderilecek değişkenlerin belirlenmesi

		$viewData ->viewFolder 		= $this->viewFolder;
		$viewData ->subViewFolder 	= "list";
		$viewData ->items 			= $items;
		$viewData ->controllerName  =$this->controllerName;

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

        // Kurallar yazilir..

		$news_type = $this->input->post("news_type");

		if($news_type == "image"){ 
			if($_FILES["img_url"]["name"] == ""){
		$alert = array(
					"title" => "Uppss!",
					"text" => "Resim eklemeyi unuttunuz",
					"type"  => "error"
				);
		      // İşlemin Sonucunu Session'a yazma işlemi...
			$this->session->set_flashdata("alert", $alert);

			redirect(base_url("news/new_form")); die();
			}

      
		

		} else if($news_type == "video"){

			echo "video seçildi";

		}

		die();
		$this->form_validation->set_rules("title", "Başlık", "required|trim");

		$this->form_validation->set_message(
			array(
				"required"  => "<b>{field}</b> alanı doldurulmalıdır"
			)
		);

        // Form Validation Calistirilir..
        // TRUE - FALSE
		$validate = $this->form_validation->run();

        // Monitör Askısı
        // monitor-askisi

		if($validate){

			$insert = $this->news_model->add(
				array(
					"title"         => $this->input->post("title"),
					"description"   => $this->input->post("description"),
					"url"           => convertToSEO($this->input->post("title")),
					"news_type"  	=> 0,
					"img_url"		=>"null",
					"video_url"		=>"null",
					"rank"          => 0,
					"isActive"      => 1,
					"createdAt"     => date("Y-m-d H:i:s")
				)
			);

            // TODO Alert sistemi eklenecek...
			if($insert){

				$alert = array(
					"title" => "Tebrikler...",
					"text" => "İşleminiz başarılı",
					"type"  => "success"
				);

			} else {

				$alert = array(
					"title" => "ooppss",
					"text" => "Bir sorun oluştu",
					"type"  => "error"
				);
			}

            // İşlemin Sonucunu Session'a yazma işlemi...
			$this->session->set_flashdata("alert", $alert);

			redirect(base_url("news"));

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
	public function update_form($id){

		$viewData = new stdClass();

		/** Tablodan Verilerin Getirilmesi.. */
		$item = $this->news_model->get(
			array(
				"id"    => $id,
			)
		);

		/** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = "update";
		$viewData->item = $item;

		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


	}

	public function update($id){

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


			$update = $this->news_model->update(
				array(
					"id"  => $id
				),

				array(
					"title"         => $this->input->post("title"),
					"description"   => $this->input->post("description"),
					"img_url"       => convertToSEO($this->input->post("title")),
					"video_url"     => convertToSEO($this->input->post("title")),
					

				)
			);

			if($update){

				$alert = array(
					"title" => "Tebrikler...",
					"text" => "İşleminiz başarılı",
					"type"  => "success"
				);

			} else {

				$alert = array(
					"title" => "ooppss",
					"text" => "Bir sorun oluştu",
					"type"  => "error"
				);
			}

            // İşlemin Sonucunu Session'a yazma işlemi...
			$this->session->set_flashdata("alert", $alert);

			redirect(base_url("news"));

		} else {

			$viewData = new stdClass();


			/** Tablodan Verilerin Getirilmesi.. */
			$item = $this->news_model->get(
				array(
					"id"    => $id,
				)
			);

			/** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
			$viewData->viewFolder = $this->viewFolder;
			$viewData->subViewFolder = "add";
			$viewData->form_error = true;
			$viewData->item = $item;

			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
		}

        // Başarılı ise
            // Kayit işlemi baslar
        // Başarısız ise
            // Hata ekranda gösterilir...

	}

	public function delete($id)
	{

		$delete = $this->news_model->delete(
			array(
				"id" => $id,
			)
		);


		if($delete){

			$alert = array(
				"title" => "Tebrikler...",
				"text" => "İşleminiz başarılı",
				"type"  => "success"
			);

		} else {

			$alert = array(
				"title" => "ooppss",
				"text" => "Bir sorun oluştu",
				"type"  => "error"
			);
		}

            // İşlemin Sonucunu Session'a yazma işlemi...
		$this->session->set_flashdata("alert", $alert);

		redirect(base_url("news"));

	}

	public function isActiveSetter($id)
	{
		if($id){
			$isActive = ($this->input->post("data") === "true") ? 1 : 0;

			$this->news_model->update(array(
				"id"  => $id
			),
			array(
				"isActive"  => $isActive
			)
		);

		}
	}

	public function imageIsActiveSetter($id)
	{
		if($id){
			$isActive = ($this->input->post("data") === "true") ? 1 : 0;

			$this->news_image_model->update(array(
				"id"  => $id
			),
			array(
				"isActive"  => $isActive
			)
		);

		}
	}


	public function isCoverSetter($id, $parent_id)
	{
		if($id && $parent_id){
			$isCover = ($this->input->post("data") === "true") ? 1 : 0;

			// Kapak yapılmak istenen kayıt
			$this->product_image_model->update(array(
				"id"		  => $id,
				"product_id"  => $parent_id
			),
			array(
				"isCover"  => $isCover
			)
		);
			// Kapak yapılmayan diğer kayıtlar
			$this->product_image_model->update(array(
				"id !="		  => $id,
				"product_id"  => $parent_id
			),
			array(
				"isCover"  => 0
			)
		);

			$viewData = new stdClass();

			/** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
			$viewData->viewFolder = $this->viewFolder;
			$viewData->subViewFolder = "image";

			$viewData->item_images = $this->product_image_model->get_all(
				array(
					"product_id"    => $parent_id
				), "rank ASC"
			);

			$render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);

			echo $render_html;

		}
	}






	public function rankSetter(){
		$data = $this->input->post("data");
		parse_str($data, $order);
		$items = $order["ord"];
		foreach ($items as $rank => $id){
			$this->news_model->update(
				array(
					"id"        => $id,
					"rank !="   => $rank
				),
				array(
					"rank"      => $rank
				)
			);
		}
	}


	public function imageRankSetter(){


		$data = $this->input->post("data");

		parse_str($data, $order);

		$items = $order["ord"];

		foreach ($items as $rank => $id){

			$this->product_image_model->update(
				array(
					"id"        => $id,
					"rank !="   => $rank
				),
				array(
					"rank"      => $rank
				)
			);

		}

	}


	public function image_form($id){

		$viewData = new stdClass();

// tablodan verilerin getirilmesi
		$item = $this->news_model->get(
			array(
				"id"    => $id,
			)
		);

		/** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = "image";
		$viewData->item=$item;
		$viewData->item_images = $this->product_image_model->get_all(
			array(
				"product_id" => $id
			), "rank ASC"
		);

		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


	}

	public function image_upload($id)
	{   $file_name = convertToSEO(pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME)) .
	"." . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

	$config["allowed_types"] 	= "jpg|jpeg|png";
	$config["upload_path"]   	= "uploads/$this->viewFolder/";
	$config["file_name"]        = $file_name;

	$this->load->library("upload", $config);

	$upload = $this->upload->do_upload("file");

	if($upload){

		$uploaded_file = $this->upload->data("file_name");

		$this->product_image_model->add(
			array(
				"img_url"		=>$uploaded_file,
				"rank"			=>0,
				"isActive"		=>1,
				"createdAt"		=>date("Y-m-d H:i:s"),
				"product_id"	=>$id
			)
		);


	}else{
		echo "işlem başarısız";
	}
}



public function refresh_image_list($id){

	$viewData = new stdClass();

	/** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
	$viewData->viewFolder = $this->viewFolder;
	$viewData->subViewFolder = "image";

	$viewData->item_images = $this->product_image_model->get_all(
		array(
			"product_id"    => $id
		)
	);

	$render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);

	echo $render_html;

}

public function imageDelete($id, $parent_id)
{

	$fileName = $this->product_image_model->get(
		array(
			"id"    => $id
		)
	);


	$delete = $this->product_image_model->delete(
		array(
			"id" => $id,
		)
	);

	

	if ($delete) {

		unlink("uploads/{$this->viewFolder}/$fileName->img_url");

		redirect(base_url("product/image_form/$parent_id"));

	}else {

		redirect(base_url("product/image_form/$parent_id"));

	}
	
}







}

