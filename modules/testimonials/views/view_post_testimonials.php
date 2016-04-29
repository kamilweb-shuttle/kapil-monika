<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Disha Exports</title>
<link href="<?php echo theme_url(); ?>css/ak.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/developers/css/proj.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="screen">
<!--
@import url("<?php echo resource_url(); ?>fancybox/jquery.fancybox-1.3.4.css");
-->
</style>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body class="bg4">
<?php echo  form_open('testimonials/post'); ?>
<div class="p10" style="width:500px;">
<h1>Post Your Testimonial</h1>
<?php echo error_message(); ?>
<div class="p10 mt10">
 <div class="fl w40">
 <p class="ttu"><label for="testimonial_title">Title :</label><strong class="red">*</strong></p>
<p class="mt5"><input type="text" name="testimonial_title" id="testimonial_title" class="input-bdr2" style="width:200px;" value="<?php echo set_value('testimonial_title');?>"><?php echo form_error('testimonial_title');?></p> 
 </div>
 <div class="fl w40 ml50">
 <p class="ttu"><label for="poster_name">Name :</label><strong class="red">*</strong></p>
<p class="mt5"><input type="text" name="poster_name" id="poster_name" class="input-bdr2" style="width:200px;" value="<?php echo set_value('poster_name');?>"><?php echo form_error('poster_name');?></p> 
 </div>
 <p class="cb"></p>
 <div class="mt5">
 <p class="ttu"><label for="email">Email :</label><strong class="red">*</strong></p>
<p class="mt5"><input type="text" name="email" id="email" class="input-bdr2" style="width:440px;" value="<?php echo set_value('email');?>"><?php echo form_error('email');?></p>
 </div>
    
<div class="cb"></div>

<div><p class="ttu mt5">
 <label for="description">Description :</label><strong class="red">*</strong></p>
<p class="mt5"><textarea name="testimonial_description" id="testimonial_description" cols="45" rows="4" class="input-bdr2" style="width:442px;"><?php echo set_value('testimonial_description');?></textarea><?php echo form_error('testimonial_description');?></p> 
</div>   


<p class="mt5"><span class="grey tahoma fs12"><label for="verification _code">WORD VERIFICATION</label> <strong class="red">*</strong></span></p>
<p class="mt5">
<input type="text" name="verification_code" id="verification_code" class="input-bdr2" style="width:250px;" autocomplete="off"><img src="<?php echo site_url('captcha/normal'); ?>" class="vam bdr" alt=""  id="captchaimage"/> <a href="javascript:viod(0);" title="Change Verification Code"  ><img src="<?php echo theme_url(); ?>images/ref12.png"  alt="Refresh"  onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();" class="ml10 vam"></a><?php echo form_error('verification_code');?> </p>

<p class="mt10">
<input type="submit" name="button" id="button" value="Submit" class="blacklink1" ></p>
      
</div>
<?php echo form_close();?>

</div>
</body>
</html>
