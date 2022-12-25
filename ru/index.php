<!DOCTYPE html>
<html language="ru">
    <head>
      <meta charset="UTF-8">

<title>find.Dhamma.gift</title>
<meta http-equiv="Cache-control" content="public">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="Поисковый Сайт Освобождения. Поиск в Пали Суттах и Винае" />
<meta name="author" content="" />
        <!-- Favicon-->
		<!-- Font Awesome icons (free version)-->
<script src="/assets/js/fontawesome.6.1.all.js" crossorigin="anonymous"></script>

<meta property="og:locale" content="ru_RU" />
<meta property="og:type" content="article" />
<meta property="og:title" content="find.Dhamma.gift" />
<meta property="og:description" content="Поисковая Система Освобождения. Находите определения и информацию в Суттах и Винае на Пали, Русском, Английском и Тайском" />
<meta property="og:url" content="https://find.dhamma.gift/" />
<meta property="og:site_name" content="find.Dhamma.gift" />
<meta property="og:image" itemprop="image" content="https://find.dhamma.gift/assets/social_sharing_gift_rus.jpg" />
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Поисковая Система Освобобждения">
<meta name="twitter:description" content="Находите информацию в Суттах и Винае на Пали, Русском, Английском и Тайском">
<link rel="icon" type="image/png" href="/assets/favico-noglass.png" />
 
<script src="/assets/js/jquery-3.6.0.js"></script>
<script src="/assets/js/jquery-ui.js"></script>
  

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
		?>
 
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase" id="mainNav">
            <a class="navbar-brand mobile-center" href="/ru/"> <div class="container"><img src="./assets/dhammafindlogo.png"  style="width:100px;"></a>
                <a class="navbar-brand mobile-none" href="/ru/">find.dhamma.gift</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Меню
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
      <!-- <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="/">Main</a></li> 
	  nav-link -->
	  
	  
<li class="nav-item mb-3 mx-lg-2"><a class="nav-link px-0 px-lg-0 rounded" href="./sc/">SC Лайт</a></li>
<li class="nav-item mb-3 mx-lg-2"><a class="nav-link px-0 px-lg-0 rounded" href="/history.php">История Поиска</a></li>
<li class="nav-item mb-3 mx-lg-2"><a class="nav-link px-0 px-lg-0 rounded" href="#help">Помощь</a></li>
<li class="nav-item mb-3 mx-lg-2"><a class="nav-link py-3 px-0 px-lg-0 rounded" href="#project">О Нас</a></li>             
<li class="nav-item mb-3 mx-lg-2"><a class="nav-link py-3 px-0 px-lg-0 rounded" href="#links">Полезное</a></li>
<li class="nav-item mb-3 mx-lg-2"><a class="nav-link py-3 px-0 px-lg-0 rounded" href="#contacts">Контакты</a></li>
<li class="nav-item mb-0 mx-lg-2"><p><a class="py-3 px-0 px-lg-1 rounded link-light text-decoration-none" href="/">En</a> 
		<a class="py-3 px-0 px-lg-1 rounded link-light" href="/ru/">Ru</a></p></li>	
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
                <h1 class="masthead-heading">Найдите Истину</h1>
                <!-- <h5 class="mr=5">Pāḷi, Русский, ไทย и English</h5> -->
				
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon">
                  
                      <i class="fa-solid fa-dharmachakra"></i>
                      </div>
                    <div class="divider-custom-line"></div>
                </div>
    
			<form method="GET" action=
			"<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>"	action="" class="justify-content-center">  

  	<div class="mb-3 form-group input-group ui-widget">
		<label class="sr-only" for="paliauto"></label>
			
			 <input style="z-index:9" name="q" type="search" class="form-control rounded-pill searchbar" id="paliauto" placeholder="прим. <?php $words = Array("Kāyagat","Seyyathāpi","Samudd","Cūḷanik", "Suññat", "Mūsik", "Vicchiko", "Hatthī");
