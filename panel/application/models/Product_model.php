<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

public $tableName = "products";

public function __construct()
{
	parent::__construct();
	
}


// tüm kayıtları getirecek olan metod
public function get_all()
{
	return $this->db->get($this->tableName)->result();
	
}






}
