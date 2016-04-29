<?php $this->load->view("top_application");?>
	<div class="mob_hider"></div>
	<!-- HEADER ENDS -->

  <div class="breadcrumbs mob_hider">
  	<div class="wrapper">
    	<p class="ml5">
    		YOU ARE HERE : 
	      <a href="<?php echo base_url();?>"><img src="<?php echo theme_url();?>images/hm.png" class="vam pb3" alt=""></a> 
      	<!--<b>&gt;</b>-->
    		<?php
				$segment=3;
  	  	$catid;
				if($catid ){
					echo category_breadcrumbs($catid,$segment);
				}
				else{
					echo '<b>&gt;</b> <strong>Categories</strong>';
				} 
				?>  
	    </p>
  	</div>
	</div>
  <section class="wrapper" style="min-height:600px;">
    <div class="pt30">
      <div class="left_zone mob_hider">
        <h2>
        	<b class="fs14 lht-16">Products by</b><br>
          Categories
        </h2>
        <div class="cat_list mt10">
        	<?php
					if(is_array($resleft) && !empty($resleft)){
						foreach($resleft as $k => $v){
							$link_url = base_url().$v['friendly_url'];
							if($v['category_id'] == $catid) $cls = 'class="act"';
							else $cls = "";
							?>
              <a href="<?php echo $link_url; ?>" <?php echo $cls; ?>><?php echo char_limiter($v['category_name'],20); ?></a><br>
              <?php
						}
					}
					?>
       	</div>
        <?php
				if($totalRecord == 10){
					?>
	        <p class="b fs13 black mt15 pl15 bb2 pb15"><a href="<?php echo base_url(); ?>category" class="uu">View All Categories»</a></p>
          <?php
				}
				?>
        <br>
        <?php 
				$cond = array();
				$cond['position'] = "Left Banner";
				banner_display($cond,200,900,'r_banner', '<p class="r_banner">', '</p>', "1");
				?>
      </div>
      <!-- right ends -->
      <script type="text/javascript">function serialize_form() { return $('#myform').serialize();   } </script>
			<?php echo form_open("",'id="myform"');?>
        <div class="right_zone" id="my_data">
          <h1 class="bb2 pb3"><?php echo $parentres['category_name']; ?></h1>
          <div class="paging_container">
            <div class="one">Showing :
              <?php echo front_record_per_page('per_page1'); ?>
            </div>
            <div class="two paging"><?php echo $page_links; ?></div>
            <div class="cb"></div>
          </div>
          <div style="min-height:600px;" class="mt20 mb10 cat_box">
          	<?php
            if(is_array($res) && !empty($res) ){
              ?> 
              <ul class="floater float_3">
                <?php
                foreach($res as $val){
                  $link_url = base_url().$val['friendly_url'];
									$catCount = count_category(" AND parent_id = '".$val['category_id']."' ");
									$proCount = count_products(" AND category_id = '".$val['category_id']."' ");
									if($proCount > 0) $count = $proCount;
									else $count = $catCount;
                  ?>
                  <li>
                    <div class="pro_box trans_eff">
                      <div class="pro_pc">
                        <figure><a href="<?php echo $link_url;?>"><img src="<?php echo get_image('category',$val['category_image'],'220','180','R'); ?>" alt="<?php echo $val['category_alt'];?>"></a></figure>
                      </div>
                      <div class="p10 pt15 bg-gray ac border1 trans_eff mt10">
                        <p class="fs18 red oswald"><a href="<?php echo $link_url;?>" class="uo"><?php echo char_limiter($val['category_name'],28);?></a></p>
                        <p class="osons ac fs16 gray weight300 mt10"><?php echo $count; ?> Items</p>
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

	<!--content section-->
	<script>
		jQuery(document).ready(function(e) {
		  jQuery('[id ^="per_page"]').live('change',function(){		
				$("[id ^='per_page'] option[value=" + jQuery(this).val() + "]").attr('selected', 'selected'); jQuery('#myform').submit();
			});	
		});
	</script>
<?php $this->load->view("bottom_application");?>