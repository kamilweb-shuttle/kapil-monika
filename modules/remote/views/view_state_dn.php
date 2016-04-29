<?php
if($ctry_id!=''){
	$cat_field = "region_name".$this->language_suffix;
	$optCategory=array(
											"autoColumn"=>"country_id ",
											"autoVal"=>$ctry_id,
											"exCond"=>" AND status='1' order by $cat_field Asc",
											"fetchmethod"=>"result_array"
										);
	$c_res=getcategorydetail("tbl_region","*",$optCategory);
	
	if(is_array($c_res)){
		?>
		<option value="">Select</option>
		<?php
		foreach($c_res as $key=>$val){
		?>
			<option value="<?php echo $val['id'];?>" <?php echo $state==$val['id'] ? 'selected="selected"' : '';?>><?php echo $val[$cat_field];?></option>
		<?php
		}
		?>
	<?php
	}
	else
	{
	?>
	  <option value="">Select</option>
	<?php
	}
}
else
{
?>
  <option value="">Select</option>
<?php
}
?>