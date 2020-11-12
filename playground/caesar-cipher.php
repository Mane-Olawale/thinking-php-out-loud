<?php

$alpha = [
    'A',
    'B',
    'C',
    'D',
    'E',
    'F',
    'G',
    'H',
    'I',
    'J',
    'K',
    'L',
    'M',
    'N',
    'O',
    'P',
    'Q',
    'R',
    'T',
    'U',
    'V',
    'W',
    'X',
    'Y',
    'Z'
];

//This is the mathematical Expression
function shift( $x, $n)
{
    return abs( $x + $n) % 26;
}


function getIndex( $letter )
{
    global $alpha;
    
    foreach ($alpha as $key => $value) {
        
        if ($value === strtoupper($letter) ) return $key;
    }

    return 1;
}


function shiftText( string $text, int $shift)
{
    global $alpha;
    
    $newText = '';

    foreach (str_split($text) as $value) {

        $newText .= ($value !== ' ') ? $alpha[ shift( getIndex($value), $shift ) ] : ' ';

    }

    return $newText;
}


/**
 * This is the Implementation
 */


 $text = 'i am a boy';

 $shift = shiftText( $text, 5);

 echo "
 Initial Text = $text \n\n
 Shifted Text = $shift \n\n
 ";