<?php
$if_details=strstr($_SERVER['REQUEST_URI'],'detail');
if($if_details){
	$details='/details/'.$this->uri->segment(3);
}
else{
	$details='';
}
echo form_open("testimonials".$details,'name="testimonials"');
?>
<div class="p15 bg-white bdr radius-5">
	<?php 
	echo validation_message();
  echo error_message();
	?>
  <p class="fs24 ttu treb black">Post Testimonial</p>
  <p class="mt8"><input type="text" class="txtbox w93" name="poster_name" value="<?php echo set_value('poster_name'); ?>" placeholder="Name" /></p>
  <p class="mt5"><input type="text" class="txtbox w93" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email ID" /></p>
  <p class="mt5">
    <textarea rows="8" class="txtbox w93" name="testimonial_description" placeholder="Comment"><?php echo set_value('testimonial_description'); ?></textarea>
  </p>
  <p class="mt2">
    <input name="verification_code" id="verification_code" type="text" style="width:120px;" class="txtbox mb5" placeholder="Enter This Code ">
    <img src="<?php echo site_url('captcha/normal'); ?>" id="captchaimage" alt="" class="vam"> <img src="<?php echo theme_url(); ?>images/ref.png" onclick="document.getElementById('captchaimage').src='<?php echo base_url(); ?>captcha/normal/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();" alt="" border="0" class="vam mt8">
  </p>
	<p>
  	<input name="button3" type="submit" class="button-style" value="Post" />
    <input type="hidden" name="action" value="post" />
  </p>    
</div>
<?php echo form_close(); ?>      