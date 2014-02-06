<?php
/*
The neplang library
by virtualanup
http://virtualanup.com
*/

class NepLang
{
    static $nepalidigits = array('०','१','२','३','४','५','६','७','८','९');
    
    //we need to store it in this way
    static $belowhundred = array(
        'सुन्य','एक','दुई','तिन','चार','पाँच','छ','सात','आठ','नौ',
        'दस्','एघार','बार','तेर','चौध','पन्ध्र','सोर्ह','सत्र','अठार','उन्नाइस',
        'बिस','एक्काइस','बाइस','तेइस','चौबिस','पच्चिस','छब्बिस','सत्ताइस','अठ्ठाइस','उनन्तिस',
        'तिस','एक्तिस','बत्तिस','तेत्तिस','चौतिस','पैतिस','छतिस','सड्तिस','अड्तिस','उन्चालिस',
        'चालिस','एक्चालिस','बयालिस','तिर्चालिस','चवालिस','पैतालिस','छयालिस','सड्चालिस','अड्चालिस','उनन्पचास',
        'पचास','एकाउन्न','बाउन्न','तृपन्न','चवन्न','पच्पन्न','छपन्न','सन्ताउन्न','अन्ठाउन्न','उनन्साठी',
        'साठी','एक्सठ्ठी','बैसठ्ठी','तिर्सठ्ठी','चौसठ्ठी','पैइसठ्ठी','छैसठ्ठी','सड्सठी','अड्सठ्ठी','उन्नान्सत्तरी',
        'सत्तरी','एकत्तर','बहत्तर','तिरत्तर','चौरत्तर','पचत्तर','चेहत्तर','सतहत्तर','अठ्हत्तर','उनानसी',
        'असि','एकासी','बयासी','तिरासी','चौरासी','पचासी','छयासी','सतासी','अठासी','उनानब्बे',
        'नब्बे','एकानब्बे','बयानब्बे','तिरानब्बे','चौरानब्बे','पन्चानब्बे','छयानब्बे','सन्तानब्बे','अन्ठानब्बे','उन्नानसय'
    );
    static $abovehundred = array(
        100000000000 => 'खर्ब',
        1000000000 => 'अर्ब',
        10000000 => 'करोड',
        100000 => 'लाख',
        1000 => 'हजार',
        100 => 'सय'
        );

    public static function englishToNepali($number)
    {
        //converts english number to nepali representation
        $number = strval($number);
        //run through the number converting each letter to nepali
        $nepali='';
        for($i=0 ; $i < strlen($number) ; $i++)
            if(is_numeric($number[$i]))
                $nepali.=self::$nepalidigits[$number[$i]];
            else if($number[$i] == '.')
                $nepali.=".";
        return $nepali;
    }

    public static function nepaliToEnglish($number)
    {
        //TODO
    }

    public static function numberToWord($number, $isnepali = false)
    {
        //converts a number to word in nepali language
        if($isnepali)
            $number = self::nepaliToEnglish($number);
        $nepali = '';
        //convert the word to nepali language text
        $number = strval($number);
        //first of all, seperate it into integer and float
        $intval = intval($number);
        $floatval = 0;
        $numberofzeros = 0;
        //get value after decimal place
        if( ($position = strpos($number,'.')) !== FALSE)
        {
            //find leading zeros in floating point value
            for($j = $position+1; $j < strlen($number) ; $j++)
                if(intval($number[$j]) != 0)
                    break;
                else
                    $numberofzeros++;
            $floatval = intval(substr($number,$position+1,strlen($number)-$position));
        }
        if($intval >= 100)
        {
            foreach( self::$abovehundred as $denom => $word)
            {
                if($intval >= $denom)
                {
                    $nepali .= self::numberToWord(intval($intval/$denom))." ".$word." ";
                    $intval = $intval % $denom;
                }
            }
        }
        //if it is less than 100, then problem solved
        if($intval < 100)
        {
            if(strlen($nepali) > 0)
            {
                if($intval != 0)
                    $nepali .= self::$belowhundred[$intval].' ';
            }
            else
                $nepali .= self::$belowhundred[$intval].' ';
        }


        if($floatval > 0)
        {
            $nepali .='दस्मलब ';
            for($j = 0;$j < $numberofzeros; $j++)
                $nepali .= self::$belowhundred[0].' ';
            $floatval = strval($floatval);
            for($j=0; $j < strlen($floatval); $j++)
                $nepali .= self::$belowhundred[intval($floatval[$j])].' ';
        }
        return $nepali;
    }
}
?>