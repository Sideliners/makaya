<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['sitename'] = 'Makaya';
$config['datetime'] = 'Y-m-d H:i:s';

if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
            $config['image_product_path'] = 'http://localhost/mkyrrhadmin/uploads/images/products/';
            $config['image_article_path'] = 'http://localhost/mkyrrhadmin/uploads/images/articles/';
            $config['image_artisan_path'] = 'http://localhost/mkyrrhadmin/uploads/images/artisans/';
            $config['image_enterprise_path'] = 'http://localhost/mkyrrhadmin/uploads/images/enterprises/';
		break;
	
		case 'testing':
		case 'production':
            $config['image_product_path'] = 'http://mkyrrhadmin.wearemakaya.com/uploads/images/products/';
            $config['image_article_path'] = 'hhttp://mkyrrhadmin.wearemakaya.com/uploads/images/articles/';
            $config['image_artisan_path'] = 'http://mkyrrhadmin.wearemakaya.com/uploads/images/artisans/';
            $config['image_enterprise_path'] = 'http://mkyrrhadmin.wearemakaya.com/uploads/images/enterprises/';
		break;

		default:
			exit('The application environment is not set correctly.');
	}
}

