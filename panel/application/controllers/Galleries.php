<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galleries extends CI_Controller {

	public $viewFolder = "";

	public function __construct()
	{
		parent::__construct();

		$this->viewFolder = "galleries_v";
		$this->load->model("gallery_model");
		$this->load->model("image_model");
		$this->load->model("video_model");
		$this->load->model("file_model");

		if (!get_active_user()) {
			redirect(base_url("login"));
		}
	}
	public function index()
	{
		$viewData = new stdClass();
		// veri tabanından verilerin getirilmesi
		$items = $this->gallery_model->get_all(
			array(), "rank ASC");

		// view e gönderilecek değişkenlerin belirlenmesi

		$viewData ->viewFolder 		= $this->viewFolder;
		$viewData ->subViewFolder 	= "list";
		$viewData ->items 			= $items;

		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}


	public function new_form(){

		$viewData = new stdClass();
		// view e gönderilecek değişkenlerin belirlenmesi
		$viewData ->viewFolder 		= $this->viewFolder;
		$viewData ->subViewFolder 	= "add";


		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}


	public function save(){

		$this->load->library("form_validation");

        // Kurallar yazilir..
		$this->form_validation->set_rules("title", "Başlık", "required|trim");

		$this->form_validation->set_message(
			array(
				"required"  => "<b>{field}</b> alanı doldurulmalıdır"
			)
		);
        // Form Validation Calistirilir..
        // TRUE - FALSE
		$validate = $this->form_validation->run();

		if($validate){

			$gallery_type = $this->input->post("gallery_type");
			$path ="uploads/$this->viewFolder/";
			$folder_name ="";

			if($gallery_type == "image"){
				$folder_name = convertToSEO($this->input->post("title"));
				$path ="$path/images/$folder_name";

			} else if($gallery_type == "file"){

				$folder_name = convertToSEO($this->input->post("title"));
				$path ="$path/files/$folder_name";

			}

			if ($gallery_type != "video") {
				if(!mkdir($path, 0755)){

					$alert = array(
						"title" => "ooppss",
						"text" => "Galeri oluşturulurken problem oluştu..",
						"type"  => "error"
					);		
					$this->session->set_flashdata("alert", $alert);

					redirect(base_url("galleries"));
					die();
				}
			}

			$insert = $this->gallery_model->add(
				array(
					"title"         => $this->input->post("title"),
					"gallery_type"  => $this->input->post("gallery_type"),
					"url"           => convertToSEO($this->input->post("title")),
					"folder_name"   => $folder_name,
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

			redirect(base_url("galleries"));

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
		$item = $this->gallery_model->get(
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

	public function update($id, $gallery_type, $oldFolderName=""){

		$this->load->library("form_validation");
		$this->form_validation->set_rules("title", "Başlık", "required|trim");
		$this->form_validation->set_message(
			array(
				"required"  => "<b>{field}</b> alanı doldurulmalıdır"
			)
		);

        // Form Validation Calistirilir..
		$validate = $this->form_validation->run();

		if($validate){
			$path ="uploads/$this->viewFolder/";
			$folder_name ="";

			if($gallery_type == "image"){
				$folder_name = convertToSEO($this->input->post("title"));
				$path ="$path/images";

			} else if($gallery_type == "file"){

				$folder_name = convertToSEO($this->input->post("title"));
				$path ="$path/files";

			}

			if ($gallery_type != "video") {
				if(!rename("$path/$oldFolderName", "$path/$folder_name")){

					$alert = array(
						"title" => "ooppss",
						"text" => "Galeri oluşturulurken problem oluştu..",
						"type"  => "error"
					);		
					$this->session->set_flashdata("alert", $alert);

					redirect(base_url("galleries")); 
					die();
				}
			}

			$update = $this->gallery_model->update(
				array(
					"id"  => $id
				),

				array(
					"title"         => $this->input->post("title"),
					"folder_name"   => $folder_name,
					"url"           => convertToSEO($this->input->post("title")),

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
			redirect(base_url("galleries"));

		} else {

			$viewData = new stdClass();

			/** Tablodan Verilerin Getirilmesi.. */
			$item = $this->gallery_model->get(
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

	public function delete($id){


		$gallery = $this->gallery_model->get(
			array(
				"id"    => $id
			)
		);

		if($gallery){


			if($gallery->gallery_type != "video"){

				if($gallery->gallery_type == "image")
					$path = "uploads/$this->viewFolder/images/$gallery->folder_name";
				else if($gallery->gallery_type == "file")
					$path = "uploads/$this->viewFolder/files/$gallery->folder_name";

				$delete_folder = rmdir($path);

				if(!$delete_folder){

					$alert = array(
						"title" => "İşlem Başarısız",
						"text" => "Kayıt silme sırasında bir problem oluştu",
						"type"  => "error"
					);

					$this->session->set_flashdata("alert", $alert);
					redirect(base_url("galleries"));

					die();
				}

			}

			$delete = $this->gallery_model->delete(
				array(
					"id"    => $id
				)
			);

            // TODO Alert Sistemi Eklenecek...
			if($delete){

				$alert = array(
					"title" => "İşlem Başarılı",
					"text" => "Kayıt başarılı bir şekilde silindi",
					"type"  => "success"
				);

			} else {

				$alert = array(
					"title" => "İşlem Başarısız",
					"text" => "Kayıt silme sırasında bir problem oluştu",
					"type"  => "error"
				);


			}

			$this->session->set_flashdata("alert", $alert);
			redirect(base_url("galleries"));

		}
	}
	public function isActiveSetter($id)
	{
		if($id){
			$isActive = ($this->input->post("data") === "true") ? 1 : 0;

			$this->gallery_model->update(array(
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

			$this->galleries_image_model->update(array(
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
			$this->galleries_image_model->update(array(
				"id"		  => $id,
				"galleries_id"  => $parent_id
			),
			array(
				"isCover"  => $isCover
			)
		);
			// Kapak yapılmayan diğer kayıtlar
			$this->galleries_image_model->update(array(
				"id !="		  => $id,
				"galleries_id"  => $parent_id
			),
			array(
				"isCover"  => 0
			)
		);

			$viewData = new stdClass();

			/** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
			$viewData->viewFolder = $this->viewFolder;
			$viewData->subViewFolder = "image";

			$viewData->item_images = $this->galleries_image_model->get_all(
				array(
					"galleries_id"    => $parent_id
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
			$this->gallery_model->update(
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

			$this->galleries_image_model->update(
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


	public function upload_form($id){

		$viewData = new stdClass();

		// tablodan verilerin getirilmesi
		$item = $this->gallery_model->get(
			array(
				"id"    => $id,
			)
		);
		switch ($item->gallery_type){
			case 'image':

			$viewData->items = $this->image_model->get_all(
				array(
					"gallery_id" => $id
				), "rank ASC"
			);

			$viewData->name="resimleri";
			break;
			case 'file':

			$viewData->items = $this->file_model->get_all(
				array(
					"gallery_id" => $id
				), "rank ASC"
			);

			$viewData->name="dosyaları";
			break;
			case 'video':
			
			$viewData->items = $this->video_model->get_all(
				array(
					"gallery_id" => $id
				), "rank ASC"
			);
			$viewData->name="videoları";
			break;

			default: 
			
			break;
		}





		/** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = "image";
		$viewData->item=$item;

		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}

	public function file_upload($id){

		$file_name = convertToSEO(pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME)) .
		"." . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

		$config["allowed_types"] 	= "jpg|jpeg|png";
		$config["upload_path"]   	= "uploads/$this->viewFolder/";
		$config["file_name"]        = $file_name;

		$this->load->library("upload", $config);

		$upload = $this->upload->do_upload("file");

		if($upload){

			$uploaded_file = $this->upload->data("file_name");

			$this->galleries_image_model->add(
				array(
					"img_url"		=>$uploaded_file,
					"rank"			=>0,
					"isActive"		=>1,
					"createdAt"		=>date("Y-m-d H:i:s"),
					"galleries_id"	=>$id
				)
			);


		}else{
			echo "işlem başarısız";
		}
	}



	public function refresh_file_list($id){

		$viewData = new stdClass();

		/** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = "image";

		$viewData->item_images = $this->galleries_image_model->get_all(
			array(
				"galleries_id"    => $id
			)
		);

		$render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);

		echo $render_html;

	}

	public function imageDelete($id, $parent_id)
	{

		$fileName = $this->galleries_image_model->get(
			array(
				"id"    => $id
			)
		);


		$delete = $this->galleries_image_model->delete(
			array(
				"id" => $id,
			)
		);



		if ($delete) {

			unlink("uploads/{$this->viewFolder}/$fileName->img_url");

			redirect(base_url("galleries/image_form/$parent_id"));

		}else {

			redirect(base_url("galleries/image_form/$parent_id"));

		}

	}







}

