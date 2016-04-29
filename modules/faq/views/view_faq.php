<?php $this->load->view('top_application'); ?>
  <div class="mob_hider"></div>
  <!-- HEADER ENDS -->
  
  <div class="breadcrumbs mob_hider">
    <div class="wrapper">
      <p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b><strong>FAQ's</strong></p>
    </div>
  </div>


  <section class="wrapper" style="min-height:600px">
    <div class="p10 pt30">
      <div class="testimonial">
        <div class="t_left">
          <h1>FAQ's</h1>
          <?php
          if(is_array($res) && !empty($res)){
            ?>
            <script type="text/javascript">function serialize_form() { return $('#myform').serialize(); } </script>
            <?php echo form_open('faq',"id='myform'");?>
              <div id="my_data">
                <div class="paging_container mt5">
                  <div class="one">Showing :
                    <?php echo front_record_per_page('per_page1');?>
                  </div>
                  <div class="two paging"><?php echo $page_links; ?></div>
                  <div class="cb"></div>
                </div>
                <ul class="fq">
                  <?php
                  $i=1;
                  foreach($res as $val){
                    ?>
                    <li>
                      <a href="javascript:void(0)"><img src="<?php echo theme_url(); ?>images/fq-r.png" alt=""><?php echo $val['faq_question'];?></a>
                      <div class="faq-text default"><?php echo $val['faq_answer'];?></div>
                    </li>
                    <?php
                  }
                  ?>
                </ul>
                <div class="paging_container">
                  <div class="one">Showing :
                    <?php echo front_record_per_page('per_page2');?>
                  </div>
                  <div class="two paging"><?php echo $page_links; ?></div>
                  <div class="cb"></div>
                </div>
              </div>
              <?php
            echo form_close();		
          }
					else{
						?>
						<div class="ac b"><br>No Records found!!!</div>
						<?php
					}
          ?>
        </div>  
        <!-- left ends -->
        <div class="t_right">
					<?php 
          $cond = array();
          $cond['position'] = "Right Banner";
          banner_display($cond,200,900,'r_banner', '<p class="r_banner">', '</p>', "1");
          ?>
        </div>
        <!-- right ends -->
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