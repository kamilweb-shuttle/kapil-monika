<?php $this->load->view("top_application");?>
  <!--content section-->
  <div class="mob_hider"></div>
  <!-- HEADER ENDS -->
  
  <div class="breadcrumbs mob_hider">
    <div class="wrapper">
      <p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b> <strong>Thank You</strong></p>
    </div>
  </div>
  
<section class="wrapper" style="min-height:450px">
	<div class="inner_wrapper pt20">
  	<h1>Thank You</h1>
    	<div class="mt10 default">
      	<div class="pr15">
					<div class="ac">
						<img src="<?php echo theme_url();?>images/thankyou.jpg" alt=""><br>
						<p class="fs22 green pt10 text-shadow">Thank You! Sir/Madam.
							<span class="grey pt5 fs18 db lht-26"><?php echo error_message(); ?></span>
					 	</p>
				 	</div>
					<div class="cb"></div>
				</div>
        <p class="cb"></p>
      </div>
    </div>
  </div>
</section>
<!--content section end--> 


<?php $this->load->view("bottom_application");?>

