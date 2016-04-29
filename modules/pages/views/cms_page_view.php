<?php $this->load->view("top_application");?>
	<div class="mob_hider"></div>
	<!-- HEADER ENDS -->
	<div class="breadcrumbs mob_hider">
  	<div class="wrapper">
    	<p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b><strong><?php echo $content['page_name'];?></strong></p>
	  </div>
	</div>
	<!--  MIDDLE STARTS -->
	<section class="wrapper cms_area" style="min-height:600px">
  	<div class="p10 pt30">
    	<h1 class="bb2 pb3"><?php echo $content['page_name'];?></h1>
	    <?php echo $content['page_description'];?>    
  	</div>
	</section>
	<!-- MIDDLE ENDS -->
	<section class="wrapper pt15  bt1 mid_banner_cont">
  	<?php 
		$cond = array();
		$cond['position'] = "Bottom Banner";
		banner_display($cond,330,182,'mid_banner', '<div class="mid_banner">', '</div>', "3");
		?>
	</section>

<!--content section-->
<?php $this->load->view("bottom_application");?>