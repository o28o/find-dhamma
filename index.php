<?php
		// Defining variables
$nameErr = $languageErr  = "";
$q = $p = $arg = $string = $sutta = "";
		// Checking for a GET request
		
		if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (empty($_GET["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_GET["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
	if (empty($_GET["p"])) {
    $languageErr = "language is required";
  } else {
    $p = test_input($_GET["p"]);
  }
}	
		if ($_SERVER["REQUEST_METHOD"] == "GET") {
		$q = test_input($_GET["q"]);
/* 		$pitaka = test_input($_GET["pitaka"]);
 */		}
		// Removing the redundant HTML characters if any exist.
		function test_input($data) {
		$data = trim($data);
	/*	$data = stripslashes($data);
		$data = htmlspecialchars($data); */
		return $data;
		}
		
      if (empty($_GET["p"])) {
    $languageErr = "";
  } else {
    $p = test_input($_GET["p"]);
  }
	
$arg = $p. ' ' . $q;
	$old_path = getcwd();
	
		$string = str_replace ("`", "", $q);
			
/* ru with arg */ 
/* for th.su dn */
  if (preg_match("/^dn[0-9]{1,2}s$/i",$string)) {

$forthsu = preg_replace("/dn/i","","$string");
$forthsu = preg_replace("/s/i","","$forthsu");

$link = shell_exec("curl -s https://tipitaka.theravada.su/toc/translations/1098 | grep \"ДН $forthsu\" | sed 's#href=\"/toc/translations/#href=\"https://tipitaka.theravada.su/node/table/#' |awk -F'\"' '{print \$2}' | tail -n1");
$link = str_replace(PHP_EOL, '', $link);

echo '<script>window.open("' . $link . '", "_self");</script>';
  exit();
}

if( $p == "-ru" ) 
{
    if(preg_match("/^(mn|dn)[0-9]{1,3}$/i",$string) || preg_match("/^(sn|an|ud)[0-9]{0,2}.[0-9]*$/i",$string) || preg_match("/^(sn|an|ud)[0-9]{0,2}.[0-9]{0,3}-[0-9].*$/i",$string)) 
    {
  $forthru = str_replace(".","_","$string"). '-';
  $filename = shell_exec("ls -R /home/a0092061/data/theravada.ru/Teaching/Canon | grep -i -m1 $forthru" ); 
  if( $filename != "" ) {
  $link = 'https://theravada.ru/Teaching/Canon/Suttanta/Texts/' . $filename;
 $link = str_replace(PHP_EOL, '', $link);
  } 
  elseif (preg_match("/^dn[0-9]{1,2}$/i",$string)) {

$forthsu = preg_replace("/dn/i","","$string");
$link = shell_exec("curl -s https://tipitaka.theravada.su/toc/translations/1098 | grep \"ДН $forthsu\" | sed 's#href=\"/toc/translations/#href=\"https://tipitaka.theravada.su/node/table/#' |awk -F'\"' '{print \$2}' | tail -n1");

$link = str_replace(PHP_EOL, '', $link);

}
echo '<script>window.open("' . $link . '", "_self");</script>';
  exit();
}

}

/* ru with layout */ 

function ru2lat($str)    {
    $tr = array(
    "А"=>"a", "Б"=>"b", "В"=>"v", "Г"=>"g", "Д"=>"d",
    "Е"=>"e", "Ё"=>"yo", "Ж"=>"zh", "З"=>"z", "И"=>"i", 
    "Й"=>"j", "К"=>"k", "Л"=>"l", "М"=>"m", "Н"=>"n", 
    "О"=>"o", "П"=>"p", "Р"=>"r", "С"=>"s", "Т"=>"t", 
    "У"=>"u", "Ф"=>"f", "Х"=>"kh", "Ц"=>"ts", "Ч"=>"ch", 
    "Ш"=>"sh", "Щ"=>"sch", "Ъ"=>"", "Ы"=>"y", "Ь"=>"", 
    "Э"=>"e", "Ю"=>"yu", "Я"=>"ya", "а"=>"a", "б"=>"b", 
    "в"=>"v", "г"=>"g", "д"=>"d", "е"=>"e", "ё"=>"yo", 
    "ж"=>"zh", "з"=>"z", "и"=>"i", "й"=>"j", "к"=>"k", 
    "л"=>"l", "м"=>"m", "н"=>"n", "о"=>"o", "п"=>"p", 
    "р"=>"r", "с"=>"s", "т"=>"t", "у"=>"u", "ф"=>"f", 
    "х"=>"kh", "ц"=>"ts", "ч"=>"ch", "ш"=>"sh", "щ"=>"sch", 
    "ъ"=>"", "ы"=>"y", "ь"=>"", "э"=>"e", "ю"=>"yu", 
    "я"=>"ya", " "=>"-", "."=>".", ","=>"", "/"=>"-",  
    ":"=>"", ";"=>"","—"=>"", "–"=>"-"
    );
    return strtr($str,$tr);
}
if (preg_match('/^[А-Яа-яЁё][А-Яа-яЁё][1-9]{1,3}/ui', $string) || preg_match("/^(сн|ан|уд)[0-9]{0,2}.[0-9]*$/ui",$string) || preg_match("/^(сн|ан|уд)[0-9]{0,2}.[0-9]{0,3}-[0-9].*$/ui",$string)) 
    {
     $trnstring = ru2lat( $string );	
  $forthru = str_replace(".","_","$trnstring"). '-';
  $filename = shell_exec("ls -R /home/a0092061/data/theravada.ru/Teaching/Canon | grep -i -m1 $forthru" ); 
 
  if( $filename != "" ) {
  $link = 'https://theravada.ru/Teaching/Canon/Suttanta/Texts/' . $filename;
 $link = str_replace(PHP_EOL, '', $link);
  } 
  
  elseif (preg_match("/^dn[0-9]{1,2}$/i",$trnstring)) {
$forthsu = preg_replace("/dn/i","","$trnstring");
$link = shell_exec("curl -s https://tipitaka.theravada.su/toc/translations/1098 | grep \"ДН $forthsu\" | sed 's#href=\"/toc/translations/#href=\"https://tipitaka.theravada.su/node/table/#' |awk -F'\"' '{print \$2}' | tail -n1");

$link = str_replace(PHP_EOL, '', $link);

}
echo '<script>window.open("' . $link . '", "_self");</script>';
  exit();
}

if( $p == "-th" ) 
{
    if(preg_match("/^(mn|dn)[0-9]{1,3}$/i",$string) || preg_match("/^(sn|an|ud)[0-9]{0,2}.[0-9]*$/i",$string) || preg_match("/^(sn|an|ud)[0-9]{0,2}.[0-9]{0,3}-[0-9].*$/i",$string)) 
    {
  $link = "https://suttacentral.net/$string/th/siam_rath";
echo '<script>window.open("' . $link . '", "_self");</script>';
  exit();
}
}

			if(preg_match("/^(mn|dn)[0-9]{1,3}$/i",$string) || preg_match("/^(sn|an|ud)[0-9]{0,2}.[0-9]*$/i",$string) || preg_match("/^(sn|an|ud)[0-9]{0,2}.[0-9]{0,3}-[0-9].*$/i",$string)){
    echo "<script>window.location.href='https://find.dhamma.gift/sc/?q=$string&lang=pli';</script>";
  exit();
}
  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8">

<title>find.Dhamma.gift</title>
 <meta http-equiv="Cache-control" content="public">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="Liberation Search Engine. Search in Pali Suttanta and Vinaya" />
<meta name="author" content="" />
<!-- Favicon-->

<meta property="og:locale" content="en_US" />
<meta property="og:type" content="article" />
<meta property="og:title" content="find.Dhamma.gift" />
<meta property="og:description" content="Liberation Search Engine. Search in Suttas and Vinaya in Pali, Russian, English and Thai" />

<meta property="og:url" content="https://find.dhamma.gift/" />
<meta property="og:site_name" content="find.Dhamma.gift" />
<meta property="og:image" itemprop="image" content="https://find.dhamma.gift/assets/social_sharing_gift.jpg" />

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="find.Dhamma.gift - Liberation Search Engine">
<meta name="twitter:description" content="Search in Pali Suttas and Vinaya in Pali, Russian, English and Thai">
<link rel="icon" type="image/png" href="./assets/favico-noglass.png" />

<script src="/assets/js/jquery-3.6.0.js"></script>
<script src="/assets/js/jquery-ui.js"></script>
  
<!-- Font Awesome icons (free version)-->
<script src="/assets/js/fontawesome.6.1.all.js" crossorigin="anonymous"></script>
<!-- Google fonts-->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
<!-- Core theme CSS (includes Bootstrap)-->
<link rel="stylesheet" href="/assets/css/jquery-ui.css">
<link href="/assets/css/styles.css" rel="stylesheet" />
<link href="/assets/css/extrastyles.css" rel="stylesheet" />
 
<script src="/assets/js/autopali.js"></script>

<style>
</style>

</head>
    <body id="page-top"> 
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase" id="mainNav">
            <a class="navbar-brand mobile-center" href="/"> <div class="container"><img src="./assets/dhammafindlogo.png"  style="width:100px;"></a>
                <a class="navbar-brand mobile-none" href="/">find.dhamma.gift</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
      <!-- <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="/">Main</a></li> -->
            
<li class="nav-item mb-3 mx-lg-2"><a class="nav-link py-3 px-0 px-lg-0 rounded" href="https://find.dhamma.gift/sc/">SC Light</a></li>
<li class="nav-item mb-3 mx-lg-2"><a class="nav-link py-3 px-0 px-lg-0 rounded" href="/history.php">Search History</a></li>
<li class="nav-item mb-3 mx-lg-2"><a class="nav-link py-3 px-0 px-lg-0 rounded" href="#help">How to</a></li>
<li class="nav-item mb-3 mx-lg-2"><a class="nav-link py-3 px-0 px-lg-0 rounded" href="#project">About</a></li>             
<li class="nav-item mb-3 mx-lg-2"><a class="nav-link py-3 px-0 px-lg-0 rounded" href="#links">Useful Links </a></li>
<li class="nav-item mb-3 mx-lg-2"><a class="nav-link py-3 px-0 px-lg-0 rounded" href="#contacts">Contacts</a></li>
<li class="nav-item mb-0 mx-lg-2"><p><a class="py-1 px-0 px-lg-1 rounded link-light" href="/">En</a> 
									<a class="link-light text-decoration-none py-1 px-0 px-lg-1 rounded" href="/ru/">Ru</a></p></li>		
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column mb-4">
                        

                <!-- Masthead Avatar Image-->
            <!--    <img class="masthead-avatar mb-5" src="assets/img/avataaars.svg" alt="..." />-->
                <!-- Masthead Heading-->
                
    <h1 class="masthead-heading">
        <a data-bs-toggle="tooltip" data-bs-placement="top" title="In Pāḷi, English, Russian & ไทย">  
        
Search for Truth
 </a>
  </h1>
  
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                        <div class="lock example divider-custom-icon">
                                        <i class="fa-solid fa-dharmachakra example icon-unlock" ></i>
 <i class="fa-solid fa-circle icon-lock bigger"></i>
                      </div>
                    <div class="divider-custom-line"></div>
                </div>
    
			<form method="GET" action=
			"<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>"	action="" class="justify-content-center">  

		<div class="mb-3 form-group input-group ui-widget dropup rounded-pill">
		<label class="sr-only dropup rounded-pill" for="paliauto"></label>
			
			 <input name="q" style="z-index:9" type="search" class="form-control rounded-pill" id="paliauto" placeholder="e.g. <?php $words = Array("Kāyagat","Seyyathāpi","Samudd","Cūḷanik", "elephant", "ocean");
echo $words[array_rand($words)]; ?> or <?php $suttas = Array("Sn56.11","Dn22","Sn12.2", "An4.163");
echo $suttas[array_rand($suttas)]; ?>" autofocus>

		<div class="input-group-append"><button onclick="document.getElementById( 'spinner' ).style.display = 'block'" type="submit" name="submit" value="search" id="searchbtn" class="btn btn-primary mainbutton ms-1 me-1 rounded-pill "><i class="fas fa-search"></i></button></div>
		</div>

<script>
var input = document.getElementById("paliauto");
input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
    document.getElementById("searchbtn").click();
  }
});

