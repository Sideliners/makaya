<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['sitename'] = 'Makaya';
$config['datetime'] = 'Y-m-d H:i:s';

switch ($_SERVER['HTTP_HOST']){
    case 'localhost':
        $config['image_product_path'] = 'http://localhost/mkyrrhadmin/uploads/images/products/';
        $config['image_article_path'] = 'http://localhost/mkyrrhadmin/uploads/images/articles/';
        $config['image_artisan_path'] = 'http://localhost/mkyrrhadmin/uploads/images/artisans/';
        $config['image_enterprise_path'] = 'http://localhost/mkyrrhadmin/uploads/images/enterprises/';
    break;

    default:
        $config['image_product_path'] = 'http://mkyrrhadmin.wearemakaya.com/uploads/images/products/';
        $config['image_article_path'] = 'hhttp://mkyrrhadmin.wearemakaya.com/uploads/images/articles/';
        $config['image_artisan_path'] = 'http://mkyrrhadmin.wearemakaya.com/uploads/images/artisans/';
        $config['image_enterprise_path'] = 'http://mkyrrhadmin.wearemakaya.com/uploads/images/enterprises/';
}

# Email Config

$config['admin_email'] = "info@wearemakaya.com";
$config['admin_email_name'] = "Makaya Asia";
$config['alt_message'] = "This is an alternative Message";
