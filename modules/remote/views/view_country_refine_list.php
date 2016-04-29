<p class="bg1 white b radius-5 p5-10">Country</p>
<p class="catelist mt5 ml4 dg_scroll">
<?php
if(is_array($country))
{
  foreach($country as $key=>$val)
  {
  ?>
	<a href="#<?php echo $key;?>" class="scroll-content-item country"><?php echo $val;?></a>
  <?php
  }
}
?>
</p>
<p class="cb"></p>