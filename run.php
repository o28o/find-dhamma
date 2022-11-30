<?php
function finddhamma($olang, $q)
{ 
			$string = str_replace ("`", "", $q);
			
			if(preg_match("/^(mn|dn)[0-9].*$/i",$string) || preg_match("/^(sn|an|ud)[0-9]{0,2}.[0-9]*$/i",$string) || preg_match("/^(sn|an|ud)[0-9]{0,2}.[0-9]{0,3}-[0-9].*$/i",$string)){
    echo "<script>window.location.href='https://find.dhamma.gift/sc/?q=$string';</script>";
  exit();
}
			$output = shell_exec("nice -19 ./scripts/finddhamma.sh $olang $lang $string"); 
			echo "<p>$output</p>";
			echo "<script>document.getElementById( 'spinner' ).style.display = 'none';</script>"
}
?>	