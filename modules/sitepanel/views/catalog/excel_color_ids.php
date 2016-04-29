<?php error_reporting(0);?>
<?php $query="SELECT * FROM wl_colors WHERE status!='2' ";
	  $res_query=$this->db->query($query);
?>
<table width="100%" border="1" style="border:1px solid;">
  <tr style="background-color:#999; color:#FFF">
    <td>&nbsp;</td>
    <td align="center"><strong>Color</strong></td>
    <td><strong>Name</strong></td>
    <td align="center"><strong>Ids</strong></td>
  </tr>
  <?php if($res_query->num_rows()>0)
  		{
			$list_color=$res_query->result_array();
			foreach($list_color as $key=>$val)
			{
			?>
            <tr>
            <td>&nbsp;</td>
            <td style="background-color:#<?php echo $val['color_code']?>">&nbsp;</td>
            <td><?php echo $val['color_name']?></td>
            <td align="center"><?php echo $val['color_id'];?></td>
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