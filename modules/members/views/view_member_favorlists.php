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
            <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><span itemprop="title"><strong><a href="<?php echo base_url();?>members/myaccount">My Account</a></strong></span></div>
            <b>&gt;</b> 
            <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><span itemprop="title"><strong>My Favorites</strong></span></div>
        </div>
    </div>
<!--tree-->

    <div class="wrapper">
        <div class="pl10 pr10 cms_area">
            <h1><span>My Favorites</span></h1>
            <div class="cb bt1 mb10"></div><!--My-Account-Starts-->
            <?php $this->load->view("members/myaccount_top");?> 
        <script type="text/javascript">function serialize_form() { return $('#myform').serialize(); } </script>
            <div id="my_data">
 <?php      //trace($res);
            if( is_array($res) && !empty($res)){       
               
               echo form_open(base_url()."members/wishlist",'id="myform"'); ?>
                <!--paging-->
                <div class="mb15 ml5 mt15 shadow1 bg4 radius-5">
                    <div class="paging_container">
                        <div class="one">Showing :<?php echo front_record_per_page('per_page1'); ?> </div>
                        <?=$page_links;?>
                        <div class="cb"></div>
                    </div>
                </div>
                <!--paging-->
         <?php echo form_close(); ?>       
                <div class="p10 bb black radius-5 b mt10 bg-gray1 radius-5 mob_hider">
                    <div class="fav-sec1">S. No.</div>
                    <div class="fav-sec2">Product Name</div>
                    <div class="fav-sec3">Code</div>
                    <div class="fav-sec4">Amount</div>
                    <div class="fav-sec5">Buy Now</div>
                    <div class="fav-sec6">Delete</div>
                    <div class="cb"></div>
                </div>
<?php       $i=1;
            foreach($res as $val)
            {
              $link_url = base_url().$val['product_friendly_url'];
              $condtion = " AND  products_id =".$val['products_id']." AND media_type='photo' ORDER BY id ASC LIMIT 1";
              $media = get_db_field_value('wl_products_media',"media",$condtion);
              $base_price_cond = array(
                                         'where'=>"products_id ='".$val['products_id']."' AND color_id ='0' AND size_id ='0'"
                                      );
              $res_base_price = $this->product_model->get_product_base_price($base_price_cond);
            if(is_array($res_base_price) && !empty($res_base_price)){
              $pro_price = $res_base_price['product_discounted_price']>0 && $res_base_price['product_discounted_price']<$res_base_price['product_price'] ? display_price($res_base_price['product_discounted_price']) : display_price($res_base_price['product_price']);
              
              if($res_base_price['quantity'] > 0){
                ?> 
                <div class="p10 bb black mt10 lht-22">
                    <div class="fav-sec1"><?php echo $i;?>.</div>
                    <div class="fav-sec2"><p class="gray"><a href="<?php echo $link_url;?>"><?php echo $val['product_name'];?></a></p></div>
                    <div class="fav-sec3"><?php echo $val['product_code'];?></div>
                    <div class="cb bb pb10 mob_only"></div>
                    <div class="fav-sec4"><p class="mob_hider"><?php
						echo $pro_price;
					?></p>
                        <p class="mob_only mt5"><b>Amount : </b> <?php
					echo $pro_price;
					?></p>
                    </div>
                    <div class="fav-sec5"><p><a href="<?php echo $link_url;?>" class="cart-box">Buy Now</a></p></div>
                    <div class="fav-sec6"><a href="<?php echo base_url();?>members/remove_favlist/<?php echo $val['wishlists_id'];?>" onclick="return confirm('Are you sure you want to remove this product from wislist');">
                            <img src="<?php echo theme_url(); ?>images/delete-icon.png" alt="Delete" title="Delete" /></a></div>
                    <div class="cb"></div>
                </div>
<?php  	$i++;    }
                }
               } 
             }else{
               echo '<div class="mt7 b ac ">'.$this->config->item('no_record_found').'</div>';
             }
             ?>  
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
  $(document).ready(function(){
		$('[id ^="per_page"]').live('change',function(){	
		//	$(':hidden[name="per_page"]','#myform').val($(this).val());	
			$('#myform').submit();
		});
  });
</script> 
<?php $this->load->view("bottom_application");?>