<?php $this->load->view("top_application");?>
<div class="mob_hider"></div>
<!-- HEADER ENDS -->
	<div class="breadcrumbs mob_hider">
  	<div class="wrapper">
    	<p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b><strong>My Account</strong></p>
  	</div>
	</div>

	<section class="wrapper pt30" style="min-height:450px">
  	<div class="inner_wrapper">
    	<h1 class="mb5">My Account</h1>
    	<ul class="emp_acc_link">
      	<li><a href="<?php echo base_url(); ?>members/myaccount" class="act">My Home</a></li>
      	<li><a href="<?php echo base_url(); ?>members/orders_history">Order History</a></li>
      	<li><a href="<?php echo base_url(); ?>members/manage_addresses">My Addresses</a></li>
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
          	<!-- left ends --> 
          	<br />
          	<br />
            <div class="acc_mid_boxes">
            	<div class="p20 pb30">
              	<div class="acc_mid_boxes_title">
                	<p class="fs28 black weight300 ttu lht-28">Welcome to <b>Telepoint</b></p>
                	<p class="fs16 ml3 mt5 bree gray">What do you want to do today?</p>
              	</div>
              	<div class="mt50">
                	<div class="box1">
                  	<p class="ac"><img src="<?php echo theme_url(); ?>images/add1.gif" width="110" height="86" alt=""></p>
	                  <p class="fs16 mt5">Review Your Previous Orders</p>
  	                <p class="mt10"> <a href="<?php echo base_url(); ?>members/orders_history" class="btn1 radius-20">Continue</a> </p>
                	</div>
                	<div class="box1">
                  	<p class="ac"><img src="<?php echo theme_url(); ?>images/add2.gif" width="110" height="86" alt=""></p>
                  	<p class="fs16 mt5">Update Your Account Info.</p>
                  	<p class="mt10"> <a href="<?php echo base_url(); ?>members/edit_account" class="btn1 radius-20">Continue</a> </p>
                	</div>
                	<div class="box1">
                  	<p class="ac"><img src="<?php echo theme_url(); ?>images/add3.gif" width="110" height="86" alt=""></p>
                  	<p class="fs16 mt5"> Manage Your Addresses</p>
                  	<p class="mt10"> <a href="<?php echo base_url(); ?>members/manage_addresses" class="btn1 radius-20">Continue</a> </p>
                	</div>
                	<div class="cb pb50"></div>
	              </div>
  	          </div>
    	      </div>
      	    <div class="auto w50 bb3 pb5"></div>
        	  <div class="auto w70 bb3 pb5"></div>
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