<!DOCTYPE HTML>
<html>
	<head>
		<link href="<?php echo theme_url();?>css/win.css" rel="stylesheet" type="text/css">
    <link href="<?php echo theme_url();?>css/conditional_win.css" rel="stylesheet" type="text/css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Welcome</title>
	</head>
	<body style="font-size:12px; color:#333; margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; background:#fff">
		<div style="padding:20px">
 			<?php echo invoice_content_print($ordmaster,$orddetail,$dlink='no');?>
    </div>
	</body>
</html>