</script>
<script>
$(document).ready(function(){
    $('[data-bs-toggle="tooltip"]').tooltip();   
});
</script>

<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="p" <?php if (isset($p) && $p=="Pali") echo "checked";?> value="">
   <a data-bs-toggle="tooltip" data-bs-placement="top" title="Default search. In Suttas of Anguttara Nikaya (an), Samyutta Nikaya (sn), Majjhimma Nikaya (mn), Digha Nikaya (dn)">Pāḷi</a>
  
  </div>

  
   <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="p" <?php if (isset($extra) && $extra=="-def ") echo "checked";?> value="-def ">
   <a data-bs-toggle="tooltip" data-bs-placement="top" title="Search for definitions in 4 main Nikayas in Pali. What is it, how many and what types, metaphors. Works only if definition was given in standard phrases. For all-round view studing all related Suttas is recommended.">Def</a>
  </div>
  
      <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="p" <?php if (isset($extra) && $extra=="-kn ") echo "checked";?> value="-kn ">
   <a data-bs-toggle="tooltip" data-bs-placement="top" title="+ search in Pali Khuddaka Nikaya: dhp, iti, ud, snp, thag, thig">+KN</a>
  </div>
  
  <div class="form-check form-check-inline">
  <input class="form-check-input"  type="radio" name="p" <?php if (isset($extra) && $p=="-vin") echo "checked";?> value="-vin ">
    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Search in Pali Vinaya">Vin</a></div>
    
  <!-- extra options -->
  <a class="text-white form-check-inline" data-bs-toggle="collapse" href="#collapseSettings" role="button" aria-expanded="false" aria-controls="collapseSettings"><i class="fa-solid fa-gear"></i></a>
