<?php
if(!empty($state))
{
?>
<p class="bg1 white b radius-5 p5-10">State</p>
<p class="catelist mt5 ml4 dg_scroll">
<?php
  foreach($state as $key=>$val)
  {
  ?>
	<a href="#<?php echo $key;?>" class="scroll-content-item state"><?php echo $val;?></a>
  <?php
  }
?>
</p>
<p class="cb"></p>
<?php
}
