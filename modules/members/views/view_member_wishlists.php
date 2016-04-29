<?php $this->load->view("top_application");
$curr_symbol = display_symbol();
?>
<div class="container"><!--Container-Starts-->
  <section class="lh18px aj"><!--Content--Starts-->
    <h1>My Wish List</h1>
    <p class="tree"><a href="<?php echo base_url();?>">Home</a><a href="<?php echo base_url();?>members/myaccount">My Account</a> My Wish List</p>
    <section class="mt10"><!--My-Account-Starts-->
    <?php $this->load->view("members/myaccount_right");?> 
    <script type="text/javascript">function serialize_form() { return $('#myform').serialize(); } </script>
    <div class="w68 fr">
      <!--Right-Part-Starts-->
      <div class="aj radius-5" id="my_data">
		 <?php
    //trace($res);
    if( is_array($res) && !empty($res))
    {
    ?>
        <div class="bgBk white p5 b treb ttu pt7 mt5">
          <table class="w100">
            <tr>
              <td class="w10"> S. No. </td>
              <td class="w35">Items</td>
              <td class="w18 ac">Price (<?php echo $curr_symbol;?>)</td>
              <td class="w15 ac">buy now</td>
              <td class="w8 ac">REMOVE</td>
            </tr>
          </table>
        </div>
     	<?php
			$i=1;
			foreach($res as $val)
			{
			  $link_url = base_url()."products/detail/".$val['products_id'];
			  $condtion = " AND  products_id =".$val['products_id']." AND media_type='photo' ORDER BY id ASC LIMIT 1";
			  $media = get_db_field_value('wl_products_media',"media",$condtion);
  
			  $base_price_cond = array(
									'where'=>"product_id ='".$val['products_id']."' AND color_id ='0' AND size_id ='0'"
								  );
			   $res_base_price = $this->product_model->get_product_base_price($base_price_cond);

			   $discounted_price = $res_base_price['product_discounted_price']>0 && $res_base_price['product_discounted_price']!=null ? TRUE : FALSE;

			  ?>       
        <div class="mt10">
          <table class="bdrAll w100">
            <tr>
              <td class="vat w5 al"><?php echo $i;?>.</td>
              <td class="w40 vam"><p class="red fs14"><a href="<?php echo $link_url;?>"><?php echo $val['product_name'];?></a></p>
                <p class="pt2 tahoma fs11 "><strong>Code</strong> : <?php echo $val['product_code'];?></p>
                <div class="cb"></div>
                <div class="cb"></div></td>
              <td class="w16 ac vam"><strong><?php
					if($discounted_price===TRUE)
					{
						echo display_price($res_base_price['product_discounted_price']);
					}
					else
					{
					  echo display_price($res_base_price['product_price']);
					}
					
			//		trace($res_base_price);
					?></strong></td>
              <td class="w18 ac vam">
        <?php if($res_base_price['quantity'] > 0){?>
                <a href="<?php echo $link_url;?>" class="btn-bg1">Buy</a>
        <?php }else{ ?>
                <a href="<?php echo base_url();?>members/notify/<?php echo $val['wishlists_id'];?>" class="btn-bg4 notify">Notify Me</a>
        <?php } ?>   
                </td>
              <td class="w8 ac vam"><a href="<?php echo base_url();?>members/remove_wislist/<?php echo $val['wishlists_id'];?>" onclick="return confirm('Are you sure you want to remove this product from wislist');">
               <img src="<?php echo theme_url(); ?>images/close.png" width="10" height="10" alt="Delete" title="Delete" /></a></td>
              </tr>
          </table>
        </div>
 <?php  	$i++;
			 } ?>       
        <div class="cb"></div>
     <?php echo form_open(base_url()."members/wishlist",'id="myform"'); ?>
        <div class="p10 mt15 mb10 ac pagin">
            <!--Paging-Starts-->
            <div class="w50 fl mt3"><?php echo $page_links; ?></div>
            <p class="fr w25 fs11 ar"> <?php echo front_record_per_page('per_page1',$per_page); ?> </p>
            <div class="cb"></div>
            <!--Paging-Ends-->
          </div>       
<?php echo form_close();?>   
 <?php
      }
      else
      {
        echo '<div class="mt7 b ac ">'.$this->config->item('no_record_found').'</div>';
      }
      ?>        
      </div>
      <div class="cb"></div>
      <!--Right-Part-Ends-->
    </div>
    <!--My-Account-Ends--></section>
    <!--Content-Ends--></section>
  <div class="cb"></div>
  <!--Container-Ends--></div>

<script type="text/javascript">
  $(document).ready(function(){
		$('[id ^="per_page"]').live('change',function(){	
		//	$(':hidden[name="per_page"]','#myform').val($(this).val());	
			$('#myform').submit();
		});
  });
</script> 
<?php $this->load->view("bottom_application");?>