<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_image_model extends CI_Model {

public $tableName = "product_images";

public function __construct()
{
	parent::__construct();
	
}

/* bu fonksiyonlarda bir değişken verip ona göre veri çekmek yerine bir array veriyoruz.
 bu arrayin özelliklerini tanımlıyoruz controller da. bu bizim yapımızı daha esnek yapıyor.
 örneğin bir tablodaki verilerin hepsini al ama durumu pasif olanları alma ya da
 bir başka özelliğine göre eleme yap demek istersek bunu yolladığımız arrrayde görüyoruz.
Burdaki olayı daha iyi anlamak için fonksiyonun kullanıldığı pruduct controllerinde update_form metoduna bak.*/
    public function get($where = array()){
        return $this->db->where($where)->get($this->tableName)->row();
    }

    /** Tüm Kayıtları bana getirecek olan metot.. */
    public function get_all($where = array(), $order = "id ASC"){

        return $this->db->where($where)->order_by($order)->get($this->tableName)->result();

    }

 public function add($data = array()){

        return $this->db->insert($this->tableName, $data);

    }

public function update($where = array(), $data=array())
{
    return $this->db->where($where)->update($this->tableName, $data);
}

public function delete($where = array())
{
    return $this->db->where($where)->delete($this->tableName);
}


}