echo $words[array_rand($words)]; ?> или <?php $suttas = Array("Sn56.11","Dn22s","Sn12.2", "An4.163");
echo $suttas[array_rand($suttas)]; ?>" autofocus>
			 
				<div class="input-group-append">
				  <button onclick="document.getElementById( 'spinner' ).style.display = 'block'" type="submit" name="submit" value="search" id="searchbtn" class="btn btn-primary mainbutton ms-1 me-1 rounded-pill"><i class="fas fa-search"></i></button>
				</div>
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

  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="p" <?php if (isset($p) && $p=="-pli") echo "checked";?> value="-pli">
  <a data-bs-toggle="tooltip" data-bs-placement="top" title="Поиск по Суттам Ангутара Никаи (an), Саньютта Никаи (sn), Маджжхима Никаи (mn), Дигха Никаи (dn) + Удана (ud) из Кхуддака Никаи (kn)">Pāḷi</a>
  </div>
  <div class="form-check form-check-inline">
  <input class="form-check-input"  type="radio" name="p" <?php if (isset($p) && $p=="-ru ") echo "checked";?> value="-ru">
  <a data-bs-toggle="tooltip" data-bs-placement="top" title="Поиск по русским переводам АН, СН, МН, ДН с SuttaCentral.net">Рус</a>
  </div>
  
    <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="p" <?php if (isset($extra) && $extra=="-def ") echo "checked";?> value="-def">
  <a data-bs-toggle="tooltip" data-bs-placement="top" title="Поиск определений понятия на Пали в 4 Никаях. Что это, какие виды бывают, какими метафорами описывается. Работает только для стандартных фраз!">Опр</a>
  </div>

  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="p" <?php if (isset($p) && $p=="English") echo "checked";?> value="-en">
  <a data-bs-toggle="tooltip" data-bs-placement="top" title="Поиск по англ. переводам АН, СН, МН, ДН с SuttaCentral.net">Eng</a>
  </div>
  
    <!-- extra options -->
  <a class="text-white form-check-inline" data-bs-toggle="collapse" href="#collapseSettings" role="button" aria-expanded="false" aria-controls="collapseSettings"><i class="fa-solid fa-gear"></i>
  </a>
<div class="collapse mt-2 " id="collapseSettings">
  <div class="float-start">


<script>
$(document).ready(function(){
    $('[data-bs-toggle="tooltip"]').tooltip();   
});
</script>
    <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="p" <?php if (isset($extra) && $extra=="-kn ") echo "checked";?> value="-kn " >
  <a data-bs-toggle="tooltip" data-bs-placement="top" title="+ поиск на Пали в 6 книгах Кхуддака Никаи: Удана, Дхаммапада, Итивутака, Суттанипата, Тхерагатха, Тхеригатха">+КН</a>
  </div>
  
  <div class="form-check form-check-inline">
  <input class="form-check-input"  type="radio" name="p" <?php if (isset($extra) && $p=="-vin") echo "checked";?> value="-vin ">
  
  <a data-bs-toggle="tooltip" data-bs-placement="top" title="Поиск в Винае на Пали">Вин</a>
  </div>
    <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="p" <?php if (isset($extra) && $extra=="-kn ") echo "checked";?> value="-all ">
  <a data-bs-toggle="tooltip" data-bs-placement="top" title="+ поиск на Пали во всех книгах Кхуддака Никаи, включая поздние">+Позд</a>
  
  </div>
      <div class="form-check form-check-inline">
  <input class="form-check-input"  type="radio" name="p" <?php if (isset($p) && $p=="-th ") echo "checked";?> value="-th">
  <a data-bs-toggle="tooltip" data-bs-placement="top" title="Поиск в 4 основных Никаях на Тайском">ไทย</a>
  </div>
  
				</form>
				
				<?php
$arg = $p. ' ' . $q;
?>
 </div>
<div>	

<div id="spinner" class="justify-content-center mt-3 mb-3"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>

	<?php
	$old_path = getcwd();
			$string = str_replace ("`", "", $q);
	
