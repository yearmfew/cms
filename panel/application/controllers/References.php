<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class References extends CI_Controller {

	public $viewFolder = "";
	public $conrollerName = "";

	public function __construct()
	{
		parent::__construct();

		$this->viewFolder = "references_v";
		$this->controllerName = "references";
		$this->load->model("reference_model");

		if (!get_active_user()) {
			redirect(base_url("login"));
		}
	}
	public function index(){
		$viewData = new stdClass();
		// veri tabanından verilerin getirilmesi
		$items = $this->reference_model->get_all(
			array(), "rank ASC");

		// view e gönderilecek değişkenlerin belirlenmesi

		$viewData ->viewFolder 		= $this->viewFolder;
		$viewData ->subViewFolder 	= "list";
		$viewData ->items 			= $items;
		$viewData ->controllerName  =$this->controllerName;

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

        if($_FILES["img_url"]["name"] == ""){

            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Lütfen bir görsel seçiniz",
                "type"  => "error"
            );

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("references/new_form"));

            die();
        }

        $this->form_validation->set_rules("title", "Başlık", "required|trim");

        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if($validate){

            // Upload Süreci...

            $file_name = convertToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

            $config["allowed_types"] = "jpg|jpeg|png";
            $config["upload_path"]   = "uploads/$this->viewFolder/";
            $config["file_name"] = $file_name;

            $this->load->library("upload", $config);

            $upload = $this->upload->do_upload("img_url");

            if($upload){

                $uploaded_file = $this->upload->data("file_name");

                $insert = $this->reference_model->add(
                    array(
                        "title"         => $this->input->post("title"),
                        "description"   => $this->input->post("description"),
                        "url"           => convertToSEO($this->input->post("title")),
                        "img_url"       => $uploaded_file,
                        "rank"          => 0,
                        "isActive"      => 1,
                        "createdAt"     => date("Y-m-d H:i:s")
                    )
                );

                // TODO Alert sistemi eklenecek...
                if($insert){

                    $alert = array(
                        "title" => "İşlem Başarılı",
                        "text" => "Kayıt başarılı bir şekilde eklendi",
                        "type"  => "success"
                    );

                } else {

                    $alert = array(
                        "title" => "İşlem Başarısız",
                        "text" => "Kayıt Ekleme sırasında bir problem oluştu",
                        "type"  => "error"
                    );
                }

            } else {

                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Görsel yüklenirken bir problem oluştu",
                    "type"  => "error"
                );

                $this->session->set_flashdata("alert", $alert);

                redirect(base_url("references/new_form"));

                die();

            }

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("references"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }
	public function update_form($id){

		$viewData = new stdClass();

		/** Tablodan Verilerin Getirilmesi.. */
		$item = $this->reference_model->get(
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

        // Kurallar yazilir..

		$references_type = $this->input->post("references_type");

		if($references_type == "video"){

			$this->form_validation->set_rules("video_url", "Video URL", "required|trim");

		}

		$this->form_validation->set_rules("title", "Başlık", "required|trim");

		$this->form_validation->set_message(
			array(
				"required"  => "<b>{field}</b> alanı doldurulmalıdır"
			)
		);

        // Form Validation Calistirilir..
		$validate = $this->form_validation->run();

		if($validate){

			if($references_type == "image"){

                // Upload Süreci...


				if($_FILES["img_url"]["name"] !== "") {

					$file_name = convertToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

					$config["allowed_types"] = "jpg|jpeg|png";
					$config["upload_path"] = "uploads/$this->viewFolder/";
					$config["file_name"] = $file_name;

					$this->load->library("upload", $config);

					$upload = $this->upload->do_upload("img_url");

					if ($upload) {

						$uploaded_file = $this->upload->data("file_name");

						$data = array(
							"title" => $this->input->post("title"),
							"description" => $this->input->post("description"),
							"url" => convertToSEO($this->input->post("title")),
							"references_type" => $references_type,
							"img_url" => $uploaded_file,
							"video_url" => "#",
						);

					} else {

						$alert = array(
							"title" => "İşlem Başarısız",
							"text" => "Görsel yüklenirken bir problem oluştu",
							"type" => "error"
						);

						$this->session->set_flashdata("alert", $alert);

						redirect(base_url("references/update_form/$id"));

						die();

					}

				} else {

					$data = array(
						"title" => $this->input->post("title"),
						"description" => $this->input->post("description"),
						"url" => convertToSEO($this->input->post("title")),
					);

				}

			} else if($references_type == "video"){

				$data = array(
					"title"         => $this->input->post("title"),
					"description"   => $this->input->post("description"),
					"url"           => convertToSEO($this->input->post("title")),
					"references_type"     => $references_type,
					"img_url"       => "#",
					"video_url"     => $this->input->post("video_url")
				);

			}

			$update = $this->reference_model->update(array("id" => $id), $data);

            // TODO Alert sistemi eklenecek...
			if($update){

				$alert = array(
					"title" => "İşlem Başarılı",
					"text" => "Kayıt başarılı bir şekilde güncellendi",
					"type"  => "success"
				);

			} else {

				$alert = array(
					"title" => "İşlem Başarısız",
					"text" => "Kayıt Güncelleme sırasında bir problem oluştu",
					"type"  => "error"
				);
			}

            // İşlemin Sonucunu Session'a yazma işlemi...
			$this->session->set_flashdata("alert", $alert);

			redirect(base_url("references"));

		} else {

			$viewData = new stdClass();

			/** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
			$viewData->viewFolder = $this->viewFolder;
			$viewData->subViewFolder = "update";
			$viewData->form_error = true;
			$viewData->references_type = $references_type;

			/** Tablodan Verilerin Getirilmesi.. */
			$viewData->item = $this->reference_model->get(
				array(
					"id"    => $id,
				)
			);

			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
		}

	}

	public function update_($id){

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


			$update = $this->reference_model->update(
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

			redirect(base_url("references"));

		} else {

			$viewData = new stdClass();


			/** Tablodan Verilerin Getirilmesi.. */
			$item = $this->reference_model->get(
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

		$delete = $this->reference_model->delete(
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

		redirect(base_url("references"));

	}

	public function isActiveSetter($id)
	{
		if($id){
			$isActive = ($this->input->post("data") === "true") ? 1 : 0;

			$this->reference_model->update(array(
				"id"  => $id
			),
			array(
				"isActive"  => $isActive
			)
		);

		}
	}


	public function rankSetter(){
		$data = $this->input->post("data");
		parse_str($data, $order);
		$items = $order["ord"];
		foreach ($items as $rank => $id){
			$this->reference_model->update(
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



}

