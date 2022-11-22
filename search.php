<?php

		// Defining variables
$nameErr = $languageErr  = "";
$pattern = $language = $arg = $olang ="";
		// Checking for a GET request
		
		
		if ($_SERVER["REQUEST_METHOD"] == "GET") {
		$pattern = test_input($_GET["pattern"]);
/* 		$pitaka = test_input($_GET["pitaka"]);
 */		}

		// Removing the redundant HTML characters if any exist.
		function test_input($data) {
		$data = trim($data);
		return $data;
		}
		
      if (empty($_GET["language"])) {
    $languageErr = "";
  } else {
    $language = test_input($_GET["language"]);
  }

if (!empty($language)) {
  $language = "-$language";
}
if (!empty($olang)) {
  $olang = "-$olang";
}
$arg = $olang . ' ' . $language . ' ' . $pattern;

			$old_path = getcwd();
			$string = str_replace ("`", "", $pattern);
			
			if(preg_match("/^(mn|dn)[0-9].*$/i",$string) || preg_match("/^(sn|an|ud)[0-9]{0,2}.[0-9]*$/i",$string) || preg_match("/^(sn|an|ud)[0-9]{0,2}.[0-9]{0,3}-[0-9].*$/i",$string)){
    echo "<script>window.location.href='https://find.dhamma.gift/sc/?q=$string';</script>";
  exit();
}
			$output = shell_exec("echo $language; nice -19 ./scripts/finddhamma.sh $olang $language $string"); 
			echo "<p>$language $output</p>";
	/*		echo "<script>document.getElementById( 'spinner' ).style.display = 'none';</script>"*/
		?>