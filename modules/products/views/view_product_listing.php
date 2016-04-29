<?php $this->load->view("top_application");?>
	<div class="mob_hider"></div>
	<!-- HEADER ENDS -->
  <div class="breadcrumbs mob_hider">
    <div class="wrapper">
      <p class="ml5">
      	YOU ARE HERE : 
        <a href="<?php echo base_url(); ?>">
        	<img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt="">
        </a> 
        <?php
				$segment=3;
				if($catid){
					echo category_breadcrumbs($catid,$segment);
				}
				else{
					echo '<b>&gt;</b><strong>'.$heading_title.'</strong>';
				}   
				?>
      </p>
    </div>
  </div>
  <section class="wrapper" style="min-height:600px;">
    <div class="pt30">
      <?php 
			$data['catid'] = $catid;
			$this->load->view("category/category_left_view",$data);
			?>
      <!-- right ends -->
      <script type="text/javascript">function serialize_form() { return $('#myform').serialize();   } </script>
      <?php echo form_open("",'id="myform" method="post" ');?>
				<div id="my_data">
          <div class="right_zone">
            <h1 class="bb2 pb3"><?php echo $heading_title; ?></h1>
            <div class="paging_container">
              <div class="one">Showing :
                <?php echo front_record_per_page('per_page1'); ?>
              </div>
              <div class="two paging"><?php echo $page_links; ?></div>
              <div class="cb"></div>
            </div>
            <div style="min-height:600px;" class="mt20 mb10 cat_box">
            	<?php
							if(is_array($res) && !empty($res)){
								?> 
                <ul class="floater float_3">
                	<?php
                	$ix=1;
									foreach($res as $val){
										$link_url=base_url().$val['friendly_url'];
										$productStock = product_stock($val['products_id']);
										?> 
                    <li>
                      <div class="pro_box trans_eff">
                        <div class="pro_pc">
                          <figure>
                          <a href="<?php echo $link_url;?>">
                          	<?<?php
														if($productStock <= 0){
															?>
                            	<img src="<?php echo theme_url(); ?>images/outstock.png" class="outstock" alt="">
                              <?php
														}
														?>
                            <img src="<?php echo get_image('products',$val['media'],'220','180','R'); ?>" alt="<?php echo $val['product_alt'];?>">
                          </a>
                          </figure>
                        </div>
                        <div class="p10 pt8 pb5">
                          <p class="fs13 black bb2 pb8 pl5"><a href="<?php echo $link_url;?>" class="uo"><?php echo char_limiter($val['product_name'],20);?></a></p>
                          <a href="<?php echo $link_url;?>" class="red_btn radius-5 fr mt12">Add to Cart</a>
                          <?php
													if($val['product_discounted_price'] > 0){
														?>
														<p class="black weight400 fs16 mt10 pl5 lht-18"><?php echo display_price($val['product_discounted_price']); ?> <b class="weight400 gray1 db fs14 through"><?php echo display_price($val['product_price']); ?></b></p>
														<?php
													}
													else{
														?>
														<p class="black weight400 fs16 mt10 pl5 lht-18"><?php echo display_price($val['product_price']); ?></p>
														<?php
													}
													?>
                        </div>
                      </div>
                    </li>
                    <?php
									}
									?>
                </ul>
                <?php
							}
							else{
								echo '<div class="ac b" style="height:175px;"><br>'.$this->config->item('no_record_found').'</div>';	
							}
							?>
              <div class="cb"></div>
            </div>
            <div class="paging_container">
              <div class="one">Showing :
                <?php echo front_record_per_page('per_page2'); ?>
              </div>
              <div class="two paging"><?php echo $page_links; ?></div>
              <div class="cb"></div>
            </div>
          </div>
      	</div>
      <?php echo form_close(); ?>  
      <!-- left ends -->
      
      <div class="cb bb pb30"></div>
      
      <!-- RECENTLY VIEWED ITEMS -->
      <?php echo get_recent_view(); ?>      
      <!-- RECENTLY VIEWED ITEMS ENDS --> 
      
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
	<script>
		jQuery(document).ready(function(e) {
		  jQuery('[id ^="per_page"]').live('change',function(){		
				$("[id ^='per_page'] option[value=" + jQuery(this).val() + "]").attr('selected', 'selected'); jQuery('#myform').submit();
			});	
		});
	</script>
<?php $this->load->view("bottom_application");?>