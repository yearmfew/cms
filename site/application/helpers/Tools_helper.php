<?php

function get_product_cover_image($product_id){

    $t = &get_instance();

    $t->load->model("product_image_model");

    $cover_image = $t->product_image_model->get(
        array(
            "isCover"       => 1,
            "product_id"    => $product_id
        )
    );

    if(empty($cover_image)){

        $cover_image = $t->product_image_model->get(
            array(
                "product_id"    => $product_id
            )
        );

    }

    return !empty($cover_image) ? $cover_image->img_url : "";

}


function get_readable_date($date){

    setlocale(LC_ALL, 'tr_TR.UTF-8');
    return strftime('%#d %B %Y', strtotime($date));
}

function get_portfolio_category_title($id){

    $t = &get_instance();

    $t->load->model("portfolio_category_model");

    $portfolio = $t->portfolio_category_model->get(
        array(
            "id"    => $id

        )
    );

    return (empty($portfolio)) ? false : $portfolio->title;


}

function get_portfolio_cover_image($id){

    $t = &get_instance();

    $t->load->model("portfolio_image_model");

    $cover_image = $t->portfolio_image_model->get(
        array(
            "isCover"       => 1,
            "portfolio_id"    => $id
        )
    );

    if(empty($cover_image)){

        $cover_image = $t->portfolio_image_model->get(
            array(
                "portfolio_id"    => $id
            )
        );

    }

    return !empty($cover_image) ? $cover_image->img_url : "";

}

function get_settings(){

    $t = &get_instance();

//    $settings = $t->session->userdata("settings");

//    if(empty($settings)){

        $t->load->model("settings_model");

        $settings = $t->settings_model->get();

        $t->session->set_userdata("settings", $settings);
//    }

    return $settings;
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


