<?php
if ( ! function_exists('site_currency'))
{
	function site_currency()
	{
		$CI = CI();
		$res=$CI->db->query("SELECT * FROM wl_currencies WHERE status='1' AND is_default ='Y' ")->result();
		if( is_array($res) )
		{
			return $res;
		}
	}

}

if ( ! function_exists('display_symbol'))
{
	function display_symbol()
	{
		$CI = CI();	
		$curr_currency_id = $CI->session->userdata('currency_id');
		
		if($curr_currency_id=='' || $curr_currency_id==0)
		{
			$res=$CI->db->query("SELECT * FROM wl_currencies WHERE is_default='Y' AND status='1' ")->row();
		
			if( is_object($res) )
			{
				$currency_id   =  $res->currency_id;
				$code          =  $res->code;
				$symbol_left   =  $res->symbol_left;
				$symbol_right  =  $res->symbol_right;
				$value         =  $res->value;

				$CI->session->set_userdata(array('currency_id'=>$currency_id));
				$CI->session->set_userdata(array('currency_code'=>$code));
				$CI->session->set_userdata(array('symbol_left'=>$symbol_left));
				$CI->session->set_userdata(array('symbol_right'=>$symbol_right));
				$CI->session->set_userdata(array('currency_value'=>$value));
			}
		}
		else
		{
			$currency_id   =  $CI->session->userdata('currency_id');
			$code          =  $CI->session->userdata('currency_code');
			$symbol_left   =  $CI->session->userdata('symbol_left');
			$symbol_right  =  $CI->session->userdata('symbol_right');
			$value         =  $CI->session->userdata('currency_value');
		}

		$symbol  =  ( $symbol_left !='') ? $symbol_left : $symbol_right;
		return $symbol;
		
		
	}
}

if ( ! function_exists('convert_currency'))
{
	function convert_currency($currency_id)
	{
		$CI = CI();	
		if($currency_id!="" && $currency_id > 0 )
		{
			$res=$CI->db->query("SELECT * FROM wl_currencies WHERE currency_id='$currency_id' AND status='1' ")->row();
			if( is_object($res) )
			{
				$CI->session->set_userdata(array('currency_id'=>$res->currency_id));
				$CI->session->set_userdata(array('currency_code'=>$res->code));
				$CI->session->set_userdata(array('symbol_left'=>$res->symbol_left));
				$CI->session->set_userdata(array('symbol_right'=>$res->symbol_right));
				$CI->session->set_userdata(array('currency_value'=>$res->value));
			}
		}
	}
}


if ( ! function_exists('display_price'))
{
	function display_price($price)
	{
		
		$CI = CI();	
		
		if($price!="")
		{
			$res=$CI->db->query("SELECT * FROM wl_currencies WHERE is_default='Y' AND status='1' ")->row();
			
			if( is_object($res) )
			{
				$currency_id   =  $CI->session->userdata('currency_id');
				$code          =  $CI->session->userdata('currency_code');
				$symbol_left   =  $CI->session->userdata('symbol_left');
				$symbol_right  =  $CI->session->userdata('symbol_right');
				$value         =  $CI->session->userdata('currency_value');
				
				if( $currency_id!="" && $value!="")
				{
					$new_price    = ( $price*$value );
					
					$final_price  =  ( $symbol_left !='') ? '<span class="WebRupee">Rs.</span> '.number_format($new_price,2) :  '<span class="WebRupee">Rs.</span> '.number_format($new_price,2);
					
				
				}else
				{
					$CI->session->set_userdata(array('currency_id'=>$res->currency_id));
					$CI->session->set_userdata(array('currency_code'=>$res->code));
					$CI->session->set_userdata(array('symbol_left'=>$res->symbol_left));
					$CI->session->set_userdata(array('symbol_right'=>$res->symbol_right));
					$CI->session->set_userdata(array('currency_value'=>$res->value));
					
				 $final_price = ($res->symbol_left!='') ? '<span class="WebRupee">Rs.</span> '.number_format($price,2) : '<span class="WebRupee">Rs.</span> '.number_format($price,2);
					
				}
				
				
			}
			return $final_price;
		}
	}
}

if( ! function_exists('fmtZerosDecimal'))
{
  function fmtZerosDecimal($price)
  {
	return preg_match("~\.(0+)$~",$price) ? intval($price) : $price;
  }
}

if( ! function_exists('formatNumberWithRounding'))
{
  function formatNumberWithRounding($value,$prec)
  {
	$value = round($value,$prec);
	$value = number_format($value,$prec,'.','');
	
	return $value;
  }
}

if( ! function_exists('formatNumber'))
{
  function formatNumber($value,$prec)
  {
	$value = number_format($value,$prec,'.','');
	
	return $value;
  }
}

if( ! function_exists('clearDecimalZeros'))
{
  function clearDecimalZeros($value)
  {
	$value = preg_replace("~(\.0+)$~","",$value);
	
	return $value;
  }
}