<?php $this->load->view("top_application");?>
  <div class="mob_hider"></div>
  <!-- HEADER ENDS -->
  <style type="text/css" media="screen">
		<!--
		@import url("<?php echo resource_url(); ?>zoom/magiczoomplus.css");
		-->
	</style>
  <div class="breadcrumbs mob_hider">
    <div class="wrapper">
      <p class="ml5">
      	YOU ARE HERE : 
        <a href="<?php echo base_url(); ?>">
        <img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt="">
        </a> 
        <?php	
				echo category_breadcrumbs($res['category_id']);	
				echo '<b>&gt;</b> <strong>'.char_limiter($res['product_name'],45).'</strong>';    
				?>
      </p>
    </div>
  </div>
	<section class="wrapper" style="min-height:600px;">
  	<div class="inner_wrapper">
    	<div class="pt30">
      	<div class="dtl_images">
        	<div style="width:400px; height:327px;" class="border1"><a href="<?php echo img_url();?>products/<?php echo $res['media']?>" class="MagicZoomPlus" id="Zoomer" title="" rel="initialize-on: mouseover;hint: false;show-loading:false; thumb-change:click"><img src="<?php echo get_image('products',$res['media'],400,327,'R');?>" class="db radius-10" alt="" width="400" height="327"></a></div>          
          <div class="ac o-hid rel mt10" style="height:68px;">
          	<?php 
						if(count($media_res) > 3){
							?>
	          	<a href="javascript:void(0)" class="prev3"><img src="<?php echo theme_url(); ?>images/arl.png" width="14" height="24" class="fl mt22 ml5" alt=""></a> 
  	          <a href="javascript:void(0)" class="next3"><img src="<?php echo theme_url(); ?>images/arr.png" width="14" height="24" class="fr mt22 mr5" alt=""></a>
              <?php
						}
						?>            
          	<div class="fl ml6" style="height:67px;">
            	<div <?php if(count($media_res) > 3){ echo 'class="scroll_3"'; }?>>
              	<ul class="myulx">
                	<?php 
									$thumbc['width']=400;
									$thumbc['height']=327;
									$thumbc['source_path']=UPLOAD_DIR.'/products/';
									if(is_array($media_res) && !empty($media_res)){
										$ix=0;
										foreach($media_res as $v){
											
											$thumbc['org_image']=$v['media'];
											Image_thumb($thumbc,'R');
											$cache_file="thumb_".$thumbc['width']."_".$thumbc['height']."_".$thumbc['org_image'];
											$catch_img_url=thumb_cache_url().$cache_file;
											?>
											<li class="fl">
												<div class="ds_thm"><a href="<?php echo img_url();?>products/<?php echo $v['media'];?>" rel="zoom-id:Zoomer;" rev="<?php echo $catch_img_url;?>"><img src="<?php echo get_image('products',$v['media'],80,65,'R');?>" alt="<?php echo $res['product_alt'];?>" width="80" height="65"></a> </div>
											</li>
											<?php
										}
									}
									?>
                </ul>
              	<div class="cb"></div>
	            </div>
  	        </div>
    	    </div>
      	  <div class="cb pb5"></div>
	      </div>
      	
  	    <div class="dtl_images_mob"><img src="<?php echo get_image('products',$res['media'],400,327,'R');?>" alt="<?php echo $res['product_alt'];?>"></div>
      
      	<!-- images ends -->
        <?php echo form_open('cart/add_to_cart/'.$res['products_id'],array('name'=>'cartfrm','id'=>'cartfrm'));?>  
          <div class="dtl_contents">
            <div>
              <p class="fs22 lht-28 b"><?php echo $res['product_name']; ?></p>
              <p class="verd lht-20">Product Code : <b class="black"><?php echo $res['product_code']; ?></b></p>
              <p class="mt5 verd">
                <?php 
                if($review_count > 0){
                  $ratingVal = product_overall_rating($res['products_id'], 'product'); 
                  //echo $ratingVal;
                  echo rating_html($ratingVal,5);
                  echo "/ ";
                }
                ?>
                <b class="red"><a href="#reviews" class="scroll uu"><?php echo $review_count; ?></a></b> 
                Reviews / <a href="#postreviews" class="scroll uu">
                <img src="<?php echo theme_url(); ?>images/pen.png" class="vam mr5" alt="">Write a Review</a>
              </p>
              <div class="cb"></div>
              <p class="mt10 verd"><b>Meterial :</b> <?php echo $res['product_material']; ?></p>
              <div id="avl">
                <?php
                if($res['product_discounted_price'] > 0){
                  ?>
                  <p class="fs24 mt20 weight300">Price : <b><b class="red through normal"><?php echo display_price($res['product_price']); ?></b> <?php echo display_price($res['product_discounted_price']); ?></b> <b class="weight300 fs16">(Save <?php echo you_save($res['product_price'],$res['product_discounted_price']); ?>%)</b></p>
                  <?php
                }
                else{
                  ?>
                  <p class="fs24 mt20 weight300">Price : <b class="red normal"><?php echo display_price($res['product_price']); ?></b></p>
                  <?php
                }
                ?>
              </div>  
              <div class="border3 mt15 p5">
                <div class="dtl_inr_box1">
                  <div class="p15 lht-20">
                    <?php
										if($res['color_ids']!='' && $res['size_ids']!=''){
											$col = explode(',',$res['color_ids']);
											$sz = explode(',',$res['size_ids']);
											?>
											<p class="verd">Available Color </p>
											<select name="color" id="color" class="p5">
												<option value="">---Select Color---</option>
												<?php
												foreach($col as $key=>$val){
													?>
													<option value="<?php echo $val; ?>"><?php echo color_name($val); ?></option>
													<?php
												}
												?>
											</select>
											<p class="mt10 verd">Available Size</p>
											<select name="size" id="size" class="p5">
												<option value="">---Select Size---</option>
												<?php
												foreach($sz as $k=>$v){
													?>
													<option value="<?php echo $v; ?>"><?php echo size_name($v); ?></option>
													<?php
												}
												?>
											</select>
                      <?php
										}
										?>
                    <input type="hidden" name="qty" id="qty" value="1" />
                    <input type="hidden" name="avlqty" id="avlqty" value="<?php echo abs($res['product_qty']); ?>" />
                    <script type="text/javascript">
                      $(document).ready(function(){
                        $('#color, #size').live('change',function(e){
                          e.preventDefault();												
                          size_id = $('#size').val();
                          color_id = $('#color').val();
													product_id = '<?php echo $res['products_id'];?>'												
                          if(color_id != '' && size_id != ''){
                            $.post('<?php echo base_url();?>products/get_product_price',{sid:size_id, cid:color_id, pid:product_id},function(data){
                              if(data){
                                var myData = data.split('-');
                                if(myData[0] > 0){
                                  if(myData[1] > 0){
                                    var price = Math.abs(myData[1]);
                                    var dis_price=Math.abs(myData[2]);
                                    if(dis_price > 0){
																			var mySave = (((price*1-dis_price*1)/price*1)*100);
																			$('#avl').html('<p class="fs24 mt20 weight300">Price : <b><b class="red through normal"><span class="WebRupee">Rs.</span>'+price.toFixed(2)+'</b> <span class="WebRupee">Rs.</span>'+dis_price.toFixed(2)+'</b> <b class="weight300 fs16">(Save '+mySave.toFixed(2)+'%)</b></p>');
																		}
																		else{
																			$('#avl').html('<p class="fs24 mt20 weight300">Price : <b><span class="WebRupee">Rs.</span>'+price.toFixed(2)+'</b></p>');
																		}
                                    $('.in_out').html('In Stock');	
                                    $('.atc_btn').show();
																		$('#avlqty').val(Math.abs(myData[0]));
                                  }
                                }
                                else{
                                  $('#avl').html('<p class="fs24 red mt20 weight300"><b>Product Not Available!!</b></p>');$('.atc_btn').hide();$('.in_out').html('Out of Stock');$('#avlqty').val(0);
                                }
                              }
                              else{
                                $('#avl').html('<p class="fs24 red mt20 weight300"><b>Product Not Available!!</b></p>');$('.atc_btn').hide();$('.in_out').html('Out of Stock');$('#avlqty').val(0);
                              }
                            });
                          }
                        });
                      });	
                    </script>
                    <p class="mt15">
                      <input name="cartbtn" type="button" class="btn2 shadow1 atc_btn" id="cartbtn" data-fancybox-type="ajax" value="Add to Cart Now!" style="font-size:14px; width:222px; height:40px; line-height:40px">
                    </p>
                    <p class="mt10">Order on phone : 1800 000 0000</p>
                  </div>
                </div>
                <div class="dtl_inr_box2">
                  <div class="p15">
                    <p class="b green fs18 in_out">In Stock</p>
                    <div class="w60 mt5 bb"></div>
                    <p class="mt5"><?php echo $res['delivery_text']; ?></p>
                     <div class="w60 mt5 bb"></div>
                <p class="mt10 b mb5 ttu">Payment Options</p>
                    <img src="<?php echo theme_url(); ?>images/po1.gif" alt="" title="Cash on Delivery"> <img src="<?php echo theme_url(); ?>images/po3.jpg" alt="" title="Credit / Debit Cards / Internet Banking">
                    <div class="w60 mt5 bb"></div>
                    <p class="mt5">Check Your Delivery Options</p>
                    <p class="mt5">
                      <input name="zip_code" id="zip_code" type="text" value="" class="w60 vam p2 pl7" placeholder="" />
                      <input name="check" type="button" class="btn6 vam chk_location" value="Check" />
                    </p>
                    <p class="mt5 pale av_check dn">COD not available at your location and not servicable.</p>
                    <span class="mt5 red zip_code_error"></span>
                  </div>
                  <script type="text/javascript">
                    $(document).ready(function(){
                      $(".chk_location").live('click',function(e){
                        e.preventDefault();	
                        $(".zip_code_error").html("");
                        if($("#zip_code").val()==0){
                          $(".zip_code_error").html("Please enter zip code.");
                        }
                        else{
                          $.ajax({"url":'<?php echo site_url('products/check_zipcode')?>','type':"POST",'dataType':"json",'data':{'zip_code':$("#zip_code").val()},
                            'success':function(data){
                              if(data.error){
                                $(".zip_code_error").html(data.error);
                              }
															else if(data.warning){
																$(".zip_code_error").html(data.warning);
															}
                              else{
                                $(".zip_code_error").html('COD available in you location.');
                              }					
                            }
                          });
                          return false;
                        }
                      });
                    });
                  </script>
                </div>
                <div class="cb"></div>
              </div>
            </div>
          </div>
        <?php echo form_close(); ?>
      	<div class="cb bb pb20"></div>
      	<!-- right ends -->
      
        <div class="mt20">
        	<?php
					if(!empty($res['video_code']) && $res['video_type'] == 'embed'){
						?>
	          <div class="pro_video shadow1">
  	        	<?php echo $res['video_code']; ?>
    	        <!--<iframe src="https://www.youtube.com/embed/GiFWkvl0g5o" frameborder="0" allowfullscreen></iframe>-->	
    	      </div>
            <?php
					}
					elseif($res['video_type'] = 'file' && $res['video_file']!=''){
						$file_name		=	$res['video_file'];
						$exp_file_name	=	explode('.',$file_name);
						$file_img_name	=	$exp_file_name[0].'.jpeg'; 
						?>
            <div class="pro_video shadow1">
			        <div  id="video-area1">  
      				</div>          
        		</div>
            <script type="text/javascript" src="<?php echo resource_url();?>jwplayer/jwplayer.js"></script>
            <script type="text/javascript">
							jwplayer("video-area1").setup({file: "<?php echo base_url(); ?>uploaded_files/products/videos/<?php echo $res['video_file']; ?>",image: "<?php echo base_url(); ?>uploaded_files/products/videos/<?php echo $file_img_name; ?>",width:'360',height:'240'});
						</script>
            <?php
					}
					?>
          <!-- video ends -->
          
          <h2 class="pb5">Product Description</h2>
          <div class="mt15"><?php echo $res['products_description']; ?></div>
          <div class="cb bb pb20"></div>
          
          <!-- DESCRIPTION ENDS -->          
          <div class="testimonial">
          	<?php
						if(is_array($review_res) && !empty($review_res)){
							?>
              <div class="t_left">
                <h2 class="pb5 mt30" id="reviews"><b class="db fs18 lht-14">Reviews for</b> <?php echo $res['product_name']; ?></h2>
                <div class="mt15">
                	<?php
									foreach($review_res as $key=>$val){
										?>
                  	<div class="t_box">
                    	<div class="t_text"> <b><?php echo $val['mem_name'];?></b> - <?php echo getDateFormat($val['review_date'],2);?>
                      	<p class="mt5"><?php echo rating_html($val['ads_rating'],5);?></p>
                      	<p class="p10 border1 mt5 i fs13 gray1 weight400 arial"><?php echo $val['text'];?></p>
                    	</div>
                  	</div>
                  	<!-- list 1 -->
                    <?php
									}
									?>
                </div>
              </div>
              <!-- left ends -->
              <?php
						}
						?>
            <div class="t_right mt30">
              <h2 id="postreviews"><b class="db fs18 lht-14">Write</b>a Review</h2>
              <?php 
							echo form_open($res['friendly_url'].'#postreviews');
							echo error_message();
								?>
                <div class="t_right_form">
                  <div>
                    <input name="name" id="name" type="text" value="<?php echo set_value('name');?>" placeholder="Name *" />
                    <?php echo form_error('name');?>
                  </div>
                  <div class="mt10">
                    <input name="email" id="email" type="text" value="<?php echo set_value('email');?>" placeholder="Email ID *" />
                    <?php echo form_error('email');?>
                  </div>
                  <div class="mt10">
                    <select name="rating" id="rating">
                      <option value="">Ratings</option>
                      <option <?php if($this->input->post('rating') == 1){ echo 'selected="selected"'; } ?> value="1">1 Star</option>
                      <option <?php if($this->input->post('rating') == 2){ echo 'selected="selected"'; } ?> value="2">2 Stars</option>
                      <option <?php if($this->input->post('rating') == 3){ echo 'selected="selected"'; } ?> value="3">3 Stars</option>
                      <option <?php if($this->input->post('rating') == 4){ echo 'selected="selected"'; } ?> value="4">4 Stars</option>
                      <option <?php if($this->input->post('rating') == 5){ echo 'selected="selected"'; } ?> value="5">5 Stars</option>
                    </select>
                    <?php echo form_error('rating');?>
                  </div>
                  <div class="mt10">
                    <textarea cols="40" rows="5" name="reviews" id="reviews" placeholder="Reviews *"><?php echo set_value('reviews');?></textarea>
                    <?php echo form_error('reviews');?>
                  </div>
                  <div class="mt10">
                    <input name="verification_code" id="verification_code1" type="text" placeholder="Enter Code *" class="vam" style="width:80px">
                    <img src="<?php echo site_url('captcha/normal/review'); ?>" alt="" class="vam" id="captchaimage1"> <img src="<?php echo theme_url();?>images/ref.png" alt="" class="vam" onclick="document.getElementById('captchaimage1').src='<?php echo site_url('captcha/normal'); ?>/review/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/review/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code1').focus();"></div>
                  <p class="grey pt5 fs11">Type the characters shown above.</p>
                  <?php echo form_error('verification_code');?>
                  <p class="mt10">
                    <input name="submit" type="submit"  value="Submit" class="btn2 radius-3" />
                    <input name="reset" type="reset" value="Reset" class="btn3 radius-3" />
                    <input type="hidden" name="post_review" value="post" />
                  </p>
                </div>
              <?php echo form_close();?>
              <?php 
							$cond = array();
							$cond['position'] = "Right Banner";
							banner_display($cond,200,900,'r_banner mob_hider mt30', '<p class="r_banner mob_hider mt30">', '</p>', "1");
							?>
            </div>
            <div class="cb bb"></div>
          </div>
          <!-- REVIEWS ENDS --> 
          
        </div>
      
      	<!-- RELATED ITEMS -->
        <?php
				$result=array();
				$result['products_id'] = $res['products_id'];
				$arr = $this->product_model->related_products($result);
				$related_count = get_found_rows();
				if($related_count > 0){
					?>
          <section class="wrapper pt35">
            <h2 class="pl10 bb1 pb5">Related Items</h2>
            <div class="rel"> 
            	<?php
							if($related_count > 3){
								?>
	            	<a href="javascript:void(0)" class="prev1"><img src="<?php echo theme_url(); ?>images/arl.png" class="arrows trans_eff ar_l" alt=""></a> 
  	            <a href="javascript:void(0)" class="next1"><img src="<?php echo theme_url(); ?>images/arr.png" class="arrows trans_eff ar_r" alt=""></a> 
                <?php
							}
							?>
            </div>                
            <div class="pro_scroller_cont">
              <div <?php if($related_count > 3){ echo 'class="fp_scroll"'; }?>>
                <ul class="floater float_4">
                  <?php
                  echo view_product($arr,$other='');
                  ?>
                </ul>
              </div>
              <div class="cb"></div>
            </div>
           	<div class="cb pb20"></div>
            <!-- scroller ends --> 
	        </section>
          <?php
				}
      	?>
      	<!-- RELATED ITEMS ENDS --> 
      
      	<!-- RECENTLY VIEWED ITEMS -->
        <?php echo get_recent_view(); ?>
        <!-- RECENTLY VIEWED ITEMS ENDS --> 
      
      </div>
  	</div>
	</section>
	<section class="wrapper pt15  bt1 mid_banner_cont">
  	<?php 
		$cond = array();
		$cond['position'] = "Bottom Banner";
		banner_display($cond,330,182,'mid_banner', '<div class="mid_banner">', '</div>', "3");
		?>
    <p class="cb"></p>
	</section>
  
  <script type="text/javascript">
		var base_stock_qty=$('#avlqty').val();
		$('#qty').keyup(function(){
			if($(this).val() > base_stock_qty ){
				alert('Quantity can not exceed then '+base_stock_qty);
				$(this).val('');
      }
    });        
		//(function($){
		$(document).ready(function(){
			$('#cartbtn').click(function(e){
				e.preventDefault();
				var qty_pat=/^[0-9]+$/;
				var cmp_ref;
				var qtyObj=$('#qty');
				wanted_qty=$.trim(qtyObj.val());
				if(wanted_qty==''){
					qtyObj.validationEngine('showPrompt', 'Please specify quantity', 'error', true);
					qtyObj.focus();
					return false;	
				}
				if(!qty_pat.test(wanted_qty)){
					qtyObj.validationEngine('showPrompt', 'Please specify a valid quantity', 'error', true);
					qtyObj.focus();
					return false;	
				}
				<?php
				if($res['color_ids']!='' && $res['size_ids']!=''){
					?>
					if($('#color').val()==''){
						$('#color').validationEngine('showPrompt', 'Please choose colour', 'error', true);
						$('#color').focus();
						return false;	
					}
					if($('#size').val()==''){
						$('#size').validationEngine('showPrompt', 'Please select size', 'error', true);
						$('#size').focus();
						return false;	
					}
					<?php
				}
				?>
				if(cmp_ref==''){
					cmp_ref='xxx';	
				}
				
				      
				$.ajax({
					'type': "POST",
					'cache': false,
					'url': '<?=base_url();?>cart/add_to_cart/<?=$res['products_id'];?>',
					'data': $('#cartfrm').serialize(),
					'success': function (data) {
						$.fancybox('<?=base_url();?>cart', {
							'width' : 1000, 
							'height' : 500,
							'autoScale' : false, 
							'transitionIn' : 'elastic', 
              'transitionOut' : 'elastic', 
              'autoSize': false,
              'type' : 'iframe'
            }); // fancybox
					} // success                                    
        }); // ajax
				//$('#cartfrm').submit();
			});
		});
		//})(jQuery);
	</script>
  <!--content section-->
<?php $this->load->view("bottom_application");?>