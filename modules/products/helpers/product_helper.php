<?php
if ( ! function_exists('you_save'))
{	
	function you_save($price,$discount_price)
	{  
		
		if($price!='' && $discount_price!='')
		{
			$you_save = (($price-$discount_price)/$price)*100;
			$you_save = formatNumberWithRounding($you_save,2);
			$you_save = fmtZerosDecimal($you_save);
			return $you_save;		
		}
		
	}
}


if ( ! function_exists('rating_html'))
{
	function rating_html($rating,$max_rating,$img_arr=array())
	{
	  if(!is_array($img_arr))
	  {
		$img_arr = array();
	  }
	  if(!array_key_exists('glow',$img_arr))
	  {
		$img_arr['glow'] = '<img alt="" class="vam" src="'.theme_url().'images/sb1.png">';
	  }
	  if(!array_key_exists('fade',$img_arr))
	  {
		$img_arr['fade'] = '<img alt="" class="vam" src="'.theme_url().'images/sb2.png">';
	  }
	  $rating = ceil($rating);
	  $rating = $rating > $max_rating ? $max_rfating : $rating;
	  $var = "";
	  $nostar = $max_rating - $rating;
	  
	  for($jx=1;$jx<=$rating;$jx++)
	  {
		$var.=$img_arr['glow'];
	  }

	  for($jx=1;$jx<=$nostar;$jx++)
	  {
		$var.=$img_arr['fade'];
	  }

	  return $var;
	}
}

if ( ! function_exists('product_overall_rating'))
{
	function product_overall_rating($product_id,$entity_type)
	{
		$CI = CI();
		$res = $CI->db->query("SELECT AVG(ads_rating) as rating FROM wl_review WHERE entity_id ='".$product_id."' AND entity_type='".$entity_type."' AND status ='1' ")->row();
		return $res->rating;
	}
}

if ( ! function_exists('product_stock')){
	function product_stock($product_id){
		$CI = CI();
		$res = $CI->db->query("SELECT SUM(quantity) as quantity FROM wl_product_attributes WHERE product_id ='".$product_id."'")->row();
		$resp = $CI->db->query("SELECT SUM(product_qty) as proQty FROM wl_products WHERE products_id ='".$product_id."'")->row();
		$totalProduct = $res->quantity+$resp->proQty;		
		return $totalProduct;
	}
}

if ( ! function_exists('color_name')){
	function color_name($color_id){
		$CI = CI();
		$res = $CI->db->query("SELECT color_name FROM wl_colors WHERE color_id ='".$color_id."'")->row();
		return $res->color_name;
	}
}

if ( ! function_exists('size_name')){
	function size_name($size_id){
		$CI = CI();
		$res = $CI->db->query("SELECT size_name FROM wl_sizes WHERE size_id ='".$size_id."'")->row();
		return $res->size_name;
	}
}

if ( ! function_exists('view_featured'))
{	
	function view_featured($arr,$other='')
	{  		
		if( is_array($arr) && !empty($arr) )
		{
			 $ix=0;	
			foreach ($arr as $val)
			{
					$cls = ( $ix==0 )	 ? "w174 fl" : "w174 fl ml17" ;	
					$link_url=base_url()."products/detail/".$val['products_id'];
					  $availableqty = ( $val['quantity'] - $val['used_quantity'] );					
				      $availableqty = ($availableqty < 0 )  ? 0 :  $availableqty;	
					
				?>
                <div class="<?php echo $cls;?>">
                <p class="wtrmrk"><a href="<?php echo $link_url;?>"><img src="<?php echo theme_url(); ?>images/spacer.gif" width="174px" height="225" alt=""></a></p>
                <div class="pro-img">
                <a href="<?php echo $link_url;?>">
                <img src="<?php echo get_image('products',$val['media'],'174','225','R'); ?>" alt="<?php echo $val['product_name'];?>" /></a>
                </div>
                <p class="black lh15px mt8 h30">
                <a href="<?php echo $link_url;?>"><?php echo char_limiter($val['product_name'],25);?></a>
                </p>
                         <p class="mt5">
								 <?php if( $val['product_discounted_price']!= '0.0000')
                                 { 
                                 ?>
                                  <span class="gray3 through">
                                  <?php  echo display_price($val['product_price']); ?>
                                  </span><span class="pl16 red2"> <?php  echo display_price($val['product_discounted_price']); ?></span>
                                
                                <?php
                                }else
                                {
                                ?>
                                 <span class="pl16 red2"> <?php  echo display_price($val['product_price']); ?></span>
                                 
                                <?php
                                }
                                ?>                
                        </p>
                     
                <p class="fs11"><span class="b green">Quantity Available :</span> <?php echo $availableqty;?></p>                
                </div>
               <?php
				 if( $ix==3) {  echo '<div class="cb mb40"></div>';  $ix=0; }else{ $ix++; }
			}			
		}		
	}
}



?>