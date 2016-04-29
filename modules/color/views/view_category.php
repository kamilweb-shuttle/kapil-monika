<?php $this->load->view("top_application");?>
<section>
<div class="bg1 min-h mt5 p10">
  <div class="fl w213">
  <?php $this->load->view("category/category_left_view");?>
  </div>
    
  <div class="fl w747 ml20">
  <!--tree-->
  <div class="mt5">
<h1>Category</h1>
<p class="tree mt10"><strong class="fs11 ttu">You are here :</strong> <a href="<?php echo base_url();?>" class="home-icon"><img src="<?php echo theme_url(); ?>images/spacer.gif" width="16" alt=""></a>
   <?php
	$segment=3;
    $catid = (int)$this->uri->segment(3,0);
	if($catid )
	{
		 echo category_breadcrumbs($catid,$segment);
		 
	}else
	{
		echo '<span class="pr2 fs14">»</span> Category';
	}   
    ?>
 </p>
</div>
<!--tree-->

<script type="text/javascript">function serialize_form() { return $('#myform').serialize();   } </script>

<?php echo form_open("",'id="myform"');?> 

<div class="aj mt10" id="my_data">
<?php
if(is_array($res) && !empty($res) )
{
	?>
<!--paging-->
<div class="p5 mb15 mt10 ml5 shadow1 radius-5">
<div class="fr">
<p class="fl"><strong class="black">Showing</strong></p>
<p class="fl ml10">
<?php echo front_record_per_page('per_page1'); ?>
</p>
  <div class="cb"></div>
</div>

<div class="fl">
<?php echo $page_links; ?>
</div>

<div class="cb"></div>
</div>
<!--paging-->

<div class="mt10 mb10">

<?php

       $ix=0;					
	
      	   foreach($res as $val)
		   {
		   		
			 $cls = ( $ix==0 )	 ? "w174 fl" : "w174 fl ml17" ;				
		     $total_subcategories = $val['total_subcategories'];	
			 			
			if($total_subcategories>0)
			{				
				$link_url = base_url()."category/index/".$val['category_id'];	
			
			}else
			{			
				$link_url = base_url()."products/index/".$val['category_id'];	
			}
		   
	 ?>

<!--product-->
<div class="<?php echo $cls;?>">
<div class="pro-img"><a href="<?php echo $link_url;?>"><img src="<?php echo get_image('category',$val['category_image'],'174','225','R'); ?>" alt="<?php echo $val['category_name'];?>" /></a></div>
<p class="black lh15px mt8"><a href="<?php echo $link_url;?>"><?php echo $val['category_name'];?></a></p>
<p class="fs11 h30 al lh15px mt5 gray2"><?php echo char_limiter($val['category_description'],25);?></p>
<p class="green fs20 mt10">30 Item</p>
</div>
<!--product-->
<?php
    
	  if( $ix==3) {  echo '<div class="cb mb40"></div>';  $ix=0; }else{ $ix++; }
	  
	 
    }
		   

?>

<div class="cb mb20"></div>


</div>

<!--paging-->
<div class="p5 ml5 shadow1 radius-5">
<div class="fr">
<p class="fl"><strong class="black">Showing</strong></p>
<p class="fl ml10">
<?php echo front_record_per_page('per_page2'); ?>
</p>
  <div class="cb"></div>
</div>

<div class="fl">
<?php echo $page_links; ?>
</div>

<div class="cb"></div>
</div>
<!--paging-->


<?php
}else
{	
	echo '<p class="ac b">'.$this->config->item('no_record_found').'</p>';	
}
?>

</div>
<?php echo form_close();?>  
 
</div>
<div class="cb"></div>

</div>
</section>
<script>
jQuery(document).ready(function(e) {
  jQuery('[id ^="per_page"]').live('change',function(){		
		$("[id ^='per_page'] option[value=" + jQuery(this).val() + "]").attr('selected', 'selected'); jQuery('#myform').submit();
	});	
});
</script>
<?php $this->load->view("bottom_application");?>