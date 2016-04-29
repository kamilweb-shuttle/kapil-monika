<?php
if(!empty($city))
{
?>
<p class="bg1 white b radius-5 p5-10">City</p>
<p class="catelist mt5 ml4 dg_scroll">
<?php
  foreach($city as $key=>$val)
  {
  ?>
	<a href="#<?php echo $key;?>" class="scroll-content-item city"><?php echo $val;?></a>
  <?php
  }
?>
</p>
<p class="cb"></p>
<?php
}
