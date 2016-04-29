<?php $this->load->view("top_application");?>
<div class="mob_hider"></div>
<!-- HEADER ENDS -->

<div class="breadcrumbs mob_hider">
  <div class="wrapper">
    <p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b> <a href="<?php echo base_url(); ?>members/myaccount">My Account</a> <b>&gt;</b> <strong>Manage Account</strong></p>
  </div>
</div>


  <section class="wrapper pt30" style="min-height:450px">
    <div class="inner_wrapper">
      <h1 class="mb5">Manage Account</h1>
    	<ul class="emp_acc_link">
      	<li><a href="<?php echo base_url(); ?>members/myaccount">My Home</a></li>
      	<li><a href="<?php echo base_url(); ?>members/orders_history">Order History</a></li>
      	<li><a href="<?php echo base_url(); ?>members/manage_addresses">My Addresses</a></li>
      	<li><a href="<?php echo base_url(); ?>members/subscriptions">My Subscriptions</a></li>
      	<li><a href="<?php echo base_url(); ?>members/edit_account" class="act">Manage Account</a></li>
    	</ul>
    	<div class="cb"></div>
    		<div class="mt2">
      		<div>
        		<div class="p15 bg-gray border1 acc_title">
            	<img src="<?php echo theme_url(); ?>images/user.png" width="42" height="43" class="fl mr10" alt="">
            	<p class="fs18 ttu b black">
              	Welcome <?php echo ($this->fname!='' || $this->fname!=0)?$this->fname:'Member';?>!
              </p>
            	<p class="mt5">Last Login : <?php echo getDateFormat($this->last_login,6); ?>/ <span class="red"><a href="<?php echo base_url(); ?>users/logout" class="underline"><img src="<?php echo theme_url(); ?>images/lgt.png" width="17" height="17" class="vam mr5" alt="">Logout!</a></span></p>
            </div>
						<!-- left ends --> 
          	<br>
            <?php 
						echo form_open('members/edit_account'); 
	      		echo error_message(); 
						?>
              <div class="short_form">
                <h3 class="bb pb2 mb20">Your Personal Information</h3>
                <fieldset class="pb15" style="border:0;">
                  <p class="w36 pt8">
                    <label for="name"> Name <b class="red">*</b> </label>
                  </p>
                  <div class="w62">
                    <input name="name" id="name" value="<?php echo set_value('name',$mres['first_name']); ?>" type="text">
                    <?php echo form_error('name'); ?>
                  </div>
                  <div class="cb pb7"></div>
                  <p class="w36 pt8">
                    <label for="mobile"> Mobile No. <b class="red">*</b> </label>
                  </p>
                  <div class="w62">
                    <input name="mobile" value="<?php echo set_value('mobile',$mres['mobile_number']); ?>" id="mobile" type="text">
                    <?php echo form_error('mobile'); ?>
                  </div>
                  <div class="cb pb7"></div>
                  <p class="w36 pt8">
                    <label for="email"> Email Id <b class="red">*</b> </label>
                  </p>
                  <div class="w62">
                    <input name="email" id="email" value="<?php echo set_value('email',$mres['user_name']); ?>" type="text">
                    <?php echo form_error('email'); ?>
                  </div>
                  <div class="cb pb7"></div>
                </fieldset>
                <p class="w62">
                  <input name="submit" type="submit" value="Update" class="btn2 radius-3">
                  <input name="reset" type="reset" value="Reset" class="btn3 radius-3">
                </p>
                <div class="cb"></div>
              </div>
            	<?php
						echo form_close();
						
						echo form_open('members/change_password'); 
						?>	
              <div class="short_form">
                <h3 class="bb pb2 mb20">Your Password Information</h3>
                <fieldset class="pb15" style="border:0;">
                  <p class="w36 pt8">
                    <label for="old_password"> Old Password <b class="red">*</b> </label>
                  </p>
                  <div class="w62">
                    <input name="old_password" id="old_password" type="password">
                    <?php echo form_error('old_password');?>
                  </div>
                  <div class="cb pb7"></div>
                  <p class="w36 pt8">
                    <label for="new_password"> New Password <b class="red">*</b> </label>
                  </p>
                  <div class="w62">
                    <input name="new_password" id="new_password" type="password">
                    <?php echo form_error('new_password');?>
                  </div>
                  <div class="cb pb7"></div>
                  <p class="w36 pt8">
                    <label for="confirm_password"> Confirm Password <b class="red">*</b> </label>
                  </p>
                  <div class="w62">
                    <input name="confirm_password" id="confirm_password" type="password">
                    <?php echo form_error('confirm_password');?>
                  </div>
                  <div class="cb pb7"></div>
                </fieldset>
                <p class="w62">
                  <input name="submit" type="submit" value="Update" class="btn2 radius-3">
                  <input name="reset" type="reset" value="Reset" class="btn3 radius-3">
                </p>
                <div class="cb"></div>
              </div>
            <?php echo form_close(); ?>  
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