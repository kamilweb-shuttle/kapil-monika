<?php $this->load->view('top_application');?>
  <div class="mob_hider"></div>
  <!-- HEADER ENDS -->
  <div class="breadcrumbs mob_hider">
    <div class="wrapper">
      <p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b> <a href="<?php echo base_url(); ?>testimonials">Testimonials</a> <b>&gt;</b> <strong><?php echo $res['poster_name']; ?></strong></p>
    </div>
  </div>


  <section class="wrapper">
    <div class="p10 pt30">
      <div class="testimonial">
        <div class="t_left">
          <h1><?php echo $res['poster_name']; ?></h1>
          <div class="bb2 pb5"></div>
          <div class="t_box">
            <p class="t_text"> <?php echo $res['testimonial_description']; ?></p>
            <p class="black mt10"><b><?php echo $res['poster_name']; ?></b></p>
            <p class="gray"><?php echo getDateFormat($res['posted_date'],2);?></p>
          </div>
          <!-- list 1 -->
          <p class="fs16 green b mt15"><a href="<?php echo base_url(); ?>testimonials" class="uu">&lt;&lt; Go Back</a></p>
        </div>
        <!-- left ends -->
        <div class="t_right">
          <!--
          <h2><b>Post</b> Testimonials</h2>
          <div class="t_right_form">
            <p>
              <input name="" type="text" placeholder="Name *">
            </p>
            <p class="mt10">
              <input name="" type="text" placeholder="Email ID *">
            </p>
            <p class="mt10">
              <textarea cols="40" rows="5" placeholder="Testimonials *"></textarea>
            </p>
            <p class="mt10">
              <input name="verification _code" id="verification _code" type="text" placeholder="Enter Code *" class="vam" style="width:80px">
              <img src="images/captcha.png" alt="" class="vam"> <img src="images/ref.png" alt="" class="vam"></p>
            <p class="grey pt5 fs11">Type the characters shown above.</p>
            <p class="mt10">
              <input name="input" type="button"  value="Submit" class="btn2 radius-3">
              <input name="input" type="button" value="Reset" class="btn3 radius-3">
            </p>
          </div>
          <br>
          <br>
          -->
          <p class="r_banner"><img src="<?php echo theme_url(); ?>images/r_bnr_1.jpg" alt=""></p>
        </div>
        <!-- right ends -->
        <div class="cb pb25"></div>
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
<?php $this->load->view("bottom_application");?>