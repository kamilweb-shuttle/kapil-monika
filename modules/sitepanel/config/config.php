<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Global
|--------------------------------------------------------------------------
*/

$config['site_admin']              	= "Telepoint Administrator Area";
$config['site_admin_name']         	= "Telepoint";

$config['category.best.image.view'] = "( File should be .jpg, .png, .gif format and file size should not be more then 2 MB (2048 KB)) ( Best image size 220X180 )";

$config['product.best.image.view']  = "( File should be .jpg, .png, .gif format and file size should not be more then 2 MB (2048 KB)) ( Best image size 750X600 )";


$config['site_admin_name']         	= "Telepoint";
$config['pagesize']                	= "10";
$config['total_product_images']    	= "4";


$config['adminPageOpt']            	= array($config['pagesize'], 2*$config['pagesize'], 3*$config['pagesize'], 4*$config['pagesize'], 5*$config['pagesize']);

//local path
$config['ffmpeg_path'] = 'C:\\user\\bin\\ffmpeg';

//server path
//$config['ffmpeg_path'] = '/usr/bin/ffmpeg'; 

//'Index Page Slide'=>"520x260",
$config['bannersz'] 								=  array('Index Middle Banner'=>"330x182", 'Index Bottom Banner'=>"1000x200", 'Bottom Banner'=>"330x182", 'Right Banner'=>"200x910", "Left Banner"=>"200x910");	

$config['bannersections'] 					= array('index'=>"Index Page", 'inner'=>"Inner Pages");

$config['banner_section_positions'] = array(
'index'=>array('Index Page Slide','Index Middle Banner','Index Bottom Banner'),
'inner'=>array('Bottom Banner', 'Right Banner', 'Left Banner'),
);	

/* End of file account.php */
/* Location: ./application/modules/sitepanel/config/sitepanel.php */