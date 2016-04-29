<?php $this->load->view('top_application');?>
	<div class="mob_hider"></div>
	<!-- HEADER ENDS -->
	<div class="breadcrumbs mob_hider">
  	<div class="wrapper">
    	<p class="ml5">YOU ARE HERE : <a href="<?php echo site_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b><strong>Testimonials</strong></p>
	  </div>
	</div>
	<!--  MIDDLE STARTS -->
  <section class="wrapper" style="min-height:600px">
    <div class="p10 pt30">
      <div class="testimonial">
        <div class="t_left">
          <h1>Testimonials</h1>
          <script type="text/javascript">function serialize_form() { return $('#myform').serialize();   } </script>
		   		<?php echo form_open('',"id='myform'"); ?> 
      		<div id="my_data">
          	<?php
						if(is_array($res) && !empty($res)){
							?>
              <div class="paging_container mt5">
                <div class="one">Showing :	<?php echo front_record_per_page('per_page1');?>	</div>
                <div class="two paging"><?php echo $page_links; ?></div>
                <div class="cb"></div>
              </div>
              <?php
							$sl=1;
							foreach($res as $val){
								$detailLink = $val['friendly_url'];
								?>
                <div class="t_box">
                  <p class="t_text">
                  	<?php echo char_limiter($val['testimonial_description'],200); ?>
                  	<b class="green"><a href="<?php echo $detailLink; ?>" class="uo">Read the rest&gt;&gt;</a></b>
                  </p>
                  <p class="black mt10"><b><?php echo $val['poster_name']; ?></b></p>
                  <p class="gray"><?php echo getDateFormat($val['posted_date'],2);?></p>
                </div>
                <?php
							}
							?>
              <!-- list 1 -->            
              <div class="paging_container">
                <div class="one">Sort by :	<?php echo front_record_per_page('per_page2');?>
                </div>
                <div class="two paging"><?php echo $page_links; ?></div>
                <div class="cb"></div>
              </div>
              <?php
						}
						?>
          </div>  
        </div>
        <!-- left ends -->        
        <div class="t_right">
         <p class="r_banner"><img src="<?php echo theme_url(); ?>images/r_bnr_1.jpg" alt=""></p>
        </div>
        <!-- right ends -->        
        <div class="cb"></div>
      </div>
    </div>
  </section>
	<!-- MIDDLE ENDS -->
	<section class="wrapper pt15  bt1 mid_banner_cont">
  	<?php 
		$cond = array();
		$cond['position'] = "Bottom Banner";
		banner_display($cond,330,182,'mid_banner', '<div class="mid_banner">', '</div>', "3");
		?>
	  <div class="cb"></div>
	</section>
	<!--body-->	
  <script>
		jQuery(document).ready(function(e) {
  		jQuery('[id ^="per_page"]').live('change',function(){		
				$("[id ^='per_page'] option[value=" + jQuery(this).val() + "]").attr('selected', 'selected'); jQuery('#myform').submit();
			});	
		});
	</script>
<?php $this->load->view("bottom_application");?>