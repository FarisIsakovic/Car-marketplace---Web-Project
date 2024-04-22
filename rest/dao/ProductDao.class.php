<?php
require_once "BaseDao.class.php";
class ProductDao extends BaseDao{
    public function __construct(){
        parent::__construct("products");
    }

    public function get_all(){
        return parent::get_all();
    }

    public function get_latest(){
        return parent::query("SELECT * FROM products ORDER BY id DESC LIMIT 4", []);
    }

    public function featured_products(){
        return parent::query("SELECT * FROM products ORDER BY RAND() LIMIT 4", []);
    }

    public function order_asc(){
        return parent::query("SELECT * FROM products ORDER BY product_price ASC", []);
    }

    public function order_desc(){
        return parent::query("SELECT * FROM products ORDER BY product_price DESC", []);
    }

}

?>