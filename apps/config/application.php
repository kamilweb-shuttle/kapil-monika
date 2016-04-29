<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['bottom.debug'] = 0;
$config['site.status']	= '1';
$config['site_name']	= 'Telepoint';

$config['auth.password_min_length']	= '6';
$config['auth.password_force_numbers']	= '0';
$config['auth.password_force_symbols']	= '0';
$config['auth.password_force_mixed_case']	= '0';


$config['allow.imgage.dimension']	= '3000x3000';
$config['allow.file.size']	        = '2048'; //In KB



$config['allow_discount_option'] = 1;

$config['config.date.time']	= date('Y-m-d H:i:s');
$config['config.date']	    = date('Y-m-d');

$config['analytics_id']	    = '';

$config['no_record_found'] = "No record(s) Found !";

$config['gender'] =  array(''=>'Select','M'=>'Male','F'=>'Female');

$config['product_set_as_config'] = array(''=>"Product Set As",
'featured_product'=>'Featured Product', 'hot_product'=>'Hot Product');


$config['product_unset_as_config']	= array(''=>"Product Unset As",
'featured_product'=>'Featured Product', 'hot_product'=>'Hot Product');

$config['user_title'] =  array(""=>"Select","Mr."=>"Mr.","Miss."=>"Miss.");


$config['register_thanks']            = "Thanks for registering with <site_name>. We look forward to serving you. ";

$config['register_thanks_activate']   = "Thanks for registering with <website name>.Please Check your mail account to activate your account on the <website name>. ";


$config['enquiry_success']              = "Your enquiry has been submitted successfully.We will revert back to you soon.";
$config['feedback_success']             = "Your Feedback has been submitted successfully.We will revert back to you soon.";
$config['product_enquiry_success']      = "Your product enquiry  has been submitted successfully.We will revert back to you soon.";
$config['product_referred_success']     = "This product has been referred to your friend successfully.";
$config['site_referred_success']        = "Site has been referred to your friend successfully.";
$config['forgot_password_success']      = "Your password has been send to your email address.Please check your email account.";

$config['exists_user_id']              = "Email id  already exists. Please use different email id.";
$config['email_not_exist']             = "Email id does not exist.";
$config['login_failed']                = "Invalid Email/Password";

$config['newsletter_subscribed']           =  "You have been subscribed successfully for our newsletter service.";
$config['newsletter_already_subscribed']   =  "You are already a subscribed member  of our newsletter service.";
$config['newsletter_unsubscribed']         =  "You have been unsubscribed from our newsletter service.";
$config['newsletter_not_subscribe']        =  "You are not the subscribe member of our news letter service.";




$config['testimonial_post_success']     = "Thank you for your testimonial to <site_name>. Your message will be posted after review by the <site_name> team.";


$config['advertisement_request']          = "Your advertisement request has been submitted successfully.We will revert back to you soon.";
$config['myaccount_update']               = "Your account information has been updated successfully.";
$config['myaccount_password_changed']     = "Password has been changed successfully.";
$config['myaccount_password_not_match']   = "Old Password does  not match.Please try again.";
$config['member_logout']                  = "Logout successfully.";


$config['wish_list_add']               = "Product has been added to your wish list successfully.";
$config['wish_list_delete']            = "Product has been deleted from your wishlist.";
$config['wish_list_product_exists']    = "This product already exists in your wish list.";



$config['cart_add']                  =  "Product has been added to your Shopping Cart.";
$config['cart_quantity_update']      =  "Product quantity has been updated successfully.";
$config['cart_product_exist']        =  "Product is already exist in your cart.";
$config['cart_delete_item']          =  "Product(s) has been deleted successfully.";
$config['cart_empty']                 =  "Cart has been cleared successfully.";
$config['cart_available_quantity']   =  "Maximum available quantity  is <quantity>.You can not add  more then available Quantity.";

$config['shipping_required']         =  "Shipping selection is required.";
$config['payment_success']           =  "Thank you for shopping with us. Your transaction is successful.";
$config['payment_failed']            =  "Your transaction is failed due to some technical error.";