<div class="collapse mt-2" id="collapseSettings">
  <div class="float-start">


  
    <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="p" <?php if (isset($extra) && $extra=="-kn ") echo "checked";?> value="-all ">
   <a data-bs-toggle="tooltip" data-bs-placement="top" title="+ search in Pali in all books of kn including later texts">+Later</a>
  </div>

  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="p" <?php if (isset($p) && $p=="English") echo "checked";?> value="-en">
    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Search in an, sn, mn, dn in English">Eng</a>
  </div>

   <div class="form-check form-check-inline">
  <input class="form-check-input"  type="radio" name="p" <?php if (isset($p) && $p=="-th ") echo "checked";?> value="-th">
    <a data-bs-toggle="tooltip" data-bs-placement="top" title="(optional) Search in an, sn, mn, dn in Thai">ไทย</a>
   </div>   
     <div class="form-check form-check-inline">
  <input class="form-check-input"  type="radio" name="p" <?php if (isset($p) && $p=="-ru ") echo "checked";?> value="-ru">
   <a data-bs-toggle="tooltip" data-bs-placement="top" title="(optional) Search in an, sn, mn, dn in Russain">Rus</a>
    
    
    
  </div>
</div>

</div>
  <!-- extra options end -->
</form>

<script>
const abbreviations = document.querySelectorAll("span.abbr");

