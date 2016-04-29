<p class="mt10 bg1 white b radius-5 p5-10">Profession</p>
<p class="catelist mt5 ml4 dg_scroll">
<?php
foreach($this->config->item('occupation_values') as $key=>$val)
{
?>
  <a href="#<?php echo $key;?>" class="scroll-content-item profession"><?php echo $val;?></a>
<?php
}
?>
</p>
<p class="cb"></p>