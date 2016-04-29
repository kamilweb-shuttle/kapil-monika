<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
* The global CI helpers 


*/

if ( ! function_exists('CI'))
{
	function CI()
	{
		if (!function_exists('get_instance')) return FALSE;
		
		$CI = &get_instance();		
		return $CI;
	}
}

if ( ! function_exists('getDateFormat')){	

	function getDateFormat($date,$format,$seperator1=",")
	{
		switch($format)
		{
			case 1: // (Ymd)->(dmY) 06 Dec, 2010 
				$arr_date=explode($seperator1,$date);			 
				$arr_date=strtotime($arr_date[0]);
				$ret_date=date("d M".$seperator1." Y",$arr_date);           
			break;
		
			case 2: // (Ymd)->(dmY) 06 December, 2010
				$arr_date=explode($seperator1,$date);			 
				$arr_date=strtotime($arr_date[0]);
				$ret_date=date("d F".$seperator1." Y",$arr_date);           
			break;
			
			case 3: // (Ymd)->(dmY) Mon Dec 06, 2010 
				$arr_date=explode($seperator1,$date);			 
				$arr_date=strtotime($arr_date[0]);
				$ret_date=date("D M d".$seperator1." Y",$arr_date);           
			break;
			
			case 4: // (Ymd)->(dmY) Monday December 06, 2010 
				$arr_date=explode($seperator1,$date);			 
				$arr_date=strtotime($arr_date[0]);
				$ret_date=date("l F d".$seperator1." Y",$arr_date);           
			break;
			
			case 5: // (Ymd)->(dmY) Monday December 06, 2010, 03:04:00 
				$arr_time1=explode(" ",$date);			 
				$arr_date=strtotime($date);
				$ret_date=date("l F d".$seperator1." Y".$seperator1." h:i:s",$arr_date);           
			break;
			
			case 6: // (Ymd)->(dmY) Monday December 06, 2010, 15:03:PM 
				$arr_time1=explode(" ",$date);			 
				$arr_date=strtotime($date);
				$ret_date=date("l F d".$seperator1." Y".$seperator1." H:i:A",$arr_date);           
			break;
			
			case 7: // (Ymd)->(dmY) Monday December 06, 2010, 15:03:PM 
				$arr_time1=explode(" ",$date);			 
				$arr_date=strtotime($date);
				$ret_date=date("d M".$seperator1." Y".$seperator1." H:i:A",$arr_date);           
			break;
			
			case 8: // (Ymd)->(dmY) Monday December 06, 2010, 03:04:00 
				$arr_time1=explode(" ",$date);			 
				$arr_date=strtotime($date);
				$ret_date=date("d M".$seperator1." Y".$seperator1." h:i",$arr_date);           
			break;
			case 9: // (Ymd)->(dmY) Monday December 06, 2010 
				$arr_date=explode($seperator1,$date);			 
				$arr_date=strtotime($arr_date[0]);
				$ret_date=date("M d".$seperator1." Y",$arr_date);           
			break;
			case 10: // (Ymd)->(dmY) Monday December 06, 2010 
				$arr_date=explode($seperator1,$date);			 
				$arr_date=strtotime($arr_date[0]);
				$ret_date=date("M d".$seperator1." Y [l]",$arr_date);           
			break;
			case 11: // (Ymd)->(dmY) Monday December 06, 2010 
				$arr_date=explode($seperator1,$date);			 
				$arr_date=strtotime($arr_date[0]);
				$ret_date=date("d-M-Y",$arr_date);           
			break;
			
		}
		return $ret_date;
	}
}


if ( ! function_exists('humanTiming'))
{	
	function humanTiming($time)
	{
		$CI = CI();
		$p="";
		$currtent_time = strtotime($CI->config->item('date_time_format'));
		
		$diff = (int) abs( $currtent_time - $time); 
		
		$tokens = array(
			31536000 => 'year',
			2592000 => 'month',
			604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'minute',
			1 => 'second'
		);
		foreach ($tokens as $unit => $text) {
			if ($diff < $unit) continue;
			$numberOfUnits = round($diff / $unit);
			return $p= $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
		}
		return ($p=='' ? '1 seconds' : $p);
		
	}
}