abbreviations.forEach(book => {
  book.addEventListener("click", e => {
    citation.value = e.target.innerHTML;
    // form.input.setSelectionRange(10, 10);
    citation.focus();
  });
});

</script>

<?php

$arg = $p . ' ' . $q;
?>
 </div>
      </div>	
            <div id="spinner" class="justify-content-center mb-3">
              <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
              </div>
		<?php

/* single search no radiobuttons */
if (preg_match('/[А-Яа-яЁё]/u', $string) && ( $p != "-ru" )) {
$p = "-ru";
}

if (preg_match('/\p{Thai}/u', $string) && ( $p != "-th" )) {
$p = "-th";
}

			$output = shell_exec("nice -19 ./scripts/finddhamma.sh $extra $p $string"); 
			echo "<p>$output</p>";
		
			if (( $p == "" ) && ( preg_match('/ not in /', $output)  )) {
			$output = shell_exec("nice -19 ./scripts/finddhamma.sh -en $extra $p $string"); 
			echo "<p>$output</p>";
			}
			
		$check = ru2lat( $output );	
			
			if (( $p == "" ) && ( preg_match('/-net-v-/', $check)  )){
			  
			$output = shell_exec("nice -19 ./scripts/finddhamma.sh -en $extra $p $string");
			echo "<p>$output</p>";
			}	
			
			echo "<script>document.getElementById( 'spinner' ).style.display = 'none';</script>"
		?>	
        </header>
	
        <!-- Portfolio Section-->
        <section class="page-section portfolio" id="help">
            <div class="container text-center">

   	<div class="d-md-inline-block">	

<a class="text-decoration-none mx-1" href="./sc/">
<figure class="figure text-decoration-none">
  <i style="font-size: 2em; color: #1EBC9C;" class="fa-solid fa-book-bookmark"></i>
  <figcaption class="figure-caption text-center">Pāḷi-Eng</figcaption>
</figure>
</a>

<a class="dropdown text-decoration-none mx-1 d-md-inline-block" id="dropdownMenuEng" data-bs-toggle="dropdown" aria-expanded="false" href="#">
<figure class="figure d-md-inline-block">
  <i style="font-size: 2em; color: #1EBC9C;" class="fa-solid fa-book d-md-inline-block"></i>
<figcaption class="figure-caption text-center">External</figcaption>   
</figure>	  
</a>

  <ul class="dropdown-menu" aria-labelledby="dropdownMenuEng">

   <li><a class="dropdown-item" target="_blank" href="https://Wisdomlib.org">Wisdomlib.org</a></li>
       <li><a class="dropdown-item" target="_blank" href="http://dictionary.tamilcube.com/pali-dictionary.aspx">Eng-Pali Dictionary</a></li>
    <li><a class="dropdown-item" target="_blank" href="https://suttacentral.net">Suttacentral.net</a></li>
   <li><a class="dropdown-item" target="_blank" href="https://obo.genaud.net/dhamma-vinaya/bd/dhamma-vinaya.htm">Translations by M. Olds</a></li>
    <li><a class="dropdown-item" target="_blank" href="https://voice.suttacentral.net">SC.net Voice</a></li>
    <li><a class="dropdown-item" target="_blank" href="https://www.digitalpalireader.online/_dprhtml/index.html">Digital Pali Reader</a></li>
    <li><a class="dropdown-item" target="_blank" href="https://Tipitaka.org">Tipitaka.org</a></li>
    <li><a class="dropdown-item" target="_blank" href="https://en.dhammadana.org/sangha/dhutanga.htm">Asceticism in Dhamma</a></li>
    <li><a class="dropdown-item" target="_blank" href="https://suttacentral.net/pitaka/vinaya/pli-tv-vi">Sc.net Vinaya</a></li>    
     <li><a class="dropdown-item" target="_blank" href="https://www.accesstoinsight.org/tipitaka/vin/sv/index.html">Accesstoinsight.org patimokkha</a></li>
  </ul>


<a class="text-decoration-none mx-1" href="/diff/?lang=pl">
<figure class="figure">
  
  <i style="font-size: 2em; color: #1EBC9C;" class="fa-solid fa-code-compare"></i>
<figcaption class="figure-caption text-center">Sutta Diff</figcaption>   
</figure>	  
</a>
<a class="text-decoration-none mx-1" href="/history.php">
<figure class="figure">
  <i style="font-size: 2em; color: #1EBC9C;" class="fa-solid fa-clock-rotate-left"></i>
<figcaption class="figure-caption text-center">History</figcaption>   
</figure>	  
</a>


<a class="dropdown text-decoration-none mx-1 d-md-inline-block" id="dropdownMenuEng" data-bs-toggle="dropdown" aria-expanded="false" href="#">
<figure class="figure d-md-inline-block">
  <i style="font-size: 2em; color: #1EBC9C;" class="fa-solid fa-link"></i>
<figcaption class="figure-caption text-center">Useful Links</figcaption> 
</figure>	  
</a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuEng">
    <li><a class="dropdown-item" href="https://play.google.com/store/apps/details?id=cn.mdict">mDict Android</a></li>
    <li><a class="dropdown-item" href="https://apps.apple.com/app/mdict/id389083586">mDict IOS</a></li>   
 <li><a class="dropdown-item" href="https://github.com/digitalpalidictionary/digitalpalidictionary/releases">Pali for mDict</a></li>  
   <li><a class="dropdown-item" href="#research">Research</a></li>
       <li><a class="dropdown-item" href="#read">Read</a></li>
    <li><a class="dropdown-item" href="#study">Study</a></li>
  </ul>
  
       
