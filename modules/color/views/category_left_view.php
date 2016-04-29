  <!--Newsletter-->
<?php
$cat_limit = 6;
$this->load->model(array('category/category_model'));
$condtion_array = array(
'field' =>"*,( SELECT COUNT(category_id) FROM wl_categories AS b
		WHERE b.parent_id=a.category_id ) AS total_subcategories",
		'condition'=>"AND parent_id = '0' AND status='1' ",
'condition'=>"AND parent_id = '0' ",
'limit'=>$cat_limit,
'offset'=>0,
'debug'=>FALSE
);	
$cat_res            = $this->category_model->getcategory($condtion_array);
$total_cat_found	=  $this->category_model->total_rec_found;	

?>
    <div class="cnt-bg p12">
      <p class="fs22 b green">Categories</p>
      <p class="cat-list mt10">
		<?php
        
        if( is_array($cat_res) && !empty($cat_res))
        {
			$i=0;
			foreach($cat_res as $v)
			{
				
			   $total_subcategories = $v['total_subcategories'];
			   
				if($total_subcategories>0)
				{				
				  $link_url = base_url()."category/index/".$v['category_id'];	
				
				}else
				{			
				   $link_url = base_url()."products/index/".$v['category_id'];	
				}
        
        ?>
        
      <a href="<?php echo $link_url;?>" ><?php echo $v['category_name'];?></a>
           
   <?php
    $i++;
	}
}
?>
<?php if( $total_cat_found > count($cat_res) ) 
{
	?>
    
<a href="<?php echo base_url();?>category">View All</a>

<?php
}
?>
      
      </p>
    </div>
    <!--Newsletter-->
    <!--ads-->
    <div class="mt11"><img src="<?php echo theme_url(); ?>images/ads-banner4.jpg" alt="" class="db" /></div>
    <!--ads-->
    <!--Newsletter-->
    <?php echo $this->load->view('pages/newsletter'); ?>
    <!--Newsletter-->
    <!--Testimonials-->
    <div class="cnt-bg mt11 p12">
      <p class="fs22 b green">Testimonials</p>
      
      
      <div class="ml6 testimonials-scroll">
		
        <?php echo $this->load->view('testimonials/scrolling_testimonial'); ?>
        
      </div>
      
      
      
      <p class="pt15 fr"><a href="<?php echo base_url();?>testimonials" class="blacklink3">View All</a></p>
      <p class="ac mt15 b fl"><a href="#" class="prev1"><img src="<?php echo theme_url(); ?>images/arrow-l.jpg" alt="" /></a><a href="#" class="next1"><img src="<?php echo theme_url(); ?>images/arrow-r.jpg" alt="" /></a></p>
      <p class="cb"></p>
    </div>
    <!--Testimonials-->
    <!--Refer Friend-->
    <div class="refer-bg mt11">
      <div class="pt15 pl20">
        <p class="fl"><img src="<?php echo theme_url(); ?>images/user.jpg" alt="" class="vam fl mr5" /></p>
        <p class="white ttu fl"><a href="<?php echo base_url();?>pages/refer_to_friends" class="refer"><span class="fs16">Refer to</span><br />
          <span class="fs31 b">Friend</span></a></p>
        <p class="cb"></p>
      </div>
    </div>
    <!--Refer Friend-->
    <!--ads-->
    <div class="mt11"><img src="<?php echo theme_url(); ?>images/ads-banner5.jpg" alt="" /></div>
    <!--ads-->