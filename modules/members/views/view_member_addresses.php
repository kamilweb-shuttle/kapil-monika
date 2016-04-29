<?php $this->load->view("top_application");?>
	<div class="mob_hider"></div>
	<!-- HEADER ENDS -->
	<div class="breadcrumbs mob_hider">
  	<div class="wrapper">
    	<p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b> <a href="<?php echo base_url(); ?>members/myaccount">My Account</a> <b>&gt;</b> <strong>My Addresses</strong></p>
	  </div>
	</div>

	<section class="wrapper pt30" style="min-height:450px">
  	<div class="inner_wrapper">
    	<h1 class="mb5">My Addresses</h1>
    	<ul class="emp_acc_link">
      	<li><a href="<?php echo base_url(); ?>members/myaccount">My Home</a></li>
      	<li><a href="<?php echo base_url(); ?>members/orders_history">Order History</a></li>
      	<li><a href="<?php echo base_url(); ?>members/members/manage_addresses" class="act">My Addresses</a></li>
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
          
          	<p class="ac"><a href="<?php echo base_url(); ?>members/manage_addresses_add" class="btn5 radius-20b" style="padding:0 40px">Add New Address</a></p>
          	<!-- left ends --> 
          	<br />
    				
            
            <div class="acc_mid_boxes">
            	<?php
							echo error_message();
							if(is_array($address_res) && !empty($address_res)){
								?>
								<script type="text/javascript">function serialize_form() { return $('#myform').serialize(); } </script>
								<?php echo form_open('faq',"id='myform'");?>
									<div id="my_data">
                    <div class="paging_container mt2">
                      <div class="one">Showing :
                        <?php echo front_record_per_page('per_page1');?>
                      </div>
                      <div class="two paging"><?php echo $page_links; ?></div>
                      <div class="cb"></div>
                    </div> 				
										<div class="mt10">
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
                          <div class="sec1">
                            <strong>S. No.</strong> <?php echo $i; ?>.
                          </div>
                          <div class="sec2">
                            <strong>Address:</strong> 
                            <p><?php echo $val['address']; ?>, <?php echo $val['city']; ?>, <?php echo $val['state']; ?>, <?php echo $val['country']; ?> - <?php echo $val['zipcode']; ?></p>
                            <p class="mt5"><b>Name :</b> <?php echo $val['name']; ?></p>
                            <p class="mt5"><b>Landmark :</b> <?php echo $val['landmark']; ?></p>
                          </div>
                          <div class="sec3">
                            <strong>Action : </strong> 
                            <a href="<?php echo base_url(); ?>members/manage_addresses_edit/<?php echo $val['address_id']; ?>"><img src="<?php echo theme_url(); ?>images/edit.png" title="Edit" class="vam mr5" alt=""></a> 
                            <a href="<?php echo base_url(); ?>members/delete_address/<?php echo $val['address_id']; ?>"><img src="<?php echo theme_url(); ?>images/m-no.png" class="vam" title="Delete" alt=""></a>
                          </div>
                          <div class="cb"></div>
                        </div>  
                      	<?php
												$i++;
											}
											?>
                    </div>   
                    
                    <div class="paging_container">
                      <div class="one">Showing :
                        <?php echo front_record_per_page('per_page2');?>
                      </div>
                      <div class="two paging"><?php echo $page_links; ?></div>
                      <div class="cb"></div>
                    </div>
                  </div>
                <?php echo form_close(); ?>
                <?php
							}
							else{
								?>
                <div class="ac mt30 red b">No Address Found!!!</div>
                <?php
							}
							?>        		
            </div>
          	<br />
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

<script type="text/javascript">
  	jQuery('[id ^="per_page"]').live('change',function(){		
			$("[id ^='per_page'] option[value=" + jQuery(this).val() + "]").attr('selected', 'selected'); 
			//jQuery("input[name='per_page']","#ord_frm").val($(this).val());
			jQuery('#ord_frm').submit();
		});	
</script>
<?php $this->load->view("bottom_application");?>