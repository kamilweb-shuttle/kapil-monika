function validcheckstatus(name,action,text)
{
	var chObj	=	document.getElementsByName(name);
	var result	=	false;	
	for(var i=0;i<chObj.length;i++){
	
		if(chObj[i].checked){
		  result=true;
		  break;
		}
	}
 
	if(!result){
		 alert("Please select atleast one "+text+" to "+action+".");
		 return false;
	}else if(action=='delete'){
			 if(!confirm("Are you sure you want to delete this.")){
			   return false;
			 }else{
				return true;
			 }
	}else{
		return true;
	}
}


function incDnc(val, qid, avaQty){
	qval=jQuery('#qty_'+qid).val();    
	mqval=jQuery('#mqty_'+qid).val();
	//alert(qid);
	var i=eval(qval);
	if(val===1){
		if(avaQty > i){
			i++;
			jQuery('#qty_'+qid).val(i);
			jQuery('#mqty_'+qid).val(i);
			jQuery.post(site_url+'cart/update_cart_qty',$('#cart_frm').serialize(),function(data){
				location.reload();
				// $("#cart_frm").load('#cart_frm');
				jQuery('#crt_msg').validationEngine('showPrompt', data.error_msg, data.error_type, true);
			},'json');                 
		}
		else{
			jQuery('#mqty_'+qid).validationEngine('showPrompt', 'Quantity can not excced '+avaQty, 'error', true);
		}
  }
	else if(val===2){
		if(i > 1){
			i--;
      jQuery('#qty_'+qid).val(i);
      jQuery('#mqty_'+qid).val(i);                
      jQuery.post(site_url+'cart/update_cart_qty',$('#cart_frm').serialize(),function(data){
				location.reload();
				jQuery('#crt_msg').validationEngine('showPrompt', data.error_msg, data.error_type, true);
			},'json');
		}
		else{
			jQuery('#mqty_'+qid).validationEngine('showPrompt', 'Quantity can not less then 1', 'error', true);
    }  
  }
}



function increment(id)
{ 

var obj = document.getElementById(id);
var max_qty ;
max_qty = document.getElementById('aval_qty').value;
max_qty = parseInt(max_qty);


			var val=obj.value;	
			if( parseInt(val)< max_qty ) {
				
			   obj.value=(+val + 1);
			   
			}else{
				if(max_qty==0){
					alert("None quantity is available.");
				}else{
					alert("Maximum available quantity is "+max_qty+". You can not add  more then available Quantity.");
			 	}
			}
}
function decrement(id)
{ 
   var obj = document.getElementById(id);
	var val=obj.value
	if(val==1 || val <1)
		val=1;
	else
	  val=(val - 1);
		
	obj.value=val || 1;
}

function show_dialogbox()
{
	$("#dialog_overlay").fadeIn(100);
	$("#dialog_box").fadeIn(100);
}
function hide_dialogbox()
{
	$("#dialog_overlay").fadeOut(100);
	$("#dialog_box").fadeOut(100);
}

function showloader(id)
{
	$("#"+id).after("<span id='"+id+"_loader'><img src='"+site_url+"/assets/developers/images/loader.gif'/></span>");
}


function hideloader(id)
{
	$("#"+id+"_loader").remove();
}
												
												
function load_more(base_uri,more_container,formid)
{	
  showloader(more_container);
  $("#more_loader_link"+more_container).remove();
   if(formid!='0')
   {
	   form_data=$('#'+formid).serialize();
   }
   else
   {
	   form_data=null;
   }
  $.post
	  (
		  base_uri,
		  form_data,
		  function(data)
		  { 
		  
		  
			 var dom = $(data);
			
			dom.filter('script').each(function(){
			$.globalEval(this.text || this.textContent || this.innerHTML || '');
			});
			
			var currdata = $( data ).find('#'+more_container).html(); $('#'+more_container).append(currdata);
			hideloader(more_container);
		  }
	  );
}



function join_newsletter(evt){	
	tg  = evt.srcElement || evt.target;
	
	if(tg.name == 'subscribe_me'){
		act_news = 'Y';
	}else{
		act_news = 'N';
	}
	
	name_val = $('#newsletter_name').val();
	email_val = $('#newsletter_email').val();
	captcha_val = $('#verification_code').val();
	
	var form = $("#chk_newsletter");	
	showloader('newsletter_loder');
	$(".btn").attr('disabled', true);		
	$.post(site_url+"pages/join_newsletter",{newsletter_name:name_val,newsletter_email:email_val,newsletter_captcha:captcha_val,subscribe_me:act_news},function(data){
		document.getElementById('captchaimage').src=site_url+'captcha/normal/'+Math.random(); 
		if(data.error_type == 'error'){
			//$('#newsletter_name').val('');	
			//$('#newsletter_email').val('');
			$('#verification_code').val('');
		}
		else{			
			$('#newsletter_name').val('');	
			$('#newsletter_email').val('');
			$('#verification_code').val('');	
		}
		$('.captchaimage').attr('src',site_url+'captcha/normal/'+Math.random());
		$("#my_newsletter_msg").html(data.error_msg);
		//$(".btn").attr('disabled', false);				 
	},'json');
	return false;
}


$(document).ready(function() {
	
	
	
	$(':checkbox.ckblsp').click(function()
    {
	 
		$(':input','#ship_container').val('');
		if($(this).prop('checked'))
		{
			$('#ship_container').hide();
			
		}else{
			
			$('#ship_container').show();
				
		}	
	}); 	
	
});

$(document).ready(function() {
	var showChar = 400;
	var ellipsestext = "...";
	var moretext = "more";
	var lesstext = "less";
	$('.more').each(function() {
		var content = $(this).html();

		if(content.length > showChar) {

			var c = content.substr(0, showChar);
			var h = content.substr(showChar-1, content.length - showChar);

			var html = c + '<span class="moreelipses  ">'+ellipsestext+'</span>&nbsp;<span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink underline blue">'+moretext+'</a></span>';

			$(this).html(html);
		}

	});

	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});
}); 

$(window).load(function(e) {
	$(".chk_location").live('click',function(e){
		e.preventDefault();	
		$(".zip_code_error").html("");
		if($("#zip_code").val()==0){
			$(".zip_code_error").html("Please select zip code.");
		}else{
			$.ajax({
				//"url":'<?php echo site_url('products/check_zipcode')?>','type':"POST",'dataType':"json",'data':{'zip_code':$("#zip_code").val()},
				'success':function(data){
					if(data.error){
						$(".zip_code_error").html(data.error);
					}else{
						$("#show_zc").html($("#zip_code").val());
						$("#show_zip").hide();
						$(".validzip").show();
					}					
				}
			});
			return false;
		}
	}); 
}); 