/* ru with arg */ 


  if (preg_match("/^dn[0-9]{1,2}s$/i",$string)) {
    
$forthsu = preg_replace("/dn/i","","$string");
$forthsu = preg_replace("/s/i","","$forthsu");
$link = shell_exec("curl -s https://tipitaka.theravada.su/toc/translations/1098 | grep \"ДН $forthsu \" | sed 's#href=\"#href=\"https://tipitaka.theravada.su#' |awk -F'\"' '{print \$2}' | tail -n1"); 
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
$link = shell_exec("curl -s https://tipitaka.theravada.su/toc/translations/1098 | grep \"ДН $forthsu\" | sed 's#href=\"#href=\"https://tipitaka.theravada.su#' |awk -F'\"' '{print \$2}'"); 
$link = str_replace(PHP_EOL, '', $link);

}
echo '<script>window.open("' . $link . '", "_self");</script>';
  exit();
}

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

if(preg_match("/^(mn|dn)[0-9]*$/i",$string) || preg_match("/^(sn|an|ud)[0-9]{0,2}.[0-9]*$/i",$string) || preg_match("/^(sn|an|ud)[0-9]{0,2}.[0-9]{0,3}-[0-9].*$/i",$string)){
    echo "<script>window.location.href='/sc/?q=$string&lang=pli';</script>";
  exit();
}
/* ru with layout */ 
if(preg_match("/^[\x{043C}\x{041C}][\x{043D}][0-9].*$/i",$string) || preg_match("/^(сн|ан|уд)[0-9]{0,2}.[0-9]*$/i",$string) || preg_match("/^(сн|ан|уд)[0-9]{0,2}.[0-9]{0,3}-[0-9].*$/i",$string)) 
    {
  $string = str_replace("н","n","$string");
  $string = str_replace("м","m","$string");
  $string = str_replace("д","d","$string");
  $string = str_replace("с","s","$string");
  $string = str_replace("а","a","$string");
  $string = str_replace("у","u","$string");
  $string = str_replace(".","_","$string"). '-';
  $link = 'https://theravada.ru/Teaching/Canon/Suttanta/Texts/' . shell_exec("ls -R /home/a0092061/data/theravada.ru/Teaching/Canon | grep -i -m1 $string" );
 $link = str_replace(PHP_EOL, '', $link);
echo '<script>window.open("' . $link . '", "_self");</script>';
  exit();
}
			$output = shell_exec("nice -19 ./scripts/finddhamma.sh -oru $p $string"); 
			echo "<p class='mt-3'>$output</p>";
			echo "<script>document.getElementById( 'spinner' ).style.display = 'none';</script>"
		?>	
</div>		
		

<!-- <a href="./history.php" class="btn btn-primary" role="button">История Поиска</a> -->


                <!-- Masthead Subheading
                <p class="masthead-subheading font-weight-light mb-0"><a href='list.php' style="color:blue;">All Searches</a></p>
                -->
            </div>
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
<figcaption class="figure-caption text-center">Английский</figcaption>   
</figure>	  
</a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuEng">
        <li><a class="dropdown-item" href="/diff/?lang=pl">Сравнить Две Сутты</a></li>
   <li><a class="dropdown-item" target="_blank" href="https://Wisdomlib.org">Wisdomlib.org</a></li>
       <li><a class="dropdown-item" target="_blank" href="http://dictionary.tamilcube.com/pali-dictionary.aspx">Англ-Пали словарь</a></li>
    <li><a class="dropdown-item" target="_blank" href="https://suttacentral.net">Suttacentral.net</a></li>

    <li><a class="dropdown-item" target="_blank" href="https://voice.suttacentral.net">Suttacentral Voice</a></li>
    <li><a class="dropdown-item" target="_blank" href="https://www.digitalpalireader.online/_dprhtml/index.html">Digital Pali Reader</a></li>
    <li><a class="dropdown-item" target="_blank" href="https://tipitaka.org/thai/">Tipitaka.org</a></li>
        <li><a class="dropdown-item" target="_blank" href="https://en.dhammadana.org/sangha/dhutanga.htm">Благородный Аскетизм</a></li>
       <li><a class="dropdown-item" target="_blank" href="https://suttacentral.net/pitaka/vinaya/pli-tv-vi">SC.net Виная</a></li>
      <li><a class="dropdown-item" target="_blank" href="https://www.accesstoinsight.org/tipitaka/vin/sv/index.html">Accesstoinsight.org Патимоккха</a></li>
        
  </ul>
  

