<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Global
|--------------------------------------------------------------------------
*/

$lang['activate']             = "Record has been activated successfully.";
$lang['deactivate']           = "Record has been de-activated successfully.";
$lang['deleted']              = "Record has been deleted successfully.";
$lang['successupdate']        = "Record has been updated successfully.";
$lang['order_updated']        = "The Selected Record(s) has been re-ordered.";
$lang['password_incorrect']   = "The Old Password is incorrect";
$lang['recordexits']          = "Record address already exists.";
$lang['success']              = "Record added successfully.";
$lang['paysuccess']           = "Payment added successfully.";
$lang['admin_logout_msg']     = "Logout successfully ..";
$lang['admin_mail_msg']       = "Mail sent Successfully...";
$lang['forgot_msg']           = "Email Id does not exist in database";
$lang['admin_reply_msg']      = "Enquiry reply sent Successfully...";
$lang['pic_uploaded']         = 'Photos has been uploaded successfully.';
$lang['pic_uploaded_err']	  	= 'Please upload at least one photo.';
$lang['pic_delete']			  		= 'Photo has been deleted successfully.';

$lang['child_to_deactivate']     =  "The selected record(s) has some sub-category/product.Please de-activate them first";
$lang['child_to_activate']       =  "The selected record(s) has some sub-category/product.Please activate them first";
$lang['child_to_delete']         =  "The selected record(s) has some sub-category/product.Please delete them first";


 $lang['marked_paid']        = "The selected record(s) has been marked as Paid";
 $lang['payment_succeeded']  = "The payment has been made successfully.";
 $lang['payment_failed']     = "The payment has been canceled.";
 $lang['email_sent']	     = "The Email has been sent successfully to the selected Users/Members.";
 

$lang['top_menu_list'] = array("Dashboard"=>"sitepanel/dashbord/",
  
 "Members Management"  =>array(
                      "Members"=>"sitepanel/members/" ,
					 ),			
  
 "Product Management"=>array(
 												"Manage Categories"=>"sitepanel/category/",
                        "Manage Products"=>"sitepanel/products",
												"Manage Color"=>"sitepanel/color",
												"Manage Size"=>"sitepanel/size",
							 					//"Manage Product Enquiry"=>"sitepanel/product_enquiry",
							 				),
 
 "Orders Management"  =>array(
                      	"Order Management"=>"sitepanel/orders/" ,
												"Shipping & COD"=>"sitepanel/orders/shipping_cod" ,
					 						),											
							 					  
 "Manage Enquiry"  =>array(
                      	"Enquiry/Feedback"=>"sitepanel/enquiry/" ,
					 						),
					 
 "Newsletter"  =>array(
                      "Newsletter"=>"sitepanel/newsletter/" ,
					 				),				 	
					  					 
 "Other Management"=>array(           
                    	"Static Pages"=>"sitepanel/staticpages/", 
											"Manage Banner"=>"sitepanel/banners/", 
											"Manage Testimonials"=>"sitepanel/testimonial/",
											"Manage Faq"=>"sitepanel/faq/", 
											"Manage Location"=>"sitepanel/zip_location/",
											"Manage Courier Company"=>"sitepanel/courier_company/",
					   					"Manage  Meta Tags"=>"sitepanel/meta/"   ,
					   					"Admin Settings"=>"sitepanel/setting/"                      
                    ),
                    
                    
);		
 
 
$lang['top_menu_icon'] = array(   
  "Product Management"=>"maintenance.png",
	"Members Management" =>"user.png",
	"Orders Management"	=>"order.png",
  "Manage Enquiry"	=>"management.png",
  "Newsletter"=>"news-lt-.png",  
  "Other Management"=>"management.png",
 );			  

/* Location: ./application/modules/sitepanel/language/admin_lang.php */