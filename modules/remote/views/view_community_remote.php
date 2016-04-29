<?php
if($cat_id!='')
{	
 ?>
     <option value="">Select</option>  
        <?php
		$this->load->helper('category');
		$condi = "AND parent='$cat_id' ";
		$cat_rs =  get_community_category( $condi );
		        
        if(is_array($cat_rs) && !empty($cat_rs) )
        {
        foreach($cat_rs  as $v)
        {
        
        ?>                    
        <option value="<?php echo $v['cat_id'];?>" <?php if($community_id == $v['cat_id']){ ?> selected="selected" <?php } ?> ><?php echo $v['cat_name'];?></option>  
        <?php
        }
        }
        ?>
	<?php
	}else
    {
    ?>
  <option value="">Select</option>
<?php
}
?>