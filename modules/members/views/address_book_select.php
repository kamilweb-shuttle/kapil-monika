<!DOCTYPE HTML>
<html>
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title><?=$this->config->item('site_name');?></title>
  
    <link href="<?php echo theme_url();?>css/win.css" rel="stylesheet" type="text/css">
    <link href="<?php echo theme_url();?>css/conditional_win.css" rel="stylesheet" type="text/css">
    <style type="text/css" media="screen">
      <!--
      @import url("<?php echo resource_url();?>fancybox/jquery.fancybox.css?v=2.1.5");
      @import url("<?php echo theme_url();?>css/fluid_dg.css");
      @import url("<?php echo theme_url(); ?>css/validationEngine.jquery.css");
      -->
    </style>
    <link href="<?php echo base_url(); ?>assets/developers/css/proj.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="<?php echo theme_url();?>images/favicon.ico">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/developers/js/common.js"></script>
    <script type="text/javascript" src="<?php echo resource_url(); ?>Scripts/languages/jquery.validationEngine-en.js"></script>
    <script type="text/javascript" src="<?php echo resource_url(); ?>Scripts/jquery.validationEngine.js"></script>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <![endif]-->
	</head>
	<body>
    <!-- MIDDLE STARTS -->
    <section class="wrapper">
      <div class="p20">
        <h1>Address Book</h1>
        <div class="mt10">
        	<?php
					if(is_array($address_res) && !empty($address_res)){
						?>
            <div class="p15 bb2 black ttu fs14 cont_4_address mob_hider b">
              <div class="sec1">S. No.</div>
              <div class="sec2">Address</div>
              <div class="sec3">Action</div>
              <div class="cb"></div>
            </div>
						<?php
            $i=1;
            foreach($address_res as $val){
              ?> 
              <div class="p15 bb cont_4_address">
                <div class="sec1"><strong>S. No.</strong> <?php echo $i; ?>.</div>
                <div class="sec2"><strong>Address:</strong>
                  <p><?php echo $val['address']; ?>, <?php echo $val['city']; ?>, <?php echo $val['state']; ?>, <?php echo $val['country']; ?> - <?php echo $val['zipcode']; ?></p>
                  <p class="mt5"><b>Name :</b> <?php echo $val['name']; ?></p>
                  <p class="mt5"><b>Landmark :</b> <?php echo $val['landmark']; ?></p>
                </div>
                <input type="hidden" name="name_<?php echo $val['address_id']; ?>" id="name_<?php echo $val['address_id']; ?>" value="<?php echo $val['name']; ?>">
                <input type="hidden" name="mobile_<?php echo $val['address_id']; ?>" id="mobile_<?php echo $val['address_id']; ?>" value="<?php echo $val['mobile']; ?>">
                <input type="hidden" name="phone_<?php echo $val['address_id']; ?>" id="phone_<?php echo $val['address_id']; ?>" value="<?php echo $val['phone']; ?>">
                <input type="hidden" name="address_<?php echo $val['address_id']; ?>" id="address_<?php echo $val['address_id']; ?>" value="<?php echo $val['address']; ?>">
                <input type="hidden" name="landmark_<?php echo $val['address_id']; ?>" id="landmark_<?php echo $val['address_id']; ?>" value="<?php echo $val['landmark']; ?>">
                <input type="hidden" name="city_<?php echo $val['address_id']; ?>" id="city_<?php echo $val['address_id']; ?>" value="<?php echo $val['city']; ?>">
                <input type="hidden" name="state_<?php echo $val['address_id']; ?>" id="state_<?php echo $val['address_id']; ?>" value="<?php echo $val['state']; ?>">
                <input type="hidden" name="country_<?php echo $val['address_id']; ?>" id="country_<?php echo $val['address_id']; ?>" value="<?php echo $val['country']; ?>">
                <input type="hidden" name="zipcode_<?php echo $val['address_id']; ?>" id="zipcode_<?php echo $val['address_id']; ?>" value="<?php echo $val['zipcode']; ?>">
                <div class="sec3">
                  <input name="select_<?php echo $val['address_id']; ?>" id="select_<?php echo$val['address_id']; ?>" type="button" class="btn6 radius-3 select_add" value="Select">
                </div>
                <div class="cb"></div>
              </div>
							<?php
              $i++;
            }
					}
					else{
						?>
            <div class="ac mt30 red b">No Address Found!!!</div>
            <?php
					}
					?>
          <!-- list 1 -->        
        </div>
      </div>
    </section>
    <!-- MIDDLE ENDS --> 
    <!--BODY ENDS--> 
    <script type="text/javascript">  
			var Page = '';
    	var site_url = '<?php echo site_url();?>';
			var theme_url = '<?php echo theme_url();?>';
			var resource_url = '<?php echo resource_url(); ?>';
			
			jQuery(document).ready(function(e) {
		  	jQuery('[id ^="select_"]').live('click',function(){		
					var iVal = $(this).attr('id');
					var mid = iVal.split('_');
					var id = mid[1];
					var name_id 		= 'name_'+id;
					var mobile_id 	= 'mobile_'+id;
					var phone_id 		= 'phone_'+id;
					var address_id 	= 'address_'+id;
					var city_id 		= 'city_'+id;
					var state_id 		= 'state_'+id;
					var landmark_id = 'landmark_'+id;
					var country_id 	= 'country_'+id;
					var zipcode_id 	= 'zipcode_'+id;
					
					window.parent.$("#name").val($('#'+name_id).val());
					window.parent.$("#mobile").val($('#'+mobile_id).val());
					window.parent.$("#phone").val($('#'+phone_id).val());
					window.parent.$("#address").val($('#'+address_id).val());
					window.parent.$("#landmark").val($('#'+landmark_id).val());
					window.parent.$("#city").val($('#'+city_id).val());
					window.parent.$("#state").val($('#'+state_id).val());
					window.parent.$("#country").val($('#'+country_id).val());
					window.parent.$("#zipcode").val($('#'+zipcode_id).val());
					window.parent.$("#def_addr").val(id);
					$.fancybox.close();
					//alert(id);
				});	
			});			
		</script>
		<script type="text/javascript" src="<?php echo resource_url(); ?>Scripts/script.int.dg.js"></script>
	</body>
</html>