<a class="dropup text-decoration-none mx-1 d-md-inline-block" id="dropdownMenuRussian" data-bs-toggle="dropdown" aria-expanded="false" href="#">
<figure class="figure dropup">
  <i style="font-size: 2em; color: #1EBC9C;" class="fa-solid fa-book d-md-inline-block"></i>
<figcaption class="figure-caption text-center">Русский</figcaption>   
</figure>	  
</a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuRussian">
    <li><a class="dropdown-item" target="_blank" href="https://theravada.ru/Teaching/Canon/Suttanta/all-suttas-list.htm">Theravada.ru</a></li>
    <li><a class="dropdown-item" target="_blank" href="https://tipitaka.theravada.su/toc/translations/1097">Theravada.su</a></li>
    <li><a class="dropdown-item" target="_blank" href="https://dhamma.ru/lib/authors/thanissaro/prat.htm">Dhamma.ru Патимоккха</a></li>
  </ul>

<a class="text-decoration-none mx-1" href="/history.php">
<figure class="figure">
  <i style="font-size: 2em; color: #1EBC9C;" class="fa-solid fa-clock-rotate-left"></i>
<figcaption class="figure-caption text-center">История</figcaption>   
</figure>	  
</a>


<a class="dropdown text-decoration-none mx-1 d-md-inline-block" id="dropdownMenuEng" data-bs-toggle="dropdown" aria-expanded="false" href="#">
<figure class="figure d-md-inline-block">
  <i style="font-size: 2em; color: #1EBC9C;" class="fa-solid fa-link"></i>
<figcaption class="figure-caption text-center">Полезное</figcaption>   
</figure>	  
</a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuEng">
      <li><a class="dropdown-item" href="https://play.google.com/store/apps/details?id=cn.mdict">mDict Android</a></li>
      
      <li><a class="dropdown-item" href="https://apps.apple.com/app/mdict/id389083586">mDict IOS</a></li>      
   <li><a class="dropdown-item" href="#research">Исследование</a></li>
       <li><a class="dropdown-item" href="#read">Чтение</a></li>
    <li><a class="dropdown-item" href="#study">Учебные Материалы</a></li>
  </ul>

<a class="text-decoration-none mx-1" target="_blank" href="https://cse.google.com/cse?cx=c184c71e0fe5d4c93">
<figure class="figure">
  <i style="font-size: 2em; color: #1EBC9C;" class="fa-brands fa-google"></i>
<figcaption class="figure-caption text-center">CSE</figcaption>   
</figure>	  
</a>
  
<a class="dropdown text-decoration-none mx-1 d-md-inline-block" id="dropdownMenuEng" data-bs-toggle="dropdown" aria-expanded="false" href="#">
<figure class="figure d-md-inline-block">
  <i style="font-size: 2em; color: #1EBC9C;" class="fa-solid fa-table-list"></i>
<figcaption class="figure-caption text-center">Грамматика</figcaption>   
</figure>	  
</a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuEng">
      <li><a class="dropdown-item" href="https://drive.google.com/file/d/1HVRK6yTMT59uHCCvTdQukRy7fmHNntOr/view?usp=sharing">Падежи</a></li>
      
      <li><a class="dropdown-item" href="https://drive.google.com/file/d/1HzPCYsVBEkWErAk6TqSWRYKseM1hqMCb/view?usp=sharing">Спряжения</a></li>

   <li><a class="dropdown-item" href="https://drive.google.com/file/d/1H_mhKNgrBYevOOnax-FUBgxkfSuwHItu/view?usp=sharing">Курс по Пали</a></li>
  </ul>
  

