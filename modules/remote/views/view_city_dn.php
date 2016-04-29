<?php
if($state_id!='')
{
	$cat_field = "city_name".$this->language_suffix;
	$optCategory=array(
											"autoColumn"=>"region_id ",
											"autoVal"=>$state_id,
											"exCond"=>" AND status='1' order by $cat_field Asc",
											"fetchmethod"=>"result_array"
										);
	$c_res=getcategorydetail("tbl_city","*",$optCategory);
	
	if(is_array($c_res))
	{
		?>
		<option value="">Select</option>
		<?php
		foreach($c_res as $key=>$val){
		?>
			<option value="<?php echo $val['id'];?>" <?php echo $city==$val['id'] ? 'selected="selected"' : '';?>><?php echo $val[$cat_field];?></option>
		<?php
		}
		
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