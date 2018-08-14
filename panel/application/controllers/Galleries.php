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

	public function new_gallery_video_form($id){

		$viewData = new stdClass();
		// view e gönderilecek değişkenlerin belirlenmesi
		$viewData ->gallery_id 		= $id;
		$viewData ->viewFolder 		= $this->viewFolder;
		$viewData ->subViewFolder 	= "video/add";


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

	public function gallery_video_save($id){

		$this->load->library("form_validation");

        // Kurallar yazilir..
		$this->form_validation->set_rules("title", "Video Adı", "required|trim");
		$this->form_validation->set_rules("url", "Video Url", "required|trim");

		$this->form_validation->set_message(
			array(
				"required"  => "<b>{field}</b> alanı doldurulmalıdır"
			)
		);
        // Form Validation Calistirilir..
        // TRUE - FALSE
		$validate = $this->form_validation->run();

		if($validate){

			$insert = $this->video_model->add(
				array(
					"title"         => $this->input->post("title"),
					"url"           => $this->input->post("url"),
					"gallery_id"	=> $id,
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

			redirect(base_url("galleries/upload_form/$id"));

		} else {

			$viewData = new stdClass();

			/** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
			$viewData->viewFolder = $this->viewFolder;
			$viewData->subViewFolder = "video/add";
			$viewData->form_error = true;
			$viewData->gallery_id = $id;

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
	public function isActiveSetter($id){
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

	public function fileIsActiveSetter($id, $gallery_type){



		if($id && $gallery_type){
			switch ($gallery_type) {
				case 'image':
				$modelName = "image_model";
				break;


				case 'file':
				$modelName = "file_model";
				break;
				default:
				# code...
				break;
			}



			$isActive = ($this->input->post("data") === "true") ? 1 : 0;

			$this->$modelName->update(array(
				"id"  => $id
			),
			array(
				"isActive"  => $isActive
			)
		);

		}
	}

	public function fileRankSetter($gallery_type){

		switch ($gallery_type) {
			case 'image':
			$modelName = "image_model";
			break;


			case 'file':
			$modelName = "file_model";
			break;
			default:
		# code...
			break;
		}

		$data = $this->input->post("data");

		parse_str($data, $order);

		$items = $order["ord"];

		foreach ($items as $rank => $id){

			$this->$modelName->update(
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
			$viewData->subViewFolder = "image";
			break;
			case 'file':

			$viewData->items = $this->file_model->get_all(
				array(
					"gallery_id" => $id
				), "rank ASC"
			);

			$viewData->name="dosyaları";
			$viewData->subViewFolder = "image";
			break;
			case 'video':
			
			$viewData->items = $this->video_model->get_all(
				array(
					"gallery_id" => $id
				), "rank ASC"
			);
			$viewData->name="videoları";
			$viewData->subViewFolder = "video/list";
			break;

			default: 
			
			break;
		}

		/** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
		$viewData->viewFolder = $this->viewFolder;
		$viewData->item=$item;
		$viewData->gallery_type = $item->gallery_type;

		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}

	public function file_upload($gallery_id, $gallery_type, $folderName){

		switch ($gallery_type) {
			case 'image':
			$path="uploads/$this->viewFolder/images/$folderName/";
			$modelName = "image_model";	
			$allowedTypes="jpg|jpeg|png";
			break;
			case 'file':
			$path="uploads/$this->viewFolder/files/$folderName/";	
			$modelName = "file_model";
			$allowedTypes="pdf|doc|docx|txt";
			break;
			default:

			break;
		}

		$file_name = convertToSEO(pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

		$config["allowed_types"] = $allowedTypes;
		$config["upload_path"]   = $path;
		$config["file_name"]     = $file_name;

		$this->load->library("upload", $config);

		$upload = $this->upload->do_upload("file");

		if($upload){

			$uploaded_file = $this->upload->data("file_name");

			$this->$modelName->add(
				array(
					"url"           => "{$config["upload_path"]}$uploaded_file",
					"rank"          => 0,
					"isActive"      => 1,
					"createdAt"     => date("Y-m-d H:i:s"),
					"title"			=> $file_name,
					"gallery_id"    => $gallery_id
				)
			);

		} else {
			echo "islem basarisiz";
		}
	}

	public function refresh_file_list($gallery_id, $gallery_type){

		$viewData = new stdClass();

		/** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = "image";

		$modelName = ($gallery_type == "image") ? "image_model" : "file_model";

		$viewData->items = $this->$modelName->get_all(
			array(
				"gallery_id"    => $gallery_id
			)
		);

		$viewData->gallery_type = $gallery_type;

		$render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/file_list_v", $viewData, true);

		echo $render_html;
	}

	public function fileDelete($id, $gallery_id, $gallery_type){

		switch ($gallery_type) {
			case 'image':
			$modelName = "image_model";
			break;
			
			case 'file':
			$modelName = "file_model";

			break;
			default:
				# code...
			break;
		}


		$fileName = $this->$modelName->get(
			array(
				"id"    => $id
			)
		);


		$delete = $this->$modelName->delete(
			array(
				"id" => $id,
			)
		);



		if ($delete) {

			unlink("$fileName->url");

			redirect(base_url("galleries/upload_form/$gallery_id"));

		}else {

			redirect(base_url("galleries/upload_form/$gallery_id"));

		}
	}







}