</div> 

         <!--            	<p class="text-center">
	<a href="./history.php" class="btn btn-primary" role="button btn-lg">История Поиска</a>
	</p>
<div class="divider-custom-icon text-center">
              <i class="fa-solid fa-book fa-4x" title="Exchange"></i> <i class="fa-solid fa-list fa-4x"></i>
              </div> -->
        <div class="font-italic"> 
        
	<h4 class="page-section-heading text-center mb-4">Как пользоваться?</h4>
	        <div class="embed-container mb-5"> 
                                   <iframe src="https://www.youtube.com/embed/4KIqQYSxTSE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                    		</div>

        <p class="lead mb-5">
		Всесторонний взгляд на значения, определения,<br> метафоры, персоналии, места и любые другие детали<br>
        из Палийских Сутт и Винаи в удобных таблицах<br> для дальнейшего изучения.

                        </p>
                                                </div> 
     <div class="container alert alert-warning float-start text-left mb-3" role="alert">
 <i class="fa-solid fa-triangle-exclamation "></i> <b>Предупреждение!</b><br><br> Переводы выполнены не Буддой! Чаще всего содержат фундаментальные ошибки главных положений его Учения. Переводы нужно читать критически. <a target="_blank" href="https://docs.google.com/spreadsheets/d/1e-uFcjBzmCf08t7BUR-Ffnz3ZlSzhLNUnIWbMbvg3go" class="alert-link"> Примеры ошибок</a><br><br>
  Самое важное из слов Будды и его учеников лучше изучить <strong> самостоятельно по Суттам</strong> на Пали. В частности, что такое Серединная Практика и Четыре Благородные Истины. Это несколько абзацев, к примеру из <a target="_blank" href="https://docs.google.com/document/d/1BtzzQajyDcehIh6kRp7QrCIWD1DGUDVEFYilJ6BurPI" class="alert-link">Sn56.11</a>.
</div>

                      <h2 class="page-section-heading text-center text-uppercase text-secondary mb-3">Примеры</h2> 
<div class="container mb-5 text-start">
              <ol class="col-lg-8 col-md-10 ms-auto">
                <!-- <li>Вся <a href="./history.php">история поиска</a></li> -->
             <li>Определение понятия <a href="/assets/demo/kata.dukkhaṁ-question_suttanta_pali.html">dukkha</a> на Пали со ссылками на Русские переводы. Запрос: <a href="/assets/demo/kata.dukkhaṁ-question_suttanta_pali.html">Kata.*dukkhaṁ\\?</a>
             </li>
             
              <li>Сутта, в которой Будда говорит, что не делает <a href="/assets/demo/dvayagaaminii_suttanta_pali_1-1.html">двусмысленных (dvayagāminī) утверждений</a> на Пали со ссылками на Русский перевод</li>
           
                <li>Все сутты со словом <a href="https://find.dhamma.gift/assets/demo/vos'merichn_suttanta_ru_140-274.html">Восьмеричный</a> Благородный Путь на Русском</li>
                <li>Все сутты со словом <a href="https://find.dhamma.gift/assets/demo/nravstvennost'_suttanta_ru_94-264.html">нравственность</a> на Русском</li>
                <li>Все сутты, где упомянут <a href="https://find.dhamma.gift/assets/demo/sariputt_suttanta_ru_176-1082.html">Сарипутта</a> на Русском</li>
               <li>Все варианты словосочетания <a href="https://find.dhamma.gift/assets/demo/pat.iccasamupp_suttanta_pali_36-115.html">paṭiccasamuppado</a> на Пали со ссылками на Русские переводы</li>
               <li>Все сутты где, упоминается об <a href="https://find.dhamma.gift/assets/demo/okean_suttanta_ru_85-298.html">океане</a> на Русском</li>
               <li>Все сутты с <a href=./assets/demo/seyyathaapi-adhivacan-uupama-opama_suttanta_pali_627-2101.html>метафорами, примерами и сравнениями</a> на Пали со ссылками на Русские переводы. Запрос: "seyyathāpi|adhivacan|ūpama|opama" </li>   
              </ol>    
