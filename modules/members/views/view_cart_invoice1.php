<?php $this->load->view("top_application");?>
	<div class="mob_hider"></div>
  <!-- HEADER ENDS -->
  
  <div class="breadcrumbs mob_hider">
    <div class="wrapper">
      <p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b> <a href="<?php echo base_url(); ?>members/myaccount">My Account</a> <b>&gt;</b> <strong>Invoice - <?php echo $ordmaster['invoice_number']; ?></strong></p>
    </div>
  </div>

	<section class="wrapper" style="min-height:450px">
    <div class="inner_wrapper pt20">
      <h1 class="bb2 pb5">Invoice</h1>    
      <?php echo invoice_content($ordmaster,$orddetail,$dlink='');?>  
      <br>
      <br>
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