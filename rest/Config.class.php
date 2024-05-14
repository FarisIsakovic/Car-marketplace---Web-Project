<?php
class Config {
    public static function DB_HOST(){
        return 'localhost';
    }

    public static function DB_USERNAME(){
        return 'root';
    }

    public static function DB_PASSWORD(){
        return '123456';
    }
    public static function DB_PORT(){
        return "3306";
    }

    public static function DB_SCHEMA(){
        return 'carmarketplace';
    }

    public static function JWT_SECRET(){
        return 'ezcb9s8UcF';
    }

}
?>