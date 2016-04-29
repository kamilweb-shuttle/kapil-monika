<?php
if($ctry_id!='')
{	
 ?>
   <option value="">Select</option>  
        <?php
        $this->load->helper('category');
        $cat = get_category('P',"AND country_id='$ctry_id'");
        
        if(is_array($cat) && !empty($cat) )
        {
        foreach($cat  as $v)
        {
        
        ?>                    
        <option value="<?php echo $v['cat_id'];?>" <?php if($package_catid== $v['cat_id']){ ?> selected="selected" <?php } ?> ><?php echo $v['cat_name'];?></option>  
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