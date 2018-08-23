<?php

function convertToSEO($text){

	$turkce  = array("ç", "Ç", "ğ", "Ğ", "ü", "Ü", "ö", "Ö", "ı", "İ", "ş", "Ş", ".", ",", "!", "'", "\"", " ", "?", "*", "_", "|", "=", "(", ")", "[", "]", "{", "}");
	$convert = array("c", "c", "g", "g", "u", "u", "o", "o", "i", "i", "s", "s", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-");

	return strtolower(str_replace($turkce, $convert, $text));

}


function get_active_user(){
	$t = &get_instance();

	$user = $t->session->userdata("user");

	if($user)
		return $user;
	else
		return false;
}

function get_readable_date($date){

	return strftime('%#d %B %Y', strtotime($date));

}


function get_settings(){

    $t = &get_instance();

    $t->load->model("settings_model");

    if($t->session->userdata("settings")){
        $settings = $t->session->userdata("settings");
    } else {

        $settings = $t->settings_model->get();

        if(!$settings) {

            $settings = new stdClass();
            $settings->company_name = "kablosuzkedi";
            $settings->logo         = "default";
            
        }

        $t->session->set_userdata("settings", $settings);

    }

    return $settings;

}

function get_category_title($category_id = 0){

    $t = get_instance();

    $t->load->model("portfolio_category_model");

    $category = $t->portfolio_category_model->get(

        array(
            "id" => $category_id
        )
    );

    if($category){
        return $category->title;
    }
    else{
        return "<b style='color:red'>Tanımlı Değil</b>";
    }

}

function send_email($toEmail = "", $subject = "", $message = ""){
    $t = & get_instance();

    $config = array(
        "protocol"  => "smtp",
        "smtp_host" => "ssl://smtp.gmail.com",
        "smtp_port" => "465",
        "smtp_user" => "calimero.gonder@gmail.com",
        "smtp_pass" => "5308673640.fb",
        "starttls"  => true,
        "charset"   => "utf-8",
        "mailtype"  => "html",
        "wordwrap"  => true,
        "newline"   => "\r\n"
    );

    $t->load->library('email', $config);
    $t->email->from("calimero.gonder@gmail.com", "CMS");
    $t->email->to($toEmail);
    $t->email->subject($subject);
    $t->email->message($message);

    return $t->email->send();   
}




