<?php $this->load->view('top_application'); ?>



  
  <div role="main" class="main">
		
			<!-- Begin page top -->
		<section class="page-breadcrumb">
				<div class="container">
					
					<ol class="breadcrumb">
  <li><a href="#">Home</a></li>

  <li class="active">Contact Us</li>
</ol>
					
				</div>
			</section>
			<!-- End page top -->
			
			<div class="container">
				<div class="row">
					<div class="col-sm-6 animation">
						<div class="contact-content">
							
							<h4>Contact Form</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Nam scelerisque faucibus risus non iaculis.</p>
							<form id="contact-form" name="form1" method="post" action="" >
							
								<div class="form-group">
									<div class="row">
										<div class="col-xs-6">
											<label for="name">Your Name*</label>
											<input name="customer_name"  type="text" id="name" class="form-control" value="" data-msg-required="Please enter your name." required>
										</div>
										<div class="col-xs-6">
											<label for="customer_mail">Your Email*</label>
											<input name="customer_mail"  type="text" id="customer_mail" class="form-control" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." required>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-xs-6">
											<label for="subject">Subject*</label>
											<input name="subject" type="text" id="subject" class="form-control" value="" data-msg-required="Please enter the subject." required>
										</div>
										<div class="col-xs-6">
											<label for="website">Website</label>
											<input type="text" class="form-control" id="website" name="website" value="">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="comments">Your Message*</label>
									<textarea name="comments" id="comments" class="form-control" rows="3" data-msg-required="Please enter your message." required></textarea>
								</div>
								<div class="form-group">
									<input type="submit" value="Submit" class="btn btn-primary">
								</div>
							</form>
						</div>
					</div>
					<div class="col-sm-6 animation">
						<div class="contact-content">
							<h4>Get in touch</h4>
							<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.</p>
							<address>
								<i class="fa fa-map-marker"></i> Alexander Street. Vancouver, BC<br>
								V6A 1E1 Canada<br><i class="fa fa-phone"></i> 012.345.6789<br>
								<i class="fa fa-print"></i> 012.345.6789<br>
								<i class="fa fa-envelope"></i> <a href="mailto:mail@domainname.com">mail@domainname.com</a>
							</address>
						</div>
					</div>
				</div>
			</div>
			<!-- Google Map -->
			<div class="animation" id="googlemaps"></div>
		</div>
  
  
  
  
  
  
  
  
  
  
  <!-- Contact us old code -->
  <!--section class="wrapper" style="min-height:600px">
    <div class="p10 pt30">
      <h1>Contact Us</h1> 
      <div class="mt10 contact_box">
        <?php echo $content;?>
        <div class="cb"></div>
        
        <a id="feedback"></a>
        <div class="mt15 contact_form_cont">
          <h3>Still need help? <b class="fs16 red">Just Fill the Below Information:</b></h3>
          <?php echo form_open('contactus');?>	
            <fieldset class="contact_form" style="border:none;">
              <div class="mt5">
                <input type="text" name="name" id="name" value="<?php echo set_value('name');?>" placeholder="Full Name *">
                <?php echo form_error('name');?>
              </div>
              <div class="mt5">
                <input type="text" name="email" id="email" value="<?php echo set_value('email');?>" placeholder="Email *">
                <?php echo form_error('email');?>
              </div>
              <div class="mt5">
                <input type="text" name="phone_number" id="phone_number" value="<?php echo set_value('phone_number');?>" placeholder="Phone Number">
                <?php echo form_error('phone_number');?>
              </div>
              <div class="mt5">
                <input type="text" name="mobile_number" id="mobile_number" value="<?php echo set_value('mobile_number');?>" placeholder="Mobile Number *">
                <?php echo form_error('mobile_number');?>
              </div>
              <div class="mt5">
                <textarea name="description" id="description" cols="45" rows="5" placeholder="Comment/Messsage *"><?php echo set_value('description');?></textarea>
                <?php echo form_error('description');?>
              </div>
              <div class="mt5">
                <input name="verification_code" id="verification_code1" type="text" placeholder="Word Verification *" class="vam" style="width:120px">
                <img src="<?php echo site_url('captcha/normal');?>" id="captchaimage1" alt="" class="vam"> <img src="<?php echo theme_url(); ?>images/ref.png" alt="" class="vam" onclick="document.getElementById('captchaimage1').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code1').focus(); document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random();" /> 
                <?php echo form_error('verification_code');?>
                <p class="grey pt5 fs11">Type the characters shown above.</p>
              </div>
              <div class="mt10">
                <input name="submit" type="submit"  value="Submit" class="btn2 radius-3" />
                <input name="reset" type="reset" value="Reset" class="btn3 radius-3" />
              </div>
            </fieldset>
          <?php echo form_close(); ?>  
        </div>
      </div>
    </div>
  </section-->
	
<?php $this->load->view('bottom_application'); ?>

  <script type="text/javascript" src="<?php echo base_url(); ?>/assets/designer/style-switcher/js/switcher.js"></script>
	
	<script type="text/javascript">
		$(function () {
			$('#datetimepicker1').datetimepicker();
			$('#datetimepicker4').datetimepicker({
				pickDate: false
			});
		});
	</script>
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script src="<?php echo base_url(); ?>/assets/designer/vendor/jquery.gmap.js"></script>
  <script>

		/*
		Map Settings

			Find the Latitude and Longitude of your address:
				- http://universimmedia.pagesperso-orange.fr/geo/loc.htm
				- http://www.findlatitudeandlongitude.com/find-address-from-latitude-and-longitude/

		*/

		// Map Markers
		var mapMarkers = [{
			address: "1234 Pine Shade Pl, Salt Lake City, UT 84118",
			html: "<strong>Flatize Shop</strong><br>123 Name Ave, Suite 600, Salt Lake City, UT 84118<br><br>",
			popup: false,
			icon: {
				image: "images/maker.png",
				iconsize: [28, 42],
				iconanchor: [28, 32]
			}
		}];

		// Map Initial Location
		var initLatitude = 40.65610;
		var initLongitude = -112.02586;

		// Map Extended Settings
		var mapSettings = {
			controls: {
				panControl: true,
				zoomControl: true,
				mapTypeControl: true,
				scaleControl: true,
				streetViewControl: true,
				overviewMapControl: true
			},
			scrollwheel: false,
			markers: mapMarkers,
			latitude: initLatitude,
			longitude: initLongitude,
			zoom: 15
		};

		var map = $("#googlemaps").gMap(mapSettings);

		// Map Center At
		var mapCenterAt = function(options, e) {
			e.preventDefault();
			$("#googlemaps").gMap("centerAt", options);
		}

	</script>
  