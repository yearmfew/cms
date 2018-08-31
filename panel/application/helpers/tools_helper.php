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
            $settings->company_name = "cms";
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


function upload_picture($file, $uploadPath, $width, $height, $name){

    $t = &get_instance();
    $t->load->library("simpleimagelib");

    if(!is_dir("{$uploadPath}/{$width}x{$height}")){
        mkdir("{$uploadPath}/{$width}x{$height}");
    }


    $upload_error = false;
    try {

        $simpleImage = $t->simpleimagelib->get_simple_image_instance();

        $simpleImage
        ->fromFile($file)
        ->thumbnail($width,$height,'center')
        ->toFile("{$uploadPath}/{$width}x{$height}/$name", null, 75);

    }catch(Exception $err) {
        $error =  $err->getMessage();
        $upload_error = true;
    }

    if($upload_error){
        echo $error;
    } else {
        return true;
    }


}

function get_picture($upload_folder = "", $picture_name = "", $resolution = "50x50"){

    if($picture_name != ""){

        if(file_exists(FCPATH . "uploads/$upload_folder/$resolution/$picture_name")){
            $picture_name = base_url("uploads/$upload_folder/$resolution/$picture_name");
        } else {
            $picture_name = base_url("assets/assets/images/default_image.png");

        }

    } else {

        $picture_name = base_url("assets/assets/images/default_image.png");

    }

    return $picture_name;

}

function get_page_list($page){

    $page_list = array(
        "home_v"                => "Anasayfa",
        "about_v"               => "Hakkımızda Sayfası",
        "news_list_v"           => "Haberler Sayfası",
        "galleries"             => "Galeri Sayfası",
        "portfolio_list_v"      => "Portfolyo Sayfası",
        "reference_list_v"      => "Referanslar Sayfası",
        "service_list_v"        => "Hizmetler Sayfası",
        "course_list_v"         => "Eğitimler Sayfası",
        "brand_list_v"          => "Markalar Sayfası",
        "contact_v"             => "İletişim Sayfası",
    );


    return (empty($page)) ? $page_list : $page_list[$page];
}