<a class="dropdown text-decoration-none mx-1 d-md-inline-block" id="dropdownMenuEng" data-bs-toggle="dropdown" aria-expanded="false" href="#">
<figure class="figure d-md-inline-block">
  <i style="font-size: 2em; color: #1EBC9C;" class="fa-brands fa-google"></i>
<figcaption class="figure-caption text-center">CSE</figcaption>   
</figure>	  
</a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuEng">
   <li>
      <script async src="https://cse.google.com/cse.js?cx=c184c71e0fe5d4c93"></script>
<div class="gcse-searchbox-only" data-newWindow="true" data-resultsUrl="/cse.php"></div>   
     </li>
</ul>


<a class="dropdown text-decoration-none mx-1 d-md-inline-block" id="dropdownMenuEng" data-bs-toggle="dropdown" aria-expanded="false" href="#">
<figure class="figure d-md-inline-block">
  <i style="font-size: 2em; color: #1EBC9C;" class="fa-solid fa-graduation-cap"></i>
<figcaption class="figure-caption text-center">Materials</figcaption>   
</figure>	  
</a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuEng">
   <li><a class="dropdown-item" href="https://drive.google.com/file/d/1HVRK6yTMT59uHCCvTdQukRy7fmHNntOr/view?usp=sharing">Cases</a></li>
       <li><a class="dropdown-item" href="https://drive.google.com/file/d/1HzPCYsVBEkWErAk6TqSWRYKseM1hqMCb/view?usp=sharing">Conjugations</a></li>
    <li><a class="dropdown-item" href="https://drive.google.com/drive/folders/1nrNtb_4s27nJGq61tpigf_b2sO_KOnVG">Other Materials</a></li>
</ul>

</div> 

				<h4 class="page-section-heading text-center mb-4">How-To Video</h4>
		
			<div class="embed-container mb-5"> 
                   <iframe src="https://www.youtube.com/embed/Q_SLMrg6L1k?modestbranding=1&hl=en-US" title="How to search in Pali Suttas and Vinaya with find.dhamma.gift" frameborder="0" allowfullscreen></iframe>
							                    		</div>
			
        <div class="font-italic"> 
        <p class="lead mb-5 font-italic text-center ">
          All-round view on Four Noble Truths<br>
        in Pali Suttas and Vinaya.<br>
        Understand the real meaning <br>
        of Four Noble Truths<br>
        and end up with pain.

                        </p></div> 
         
              <div class="container alert alert-warning float-start text-left mb-3" role="alert">
 <i class="fa-solid fa-triangle-exclamation "></i> <b>Warning about translations!</b><br><br> Translations did not come from Buddha! Be scrutinizing and critical reading them. The most important fundamentals of Buddhas Teaching are better to be learned<strong> on one's own from Suttas</strong> in Pali. The minimum is: Middle Practice and Four Noble Truths. E.g. few paragraphs from <a target="_blank" href="https://docs.google.com/document/d/1-ZY2G7dVq48EG8VPZIrItE6ShfqWgV5U9qDcb7VrelU/edit?usp=drivesdk" class="alert-link">Sn56.11</a>.
</div>

         
               <h2 class="page-section-heading text-center text-uppercase text-secondary mb-3">Examples</h2>  
              <div class="container mb-5">
              <ol class="col-lg-8 col-md-10 ms-auto text-start">
			  
                   <!-- <li>All <a href="./history.php">previous searches</a></li> -->
           <li>Definition of the <a href="/assets/demo/kata.dukkhaṁ-question_suttanta_pali.html">dukkha</a> in Pali with quotes in English. Query is: <a href="/assets/demo/kata.dukkhaṁ-question_suttanta_pali.html">Kata.*dukkhaṁ\\?</a></li>

 <li>Sutta where Buddha says that he doesn't make <a href="/assets/demo/dvayagaaminii_suttanta_pali_1-1.html">ambiguous (dvayagāminī) statements</a> in Pali with English quote</li>

             <li>All variants of the word <a href="https://find.dhamma.gift/assets/demo/pat.iccasamupp_suttanta_pali_words_36-115-16.html">paṭiccasamuppado</a> in Pali with quotes in English</li>
            
                <li>All suttas about <a href="https://find.dhamma.gift/assets/demo/eightfold_suttanta_en.html">Eightfold</a> Path in English</li>
                <li>All suttas that took place or related to <a href="https://find.dhamma.gift/assets/demo/%E0%B8%AA%E0%B8%B2%E0%B8%A7%E0%B8%B1%E0%B8%95%E0%B8%96%E0%B8%B5_suttanta_th.html">Savathi</a> in Thai</li>
                <li>All suttas where <a href="https://find.dhamma.gift/assets/demo/sariputt_suttanta_ru_176-1082.html">Sariputta</a> was mentioned in Russian</li>
    
             <li>All suttas about or containing the word <a href="https://find.dhamma.gift/assets/demo/ocean_suttanta_en_91-274.html">ocean</a> in English</li>
                 <li>All Suttas with <a href=./assets/demo/seyyathaapi-adhivacan-uupama-opama_suttanta_pali_627-2101.html>metaphors & similies</a> in Pali and English</li>   
              </ol>    
