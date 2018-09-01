<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_pass extends CI_Controller {

	public $viewFolder ="";

	public function __construct()
	{
		parent::__construct();

		$this->viewFolder = "users_v";
		$this->load->model("user_model");

	}




	public function forget_password(){


		$viewData = new stdClass();

		/** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = "forget_password";

		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

	}


	public function rePassword(){

		$this->load->library("form_validation");

        // Kurallar yazilir..

		$this->form_validation->set_rules("email", "E-mail", "required|trim|valid_email");
		
		$this->form_validation->set_message(
			array(
				"required"      =>"<b>{field}</b> alanı doldurulmalıdır",
				"valid_email"   =>"lütfen geçerli bir E-posta adresi giriniz"
			)
		);

        // Form Validation Calistirilir..
		if($this->form_validation->run() === FALSE){
			$viewData = new stdClass();
			/** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
			$viewData->viewFolder = $this->viewFolder;
			$viewData->subViewFolder = "forget_password";
			$viewData->form_error = true;

			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
		} else{

			$user = $this->user_model->get( array(

				"isActive" =>1,
				"email" => $this->input->post("email")
			)
		);

			if($user){
				
				$link = base_url("change_pass/rePassword_form/$user->id");
				$send = send_email($user->email, "Şifremi Unuttum", "Yeni şifre oluşturmak için <b>{$link}</b>'e tıklayınız.");

				if($send){ 

					$alert = array(
						"title" => "Tebrikler",
						"text" 	=> "Şifre değiştirmek için lütfen e postanızı kontrol ediniz...",
						"type"  => "success"
					);

					$this->session->set_flashdata("alert", $alert);
					redirect(base_url("login"));
					die();

				} else {

				//	echo $this->email->print_debugger();

					$alert = array(
						"title" => "Hata",
						"text" 	=> "E-posta Gönderilemedi...",
						"type"  => "error"
					);

					$this->session->set_flashdata("alert", $alert);
					redirect(base_url("sifremi-unuttum"));
					die();

				}





			} else{
				$alert = array(
					"title" => "Hata",
					"text" 	=> "Böyle bir kullanıcı bulunamadı",
					"type"  => "error"
				);

				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("sifremi-unuttum"));

			}

		} 

	}


	public function rePassword_form($id)
	{
		
		$viewData = new stdClass();

		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = "change_password";

		$viewData->item = $this->user_model->get(
			array(
				"id"  => $id
			)
		);

		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData );


	}

    public function update_forgatten_password($id){

        $this->load->library("form_validation");

        $this->form_validation->set_rules("password", "Şifre", "required|trim|min_length[6]|max_length[8]");
        $this->form_validation->set_rules("re_password", "Şifre Tekrar", "required|trim|min_length[6]|max_length[8]|matches[password]");
        $this->form_validation->set_message(
            array(
                "required"      =>"<b>{field}</b> alanı doldurulmalıdır",        
                "matches"       =>"<b>{field}</b> girdiğiniz şifreler birbiri ile uyuşmuyor",
                "min_length"    =>"Şifreniz 6 karakterden az olmamalıdır",
                "max_length"    =>"Şifreniz 8 karakterden fazla olmamalıdır"
            )
        );
        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if($validate){
            $insert = $this->user_model->update(array("id" => $id),
                array(
                    "password"     => md5($this->input->post("password")),                  
                )
            );
            if($insert){
                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text" => "Şifreniz başarılı bir şekilde güncellendi",
                    "type"  => "success"
                );
            } else {

                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Güncelleme sırasında bir problem oluştu",
                    "type"  => "error"
                );
            }


            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("users"));
            die();
        }  else {
            
            $viewData = new stdClass();
            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "change_password";
            $viewData->form_error = true;
            $viewData->item = $this->user_model->get(
                array(
                    "id"    => $id,
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }


}


