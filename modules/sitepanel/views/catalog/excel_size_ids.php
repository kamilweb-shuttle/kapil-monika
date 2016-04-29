<?php error_reporting(0);?>
<?php $query="SELECT * FROM wl_sizes WHERE status!='2' ";
	  $res_query=$this->db->query($query);
?>
<table width="100%" border="1" style="border:1px solid;">
  <tr style="background-color:#999; color:#FFF">
    <td>&nbsp;</td>
    <td><strong>Size Title</strong></td>
    <td align="center"><strong>Ids</strong></td>
    <td>&nbsp;</td>
  </tr>
  <?php if($res_query->num_rows()>0)
  		{
			$list_size=$res_query->result_array();
			foreach($list_size as $key=>$val)
			{
			?>
            <tr>
            <td>&nbsp;</td>
            <td><?php echo $val['size_name']?></td>
            <td align="center"><?php echo $val['size_id'];?></td>
            <td>&nbsp;</td>
            </tr>
            <?php
			}
				
   }else{?>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" align="center"><strong>No Records Here.</strong></td>
    <td>&nbsp;</td>
  </tr>
  <?php }?>
</table>