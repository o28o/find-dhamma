<?php

function RandomWord() 
{
$words = Array("Kāyagat","Seyyathāpi","Samudd","Cūḷanik", "Suññat", "Mūsik", "Vicchiko", "Hatthī");
$val = $words[array_rand($words)];
return $val;
}

function RandomSutta() {
$suttas = Array("Sn56.11","Dn22","Sn12.2");
$val =  $suttas[array_rand($suttas)];
return $val;
}

RandomWord();
RandomSutta();
?> 

