<?php

namespace App\Services;

class Censurator
{
    const LIST = ['idiot', 'noob', 'Geek','fuck'];


    public function purify($text)
    {

        foreach (self::LIST as $word){

            $replacement=str_repeat("*" ,mb_strlen($word));
            $text = preg_replace("/[^\w]" . $word . "[^\w]/i", $replacement, $text);        }

        return $text;



    }


}