</div>         
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">How to Search</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                        <div class="lock example divider-custom-icon">
                                        <i class="fa-solid fa-dharmachakra example icon-unlock" ></i>
 <i class="fa-solid fa-circle icon-lock bigger"></i>
                      </div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Grid Items-->
                <div class="row justify-content-center">		 
                  		 
         <h4 class="page-section-heading text-center mb-4">Detailed Video</h4>
                    <div class="col-md-6 col-lg-4 mb-0">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal6">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/awakening.jpg" alt="..." />
							
                        </div>
		<!-- text here --> <p class="mb-4">
		</p>
				
                    </div>
            
			<h4 class="page-section-heading text-center mb-4">Tips & Tricks</h4>
                    <div class="col-md-6 col-lg-4 mb-0">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal5">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/dhammawheelgreen.jpg" alt="..." />
							
                        </div>
			
				                    		<!-- text here --> <p class="mb-4">
		</p>

				
                    </div>

<h4 class="page-section-heading text-center mb-4">Advanced</h4>
                    <div class="col-md-6 col-lg-4 mb-0">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal4">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/sangha.jpg" alt="..." />
							
                        </div>
			
				                    		<!-- text here --> <p class="mb-4">
		</p>

				
                    </div>


                </div>
            </div>
        </section>
        <!-- About Section-->
        <section class="page-section bg-primary text-white mb-0" id="project">
            <div class="container">
                <!-- About Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-white">About Project</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                        <div class="lock example divider-custom-icon">
                                        <i class="fa-solid fa-dharmachakra example icon-unlock" ></i>
 <i class="fa-solid fa-circle icon-lock bigger"></i>
                      </div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- About Section Content-->
                <div class="row">
                    <div class="col-lg-4 ms-auto"><p class="lead">Find.Dhamma.Gift is a Liberation Search Engine, it's a search tool based on SuttaCentral.net and Theravada.ru materials. You can search in Pali, Russian, Thai and English for meanings, definitions, metaphors, explanations, people, locations etc. described in Suttas and Vinaya.
                    </p></div>
                    <div class="col-lg-4 me-auto"><p class="lead">Dhamma Enthusiasts, Developers and Contributors are warmly welcome, because project has great potential to find the real meaning of the texts. But! I'm not a developer and its just a bash script with php wrapper😊</p></div>
                    
                </div>
                <!-- About Section Button-->
                <div class="text-center mt-4">
                    <a class="btn btn-xl btn-outline-light" target="_blank" href="https://github.com/o28o/find-dhamma">
                
                   <i class="fa-brands fa-github"></i>     Project on GitHub
                    </a>
                </div>
            </div>
        </section>
  
        <!-- Footer-->
        <footer id="links" class="footer text-center ">
               <h2 class="page-section-heading text-center text-uppercase text-white mb-5">Recommended Links</h2>
			   
            <div class="container">
                <div  class="row">
                   <!-- Footer Location-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
          

                        <h4 id="research" class="text-uppercase mb-4">Research</h4>
               
                <div class="list-group">

  <a href="#page-top" style="z-index:1" class="list-group-item list-group-item-action active">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">find.dhamma.gift</h5>
      <small class="text-muted">online</small>
    </div>
    <p class="mb-1">All encompassing search within all Suttas and Vinaya.</p>
    <small class="text-muted"></small>
  </a>
  

    <a href="/cse.php" target="_blank" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Google from dhamma.gift</h5>
      <small class="text-muted">онлайн</small>
    </div>
    <p class="mb-1">
      Search with Google within recommended resources
    </p>
    <small class="text-muted">Especially convenient for Wisdomlib</small>
  </a>
  
        <a target="_blank" href="https://digitalpalidictionary.github.io/" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Digital Pali Dictionary</h5>
      <small class="text-muted">app</small>
    </div>
    <p class="mb-1">The biggest and quickest dictionary and pali grammar.</p>
    <small class="text-muted">Available for PC, Mac, Android, IOS</small>
  </a>

    <a target="_blank" href="https://dsal.uchicago.edu/dictionaries/pali/" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Pali Text Society Dictionary</h5>
      <small class="text-muted">online</small>
    </div>
    <p class="mb-1">One of the most famous Pali English dictionaries</p>
    <small class="text-muted"></small>
  </a>


    <a target="_blank" href="https://www.wisdomlib.org/" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Wisdomlib.org</h5>
      <small class="text-muted">online</small>
    </div>
    <p class="mb-1">Excellent online collection of dictionaries. Not only Pali, but multiple spiritual traditions of India</p>
    <small class="text-muted">Very helpful for difficult terms.</small>
  </a>
  
      <a target="_blank" href="http://dictionary.tamilcube.com/pali-dictionary.aspx" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">TamilCube.com</h5>
      <small class="text-muted">online</small>
    </div>
    <p class="mb-1">Simple Online English-Pali Dictionary</p>
    <small class="text-muted"></small>
  </a>

    <a target="_blank"  href="
  https://drive.google.com/drive/folders/1bdkm-g_ReZi5QEior_gNTok8r4flAfa3?usp=sharing" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">All Pali words from Suttanta (except KN) & Vinaya</h5>
      <small class="text-muted">offline</small>
    </div>
    <p class="mb-1">In alphabetical order with count number</p>
    <small class="text-muted"></small>
  </a>


