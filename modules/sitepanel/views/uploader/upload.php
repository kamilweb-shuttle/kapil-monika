<?php $this->load->view('includes/face_header'); ?>
<style type="text/css">
@import url("<?php echo resource_url();?>fancybox/jquery.fancybox.css");
</style>
<script src="<?php echo resource_url();?>fancybox/jquery.fancybox.pack.js"></script>
<style>
.percent_bar{
  font-weight:bold;font-size:16px;color:#f00;padding-left:30px;
}
.cont_div{border:4px solid #e4e4e4}
.item_selected{
  border-color:#0f0 !important;
}
#list ul li{list-style:none;}

</style>
<?php error_message();?>

<!-- Upload Form -->
<div style="float:left">
<?php echo form_open_multipart('');?>
<table width="100%"  border="0" cellspacing="5" cellpadding="5">
<tr>
  <td>
	<input type="file" name="file[]" id="files" multiple autocomplete="off">
	<input type="button" name="upload" id="upload" value="Upload" style="display:none;" />
  </td>
</tr>
</table>
<?php echo form_close();?>
</div>
<!-- Upload Form Ends-->

<!-- Search Form -->
<div style="float:right;padding-top:5px;">
<?php echo form_open('','method="get"');?>
<input type="text" name="search_keyword" value="<?php echo $this->input->post('search_keyword');?>" placeholder="Search"  /><input type="submit" name="search_sbt" value="Search"  />
<?php echo form_close();?>
</div>
<!-- Search Form Ends-->

<div style="clear:both;"></div>

<!--Progress Container -->
<div id="list"></div>
<!--Progress Container Ends-->

<!-- Media List from Library -->
<div id="loaded_items">
<?php
$keyword = "";
if($this->input->get_post('search_keyword')!='')
{
  $keyword = $this->input->get_post('search_keyword');
}
$file_object = array();
$dir = UPLOAD_DIR."/product_images/thumb/";
$dir_handle  = opendir($dir);
while ($object = readdir($dir_handle))
{
  if (!in_array($object, array('.','..','Thumbs.db')))
  {
	if(($keyword !='' && preg_match("~$keyword~",$object)) || $keyword =='')
	{
	  $filename    = $dir . $object;
	  $last_modified = filemtime($filename);
	  $file_object[] = array(
						  'name' => $object,
						  'size' => filesize($filename),
						  'type' => filetype($filename),
						  'time' => $last_modified
						  );
	}
  }
}

function order_way(&$arr,&$arr1)
{
  if($arr['time']<$arr1['time'])
  return 1;
   elseif($arr['time']==$arr1['time'])
return 0;
else
return -1;

}
uasort($file_object,'order_way');
?>


<?php echo form_open('');?>

<?php
if(!empty($file_object))
{
?>

<div style="padding-top:10px;padding-bottom:5px;text-align:center;">
  <?php
  if($this->input->get_post('action')!=='browse')
  {
  ?>
  <input type="submit" name="del_sbt" value="Delete" id="del_sbt" class="button" />
  <?php
  }
  else
  {
  ?> 
  <input type="submit" name="sel_sbt" value="Select" id="sel_sbt" class="button" />
  <?php
  }
  ?>
  </div>
<table width="100%" border=0 cellpadding=5 cellspacing=5>
<?php
$ix = 0;
$to_show = 4;
foreach($file_object as $val)
{
  if($ix%$to_show==0)
  {
  ?>
	<tr>
  <?php
  }
  ?>
	<td width="25%">
<div style="width:60%" class="cont_div">
	  <p>
	 <a href="<?php echo base_url();?>uploaded_files/product_images/<?php echo $val['name'];?>" data-rel="gallery"><img src="<?php echo base_url();?>uploaded_files/product_images/thumb/<?php echo $val['name'];?>" data-imgname="<?php echo $val['name'];?>" data-class="item_image" /></a>
</p>
<p>
	  <label> <input type="checkbox" name="delete[]" value="<?php echo $val['name'];?>" class="del_items" /><?php echo $val['name'];?></label>
</p>
</div>
	</td>
  <?php
  $ix++;
  if($ix%$to_show==0)
  {
  ?>
	</tr>
  <?php
  }
}
if($ix%$to_show > 0)
{
  $colspan_offset = $to_show-($ix%$to_show);
  $coslpan_layout = $colspan_offset > 1 ? 'colspan="'.$colspan_offset.'"' : '';
?>
  <td <?php echo $coslpan_layout;?>><td>
  </tr>
<?php
}
?>
</table>
<?php echo form_close();?>
<?php
}
?>

</div>
<!-- Media List from Library Ends-->

<script type="text/javascript" src="<?php echo base_url();?>assets/sitepanel/js/uploader.js"></script>
</body>
</html>