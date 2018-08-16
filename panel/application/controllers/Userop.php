<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userop extends CI_Controller {

	public $viewFolder ="";

	public function __construct()
	{
		parent::__construct();

		$this->viewFolder = "users_v";
		$this->load->model("user_model");

	}



	public function login(){

		if (get_active_user()) {
			redirect(base_url());
		}

		$viewData = new stdClass();
		$this->load->library("form_validation");

		/** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = "login";

		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);  
	}

	public function do_login(){
		if (get_active_user()) {
			redirect(base_url("login"));
		}
		$this->load->library("form_validation");

        // Kurallar yazilir..

		$this->form_validation->set_rules("user_email", "E-mail", "required|trim|valid_email");
		$this->form_validation->set_rules("user_password", "Şifre", "required|trim|min_length[6]|max_length[8]");

		$this->form_validation->set_message(
			array(
				"required"      =>"<b>{field}</b> alanı doldurulmalıdır",
				"valid_email"   =>"lütfen geçerli bir E-posta adresi giriniz",
				"min_length"    =>"<b>{field}</b> 6 karakterden az olmamalıdır",
				"max_length"    =>"<b>{field}</b> 8 karakterden fazla olmamalıdır"

			)
		);

        // Form Validation Calistirilir..
		$validate = $this->form_validation->run();


		if($validate) {

			$user = $this->user_model->get(
				array(
					"email" 	=>$this->input->post("user_email"),
					"password" 	=>md5($this->input->post("user_password")),
					"isActive"	=>1
				));

			if($user){

				$alert = array(
					"title" => "Hoşgeldiniz",
					"text" 	=> "$user->full_name ..",
					"type"  => "success"
				);

				$this->session->set_userdata("user", $user);
				$this->session->set_flashdata("alert", $alert);

				redirect(base_url());
			} else{
				$alert = array(
					"title" => "Hata",
					"text" 	=> "Hatalı şifre veya email girişi",
					"type"  => "error"
				);

				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("login"));
			}



		} else{
			
			$viewData = new stdClass();
			/** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
			$viewData->viewFolder = $this->viewFolder;
			$viewData->subViewFolder = "login";
			$viewData->form_error = true;


			$alert = array(
				"title" => "Hata",
				"text" 	=> "Hatalı şifre veya email girişi...",
				"type"  => "error"
			);

			$this->session->set_flashdata("alert", $alert);

			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


		}
	}

	public function logout(){

		$this->session->unset_userdata("user");
		redirect(base_url("login"));
	}

	public function send_email(){

		$config = array(

			"protocol"	=> "smtp",
			"smtp_host" => "ssl://smtp.gmail.com",
			"smtp_port" => "465",
			"smtp_user" => "eniacyazilim@gmail.com",
			"smtp_pass" => "eniac.123",
			"starttls"  => true,
			"charset"	=> "utf-8",
			"mailtype"  => "html",
			"wordwrap"  => true,
			"newline"   => "\r\n"



		);


		$this->load->library('email', $config);

		$this->email->from("eniacyazilim@gmail.com", "CMS");
		$this->email->to("brlylmz23@gmail.com");
		$this->email->subject("CMS için email denemeleri");
		$this->email->message("deneme email postası...");

		$send =	$this->email->send();	

		if($send){ 
			echo "E-posta başarılı bir şekilde gönderildi";
		} else {

			echo $this->email->print_debugger();
		}


	}





}


