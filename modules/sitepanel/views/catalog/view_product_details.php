<?php $this->load->view('includes/face_header'); ?>
<table width="100%"  border="0" cellspacing="5" cellpadding="5" class="list">
<thead>
<tr >
	<td colspan="3" height="30"><?php echo $heading_title; ?></td>
</tr>
</thead>
<?php
if(is_array($res) && !empty($res))
{
  $res = $res[0];
?>
<tr class="trOdd">
	<td> Add Date </td>
	<td>:</td>
	<td><?php echo $res['product_added_date'];?></td>
</tr>

<tr class="trOdd">
	<td width="19%">Product Name </td>
	<td width="3%">: </td>
	<td width="78%"><?php echo $res['product_name'];?> </td>
</tr>
<tr class="trOdd">
	<td width="19%">Product Code </td>
	<td width="3%">: </td>
	<td width="78%"><?php echo $res['product_code'];?> </td>
</tr>


<tr class="trOdd">
	<td>Category</td>
	<td>:</td>
	<td>
	<?php 
	$catlinks = explode(',',$res['category_links']);
	$res_category = $this->db->select('category_name,category_id')->from('wl_categories')->where_in('category_id',$catlinks)->get()->result_array();
	if(is_array($res_category) && !empty($res_category))
	{
	  $sptr_cat = '';
	  foreach($res_category as $val)
	  {
		echo $sptr_cat.$val['category_name'];
		$sptr_cat = " -> ";
	  }
	}
	?>
	</td>
</tr>


<tr class="trOdd">
	<td>Price</td>
	<td>: </td>
	<td>
	  <?php
	  if($res['product_discounted_price']=='0.00')
	  {
	  ?>
		<span style="color: #b00;"><?php echo display_price($res['product_price']);?></span>
	  <?php
	  }
	  else
	  {
	  ?>
		<span style="text-decoration: line-through;"><?php echo display_price($res['product_price']);?></span><br> 
		<span style="color: #b00;"><?php echo display_price($res['product_discounted_price']);?></span>
	  <?php
	  }
	  ?>   
	</td>
</tr>

<tr class="trOdd">
	<td>Description</td>
	<td>: </td>
	<td><?php echo $res['products_description'];?> </td>
</tr>

<tr class="trOdd">
	<td>Status</td>
	<td>: </td>
	<td><?php echo $res['status']==1? "Active": "In-active";?> </td>
</tr>
<?php
}
else
{
?>
  <tr class="trOdd">
	<td colspan="3">No record(s) found</td>
</tr>
<?php
}
?>
</table>
</body>
</html>