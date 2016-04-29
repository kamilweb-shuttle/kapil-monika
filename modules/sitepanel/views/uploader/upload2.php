<?php $this->load->view('includes/face_header'); ?>
<?php echo form_open_multipart('');?>
<style>
.percent_bar{
  font-weight:bold;font-size:16px;color:#f00;padding-left:30px;
}
</style>
<table width="100%"  border="0" cellspacing="5" cellpadding="5">
<tr>
  <td>
	<input type="file" name="file[]" id="files" multiple>
	<input type="button" name="upload" id="upload" value="Upload" />
  </td>
</tr>
</table>
<div id="list"></div>
<?php echo form_close();?>
<script type="text/javascript">
  var readerObj = Array();
  var total_completer = 0;
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // files is a FileList of File objects. List some properties.
    $('#list').html('<ul></ul>');
    for (var i = 0, f; f = files[i]; i++) {
	  // Only process image files.
	  if (!f.type.match('image.*')) {
		continue;
	  }
	  
	  f.key = i;

	  readerObj.push((new FileReader()));

	  
	
	  readerObj[i].onload = (showDataBfrUpload)(f,readerObj[i]);

	  //alert(readerObj[i]);

	  // Read in the image file as a data URL.
	  readerObj[i].readAsDataURL(f);
	}

  }
  
  function showDataBfrUpload(theFile,reader) {
	//alert(this);
	reader.file = theFile;
	return function(e) {
	// Render thumbnail.
	list_item = ['<li id="progress_item'+theFile.key+'">','<img class="thumb" src="', e.target.result,
	'" title="', escape(theFile.name), '" width="100" height="100"/>','<strong>', escape(theFile.name), '</strong> (', theFile.type || 'n/a', ') - ',theFile.size, ' bytes','<span class="percent_bar" data-cent="0"></span>','</li>'].join('');
	$('#list ul').append(list_item);
	};
  }

  function completeHandler(data)
  {
	
  }

  function errorHandler(data)
  {
	
  }

  function abortHandler(data)
  {
	
  }

  function progressHandler(event){
	var percent = (event.loaded / event.total) * 100;
	percent = Math.round(percent);
	$('#progress_item'+this.ctr+' span').attr('data-cent',percent).html(percent+'% uploaded...');
	if(percent==100){
	  
	  (function(ctr){
		window.setTimeout(function(){
		  $('#progress_item'+ctr).remove();
		  total_items_left = $('#list li').length;
		  alert('fdfsd');
		  if(total_items_left==0){
			window.location.reload();
		  }
		},4000);
	  })(this.ctr);
	  
	  
	}
  }

  function startUpload(){
	processorObj = new Array();
	total_files = readerObj.length;
	for (var i = 0, f; f = readerObj[i]; i++) {
	  //readerObj[i].readAsDataURL(f);
	  //alert(f.file.name);
	  
	  processorObj.push(( new XMLHttpRequest()));
	  processorObj[i].ctr = f.file.key;
	  processorObj[i].upload.ctr = f.file.key;
	  processorObj[i].upload.addEventListener("progress", progressHandler, false); 
	  processorObj[i].addEventListener("load", completeHandler, false); 
	  processorObj[i].addEventListener("error", errorHandler, false); 
	  processorObj[i].addEventListener("abort", abortHandler, false); 
	  processorObj[i].open("POST", '<?php echo base_url();?>sitepanel/multi_uploader/response');
	  formdata = new FormData();
	  formdata.append('upload','Y');
	  formdata.append('filex',f.file);
	   processorObj[i].send(formdata);
	}
  }
  
  $('#files').change(handleFileSelect);
  $('#upload').click(startUpload);
</script>
</body>
</html>