</div>


                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Как Искать?</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fa-solid fa-dharmachakra"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Grid Items-->
                <div class="row justify-content-center">
                  
                            <h4 class="page-section-heading text-center mb-4">Подробное Видео</h4>
                    <div class="col-md-6 col-lg-4 mb-0">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal1">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/awakening.jpg" alt="..." />
							
                        </div>
		<!-- text here --> <p class="mb-4">
		</p>
				
                    </div>             
								 
            
			<h4 class="page-section-heading text-center mb-4">Основы</h4>
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

<h4 class="page-section-heading text-center mb-4">для Продвинутых</h4>
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
                <h2 class="page-section-heading text-center text-uppercase text-white">О Проекте</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fa-solid fa-dharmachakra"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- About Section Content-->
                <div class="row">
				
                    <div class="col-lg-4 ms-auto"><p class="lead">Find.Dhamma.Gift это поисковая система Освобождения, инструмент для поиска основанный на материалах SuttaCentral.net и Theravada.ru. Вы можете искать понятия, определения, метафоры, объяснения, людей, места и другое описанное в Суттах и Винае на Пали, Русском, Тайском и Английском.
                    </p></div>
                    <div class="col-lg-4 me-auto"><p class="lead">Дхамма энтузиасты, разработчики горячо приветствуются, у проекта большой потенциал в поисках настоящего значения текстов. Но, я не разработчик и это всего лишь скрипт на Bash и PHP-обёртка😊</p></div>
                    
                </div>
                <!-- About Section Button-->
                <div class="text-center mt-4">
                    <a class="btn btn-xl btn-outline-light" target="_blank" href="https://github.com/o28o/find-dhamma">
                
                   <i class="fa-brands fa-github"></i>     Проект на GitHub
                    </a>
                </div>
            </div>
        </section>
  
        <!-- Footer-->
        <footer id="links" class="footer text-center ">
               <h2 class="page-section-heading text-center text-uppercase text-white mb-5">Полезные Ссылки</h2>
			   
            <div class="container">
                <div  class="row">
                   <!-- Footer Location-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
          

                        <h4 id="research" class="text-uppercase mb-4">Исследование</h4>
               
                <div class="list-group">

  <a href="#page-top" style="z-index:1" class="list-group-item list-group-item-action active">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">find.dhamma.gift</h5>
      <small class="text-muted">онлайн</small>
    </div>
    <p class="mb-1">Всепроникающий поиск по Суттам и Винае.</p>
    <small class="text-muted"></small>
  </a>
  
    <a href="#" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Google от dhamma.gift</h5>
      <small class="text-muted">онлайн</small>
    </div>
    <p class="mb-1">
      Google поиск по рекомендованным ресурсам
        <script async src="https://cse.google.com/cse.js?cx=c184c71e0fe5d4c93">
</script>
<div style="z-index:99999" class="gcse-search"></div>
    </p>
    <small class="text-muted">Особенно удобен для поисков на Wisdomlib</small>
  </a>

        <a target="_blank" href="https://digitalpalidictionary.github.io/" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Digital Pali Dictionary</h5>
      <small class="text-muted">приложение</small>
    </div>
    <p class="mb-1">Объёмный и самый удобный Пали-Англ словарь и грамматика Пали.</p>
    <small class="text-muted">Доступно для ПК, Mac, Android, IOS</small>
  </a>
        <a target="_blank" href="https://devamitta.github.io/pali/" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">DPD Русская Версия</h5>
      <small class="text-muted">приложение</small