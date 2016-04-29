$('#face_close').html('');
var readerObj = Array();
var total_completer = 0;
function handleFileSelect(evt) {
var files = evt.target.files; // FileList object

if(files.length > 10){
  alert("You can select 10 images at once");
  return false;
}

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

  $('#upload').show();
}

}

function showDataBfrUpload(theFile,reader) {
	//alert(this);
	reader.file = theFile;
	return function(e) {
	// Render thumbnail.
	list_item = ['<li id="progress_item'+theFile.key+'">','<img class="thumb" src="', e.target.result,
	'" title="', escape(theFile.name), '" width="100" height="100"/>','<strong>', escape(theFile.name), '</strong> (', theFile.type || 'n/a', ') - ',theFile.size, ' bytes','<span class="percent_bar" data-cent="0"></span><a data-pg-item="'+theFile.key+'" class="raw_delete">Remove</a>','</li>'].join('');
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
		  if(total_items_left==0){
			window.location.reload();
		  }
		},2000);
	  })(this.ctr);
	  
	  
	}
}

function startUpload(e){
	$(this).hide();
	$('.raw_delete').remove();
	processorObj = new Array();
	total_files = readerObj.length;
	for (var i in readerObj) {
	  //alert(i);
	  f = readerObj[i];
	  //readerObj[i].readAsDataURL(f);
	  //alert(f.file.name);
	  
	  //processorObj.push(( new XMLHttpRequest()));
	  processorObj[i] = new XMLHttpRequest();
	  processorObj[i].ctr = f.file.key;
	  processorObj[i].upload.ctr = f.file.key;
	  processorObj[i].upload.addEventListener("progress", progressHandler, false); 
	  processorObj[i].addEventListener("load", completeHandler, false); 
	  processorObj[i].addEventListener("error", errorHandler, false); 
	  processorObj[i].addEventListener("abort", abortHandler, false); 
	  processorObj[i].open("POST", site_url+'sitepanel/upload_media/response');
	  formdata = new FormData();
	  formdata.append('upload','Y');
	  formdata.append('filex',f.file);
	   processorObj[i].send(formdata);
	}
}

$('#files').change(handleFileSelect);
$('#upload').click(startUpload);
$(document).ready(function(){
  $("a[data-rel=gallery]").fancybox({'type':'image','titlePosition':'over'});

  $('#del_sbt').click(function(e){
	e.preventDefault;
	frmObj = this.form;
	ckbox = $('.del_items:checked');
	if(ckbox.length){
	  frmObj.submit();
	}else{
	  alert("Please select item");
	}
  });

  $('.del_items').click(function(){
	lobj = $(this).parents('.cont_div');
	if(lobj.hasClass('item_selected')){
	  lobj.removeClass('item_selected');
	}else{
	  lobj.addClass('item_selected');
	}
  });

  $('#sel_sbt').click(function(e){
	e.preventDefault();
	ckbox = $('.del_items:checked');
	selected_length = ckbox.length;
	allowed_total_select = parent.total_db_limit;
	if(!selected_length){
	  alert("Please select item");
	  return false;
	}
	if(selected_length >  allowed_total_select){
	  alert("You can select "+allowed_total_select+" items");
	  return false;
	}
	var select_str = '<ul class="image_select_list">';
	var img_str = "";
	var img_sptr = "";
	$('.item_selected img[data-class="item_image"]').each(function(m,n){
	  lobj = $(n);
	  lobj_imgname = lobj.attr('data-imgname');
	  img_str += img_sptr+lobj_imgname;
	  select_str += '<li data-src="'+lobj_imgname+'"><img src="'+lobj.attr('src')+'">&nbsp;<a class="red delete_media"><img src="'+site_url+'assets/sitepanel/image/edit-cut.png"></a></li>';
	  img_sptr = ",";
	});
	select_str += '</ul>';
	parent.$('#browsed_container').html(select_str);
	parent.$('#browsed_image').val(img_str);
	parent.$('.fancybox-close').click();
  });
  
  $('#list').delegate('.raw_delete','click',function(e){
	e.preventDefault;
	robj = $(this);
	rkey = robj.attr('data-pg-item');
	$('#progress_item'+rkey).remove();
	delete(readerObj[rkey]);
  });

  $('#browsed_container').delegate('.delete_media','click',function(e){
	e.preventDefault();
	var lobj = $(this);
	var crfm = confirm('Are you sure you want to delete this');
	if(crfm){
	  lobj.parents('li').remove();
	  var img_str = "";
	  var img_sptr = "";
	  $('.image_select_list li').each(function(m,n){
		lobj = $(n);
		lobj_imgname = lobj.attr('data-src');
		img_str += img_sptr+lobj_imgname;
		img_sptr = ",";
	  });
	  $('#browsed_image').val(img_str);
	  if(!img_str.length){
		$('#browsed_container').html('<span class="red">None</span>');
	  }
	}
  });
  
});