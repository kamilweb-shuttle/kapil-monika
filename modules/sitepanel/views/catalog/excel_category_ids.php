<?php error_reporting(0);?>
<?php $cat_query="SELECT * FROM wl_categories WHERE ((parent_id =0 AND category_id NOT IN (SELECT `parent_id` FROM wl_categories)) || (parent_id >0 AND category_id NOT IN (SELECT `parent_id` FROM wl_categories)) AND status!='2') ";
$res_query=$this->db->query($cat_query);
?>
<table width="100%" border="1" style="border:1px solid;">
  <tr style="background-color:#999; color:#FFF">
    <td>&nbsp;</td>
    <td><strong>Category Navigation</strong></td>
    <td align="center"><strong>Category Ids</strong></td>
    <td>&nbsp;</td>
  </tr>
  <?php if($res_query->num_rows()>0)
  		{
			$list_cat=$res_query->result_array();
			foreach($list_cat as $key=>$val)
			{
				echo "<tr>";
				$catTopArray =getTopParentIDArray($val['category_id']);
				$catTitle = array();
				$lastLevelID = "";
				if(count($catTopArray))
				{
					echo "<td></td><td>";
					sort($catTopArray);
					foreach($catTopArray as $catID)
					{
						$catRes = get_db_single_row('wl_categories','category_name',"category_id='".$catID."'");
						$catTitle[] = $catRes['category_name'];
						$lastLevelID = $catID;
					}
					echo implode('>>',$catTitle);
					echo "</td>";
					echo "<td align='center'>";
					echo $lastLevelID;
					echo "</td>";
					
				}
	echo "</tr>";
   }}else{?>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" align="center"><strong>No Records Here.</strong></td>
    <td>&nbsp;</td>
  </tr>
  <?php }?>
</table>