/************************************************************
1.Convert Nested Array to Single Array
2.If $key is not empty then key will be preserved but 
value will be overwrite if occur more than once

************************************************************/

if ( ! function_exists('array_flatten'))
{
	function array_flatten($array,$return,$key='')
	{
		if(is_array($array))
		{
			foreach($array as $ky=>$val)
			{
				$key=($key!=='' ? $ky : '');
				
				$return = array_flatten($val,$return,$key);
			}
		}else
		{
			if($key!='')
			{
				$return[$key]=$array;
			}else
			{
				$return[]=$array;
			}
		}
		return $return;
	} 
}

/*
find one array 
$arr1 =  array('0'=>'1','1'=>'2')
$arr2 =  = array('1' =>'Boarding Job','2' =>'Night Job','3'=>'Daily Job');
$result ==> Boarding Job,Night Job
*/ 
function getArrayValueBykey($arr1,$arr2)
{
    $res =array();
	if( is_array($arr1) && is_array($arr2) ){
		
		foreach($arr1 as $key=>$val){
			
		  if($val!="" )
		  {
			  
		    $res[] = $arr2[$val];
			
		   }
		  		
		}		
	
	}
	
  return $res;
}


if ( ! function_exists('getAge'))
{
	function getAge($dob)
	{
		$age = 31536000;  //days secon 86400X365
		$birth = strtotime($dob); // Start as time
		$current = strtotime(date('Y')); // End as time
		if($current > $birth)
		{
			$finalAge = round(($current - $birth) /$age)+1;
		}
		return $finalAge;
	}
}



//$in_string = " hi  this dkmphp  net india  wenlink india  development fun company php delhi";
//$spam_word_arr = array('php','net','fun');

if ( ! function_exists('check_spam_words'))
{
	function check_spam_words($spam_word_arr,$in_string)
	{
		$is_spam_found = false;
		if( is_array($spam_word_arr) && $in_string!="" )
		{ 
			foreach($spam_word_arr as $val)
			{   
				if( preg_match("/\b$val\b/i",$in_string) )
				{
					$is_spam_found = true;
					break;
				}
			}
		}
		return $is_spam_found;
	}
}

if ( ! function_exists('file_ext'))
{
	function file_ext($file)
	{
		$file_ext = strtolower(strrchr($file,'.'));
		$file_ext = substr($file_ext,1);
		return $file_ext;
	}
}


if ( ! function_exists('applyFilter'))
{
	function applyFilter($type,$val)
	{
		switch($type)
		{
			case 'NUMERIC_GT_ZERO':
				$val=preg_replace("~^0*~","",trim($val));
				return preg_match("~^[1-9][0-9]*$~i",$val) ? $val : 0;
			break;
			case 'NUMERIC_WT_ZERO':
				return preg_match("~^[0-9]*$~i",trim($val)) ? $val : -1;
			break;
		}
	}
}

if( ! function_exists('removeImage'))
{
	function removeImage($cfgs)
	{	
		if($cfgs['source_dir']!='' && $cfgs['source_file']!='')
		{
			$pathImage=UPLOAD_DIR."/".$cfgs['source_dir']."/".$cfgs['source_file'];
			if(file_exists($pathImage))
			{
				unlink($pathImage);
			}
		}
	}	
}


if( ! function_exists('trace'))
{
	function trace()
	{
		list($callee) = debug_backtrace();
		$arguments = func_get_args();
		$total_arguments = count($arguments);

		echo '<fieldset style="background: #fefefe !important; border:3px red solid; padding:5px; font-family:Courier New,Courier, monospace;font-size:12px">';
	    echo '<legend style="background:lightgrey; padding:6px;">'.$callee['file'].' @ line: '.$callee['line'].'</legend><pre>';
	    $i = 0;
	    foreach ($arguments as $argument)
	    {
			echo '<br/><strong>Debug #'.(++$i).' of '.$total_arguments.'</strong>: ';

			if ( (is_array($argument) || is_object($argument)) && count($argument))
			{
				print_r($argument);
			}
			else
			{
				var_dump($argument);
			}
		}

		echo '</pre>' . PHP_EOL;
		echo '</fieldset>' . PHP_EOL;
	
	}
}

