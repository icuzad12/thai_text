<?php

class Thai_text {
	//คำอ่านภาษาไทยเป็นงเินมี บาท กะ สตางค์
	public static function readThaiBath($number){
  	
  		$numberformat = number_format($number,2);
  		$explode = explode('.' , $numberformat);
  		$baht = $explode[0];
  		$stang = $explode[1];
  
   		if($stang == '00'){
    		return Most::readThai($baht).'บาทถ้วน';
   		}else{
    		return Most::readThai($baht).'บาท'.Most::readThai($stang).'สตางค์';
   		}
 	}
 	//คำอ่านภาษาไทย
 	public static function readThai($num){   
  	
  		$num = str_replace(',','',$num);
     	$num_decimal = explode('.',$num);
     	$num = $num_decimal[0];
     	$returnNumWord ='';   
     	$lenNumber = strlen($num);   
     	$lenNumber2 = $lenNumber - 1;   
     	$kaGroup = array('' , 'สิบ' ,  'ร้อย' , 'พัน' , 'หมื่น' , 'แสน' , 'ล้าน' , 'สิบ' , 'ร้อย' , 'พัน' , 'หมื่น' , 'แสน' , 'ล้าน');   
     	$kaDigit = array('' , 'หนึ่ง' , 'สอง' , 'สาม' , 'สี่' , 'ห้า' , 'หก' , 'เจ็ด' , 'แปด' , 'เก้า');   
     	$kaDigitDecimal = array('ศูนย์' , 'หนึ่ง' , 'สอง' , 'สาม' , 'สี่' , 'ห้า' , 'หก' , 'เจ็ด' , 'แปด' , 'เก้า');   
     	$ii = 0;   
 		
 		for($i = $lenNumber2;$i >= 0;$i--){   
  			$kaNumWord[$i] = substr($num,$ii,1);   
  			$ii++;   
    	}   
 		$ii = 0;   
 		
 		for($i = $lenNumber2;$i >= 0;$i--){   
  			if(($kaNumWord[$i] == 2 && $i ==1) || ($kaNumWord[$i] == 2 && $i == 7)){   
            	$kaDigit[$kaNumWord[$i]]='ยี่';   
        }else{   
            if($kaNumWord[$i] == 2){   
                $kaDigit[$kaNumWord[$i]] = 'สอง';        
            }   
            if(($kaNumWord[$i] == 1 && $i <= 2 && $i == 0) || ($kaNumWord[$i] == 1 && $lenNumber > 6 && $i == 6)){   
                if($kaNumWord[$i + 1] == 0){   
                    $kaDigit[$kaNumWord[$i]] = 'หนึ่ง';      
                }else{   
                    $kaDigit[$kaNumWord[$i]] = 'เอ็ด';       
                }   
            }else if(($kaNumWord[$i] == 1 && $i <= 2 && $i == 1) || ($kaNumWord[$i] == 1 && $lenNumber >6 && $i == 7)){   
                $kaDigit[$kaNumWord[$i]] = '';   
            }else{   
                if($kaNumWord[$i] == 1){   
     				$kaDigit[$kaNumWord[$i]] = 'หนึ่ง';   
                }   
            }   
        }   
        if($kaNumWord[$i] == 0){   
        	if($i != 6){
   				$kaGroup[$i] = '';   
         	}
        }   
        $kaNumWord[$i] = substr($num,$ii,1);   
        $ii++;   
        $returnNumWord.=$kaDigit[$kaNumWord[$i]].$kaGroup[$i];   
    	} 

       return $returnNumWord;   
 	}

 	//convert from คศ to พศ
    public static function convertYear($y){
    	$y = $y+543;
    	return $y;
    }

 	//convert month number into thai month
    public static function convertMonth($m){
    	if ($m == 1) {
        	$m = "มกราคม";
        }elseif ($m == 2) {
        	$m = "กุมภาพันธ์";
        }elseif ($m == 3) {
		    $m = "มีนาคม";
        }elseif ($m == 4) {
        	$m = "เมษายน";
        }elseif ($m == 5) {
        	$m = "พฤษภาคม";
        }elseif ($m == 6) {
        	$m = "มิถุนายน";
        }elseif ($m == 7) {
        	$m = "กรกฎาคม";
        }elseif ($m == 8 ) {
        	$m = "สิงหาคม";
        }elseif ($m == 9) {
        	$m = "กันยายน";
        }elseif ($m == 10) {
        	$m = "ตุลาคม";
        }elseif ($m == 11) {
        	$m = "พฤศจิกายน";
        }else $m = "ธันวาคม";

        return $m;
    }
    //Thai date from DateObject (carbon object)
    public static function dateFromDateObject($dateObject)
    {
    	  $m = $dateObject->month;
        $y = $dateObject->year;
        $d = $dateObject->day;

        $y = Most::convertYear($y);
        $m = Most::convertMonth($m);

        return $d." ".$m." ".$y;
    }

}