<?php $this->load->view("top_application");?>
	<div class="mob_hider"></div>
	<!-- HEADER ENDS -->
	<div class="breadcrumbs mob_hider">
  	<div class="wrapper">
    	<p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b> <a href="<?php echo base_url(); ?>members/myaccount">My Account</a> <b>&gt;</b> <a href="<?php echo base_url(); ?>members/manage_addresses/">My Addresses</a> <b>&gt;</b> <strong>Add</strong></p>
	  </div>
	</div>

	<section class="wrapper pt30" style="min-height:450px">
  	<div class="inner_wrapper">
    	<h1 class="mb5">My Account</h1>
    	<ul class="emp_acc_link">
      	<li><a href="<?php echo base_url(); ?>members/myaccount">My Home</a></li>
      	<li><a href="<?php echo base_url(); ?>members/orders_history">Order History</a></li>
      	<li><a href="<?php echo base_url(); ?>members/manage_addresses" class="act">My Addresses</a></li>
      	<li><a href="<?php echo base_url(); ?>members/subscriptions">My Subscriptions</a></li>
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
          	<p class="ac"><a href="<?php echo base_url(); ?>members/manage_addresses" class="btn5 radius-20b" style="padding:0 40px">Go Back</a></p>
          <!-- left ends -->
          	<?php echo form_open('');?>		
              <div class="short_form">
              	<?php	echo error_message(); ?>								
                <h3 class="bb pb2 mb20">Enter  Details</h3>
                <fieldset class="pb15" style="border:0;">
                  <p class="w36 pt8">
                    <label for="name">Name <b class="red">*</b> </label>
                  </p>
                  <div class="w62">
                    <input name="name" id="name" value="<?php echo set_value('name');?>" type="text">
                    <?php echo form_error('name');?>
                  </div>
                  <div class="cb pb7"></div>
                  <p class="w36 pt8">
                    <label for="mobile"> Mobile No. <b class="red">*</b> </label>
                  </p>
                  <div class="w62">
                    <input name="mobile" id="mobile" value="<?php echo set_value('mobile');?>" type="text">
                    <?php echo form_error('mobile');?>
                  </div>
                  <div class="cb pb7"></div>
                  <p class="w36 pt8">
                    <label for="phone"> Phone No. </label>
                  </p>
                  <div class="w62">
                    <input name="phone" id="phone" value="<?php echo set_value('phone');?>" type="text">
                    <?php echo form_error('phone');?>
                  </div>
                  <div class="cb pb7"></div>
                  <p class="w36 pt8">
                    <label for="pincode"> Pin Code <b class="red">*</b> </label>
                  </p>
                  <div class="w62">
                    <input name="zipcode" id="zipcode" value="<?php echo set_value('zipcode');?>" type="text">
                    <?php echo form_error('zipcode');?>
                  </div>
                  <div class="cb pb7"></div>
                  <p class="w36 pt8">
                    <label for="address"> Address <b class="red">*</b> </label>
                  </p>
                  <div class="w62">
                    <textarea name="address" rows="3" id="address"><?php echo set_value('address');?></textarea>
                    <?php echo form_error('address');?>
                  </div>
                  <div class="cb pb7"></div>
                  <p class="w36 pt8">
                    <label for="landmark"> Landmark <b class="red">*</b> </label>
                  </p>
                  <div class="w62">
                    <textarea name="landmark" rows="2" id="landmark"><?php echo set_value('landmark');?></textarea>
                    <?php echo form_error('landmark');?>
                  </div>
                  <div class="cb pb7"></div>
                  <p class="w36 pt8">
                    <label for="city"> City <b class="red">*</b> </label>
                  </p>
                  <div class="w62">
                    <input name="city" id="city" value="<?php echo set_value('city');?>" type="text">
                    <?php echo form_error('city');?>
                  </div>
                  <div class="cb pb7"></div>
                  <p class="w36 pt8">
                    <label for="state"> State/Region <b class="red">*</b> </label>
                  </p>
                  <div class="w62">
                    <input name="state" id="state" value="<?php echo set_value('state');?>" type="text">
                    <?php echo form_error('state');?>
                  </div>
                  <div class="cb pb7"></div>
                  <p class="w36 pt8">
                    <label for="country"> Country <b class="red">*</b> </label>
                  </p>
                  <div class="w62">
                  	<?php echo CountrySelectBox(array('name'=>'country','format'=>'','current_selected_val'=>set_value('country') )); ?>
                    <?php echo form_error('country');?>
                  </div>
                  <div class="cb"></div>
                </fieldset>
                <p class="w62">
                  <input name="submit" type="submit" value="Submit" class="btn2 radius-3">
                  <input name="reset" type="reset" value="Reset" class="btn3 radius-3">
                </p>
                <div class="cb"></div>
              </div>            
            <?php echo form_close(); ?>
          	<br />
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

<script type="text/javascript">
  	jQuery('[id ^="per_page"]').live('change',function(){		
			$("[id ^='per_page'] option[value=" + jQuery(this).val() + "]").attr('selected', 'selected'); 
			//jQuery("input[name='per_page']","#ord_frm").val($(this).val());
			jQuery('#ord_frm').submit();
		});	
</script>
<?php $this->load->view("bottom_application");?>