if( ! function_exists('find_paging_segment'))
{ 
	 function find_paging_segment($debug=FALSE)
	 {
		 $ci=  CI();
		 $segment_array = $ci->uri->segments;
		 
		 if($debug)
		 {
		   trace($ci->uri->segments);
		 }
		 
		 $key =  array_search('pg',$segment_array);
		
		return $key+1;
		 
	 } 
}



if ( ! function_exists('make_missing_folder'))
{
	function make_missing_folder($dir_to_create="")
	{
		if(empty($dir_to_create))
		return;
			
		$dir_path=UPLOAD_DIR;
		$subdirs=explode("/",$dir_to_create);
		foreach($subdirs as $dir)
		{
		  if($dir!="")
		  {
			  $dir_path = $dir_path."/".$dir;	
			  if(!file_exists($dir_path) )
			  {
					//echo $dir_path;
					mkdir($dir_path,0755);
			  }else
			  {
				   chmod($dir_path,0755);
			  }
			  
		  }
		}
	}
}

if ( ! function_exists('char_limiter'))
{
  function char_limiter($str,$len,$suffix='...')
  {
	  $str = strip_tags($str);
	  if(strlen($str)>$len)
	  {
		  $str=substr($str,0,$len).$suffix;
	  }
	  return $str;
  }
}  

if ( ! function_exists('redirect_top'))
{
	function redirect_top($url='')
	{
			if(!strpos($url,'ttp://') && !strpos($url,'ttps://'))
			$url=base_url().$url;
			
			if($url==''):
			?>
			<script>
			 top.$.fancybox.close();
			 window.top.location.reload();
			</script>
			<?php
			else:
			
			?>
			<script>
			 top.$.fancybox.close();
			 window.top.location.href="<?php echo $url?>";
			</script>
			<?php
			endif;
			exit;
	}
}

if ( ! function_exists('confirm_js_box'))
{	
	function confirm_js_box($txt='remove')
	{
		
		$var = "onclick=\"return confirm('Are you sure you want to $txt this record');\" ";
	    return $var;	
	}
}



/*
    A)  $varg contains  following options 
		
    default_text 	=>      Default Option Text
	name 		    => 		Dropdn name
	id 		        => 		Dropdn id (default to name)
	format      	=>	    All extra attributes for the dpdn(style,class,event...)
	opt_val_fld     =>      i).$result is from database => field name to be shown in option value box
							ii).$result is custom single dimensional array => key/value for option value box(default 'key')								
	opt_txt_fld     =>      i).$result is from database => field name to be shown in option text box
							ii).$result is custom single dimensional array => key/value for option text box(default 'value')
	B) $result         =>     result set  from database or could be your single dimensional associative/index array
	
	*/

if ( ! function_exists('make_select_box'))
{	
	function make_select_box($varg=array(),$result=array())
	{	
	
		$ci = CI();	
		$var="";
				
		$varg['default_text']=!array_key_exists('default_text',$varg) ? "Select" : $varg['default_text'];
		
		$varg['id']=!array_key_exists('id',$varg) ? $varg['name'] : $varg['id'];
		
		$opt_val_fld = !array_key_exists('opt_val_fld',$varg) ? $varg['opt_val_fld'] : 'key';
		
		$opt_txt_fld = !array_key_exists('opt_txt_fld',$varg) ? $varg['opt_txt_fld'] : 'value';
		
		$is_associative_array = !array_key_exists('associative',$varg) ? FALSE : $varg['associative'];
		
		
		$var.='<select name="'.$varg['name'].'" id="'.$varg['id'].'" '.$varg['format'].'>';
		
		if($varg['default_text']!="")
		{
			$var.='<option value="" selected="selected">'.$varg['default_text'].'</option>';
		}		
		
		foreach($result as $key=>$val)
		{	
		   	if( is_array($val) && !empty($val))
			{ 
				if(is_array($varg['current_selected_val']))
				{					
					$select_element=in_array($val[$opt_val_fld],$varg['current_selected_val']) ? "selected" : "";
					
				}else
				{					
					$select_element=( $varg['current_selected_val']==$val[$opt_val_fld] ) ? "selected" : "";
					
				}	
						
				$var.='<option value="'.$val[$opt_val_fld].'" '.$select_element.'>'.ucfirst($val[$opt_txt_fld]).'</option>';
				   
			}else
			{		
						
				$opt_val_fld = $opt_val_fld === 'key' ? $key : $val;
				$opt_txt_fld = $opt_txt_fld === 'key' ? $key : $val;
				
				if(is_array($varg['current_selected_val']))
				{					
					$select_element=in_array($opt_val_fld,$varg['current_selected_val']) ? "selected" : "";
					
				}else
				{					
					$select_element=( $varg['current_selected_val']==$opt_val_fld ) ? "selected" : "";
					
				}	
						
				$var.='<option value="'.$opt_val_fld.'" '.$select_element.'>'.$opt_txt_fld.'</option>';					
				
			}
			
			
		}
		
		$var.='</select>';
		
		return $var;
	}

}


