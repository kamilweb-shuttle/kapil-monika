<?php 
$this->load->view("top_application");
$curr_symbol = display_symbol();
$default_date = '2014-06-01';
$posted_start_date = $this->input->post('start_date');
?>
	<div class="mob_hider"></div>
  <!-- HEADER ENDS -->
  
  <div class="breadcrumbs mob_hider">
    <div class="wrapper">
      <p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b> <a href="<?php echo base_url(); ?>members/myaccount">My Account</a> <b>&gt;</b> <strong>Order History</strong></p>
    </div>
  </div>

  <section class="wrapper pt30" style="min-height:450px">
    <div class="inner_wrapper">
      <h1 class="mb5">Order History</h1>
      <ul class="emp_acc_link">
      	<li><a href="<?php echo base_url(); ?>members/myaccount">My Home</a></li>
      	<li><a href="<?php echo base_url(); ?>members/orders_history" class="act">Order History</a></li>
      	<li><a href="<?php echo base_url(); ?>members/members/manage_addresses">My Addresses</a></li>
      	<li><a href="<?php echo base_url(); ?>members/subscriptions">My Subscriptions</a></li>
      	<li><a href="<?php echo base_url(); ?>members/edit_account">Manage Account</a></li>
    	</ul>
      <div class="cb"></div>
      <div class="mt2">
        <div>
          <div class="p1 pt2 bg-white">
            <div class="p15 bg-gray border1 acc_title">
            	<img src="<?php echo theme_url(); ?>images/user.png" width="42" height="43" class="fl mr10" alt="">
            	<p class="fs18 ttu b black">
              	Welcome <?php echo ($this->fname!='' || $this->fname!=0)?$this->fname:'Member';?>!
              </p>
            	<p class="mt5">Last Login : <?php echo getDateFormat($this->last_login,6); ?>/ <span class="red"><a href="<?php echo base_url(); ?>users/logout" class="underline"><img src="<?php echo theme_url(); ?>images/lgt.png" width="17" height="17" class="vam mr5" alt="">Logout!</a></span></p>
            </div>            
            <!-- left ends --> 
            <br />
            <br />            
            <div class="acc_mid_boxes">
            	<script type="text/javascript">function serialize_form() { return $('#ord_frm').serialize(); } </script>
              <?php 
							echo form_open(base_url()."members/orders_history",'id="ord_frm"'); 
              error_message(); 
        			?>
                <div class="bg-gray border1 p10 pl15 acc_odh_filter">
                  <p>
                    <input name="order_id" id="order_id" value="" type="text" class="p5" placeholder="Order/Invoice No.">
                  </p>
                  <p>
                    <input name="start_date" id="start_date" type="text" readonly="readonly" class="p5 vam start_date1" placeholder="From">
                    <img src="<?php echo theme_url(); ?>images/calendar.png" alt="" class="start_date"></p>
                  <p>
                    <input name="end_date" id="end_date" type="text" readonly="readonly" class="p5 vam end_date1" placeholder="To">
                    <img src="<?php echo theme_url(); ?>images/calendar.png" alt="" class="end_date">
                  </p>               
                  <div>
                    <input name="action" type="submit" class="btn4" value="Search" />
                  </div>
                  <div class="cb"></div>
                </div>
                <?php
								if( is_array($res) && !empty($res)){
									?>
                  <div id="my_data">
                    <div class="paging_container mt2">
                      <div class="one">Showing :
                        <?php echo front_record_per_page('per_page1'); ?>
                      </div>
                      <div class="two paging"><?php echo $page_links;?></div>
                      <div class="cb"></div>
                    </div>                
                    <div class="mt10">                    
                      <div class="p15 bb2 black ttu fs14 cont_4_oh mob_hider b">
                        <div class="sec1">S. No.</div>
                        <div class="sec2">Order/Invoice No.</div>
                        <div class="sec3">Shipping Details</div>
                        <div class="sec4">View</div>
                        <div class="cb"></div>
                      </div>
              				<?php
											$i=1;
											foreach($res as $val){
												$total           	=  $val['total_amount'];
												$discount_total  	=  $val['coupon_discount_amount'];
												$shipping_total  	=  $val['shipping_amount'];
												$cod_total  			=  $val['cod_amount'];
												$tax 							= $val['vat_amount'];
												$grand_total      = ($total-$discount_total)+$shipping_total+$tax+$cod_total;			
												?> 
                        <div class="p15 bb cont_4_oh mt15">
                          <div class="sec1"><strong>S. No.:</strong> <?php echo $i; ?>.</div>
                          <div class="sec2">
                            <strong>Order/Invoice No.</strong>
                            <p class="black fs16">Order No.: <a href="<?php echo base_url(); ?>members/my_invoice/<?php echo $val['order_id']; ?>" class="uu" target="_blank"><?php echo $val['invoice_number']; ?></a></p>
                            <p class="mt2">Paid Amount : <b class="black"><?php echo display_price($total); ?></b>, Dated : <?php echo getDateFormat($val['order_received_date'],2); ?></p>
                          </div>
                          <div class="sec3">
                            <strong>Shipping Details</strong>
                            <p class="lht-18">Status : <b class="green"><?php echo $val['order_status'];?></b></p>
                            <?php
														//echo $val['courier_company_id'];
														if($val['courier_company_id']!=''){
															//echo "SELECT company_name FROM tbl_courier_company WHERE status = '1' AND company_id = '".$val['courier_company_id']."'";
															$comp_name = $this->db->query("SELECT company_name FROM tbl_courier_company WHERE status = '1' AND company_id = '".$val['courier_company_id']."'")->row_array();
															//trace($comp_name);
															if(!empty($comp_name)){
																?>
  	                          	<p class="mt10 i">Courier Info</p>
    	                          <p class="verd b black"><?php echo $comp_name['company_name']; ?></p>
                              	<?php
															}
														}
														if($val['tracking_code']!=''){
															?>
                            	<p>Reference No. <?php echo $val['tracking_code']; ?></p>
                              <?php
														}
														?>
                          </div>
                          <div class="sec4">
                          <a href="<?php echo base_url(); ?>members/my_invoice/<?php echo $val['order_id']; ?>" target="_blank" class=""><strong>View : </strong> <img src="<?php echo theme_url(); ?>images/vie.png" class="vam" alt=""></a>
                          </div>
                          <div class="cb"></div>
                        </div>     
                      	<!-- list 1 --> 
                        <?php
												$i++;
											}
											?>                             
                    </div>                                
                    <div class="paging_container">
                      <div class="one">Showing :
                        <?php echo front_record_per_page('per_page2'); ?>
                      </div>
                      <div class="two paging"><?php echo $page_links;?></div>
                      <div class="cb"></div>
                    </div>
                  </div>
                  <!--<input type="hidden" name="page_num" value="<?php echo $i; ?>" />-->
                  <?php
								}
							echo form_close();		
							?>
            </div>
            <br>
          </div>
        </div>
      </div>
      <div class="cb"></div>
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
	<script type="text/javascript" src="<?php echo base_url();?>assets/developers/js/ui/jquery-ui-1.8.16.custom.min.js"></script>
	<link type="text/css" href="<?php echo base_url();?>assets/developers/js/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
      
	<script type="text/javascript">
   jQuery(document).ready(function(){
		 
		 jQuery('[id ^="per_page"]').live('change',function(){
			 	$("[id ^='per_page'] option[value=" + jQuery(this).val() + "]").attr('selected', 'selected'); 
				//jQuery("input[name='per_page']","#ord_frm").val($(this).val());
				$('#ord_frm').submit();
			});	
		 
			jQuery('.start_date,.end_date').live('click',function(e){
	  		e.preventDefault();
	  		cls = $(this).hasClass('start_date') ? 'start_date1' : 'end_date1';
	  		jQuery('.'+cls+':eq(0)').focus();
				jQuery('.'+cls+':eq(0)').focus();
			});
			jQuery( ".start_date1").live('focus',function(){
					jQuery(this).datepicker({
					showOn: "focus",
					dateFormat: 'yy-mm-dd',
					changeMonth: true,
					changeYear: true,
					defaultDate: 'y',
					buttonText:'',
					minDate:'<?php echo $default_date;?>' ,
					maxDate:'<?php echo date('Y-m-d',strtotime(date('Y-m-d',time())."+180 days"));?>',
					yearRange: "c-100:c+100",
					buttonImageOnly: true,
					onSelect: function(dateText, inst) {
									jQuery('.start_date1').val(dateText);
									jQuery( ".end_date1").datepicker("option",{
									minDate:dateText ,
									maxDate:'<?php echo date('Y-m-d',strtotime(date('Y-m-d',time())."+180 days"));?>',
								});
		
								}
				});
			});
			jQuery( ".end_date1").live('focus',function(){
					jQuery(this).datepicker({
								showOn: "focus",
								dateFormat: 'yy-mm-dd',
								changeMonth: true,
								changeYear: true,
								defaultDate: 'y',
								buttonText:'',
								minDate:'<?php echo $posted_start_date!='' ? $posted_start_date :  $default_date;?>' ,
								maxDate:'<?php echo date('Y-m-d',strtotime(date('Y-m-d',time())."+180 days"));?>',
								yearRange: "c-100:c+100",
								buttonImageOnly: true,
								onSelect: function(dateText, inst) {
								jQuery('.end_date1').val(dateText);
								}
							});
				});
				
			});
		
		
</script>
<?php $this->load->view("bottom_application");?>