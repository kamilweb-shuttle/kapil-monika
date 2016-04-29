 <p class="mt10 bg1 white b radius-5 p5-10">Religion</p>
<p class="catelist mt5 ml4 dg_scroll">
<?php
foreach($this->config->item('religion_collection') as $key=>$val)
{
?>
  <a href="#<?php echo $key;?>" class="scroll-content-item user_religion"><?php echo $val;?></a>
<?php
}
?>
</p>
<p class="cb"></p>