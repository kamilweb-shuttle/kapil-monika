<?php $this->load->view("top_application");?>
  <div class="mob_hider"></div>
  <!-- HEADER ENDS -->
  
  <div class="breadcrumbs mob_hider">
    <div class="wrapper">
      <p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b><strong>Order Tracking</strong></p>
    </div>
  </div>

  <section class="wrapper cms_area">
    <div class="p10 pt30">
      <h1 class="bb2 pb3">Order Tracking</h1>
      <?php
			if($track!=''){
				if($track=='Yes'){
					?>
          <div class="ac mt20 status_dtl border1 p20 bg-gray fs16 weight300">
            <p class="lht-18">Status : <b class="green"><?php echo $order_status; ?></b> - <?php echo getDateFormat($order_received_date,2); ?></p>
            <?php
						if($company_name!=''){
							?>
            	<p class="mt10">Courier Info</p>
            	<p class="mt10 mb5 b black"><?php echo $company_name; ?></p>
            	<?php
						}
						if($tracking_code != ''){
							?>
	            <p>Reference No. <?php echo $tracking_code; ?></p>
              <?php
						}
						?>
          </div>
      		<?php
				}
				elseif($track == 'No'){
					?>
          <div class="ac mt20 status_dtl border1 p20 bg-gray fs16 weight300">
            <p class="lht-18">Status : <b class="red">Invalid Data</b></p>
          </div>  
          <?php
				}
			}
      echo form_open('');
			echo error_message();
			?>
      <div class="short_form">
        <fieldset class="pb15" style="border:0;">
          <p class="w36 pt8">
            <label for="name"> Order Number <b class="red">*</b> </label>
          </p>
          <div class="w62">
            <input name="invoice_number" id="invoice_number" value="<?php echo set_value('invoice_number');?>" type="text"><?php echo form_error('invoice_number');?>
          </div>
          <div class="cb pb7"></div>
          <p class="w36 pt8">
            <label for="email"> Email ID <b class="red">*</b> </label>
          </p>
          <div class="w62">
            <input name="email" id="email" value="<?php echo set_value('email');?>" type="text">
            <?php echo form_error('email');?>
          </div>
          <div class="cb pb7"></div>
          <div class="w62">
            <p class="mb10">
              <input name="verification_code" id="verification_code" type="text" placeholder="Word Verification *">
            </p>
            <img src="<?php echo site_url('captcha/normal');?>" id="captchaimage" alt="" class="vam"> <img src="<?php echo theme_url(); ?>images/ref.png" alt="" class="vam" onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();" />
            <?php echo form_error('verification_code');?>
          </div>
          <div class="cb"></div>
        </fieldset>
        <p class="w62">
          <input name="register_me" type="submit" value="Track My Order" class="btn2 radius-3" />
        </p>
        <div class="cb"></div>
      </div>
      <?php echo form_close(); ?>
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