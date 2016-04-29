<!--footer-->
<footer class="pt12">
	<?php
	if($this->uri->segment('1')!="newsletter"){
		?>
    <section class="foot1">
      <div class="wrapper pt10">
        <div  id="my_newsletter_msg" class="mt5 ac ft-18"></div>
        <div class="nl_box1">
          <p class="black fs24 poiret ttu weight600">Newsletter</p>
          <p class="lht-14 fs12 mt9 gray">Enter your email address to sign up for our 
            special offers and product promotions</p>
        </div>
        <?php echo form_open('pages/join_newsletter','name="newsletter" id="chk_newsletter" onsubmit="return join_newsletter();" ') ;?>
          <div class="nws_box nl_box2 mb5">
            <input name="newsletter_name" id="newsletter_name" type="text" class="p5 radius-5 vam" placeholder="Name">
            <input name="newsletter_email" id="newsletter_email" type="text" class="p5 radius-5 vam" placeholder="Email Address">
            <div class="cb"></div>
            <img src="<?php echo site_url('captcha/normal');?>" id="captchaimage" class="vam mt6" alt="" />
            <input name="verification_code" id="verification_code" type="text" style="width:113px; margin:6px 0 0 5px" class="p5 radius-5 vam" placeholder="verification Code *">
            <img src="<?php echo theme_url(); ?>images/ref.png" class="vam mt8 ml5" alt="" onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('captchaimage1').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();" />
            <div class="cb"></div>
          </div>
          <div class="nws_box nl_box3">
            <input name="subscribe_me" type="submit" class="btn1 vam radius-5" value="Subscribe" style="width:117px; padding:0" onclick="return join_newsletter(event);" />
            <input name="unsubscribe_me" type="submit" class="btn1 vam radius-5" value="Unsubscribe" style="width:139px; padding:0" onclick="return join_newsletter(event);" />
          </div>
        <?php echo form_close();?> 
        <div class="cb"></div>
      </div>
    </section>
  	<?php
	}
	?>
  <!-- LINE 1 ENDS -->  
  <section class="wrapper footlink_container pt15">
    <div class="fc_box1">
      <h3>useful Links</h3>
      <p class="footlink float1"><a href="<?php echo base_url(); ?>">Home</a> <a href="<?php echo base_url(); ?>aboutus">About Us</a> <a href="<?php echo base_url(); ?>terms-conditions">Terms &amp; conditions</a> <a href="<?php echo base_url(); ?>privacy-policy">Privacy Policy</a> <a href="<?php echo base_url(); ?>security">Security</a> <a href="<?php echo base_url(); ?>testimonials">Testimonials</a>  </p>
      <p class="footlink float2"> <a href="<?php echo base_url(); ?>newsletter">Newsletter</a> <a href="<?php echo base_url(); ?>sms-alert">SMS Alert</a> <a href="<?php echo base_url(); ?>legal-disclaimer">Legal Disclaimer</a> 
      <?php
			if(!isset($this->session->userdata['user_id'])){
				?>
      	<a href="<?php echo base_url(); ?>login">Login</a> 
        <a href="<?php echo base_url(); ?>register">Register</a> 
        <?php
			}
			else{
				?>
        <a href="<?php echo base_url(); ?>users/logout">Logout</a> 
        <a href="<?php echo base_url(); ?>members/myaccount">My Account</a> 
        <?php
			}
			?> <a href="<?php echo base_url(); ?>sitemap">Sitemap</a></p>
      <div class="cb"></div>
    </div>
    <div class="fc_box2">
      <h3>Help</h3>
      <p class="footlink mt5"> <a href="<?php echo base_url(); ?>contactus">Contact Us</a> <a href="<?php echo base_url(); ?>delivery-information">Delivery &amp; Returns</a> <a href="<?php echo base_url(); ?>order-tracking">Order Tracking</a> <a href="<?php echo base_url(); ?>faq">FAQ's</a> <a href="<?php echo base_url(); ?>help">Help</a></p>
    </div>
    <div class="fc_box2">
    	<?php
			$cat_res = $this->db->query("SELECT *, ( SELECT COUNT(category_id) FROM wl_categories AS b WHERE b.parent_id=a.category_id ) AS total_subcategories FROM (`wl_categories` as a) WHERE `status` !='2' AND parent_id = '0' AND status='1' ORDER BY `sort_order` asc LIMIT 5 ")->result_array();
			?>
      <h3> categories</h3>
      <p class="footlink mt5"> 
      	<?php
				if( is_array($cat_res) && !empty($cat_res)){
					$ix=1;
					foreach($cat_res as $v){
						$link_url = base_url().$v['friendly_url'];
						?>
  					<a href="<?php echo $link_url; ?>"><?php echo $v['category_name']; ?></a> 
            <?php
					}
				}
				?>
      	<a href="category" class="act">View All</a>
      </p>
    </div>
    <!-- navs ends -->
    <div class="cb bb pb20 des_hider"></div>
    <div class="fc_box3">
      <?php
			$this->load->view('testimonials/scrolling_testimonial');
			?>
    </div>
    <!-- testimonials ends -->
    <div class="cb pb20"></div>
    <div class="cb bb mb20 des_hider"></div>
    <p class="foot_cards"><span><img src="<?php echo theme_url(); ?>images/weacc.png" alt=""></span> <img src="<?php echo theme_url(); ?>images/c_1.png" alt=""> <img src="<?php echo theme_url(); ?>images/c_2.png" alt=""> <img src="<?php echo theme_url(); ?>images/c_3.png" alt=""> <img src="<?php echo theme_url(); ?>images/c_4.png" alt=""> </p>
    <div class="cb bb pb20 mob_only mb20"></div>
    <p class="foot_cartificate"><img src="<?php echo theme_url(); ?>images/sp.png" alt=""> <img src="<?php echo theme_url(); ?>images/mcsc.png" alt=""> <img src="<?php echo theme_url(); ?>images/vbv.png" alt=""></p>
    <div class="cb bb pb20 des_hider mb20"></div>
    <div class="foot_social">
      <h3 class="fl mt8">Follow Us :</h3>
      <div class="fl ml10"> <a href="#"><img src="<?php echo theme_url(); ?>images/soc_1.png" alt=""></a> <a href="#"><img src="<?php echo theme_url(); ?>images/soc_2.png" alt=""></a> <a href="#"><img src="<?php echo theme_url(); ?>images/soc_3.png" alt=""></a> <a href="#"><img src="<?php echo theme_url(); ?>images/soc_4.png" alt=""></a> </div>
      <div class="cb"></div>
    </div>
    <div class="cb"></div>
    <div class="cb"></div>
  </section>
  <!-- LINE 2 ENDS -->
  
  <div class="bb pb10"></div>
  <section class="wrapper pt5">
    <div class="ml10 mr10">
      <h2 class="fs20">Welcome to Telepoint</h2>
      <p class="aj fs12 weight400">
      	<?php
				$this->load->model(array('pages/pages_model'));
				$condition       = array('friendly_url'=>'aboutus','status'=>'1');			 
        $content         = $this->pages_model->get_cms_page( $condition );				 
        echo char_limiter($content['page_description'],600);				
				?>
      </p>
      <p class="mt5"><a href="<?php echo base_url(); ?>aboutus" class="more radius-5" style="line-height:28px; height:28px">Read More</a></p>
    </div>
  </section>
  <!-- WELCOME ENDS -->
  
  <div class="foot2 mt10">
    <div class="wrapper">
      <div class="foot_logo"> <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/tp1.png" alt=""></a> </div>
      <p class="fs12 black lht-14 pt16 foot_text"> Copyright © 2014 Telepoint, All rights reserved.<br>
        Developed and Managed by <a href="http://www.weblinkindia.net/" target="_blank" class="uo">WeblinkIndia.NET</a> </p>
      <div class="cb"></div>
    </div>
  </div>
  <!--<div class="l_chat"><a href="#"><img src="../images/lc.png" alt=""></a></div>-->
</footer>
<!-- #EndLibraryItem --><!--footer end--> 