</div>  



                  
                        <p class="lead mb-0"> 
      
	  


                        </p>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 id="read" class="text-uppercase mb-4">Read</h4>
                       
 <div class="list-group">


  <a target="_blank" href="https://Suttacentral.net" class="list-group-item list-group-item-action" aria-current="true">
    <div class="d-flex w-100 justify-content-between text-left">
      <h5 class="mb-1">Suttacentral.net</h5>
      <small>online & offline</small>
    </div>
    <p class="mb-1 text-left">The most complete line-by-line Pali-English collection</p>
    <small>Pali-English dictionary can be turned on in settings</small>
  </a>
  
    <a target="_blank"   href="https://www.digitalpalireader.online/" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Digital Pali Reader</h5>
      <small class="text-muted">online & offline</small>
    </div>
    <p class="mb-1">Very profound online tool for Pali researches.</p>
    <small class="text-muted">Built-in Pali-English dictionary</small>
  </a>
  
  <a target="_blank"  href="https://tipitaka.theravada.su/toc/translations/1097" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Tipitaka.Theravada.su</h5>
      <small class="text-muted">online</small>
    </div>
    <p class="mb-1">Multiple translation options. Pali-English-Russian line-by-line.</p>
    <small class="text-muted">Especially recommended for studying Digha Nikaya</small>
  </a>
  
  <a href="https://www.theravada.ru/" target="_blank"   class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Theravada.ru </h5>
      <small class="text-muted">online</small>
    </div>
    <p class="mb-1">The most complete translation of Suttanta in Russian.</p>
    <small class="text-muted"></small>
  </a>
  
</div>  

				
                    </div>
					
					 <div class="col-lg-4 mb-5 mb-lg-0">
					<h4 id="study" class="text-uppercase mb-4">Study</h4>
	
	<div class="list-group">


  <a target="_blank" href="https://drive.google.com/file/d/1O_wZ_DLMbTMPnyl34Xxr9_t-Px6g8Hb0/view?usp=sharing" class="list-group-item list-group-item-action active" aria-current="true">
    <div class="d-flex w-100 justify-content-between text-left ">
      <h5 class="mb-1">New Pali Course</h5>
      <small>textbook</small>
    </div>
    <p class="mb-1 text-left">Highly recommended</p>
    <small></small>
  </a>

    <a target="_blank"   href="https://drive.google.com/file/d/1HVRK6yTMT59uHCCvTdQukRy7fmHNntOr/view?usp=sharing" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Pali cases</h5>
      <small class="text-muted">table</small>
    </div>
    <p class="mb-1">Cases are mistranslated pretty often.</p>
    <small class="text-muted">Check Pali original</small>
  </a>

  <a target="_blank" href="https://drive.google.com/file/d/1HzPCYsVBEkWErAk6TqSWRYKseM1hqMCb/view?usp=sharing" class="list-group-item list-group-item-action" aria-current="true">
    <div class="d-flex w-100 justify-content-between text-left">
      <h5 class="mb-1">Pali verb conjugation</h5>
      <small>table</small>
    </div>
    <p class="mb-1 text-left">Conjugations sometimes mistranslated.</p>
    <small>Check Pali original</small>
  </a>
  

  <a target="_blank"  href="
  https://drive.google.com/drive/u/1/folders/1UU-y5idRNpfcVTripRUtyTVcOgdwjMGN" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Materials for studying Pali in English and Russian</h5>
      <small class="text-muted">offline</small>
    </div>
    <p class="mb-1">Collection of textbooks and tables</p>
    <small class="text-muted"></small>
  </a>
  
