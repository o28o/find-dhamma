
<?php
function RandomWord() {
  $words = Array("Kāyagat","Seyyathāpi","Samudd","Cūḷanik", "Suññat", "Mūsik", "Vicchiko", "Hatthī");
return $words[array_rand($words)];
}

function RandomSutta() {
$suttas = Array("Sn56.11","Dn22","Sn12.2");
return $suttas[array_rand($suttas)];
}



?> 

