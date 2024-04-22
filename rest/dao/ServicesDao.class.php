<?php
require_once "BaseDao.class.php";
class ServiceDao extends BaseDao{
    public function __construct(){
        parent::__construct("services");
    }

    public function get_all(){
        return parent::get_all();
    }

}

?>