</div>  
</div>
                    <!-- Footer About Text-->
                    <div id="contacts" class="col-lg-0 text-center">
                        <h4 class="text-uppercase mt-5 mb-4">Contacts</h4>
						
                        <p class="lead mb-4">
                            Find the Noble Eightfold Path.<br>
							Understand the Four Noble Truths.<br>Dhamma - is Actuality.
                      
                        </p>
							   <a  target="_blank"  class="btn btn-outline-light btn-social mx-1" href="https://github.com/o28o/find-dhamma#readme"><i class="fa-brands fa-github"></i></a>
                        <a  target="_blank"  class="btn btn-outline-light btn-social mx-1" href="mailto:o@dhamma.gift"><i class="fa-solid fa-at"></i></a>
												<a href="https://m.youtube.com/channel/UCoyL5T0wMubqrj4OnKVOlMw" class="btn btn-outline-light btn-social mx-1" title="YouTube" target="_blank" rel="nofollow"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><a target="_blank" rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Лицензия Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a> <small>Copyright &copy; Dhamma.gift 2022</small></div>
        </div>
        <!-- Portfolio Modals-->
     
        <!-- Portfolio Modal 4-->
        <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" aria-labelledby="portfolioModal4" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Advanced</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fa-solid fa-dharmachakra"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/sangha.jpg" alt="..." /> -->
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">	
									<strong>Tip #1</strong><br>
								   If you want to find some word in particular sutta, samyutta or nikaya run search like this: Sn17.*seyyathāpi
								  <br>This example will search for all similies and metaphors in all Sn17.<br><br>
								  <strong>Tip #2</strong><br>
								   To add variations you may add [], e.g. nand[iī] this will search for both nandi and nandī matches.
								 <br><br>
								  
									<strong>Tip #3</strong><br>
								   If you want to find words beginning or ending from some pattern use \\b before and/or in the end of the pattern. e.g. <strong>\\bkummo\\b</strong> will search for only kummo and will skip kummova and any other<br><br>
									<strong>Tip #4</strong><br>
								   You may use regexes that are applicable in GNU grep -E statements. With proper escaping (\\) they should work.<br><br>
								</p>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Close Window
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 5-->
        <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" aria-labelledby="portfolioModal5" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Tips & Tricks</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fa-solid fa-dharmachakra"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/dhammawheel.jpg" alt="..." /> -->
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4"><strong>Tip #0</strong><br>
										If you search in Pali you don't need to check it in options. Pali is default.<br><br>
									 <strong>Tip #1</strong><br>
                                    Use special characters ā ī ū ḍ ṁ ṁ ṇ ṅ ñ ṭ<br><br>
                                   
								   <strong>Tip #2 Khuddaka NIkaya</strong><br>
									 Search is performed in All DN, MN, SN, AN. use <strong>-kn</strong> option if you also want to include results from the following books of KN: Dhammapada, Udāna, Itivuttaka, Suttanipāta, Theragāthā, Therīgāthā. Other books of KN will not be used in the search even with option. You may use alternative services to make searches in Jatakas and other book of KN.<br>
									 Example #1: -kn jamm
									 <br>Will search in DN, MN, SN, AN + books of KN listed above
									 <br>
									 Example #2: jamm
									 <br>Will search in DN, MN, SN, AN only.
									 <br><br>
									 
									 <strong>Tip #3 Vinaya</strong><br> 
                                   if you're willing to search in Vinaya add -vin to your search request. For pali vinaya search for cetana the line will look like: -vin cetana <br><br>

									 <strong>Tip #4 Stem</strong><br>
                                    Use stem of the word for broader results with or without prefixes or endings. 
									<br><br>
									          <strong>Tip #5</strong><br>
                                    Prefer Pali to other languages. Pali is the language in which the oldest Dhamma related texts are written.	
									<br><br>
									<strong>Tip #6</strong><br>
									For Pali search results you have two options: results sorted by Suttas/Texts with quotes and by words. Use both to get some extra details.<br><br>
                                   <strong>Tip #7</strong><br>Minimal length of search pattern is 3 symbols. But if possible search for longer patterns. Then you will get more precise results.<br><br>
                                   
								 
									<strong>Tip #8</strong><br> 
                                   We highly recommend to search in Pali. As it will give the best results, and you will develop a very important habit to look into Pali and do not rely blindly on the translations. But obviously you can get some benefits from searches in translations. If you are looking for animals, plants, etc. There are at least 4 different pali words for a snake but in Russian or English - it's just "a snake" or "a viper". <br><br>
				
									<strong>Tip #9</strong><br>
                                   if your request fails due to timeout try longer search pattern.  <br><br>
								   <strong>Tip #10</strong><br>
                                   if your request fails due to timeout, and you can't use longer search pattern try <a href="./bg.php">Background Mode</a>. It might work.
								   <br><br> 
								   
                                   
									
									</p>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Close Window
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 6-->
        <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" aria-labelledby="portfolioModal6" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Demo Video</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fa-solid fa-dharmachakra"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/submarine.png" alt="..." /> -->
									<!-- Portfolio Modal - Text-->
									  <div class="embed-container"> 
                                        <iframe src="https://www.youtube.com/embed/Q_SLMrg6L1k?modestbranding=1&hl=en-US" title="How to search in Pali Suttas and Vinaya with find.dhamma.gift" frameborder="0" allowfullscreen></iframe>
							                    		</div>
									                          <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Close Window
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script type="text/javascript" src="/assets/js/bootstrap.bundle.5.13.min.js"></script>
        <!-- Core theme JS
        <script src="js/scripts.js"></script>-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
         <script>
const tasks = ["The 1st is Sn56.11", "Read sn22.87", "Ponder on mn28", "Dukkha in Suttas is?", "How many Jhanas in Suttas?",  "Real meaning of Pañña is?", "Dukkha is defined in dn22", "Saṅkhārā in mn44", "Why Tathagata is like ocean?", "Why Dhamma is like Ocean?", "Why Tathagata is like elephant?", "What is the ocean?", "What is the all?"];

const random = Math.floor(Math.random() * tasks.length);
console.log(random, tasks[random]);
let defaultTitle = document.title
window.onblur = () => {
   //change title, blink title, whatever
   document.title = tasks[random]
}
window.onfocus = () => {
   //back to default title
   document.title = defaultTitle
}
</script>  
    </body>
</html>
