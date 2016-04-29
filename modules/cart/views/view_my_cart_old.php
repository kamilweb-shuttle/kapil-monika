<?php $this->load->view("top_application");
$curr_symbol = display_symbol();
?>
<section class="mb25">
     <!--tree-->
    <div class="breadcrumb mt8 mb8 mob_hider">
        <div class="wrapper">
            <b class="ttu"><span class="red">You Are Here :</span> </b>
            <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="<?=base_url();?>" itemprop="url"><span itemprop="title">
                 <img src="<?=theme_url();?>images/tree-home.png" class="vam" alt="<?=$this->config->item('site_name');?>" title="<?=$this->config->item('site_name');?>" /></span></a></div>   
            <b>&gt;</b>   
            <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"  class="dib"><span itemprop="title"><strong><?=$title;?></strong></span></div>
        </div>
    </div>
    <!--tree-->
    <div class="wrapper">
        <div class="pl10 pr10 cms_area">           
            <h1><span><?=$title;?></span></h1>
            <div class="cb bt1 mb10"></div>
             <?php  error_message();
            // trace($this->cart->contents());?> 
            <div class="cb mb10"></div>
            <?php if($this->cart->total_items() > 0 ) 
                  {	
                     echo form_open('cart/','name="cart_frm" id="cart_frm" ');?>
                    <div class="mt20 p10 bg-gray1 black ttu radius-5 b mob_hider">
                        <div class="invoice-sec1">S. No.</div>
                        <div class="invoice-sec2">Product Details</div>
                        <div class="invoice-sec3">Qty.</div>
                        <div class="invoice-sec4">Sub Total</div>
                        <div class="cb"></div>
                    </div>
              <?php	   
                    $i=1;
                    $totweight=0;
                    $shipcharge = "";
                    foreach($this->cart->contents() as $items)
                    {
                      //trace($items);
                       $friendly_url = get_db_field_value('wl_products', 'product_friendly_url', array('products_id' =>$items['pid']));
                      $link_url=base_url().$friendly_url; 			 
                      $quantity_available = "";

                      $brand_flag = FALSE;
                      if($items['options']['Brand']!=null)
                      {
                              $brand_id = $items['options']['Brand'];
                              $brand_cond = array(
                                                    'where'=> "status = '1' "
                                                  );
                              $res_brand = $this->product_model->get_product_brand($brand_id,$brand_cond);
                              $brand_flag = is_array($res_brand) && !empty($res_brand) ? TRUE : FALSE;
                      }	

                      $color_flag = FALSE;
                      if($items['options']['Color']>0)
                      {
                              $color_id = $items['options']['Color'];
                              $this->db->select("color_name");
                              $this->db->from('wl_colors');
                              $this->db->where(array('color_id ='=>$color_id,'status = '=>'1'));
                              $qry_color = $this->db->get();
                              $res_color = $qry_color->row_array();
                              $color_flag = is_array($res_color) && !empty($res_color) ? TRUE : FALSE;
                      }	

                      $size_flag = FALSE;
                      if($items['options']['Size']>0)
                      {
                              $size_id = $items['options']['Size'];
                              $this->db->select("size_name");
                              $this->db->from('wl_sizes');
                              $this->db->where(array('size_id ='=>$size_id,'status = '=>'1'));
                              $qry_size = $this->db->get();
                              $res_size = $qry_size->row_array();
                              $size_flag = is_array($res_size) && !empty($res_size) ? TRUE : FALSE;
                      }

                      ?>
                         <div class="mt20 bb pb20">
                            <div class="invoice-sec1"><p class="pl10"><?=$i;?>.</p></div>
                            <div class="invoice-sec2">
                                <div class="thum-pro-w">
                                    <div class="thum-pro-img"><img src="<?php echo get_image('products',$items['img'],'80','60','R'); ?>" alt="" /></div>
                                </div>
                                <div class="thum-pro-cnt">
                                    <p class="black fs16"><a href="<?php echo $link_url;?>" target="_parent"><?php echo $items['origname'];?></a></p>
                          <?php if($color_flag === TRUE)
                                {
                                ?>   <p class="mt2">Color : <strong class="fs13 red"><?php echo $res_color['color_name'];?></strong></p>
                          <?php } 
			
			        if($size_flag === TRUE)
                                {   ?>
                                    <p class="mt2">Size : <strong class="fs13 red"><?php echo $res_size['size_name'];?></strong></p>
                          <?php } 		
			      if($brand_flag === TRUE)
                                {
                                ?><p class="mt2">Brand : <?php echo $res_brand['brand_name'];?></p>
                          <?php } ?>
                                    <p class="mt2">Product ID : <?php echo $items['code'];?></p>
                                    <p class="mt5 black">Price: 
                                     <?php if($items['product_price'] > $items['discount_price']){?>   
                                        <span class="linethrough"><?php echo display_price($items['product_price']);?></span>
                                        <strong class="fs13 red"><?php echo display_price($items['discount_price']);?></strong>
                                     <?php }else{ ?>   
                                        <strong class="fs13 red"><?php echo display_price($items['product_price']);?></strong>
                                     <?php } ?></p>
                                    <p class="mt5 red"><a href="<?php echo base_url(); ?>cart/remove_item/<?php echo $items['rowid']; ?>" onclick="return confirm('Are you sure you want to remove this item');">X Remove</a></p>
                                    <p class="cb"></p>
                                </div>
                                <div class="cb"></div>
                            </div>
                            <div class="cb bb pb15 mob_only"></div>
                            <div class="invoice-sec3">
                                <p class="mob_only"><b>Qty.</b> : 
                                   <a href="javascript:void(0)" onclick="return incDnc(2, <?php echo $i;?>, <?php echo $items['availableqty'];?>);"><img src="<?php echo theme_url();?>images/less.png" alt="" class="vam" /></a>
                                   <input readonly="readonly" name="<?php echo $i; ?>[qty]" id="mqty_<?php echo $i;?>" type="text" value="<?php echo $items['qty']; ?>" class="txtbox ac bdrn" style="width:15px;" />
                                   <a href="javascript:void(0)" onclick="return incDnc(1, <?php echo $i;?>, <?php echo $items['availableqty'];?>);"><img src="<?php echo theme_url();?>images/add.png" alt="" class="vam" /></a>
                                </p>
                                <b class="mob_hider">
                                    <a href="javascript:void(0);" onclick="return incDnc(2, <?php echo $i;?>, <?php echo $items['availableqty'];?>);"><img src="<?php echo theme_url();?>images/less.png" alt="" class="vam" /></a>
                                    <input readonly="readonly" name="<?php echo $i; ?>[qty]" id="qty_<?php echo $i;?>" type="text" value="<?php echo $items['qty']; ?>" class="txtbox ac bdrn" style="width:15px;" />
                                    <a href="javascript:void(0);" onclick="return incDnc(1, <?php echo $i;?>, <?php echo $items['availableqty'];?>);"><img src="<?php echo theme_url();?>images/add.png" alt="" class="vam" /></a>
                                </b>
                                <input type="hidden" name="<?php echo $i; ?>[rowid]" id='cart_rowid_<?php echo $i; ?>' value="<?php echo $items['rowid']; ?>" />                                
                            </div>
                            <div class="invoice-sec4"><b><?php echo display_price($items['subtotal']);?></b></div>
                            <div class="cb"></div>
                        </div>
			<?php
			  $i++;
			}
			
                 $cart_total      = $this->cart->total();
                 $tax = ($cart_total*$tax_cent)/100;

                 $tax_cent_applied = fmtZerosDecimal($tax_cent);

                 $discount_amount = $this->session->userdata('discount_amount');
                 $shipping_total  = array_key_exists('shipment_rate',$shipping_res) ?  $shipping_res['shipment_rate'] : 0;
                 $discount_total  = $discount_amount;
                 $grand_total      = ($cart_total-$discount_total)+$shipping_total+$tax;
		//	trace($this->session->userdata);
			?>  
                      <div class="w100 ar mt15">
                          <p class="pr10">Shipping Charges  : <select name="shipping_method" id="shipping_method" style=" width:190px; font-weight: bold;" onchange="this.form.submit();">
              <option value=""><strong>Select Shipping</strong></option><?php 
            $set_shipping_id = $this->session->userdata('shipping_id');
            if(is_array($shipping_methods) && !empty($shipping_methods))
            {
              foreach( $shipping_methods as $val )
              {	
              ?>
              <option value="<?php echo $val['shipping_id'];?>" <?php if($set_shipping_id==$val['shipping_id']) { ?> selected="selected" <?php } ?> ><?php echo $val['shipping_type'];?> &raquo; <?php echo display_price($val['shipment_rate']);?></option>
              <?php
              }	
            }		  
            ?></select><span class="fs14"> <?php echo form_error('shipping_method');?></span></p>  
                <?php if($tax_cent > 0){?>
                        <p class="fs18 pr10 b mt10">Tax  : <b><span class="WebRupee"></span> <?php echo display_price($tax);?></b></p>
                 <?php } ?>   
                        <p class="fs18 pr10 b mt10">Estimated Total  : <b><span class="WebRupee"></span> <?php echo display_price($grand_total);?></b></p>
                        <p class="btn-right"><input name="UserCheckout" type="submit" class="btn3 radius-3 shadow1" value="Proceed to Payment &gt;" /></p>
                        <p class="btn-right"><input name="Update_Qty" id="Update_Qty" type="submit" class="btn3 radius-3 shadow1" value="Update Quantity" /></p>
                        <p class="btn-left"><input type="button" class="btn1 radius-3 shadow1" value="&lt; Continue Shopping" onClick="window.open('<?php echo base_url();?>category','_parent')" /></p>
                        <div class="cb mb10"></div>
                    </div>
                    <div class="cb"></div>
        <!--<input name="EmptyCart" type="submit" class="btn-bg1 fs12" value="Clear Cart &raquo;" onclick="return confirm('Are you sure you want to clear the cart');" />-->
       
<?php echo form_close();
        }else{
      ?>
            <div class="grey bdr p15 bg-dgrey radius-5">
              <strong>Your Cart is empty</strong>     
            </div>  
      <?php
        }
  ?> 
        </div>
    </div>
</section>   
 <script type="application/javascript" language="javascript">
  jQuery(document).ready(function(e) {
    jQuery('input[name = "coupon_code"]').live('blur keyup', function(){
		 jQuery('#cart_frm').submit();
		});
  });
 </script>
<?php $this->load->view("bottom_application");?>