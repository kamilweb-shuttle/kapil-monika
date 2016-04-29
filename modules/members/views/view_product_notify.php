<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to BlueSkyNails</title>
<link href="<?php echo theme_url(); ?>css/layout-ravi.css" rel="stylesheet" type="text/css" />
</head>
<body style="font-size:12px; color:#fff; margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; background:#fff;">
<div class="p15 radius-5 mt10 form-style bg-grey2">
	<h2 class="abel fs30">Notify Me</h2>
  <div class="cb"></div>
   <span class="red required" style="width: 100%; color:#F30; text-align:center">
    <?php echo error_message(); ?></span>
	  <?php echo  form_open(''); 
		?>  
  <p class="mt10">
   <textarea name="message" placeholder="Enter Your Comment" cols="5" rows="3"  style="width:300px"><?php echo set_value('message', $wish['message']);?></textarea>
   <?php echo form_error('message');?></p>   
  
  <p class="mt20 mb10">
  <?php //if($wish['notify'] == 0){?> 
   <input type="submit" name="submit" id="button" value="Submit" class="btn-bg1" />
  	<input type="hidden" name="wislist_id" value="<?php echo $wishId;?>" />
  <?php //} ?>  
  </p>
 <?php echo form_close(); ?>          
</div>
</body>
</html>