<?php 
$this->load->view('top_application');
$cat_res = $this->db->query("SELECT *, ( SELECT COUNT(category_id) FROM wl_categories AS b WHERE b.parent_id=a.category_id ) AS total_subcategories FROM (`wl_categories` as a) WHERE `status` !='2' AND parent_id = '0' AND status='1' ORDER BY `sort_order` asc LIMIT 15 ")->result_array();
?>
	<div class="mob_hider"></div>
  <!-- HEADER ENDS -->
  
  <div class="breadcrumbs mob_hider">
    <div class="wrapper">
      <p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b><strong>Sitemap</strong></p>
    </div>
  </div>

  <section class="wrapper" style="min-height:600px">
    <div class="p10 pt30">
      <h1 class="bb2 pb3">Sitemap</h1>
      <h3 class="mt25">Quick Links</h3>
  		<div class="sitemap mt5">
      	<a href="<?php echo base_url(); ?>">Home</a> 
        <a href="<?php echo base_url(); ?>aboutus">About Us</a> 
        <a href="<?php echo base_url(); ?>terms-conditions">Terms &amp; conditions</a> 
        <a href="<?php echo base_url(); ?>privacy-policy">Privacy Policy</a> 
        <a href="<?php echo base_url(); ?>security">Security</a> 
        <a href="<?php echo base_url(); ?>testimonials">Testimonials</a>
  			<a href="<?php echo base_url(); ?>contactus">Contact Us</a> 
        <a href="<?php echo base_url(); ?>delivery-information">Delivery &amp; Returns</a> 
        <a href="<?php echo base_url(); ?>order-tracking">Order Tracking</a> 
        <a href="<?php echo base_url(); ?>faq">FAQ's</a> 
				<div class="cb"></div>
		  </div>
    	
      <h3 class="mt25">Categories</h3> 
    	<div class="sitemap mt5">
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
  		  <div class="cb"></div>
		  </div>
    </div>
  </section>
  
	<section class="wrapper pt15  bt1 mid_banner_cont">
  	<?php 
		$cond = array();
		$cond['position'] = "Bottom Banner";
		banner_display($cond,330,182,'mid_banner', '<div class="mid_banner">', '</div>', "3");
		?>
	</section>
<!--content section-->
<?php $this->load->view('bottom_application'); ?>