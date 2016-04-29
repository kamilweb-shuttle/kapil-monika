<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to BlueSkyNails</title>
<link href="<?php echo theme_url(); ?>css/layout-ravi.css" rel="stylesheet" type="text/css" />
</head>
<body style="font-size:12px; color:#fff; margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; background:#fff;">
<div style="width:800px; background:#f4f4f4;">
  <div style="margin-top:10px; text-align:justify; padding:10px; border-radius:5px; border:solid 1px #ccc">
 <?php echo invoice_content($ordmaster,$orddetail);?>
   <table align="center" cellpadding="3" cellspacing="0">
        <tr>
          <td align="center"><strong> <p style=" text-align:left;" ><a href="javascript:void(0)" onclick="print();" style="font-size:12px; padding:2px 13px; color:#000000; border-radius:4px; text-decoration:none; cursor: pointer; display:inline-block;"><img src="<?php echo theme_url(); ?>images/print-icon.png" alt="" class="vam mr5" />Print Invoice</a></p></strong></td>
        </tr>
      </table>
    <p class="mt20 mb10">&nbsp;</p>
  </div>
</div>
</body>
</html>