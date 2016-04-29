<?php $this->load->view('includes/face_header'); ?>
<?php
//trace($post_err);
//trace($matrix_arr_db);
?>
<?php echo form_open("sitepanel/products/view_stocks/".$this->uri->segment(4),'id="myform"');?>
<table width="90%" align="left" cellpadding="1" cellspacing="1" class="list" style="margin-top:10px;">
<thead>
<tr>
	<td colspan="4" height="30"><?php echo $heading_title; ?>
		
	</td>
</tr>
</thead>
<tr><td colspan="4" align="center" ><?php error_message();?> </td></tr>
</table>
<table width="90%" align="left" cellpadding="4" cellspacing="4"  style="margin-top:10px;">
<?php 
if ((is_array($res_colors) && !empty ($res_colors)) || (is_array($res_size) && !empty ($res_size)) )
{ 
	$values_posted_back=(is_array($this->input->post())) ? TRUE : FALSE;

	$outer_loop = "";
	$inner_loop = array();
?>
	<tr>
		<?php
		if (is_array($res_colors) && !empty ($res_colors))
		{
		  $outer_loop = $res_colors;
		  $outer_field_type = "color";
		?>
		<td><strong>Color</strong></td>
		<?php
		}
		if (is_array($res_size) && !empty ($res_size))
		{
		  if($outer_loop == "")
		  {
			$outer_loop = $res_size;
			$outer_field_type = "size";
		  }
		  else
		  {
			$inner_loop = $res_size;
		  }
		?>
		<td><strong>Size</strong></td>
		<?php
		}
		?>
		<td><strong>Quantity</strong></td>
		<td><strong>Product Price</strong></td>
		<td><strong>Discounted Price</strong></td>
	</tr>
	<?php
	$loop_ctr = 0; 
	foreach($outer_loop as $key1=>$val1)
	{
	  if(!empty($inner_loop))
	  {
		foreach($inner_loop as $key2=>$val2)
		{
			$size_id = $val2['size_id'];
			$color_id = $val1['color_id'];

			$loop_product_price = "";
			$loop_product_discounted_price = "";
			$loop_quantity = "";

			if($values_posted_back === TRUE)
			{
			  $product_price = $this->input->post('product_price');

			  $loop_product_price = $product_price[$loop_ctr];

			  $product_discounted_price = $this->input->post('product_discounted_price');

			  $loop_product_discounted_price = $product_discounted_price[$loop_ctr];

			  $quantity = $this->input->post('quantity');

			  $loop_quantity = $quantity[$loop_ctr];
			}
			elseif($matrix_arr_filled === TRUE)
			{
				if(array_key_exists($color_id,$matrix_arr_db))
				{
				  if(array_key_exists($size_id,$matrix_arr_db[$color_id]))
				  {
					$loop_product_price = $matrix_arr_db[$color_id][$size_id]['product_price'];
					$loop_product_price = formatNumber($loop_product_price,2);
					$loop_product_discounted_price = $matrix_arr_db[$color_id][$size_id]['product_discounted_price'];
					$loop_product_discounted_price = $loop_product_discounted_price==0 ? "" : formatNumber($loop_product_discounted_price,2);
					$loop_quantity = $matrix_arr_db[$color_id][$size_id]['quantity'];
				  }
				}
			}
		?>
		  <tr>
		  <td>
			<select name="color[]">
			  <option value="<?php echo $val1['color_id'];?>" selected><?php echo $val1['color_name'];?></option>
			</select>
		  </td>
		  <td>
		  <select name="size[]">
			  <option value="<?php echo $val2['size_id'];?>" selected><?php echo $val2['size_name'];?></option>
		   </select>
		  </td>
		  <td>
		  <input type="text" name="quantity[]" value="<?php echo $loop_quantity;?>" />
		  <?php
		  if(array_key_exists($loop_ctr,$post_err['quantity']))
		  {
			echo '<div class="required">'.$post_err['quantity'][$loop_ctr].'</div>';
		  }
		  ?>
		</td>
		<td>
		  <input type="text" name="product_price[]" value="<?php echo $loop_product_price;?>" />
		  <?php
		  if(array_key_exists($loop_ctr,$post_err['product_price']))
		  {
			echo '<div class="required">'.$post_err['product_price'][$loop_ctr].'</div>';
		  }
		  ?>
		</td>
		<td>
		  <input type="text" name="product_discounted_price[]" value="<?php echo $loop_product_discounted_price;?>" />
		  <?php
		  if(array_key_exists($loop_ctr,$post_err['product_discounted_price']))
		  {
			echo '<div class="required">'.$post_err['product_discounted_price'][$loop_ctr].'</div>';
		  }
		  ?>
		</td>
		  </tr>
		<?php
		  $loop_ctr++;
		}
	  }
	  else
	  {
		$loop_product_price = "";
		$loop_product_discounted_price = "";
		$loop_quantity = "";

		if($outer_field_type == 'color')
		{
		  $size_id = 0;

		  $color_id = $val1['color_id'];
		}
		else
		{
		  $size_id = $val1['size_id'];

		  $color_id = 0;
		}

		if($values_posted_back === TRUE)
		{
		  $product_price = $this->input->post('product_price');

		  $loop_product_price = $product_price[$loop_ctr];

		  $product_discounted_price = $this->input->post('product_discounted_price');

		  $loop_product_discounted_price = $product_discounted_price[$loop_ctr];

		  $quantity = $this->input->post('quantity');

		  $loop_quantity = $quantity[$loop_ctr];
		}
		elseif($matrix_arr_filled === TRUE)
		{
			if(array_key_exists($color_id,$matrix_arr_db))
			{
			  if(array_key_exists($size_id,$matrix_arr_db[$color_id]))
			  {
				$loop_product_price = $matrix_arr_db[$color_id][$size_id]['product_price'];
				$loop_product_price = formatNumber($loop_product_price,2);
				$loop_product_discounted_price = $matrix_arr_db[$color_id][$size_id]['product_discounted_price'];
				$loop_product_discounted_price = $loop_product_discounted_price==0 ? "" : formatNumber($loop_product_discounted_price,2);
				$loop_quantity = $matrix_arr_db[$color_id][$size_id]['quantity'];
			  }
			}
		}
	  ?>
		<tr>
		<td>
		  <?php
		  if($outer_field_type == 'color')
		  {
		  ?>
		  <select name="color[]">
			<option value="<?php echo $val1['color_id'];?>" selected><?php echo $val1['color_name'];?></option>
		  </select>
		  <?php
		  }
		  else
		  {
		  ?>
			<select name="size[]">
			<option value="<?php echo $val1['size_id'];?>" selected><?php echo $val1['size_name'];?></option>
		  </select>
		  <?php
		  }
		  ?>
		</td>
		<td>
		  <input type="text" name="quantity[]" value="<?php echo $loop_quantity;?>" />
		  <?php
		  if(array_key_exists($loop_ctr,$post_err['quantity']))
		  {
			echo '<div class="required">'.$post_err['quantity'][$loop_ctr].'</div>';
		  }
		  ?>
		</td>
		<td>
		  <input type="text" name="product_price[]" value="<?php echo $loop_product_price;?>" />
		  <?php
		  if(array_key_exists($loop_ctr,$post_err['product_price']))
		  {
			echo '<div class="required">'.$post_err['product_price'][$loop_ctr].'</div>';
		  }
		  ?>
		</td>
		<td>
		  <input type="text" name="product_discounted_price[]" value="<?php echo $loop_product_discounted_price;?>" />
		  <?php
		  if(array_key_exists($loop_ctr,$post_err['product_discounted_price']))
		  {
			echo '<div class="required">'.$post_err['product_discounted_price'][$loop_ctr].'</div>';
		  }
		  ?>
		</td>
		</tr>
	  <?php
		$loop_ctr++;
	  }
	}
	?>
	
</table>
<table width="90%" align="left" cellpadding="1" cellspacing="1">
	<tr>
		<td>
			<input type="submit" name="sub" value="Save" class="button2" />
			<input type="hidden" name="ref_id" value="<?php echo $this->uri->segment(4);?>" />
		</td>
	</tr>
<?php  
}else{
	echo "<tr><td><center><strong> No record(s) found !</strong></center></td></tr>" ;
}
?>
</table>
<?php
echo form_close();	
?>
</body>
</html>