<?php
require_once 'BaseService.php';
require_once __DIR__."/../dao/ServicesDao.class.php";
class ServiceService extends BaseService{
    public function __construct(){
        parent::__construct(new ServiceDao());
    }

    public function add($entity){
        return parent::add($entity);
    }
    
}
?>