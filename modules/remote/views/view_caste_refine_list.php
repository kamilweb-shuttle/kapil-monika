<?php
if(!empty($caste))
{
?>
<p class="mt10 bg1 white b radius-5 p5-10">Caste</p>
<p class="catelist mt5 ml4 dg_scroll">
<?php
foreach($caste as $key=>$val)
{
?>
  <a href="#<?php echo $key;?>" class="scroll-content-item caste"><?php echo $val;?></a>
<?php
}
?>
</p>
<p class="cb"></p>
<?php
}
