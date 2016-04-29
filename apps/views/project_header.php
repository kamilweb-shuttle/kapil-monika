<?php 
$this->load->helper('banner');
//trace($this->meta_info);
if(isset($this->meta_info['entity_id'])){
	$catID = (int) $this->meta_info['entity_id'];
	$metaType = $this->meta_info['page_url'];
}
else{
	$catID = "";
	$metaType="";
}
?>
<header>
	<section class="top1">
  	<div class="wrapper rel">
      <div class="call_bg">
        <p>NEED HELP? CALL <b>+91-9212029225</b></p>
      </div>
      <p class="t_link ar osons mr1"><a href="<?php echo base_url(); ?>testimonials">TESTIMONIALS</a> <!--<a href="<?php //echo base_url(); ?>help">HELP</a>--> <a href="<?php echo base_url(); ?>newsletter">SUBSCRIBE</a> <a href="<?php echo base_url(); ?>order-tracking">ORDER TRACKING</a></p>
    </div>
  </section><!-- #EndLibraryItem --><!-- top 1 ends -->
  <section class="top2">
  	<div class="wrapper">
      <div class="logo_area">
        <p id="logo">
          <a href="<?php echo site_url(); ?>"><img src="<?php echo theme_url(); ?>images/telepoint.png" alt=""></a>
        </p>
      </div>
			<!-- logo ends -->
      <div class="t_right1 mob_hider">
        <div class="acc_box red"> 
        	<?php
					if(!isset($this->session->userdata['user_id'])){
						?>
        		<a class="db lht-14" href="<?php echo base_url(); ?>login"><img src="<?php echo theme_url(); ?>images/acc_blt.png" class="fr mt18" alt="">Sign In <b class="black db">My Acccount</b></a>
            <?php
					}
					else{
						?><a class="db lht-14" href="<?php echo base_url(); ?>users/logout"><img src="<?php echo theme_url(); ?>images/acc_blt.png" class="fr mt18" alt="">Logout</a> <b class="black db"><a class="db lht-14" href="<?php echo base_url(); ?>members/myaccount">My Acccount</a></b>
            <?php
					}
					?>
           </div>
        <!-- acc box ends -->
        <div class="cart_cont">
          <p class="ac gray fs13 osons lht-26 pl10"><a href="<?php echo base_url(); ?>cart" class="db atc_btn">items (<b class="black cartCnt"><?php echo count($this->cart->contents()); ?></b>)</a></p>
          <div id="cartCountId">
          <?php
					if($this->cart->total_items() > 0){
						$this->load->model('cart/cart_model');
						$this->load->helper('products/product');
						$this->load->view('view_cart_top');
					}
          ?>
          </div>
        </div>
        <!-- cart box ends -->
        <div class="cb"></div>
      </div>
			<p class="mt20 ac mob_only t_mob_btn"><a href="<?php echo base_url(); ?>login" class="red_btn radius-3 shadow1 vam">My Account</a> <a href="<?php echo base_url(); ?>cart" class="red_btn radius-3 shadow1 vam">Shopping Cart</a> <a href="javascript:void(0)" class="red_btn radius-3 shadow1 srch_link vam"><img src="<?php echo theme_url(); ?>images/srch_icon.png" class="db" alt=""></a></p>
    	<!-- two buttons ends --><!-- #EndLibraryItem -->
    	<div class="cb des_hider"></div>
      <div class="t_right2">
      	<?php echo form_open(base_url().'products'); ?>
        <div class="search_box">
          <input name="" type="image" src="<?php echo theme_url(); ?>images/srch.png" alt="Search" class="search_btn db fr">
          <input type="hidden" name="action" value="search" />
          <div class="pl6 pt6">
            <input name="keyword" type="text" id="inputString" placeholder="What are you searching for?" onKeyUp="lookup(this.value);">
            <div class="suggestionsBox" id="suggestions" style="display:none;">
              <div class="suggestionList" id="autoSuggestionsList"></div>
            </div>
          </div>
        </div>
        <?php echo form_close(); ?>
        <div class="soc_box mob_hider"> <a href="#"><img src="<?php echo theme_url(); ?>images/face.png" alt=""></a> <a href="#"><img src="<?php echo theme_url(); ?>images/twit.png" alt=""></a> <a href="#"><img src="<?php echo theme_url(); ?>images/in.png" alt=""></a> <a href="#"><img src="<?php echo theme_url(); ?>images/ytube.png" alt=""></a> </div>
        <div class="cb"></div>
      </div><!-- #EndLibraryItem -->
    	<div class="cb"></div>
      <nav>
        <div class="nav_mob">
          <img src="<?php echo theme_url(); ?>images/mobi_nav.png" class="navlink" alt="">
          <ul class="topmenu">
            <li> <a href="<?php echo base_url(); ?>" <?php if($catID <=0 && $metaType == 'home'){ echo 'class="act"'; } ?>><img src="<?php echo theme_url(); ?>images/home-ico.png" class="Home" alt=""></a> </li>
            <li> <a href="<?php echo base_url(); ?>aboutus" <?php if($catID <=0 && $metaType == 'aboutus'){ echo 'class="act"'; } ?>>About Us</a> </li>
            <?php
						$sql 		= "SELECT category_id, category_name, friendly_url FROM wl_categories WHERE status = '1' AND parent_id = '0' ORDER BY category_id asc LIMIT 0,5";
						$result = $this->db->query($sql)->result_array();
						if(is_array($result) && !empty($result)){
							foreach($result as $key=>$value){
								?>
  		          <li> 
    		          <a href="<?php echo base_url(); ?><?php echo $value['friendly_url']; ?>" <?php if($catID ==$value['category_id']){ echo 'class="act"'; } ?>>
										<?php echo $value['category_name']; ?>
                  </a>
                  <?php
                  $sqlsub	= "SELECT category_id, category_name, friendly_url FROM wl_categories WHERE status = '1' AND parent_id = '".$value['category_id']."' ORDER BY category_id desc LIMIT 0,8";
									$resultsub = $this->db->query($sqlsub)->result_array();
									
									if(is_array($resultsub) && !empty($resultsub)){
										$sqlprocnt	= "SELECT products_id, product_name, friendly_url FROM wl_products WHERE status = '1' AND FIND_IN_SET('".$value['category_id']."', category_links)";
										$resultprocnt = $this->db->query($sqlprocnt)->result_array();
										$cntproduct = get_found_rows();
										if($cntproduct > 0){
											?>
                      <div class="sub_cat">
                        <div class="sub_cat_inner">
                          <?php
                          foreach($resultsub as $key=>$val){
                            $sqlpro	= "SELECT products_id, product_name, friendly_url FROM wl_products WHERE status = '1' AND category_id = '".$val['category_id']."' ORDER BY products_id desc LIMIT 0,5";
                            $resultpro = $this->db->query($sqlpro)->result_array();
                            $cntPro = get_found_rows();
                            if($cntPro > 0){
                              ?>
                              <section>
                                <p class="sublink"> 
                                  <a href="<?php echo base_url(); ?><?php echo $val['friendly_url']; ?>">
                                    <?php echo $val['category_name']; ?>
                                  </a>
                                </p>
                                <?php
                                if(is_array($resultpro) && !empty($resultpro)){
                                  ?>
                                  <p class="sublink1 mt10"> 
                                    <?php
                                    $sl=1;
                                    foreach($resultpro as $key=>$pageVal){
                                      ?>
                                      <a href="<?php echo base_url(); ?><?php echo $pageVal['friendly_url']; ?>"><?php echo $pageVal['product_name']; ?></a>
                                      <?php
                                      $sl++;
                                    }
                                    if($sl > 4){
                                      ?>
                                      <a href="<?php echo base_url(); ?><?php echo $val['friendly_url']; ?>" class="act">View All»</a> 
                                      <?php
                                    }
                                    ?>
                                  </p>
                                  <?php
                                }
                                ?>
                              </section>
                              <?php
                            }
                          }
                          ?>                        
                          <div class="cb pb15"></div>
                          <p class="bt1 pt10 white"><a href="<?php echo base_url(); ?><?php echo $value['friendly_url']; ?>" class="btn1" style="display:block">View All Categories</a></p>
                        </div>
                      </div>
                    	<?php
										}
									}
									else{
										$sqlprocnt	= "SELECT products_id, product_name, friendly_url FROM wl_products WHERE status = '1' AND FIND_IN_SET('".$value['category_id']."', category_links)  ORDER BY products_id desc LIMIT 0,20";
										$resultprocnt = $this->db->query($sqlprocnt)->result_array();
										$cntproduct = get_found_rows();
										if($cntproduct > 0){
											?>
                      <div class="sub_cat">
                        <div class="sub_cat_inner">
                        	
                          	
	                          	<?php
															$sl=1;
															$cnt=0;
  	                        	foreach($resultprocnt as $key=>$val){
																//if($sl == 1){
																	?><section style="min-height:20px;"><p class="sublink1 mt10"> <?php
																//}
																?>
                              	<a href="<?php echo base_url(); ?><?php echo $val['friendly_url']; ?>"><?php echo $val['product_name']; ?></a>
                                <?php
																//if($sl == 6){
																	?></p></section><?php
																	//$sl=0;
																//}
																$cnt++;
                                $sl++;
                              }
															/*if($cnt % 6 !=0){
																?></p></section><?php
															}*/
                              ?>
                          	<div class="cb pb15"></div>
                          <p class="bt1 pt10 white"><a href="<?php echo base_url(); ?><?php echo $value['friendly_url']; ?>" class="btn1" style="display:block">View All Products</a></p>
                        </div>
                      </div>
                    	<?php
										}
									}
									?>
            		</li>
              	<?php
							}
						}
            ?>
            <li> <a href="<?php echo base_url(); ?>contactus" <?php if($catID <=0 && $metaType == 'contactus'){ echo 'class="act"'; } ?>>Contact Us</a> </li>
          </ul>
          <div class="cb"></div>
        </div>
      </nav><!-- #EndLibraryItem --><!-- nav ends --> 
  	</div>
	</section>
	<!-- top 2 ends --> 
</header>
<div class="mob_hider"></div>
<!-- HEADER ENDS -->
<?php
if( !count($this->uri->segments) ){
	?>
  <section class="wrapper pt10 mob_hider">
  	<div class="banner_area">
      <div class="fluid_container pb29">
        <div class="fluid_dg_wrap fluid_dg_charcoal_skin fluid_container" id="fluid_dg_wrap_1" >
          <div data-src="<?php echo resource_url(); ?>banner/slide1.jpg"></div>
          <div data-src="<?php echo resource_url(); ?>banner/slide2.jpg"></div>
          <div data-src="<?php echo resource_url(); ?>banner/slide3.jpg"></div>
          <div data-src="<?php echo resource_url(); ?>banner/slide4.jpg"></div>
          <div data-src="<?php echo resource_url(); ?>banner/slide5.jpg"></div>
        </div>
      </div>
    </div>
    <div class="cb bb pb8"></div>
  </section>
  <?php
}
?>