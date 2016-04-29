<?php $this->load->view("top_application");?>
<div class="mob_hider"></div>
<!-- HEADER ENDS -->

  <div class="breadcrumbs mob_hider">
    <div class="wrapper">
      <p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b> <a href="<?php echo base_url(); ?>members/myaccount">My Account</a> <b>&gt;</b> <strong>My Subscriptions</strong></p>
    </div>
  </div>

	<section class="wrapper pt30" style="min-height:450px">
  	<div class="inner_wrapper">
    	<h1 class="mb5">My Subscriptions</h1>
    	<ul class="emp_acc_link">
      	<li><a href="<?php echo base_url(); ?>members/myaccount">My Home</a></li>
      	<li><a href="<?php echo base_url(); ?>members/orders_history">Order History</a></li>
      	<li><a href="<?php echo base_url(); ?>members/manage_addresses">My Addresses</a></li>
      	<li><a href="<?php echo base_url(); ?>members/subscriptions" class="act">My Subscriptions</a></li>
      	<li><a href="<?php echo base_url(); ?>members/edit_account">Manage Account</a></li>
    	</ul>
    	<div class="cb"></div>
    	<div class="mt2">
      	<div>
        	<div class="p1 pt2 bg-white">
          	<div class="p15 bg-gray border1 acc_title">
            	<img src="<?php echo theme_url(); ?>images/user.png" width="42" height="43" class="fl mr10" alt="">
            	<p class="fs18 ttu b black">
              	Welcome <?php echo ($this->fname!='' || $this->fname!=0)?$this->fname:'Member';?>!
              </p>
            	<p class="mt5">Last Login : <?php echo getDateFormat($this->last_login,6); ?>/ <span class="red"><a href="<?php echo base_url(); ?>users/logout" class="underline"><img src="<?php echo theme_url(); ?>images/lgt.png" width="17" height="17" class="vam mr5" alt="">Logout!</a></span></p>
            </div>
          	<!-- left ends --> 
           	<br>
				    <?php echo form_open('pages/join_newsletter','name="newsletter" id="chk_newsletter" onsubmit="return join_newsletter();" ') ;?>
              <div class="short_form">
                <h3 class="bb pb2 mb20">Subscribe for Email Alerts</h3>
                <div  id="my_newsletter_msg" class="mt5 ac p5 ft-18"></div>
                <fieldset class="pb15" style="border:0;">
                  <p class="w36 pt8">
                    <label for="name"> Name <b class="red">*</b> </label>
                  </p>
                  <p class="w62">
                    <input name="newsletter_name" id="newsletter_name" type="text">
                  </p>
                  <div class="cb pb7"></div>
                  <p class="w36 pt8">
                    <label for="email"> Email ID <b class="red">*</b> </label>
                  </p>
                  <p class="w62">
                    <input name="newsletter_email" id="newsletter_email" type="text">
                  </p>
                  <div class="cb pb7"></div>
                  <div class="w62">
                    <p class="mb10">
                      <input name="verification_code" id="verification_code" type="text" placeholder="Word Verification *">
                    </p>
                    <img src="<?php echo site_url('captcha/normal');?>" id="captchaimage" alt="" class="vam"> <img src="<?php echo theme_url(); ?>images/ref.png" alt="" class="vam" onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();" /> 
                  </div>
                  <div class="cb pb7"></div>
                </fieldset>
                <p class="w62">
                  <input name="subscribe_me" type="submit" value="Subscribe" class="btn2 radius-3" onclick="return join_newsletter(event);" />
                  <input name="unsubscribe_me" type="submit" value="Unsubscribe" class="btn3 radius-3" onclick="return join_newsletter(event);" />
                </p>
                <div class="cb"></div>
              </div>
    				<?php echo form_close();?>

            <div class="short_form">
            <h3 class="bb pb2 mb20">Subscribe for SMS Alerts</h3>
                  <fieldset class="pb15" style="border:0;">
                    <p class="w36 pt8">
                      <label for="name"> Name <b class="red">*</b> </label>
                    </p>
                    <p class="w62">
                      <input name="name" id="name" type="text">
                    </p>
                    <div class="cb pb7"></div>
                    <p class="w36 pt8">
                      <label for="email"> Mobile No. <b class="red">*</b> </label>
                    </p>
                    <p class="w62">
                      <input name="email" id="email" type="text">
                    </p>
                    <div class="cb pb7"></div>
                    
                  </fieldset>
                  <p class="w62">
                    <input name="register_me" type="button" value="Subscribe" class="btn2 radius-3" onClick="$('.verify_sms').show(0)">
                    <input name="reset" type="button" value="Unsubscribe" class="btn3 radius-3">
                  </p>
                  <div class="cb"></div>
                  
                  <div class="p15 border1 mt15 bg-gray dn verify_sms">
                   <p class="w36 pt8">
                      <label for="email"> Verify Mobile No. <b class="red">*</b> </label>
                    </p>
                    <p class="w62">
                      <input name="email" id="email" type="text">
                      <span class="db pt5 fs11 red">Enter Verification Code sent to your mobile.</span>
                    </p>
                  
                    <div class="cb pb7"></div>
                     <p class="w62">
                    <input name="register_me" type="button" value="Submit" class="btn1 radius-3">
                  </p>
                  <div class="cb"></div>
                  
                  </div>
                  
                  
                  <div class="cb"></div>
                </div>
          
          	<br>
					</div>
      	</div>
    	</div>
    	<div class="cb"></div>
  	</div>
	</section>
	<section class="wrapper pt15  bt1 mid_banner_cont">
  	<?php 
		$cond = array();
		$cond['position'] = "Bottom Banner";
		banner_display($cond,330,182,'mid_banner', '<div class="mid_banner">', '</div>', "3");
		?>
	  <div class="cb"></div>
	</section>
<?php $this->load->view("bottom_application");?>