function CountrySelectBox($varg=array())
{	
	$CI = CI();	
	$var="";
	
	/**********************************************************
	default_text 		=>Default Option Text
	name 		=> 			Dropdn name
	id 		=> 			Dropdn id (default to name)
	format      		=>	all extra attributes for the dpdn(style,class,event...)
	opt_val_fld     =>      DpDn option value field to be fetched from database
	opt_txt_fld     =>      DpDn option text field to be fetched from database
	
	***********************************************************/		
	$varg['default_text']=!array_key_exists('default_text',$varg) ? "Select Country" : $varg['default_text'];
	$varg['id']=!array_key_exists('id',$varg) ? $varg['name'] : $varg['id'];
	$opt_val_fld=!array_key_exists('opt_val_fld',$varg) ? "name" : $varg['opt_val_fld'];
	$opt_txt_fld=!array_key_exists('opt_txt_fld',$varg) ? "name" : $varg['opt_txt_fld']; 
	
	$var.='<select name="'.$varg['name'].'" id="'.$varg['id'].'" '.$varg['format'].'>';
	if($varg['default_text']!="")
	{
		$var.='<option value="" selected="selected">'.$varg['default_text'].'</option>';
	}	
	$contry_res=$CI->db->query("SELECT * FROM wl_countries WHERE 1")->result_array();
	foreach($contry_res as $key=>$val)
	{		
		if(is_array($varg['current_selected_val']))
		{
			$select_element=in_array($val[$opt_val_fld],$varg['current_selected_val']) ? "selected" : "";
		}else
		{
			$select_element=( $varg['current_selected_val']==$val[$opt_val_fld] ) ? "selected" : "";
		}		
		$var.='<option value="'.$val[$opt_val_fld].'" '.$select_element.'>'.ucfirst($val[$opt_txt_fld]).'</option>';
	}
	$var.='</select>';
	return $var;
}


if ( ! function_exists('get_content')){
	
	function get_content($tbl="wl_auto_respond_mails",$pageId)
	{
		$CI = CI();	
		
		if( $pageId > 0 )
		{ 
			$res =  $CI->db->get_where($tbl,array('id'=>$pageId))->row();

			if( is_object($res) )
			{
				return $res;
			}
		}
	}
}
	if ( ! function_exists('get_site_email'))
	{
	function get_site_email()
	{
		$CI = CI();		
		$CI->db->select('*');
		$CI->db->from('tbl_admin');
		$CI->db->where('admin_id','1');		
		$query = $CI->db->get();
		if($query->num_rows() > 0) return $query->row(); 
	}
	}
	
	if( ! function_exists('category_link'))
{  
	function category_link($parent)
	{
		$ci = CI();
	   $record_count =0;
	   
		$p=$ci->db->query("SELECT * FROM  wl_categories WHERE parent_id='$parent' and status='1'");
	
		$rsrow=$p->num_rows();
		if($rsrow>0){
			$link_url = base_url()."category/index/".$parent;	
			}else
			{			
			$link_url = base_url()."products/index/".$parent;	
			}
	
		return $link_url;
	}  
}


if ( ! function_exists('count_gallery'))
{
	function count_gallery($condtion='')
	{		
		 $ci = CI();
		 $condtion = "status ='1' ".$condtion;	 
		 $sql="SELECT COUNT(gallery_id)  AS total_gallery FROM wl_gallery WHERE $condtion ";		 
		echo $sql;
		 $query=$ci->db->query($sql)->row_array();
		 return  $query['total_gallery'];
		 
	}
}

function get_recent_view(){}