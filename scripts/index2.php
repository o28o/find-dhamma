<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8">
	  
	  <meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name=" apple-mobile-web-app-title" content="Rolos Chicken">
<link rel="apple-touch-icon" sizes="57x57" href="/templates/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/templates/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/templates/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/templates/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/templates/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/templates/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/templates/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/templates/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/templates/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/templates/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/templates/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/templates/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/templates/favicon-16x16.png">
<link rel="manifest" href="/templates/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/templates/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<title>Dhamma Find - Better then Google for Suttas and Vinaya</title>

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!-- Favicon-->

<link rel="icon" type="image/png" href="https://find.dhamma.gift/templates/favico.png" />
    
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="/templates/add-to-homescreen-master/src/addtohomescreen.min.js
"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/extrastyles.css" rel="stylesheet" />
        <link href="/templates/add-to-homescreen-master/style
/addtohomescreen.css" rel="stylesheet" />

<script>
//if the website is not opened in app mode show (i.e. in a browser) the add to homescreen prompt
if
(
(("standalone" in window.navigator) && !window.navigator.standalone) // ios
( !window.matchMedia(' (display-mode: standalone) ').matches ) // android
) {
addToHomescreen();
}
</script>

    </head>
      <body id="page-top"> 
    	<?php

		// Defining variables
$nameErr = $languageErr  = "";
$pattern = $language = $arg = "";
		// Checking for a POST request
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
	if (empty($_POST["language"])) {
    $languageErr = "language is required";
  } else {
    $language = test_input($_POST["language"]);
  }
}	
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$pattern = test_input($_POST["pattern"]);
/* 		$pitaka = test_input($_POST["pitaka"]);
 */		}

		// Removing the redundant HTML characters if any exist.
		function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}
		
      if (empty($_POST["language"])) {
    $languageErr = "";
  } else {
    $language = test_input($_POST["language"]);
  }
		?>
 
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase" id="mainNav">
            <a class="navbar-brand" href="/"> <div class="container"><img src="assets/dhammafindlogo.png"  style="width:100px;"></a>
                <a class="navbar-brand" href="/#page-top">find.dhamma.gift</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
      <!-- <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="/">Main</a></li> -->
             <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="https://sc.dhamma.gift/">SC Light</a></li>
             
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="/list.php?lang=pali">Search History</a></li>
                       <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="/bg.php">Background Mode</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#help">How to</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#project">About</a></li>             <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#links">Useful Links </a></li>
						<li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#contacts">Contacts</a></li>
          
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                        

                <!-- Masthead Avatar Image-->
            <!--    <img class="masthead-avatar mb-5" src="assets/img/avataaars.svg" alt="..." />-->
                <!-- Masthead Heading-->
                <h1 class="masthead-heading mb-0">Search for Truth</h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon">
                  
                      <i class="fa-solid fa-dharmachakra"></i>
                      </div>
                    <div class="divider-custom-line"></div>
                </div>
    
			<form method="post" action=
			"<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>"	action="" class="justify-content-center">  

                            <div class="form-group">
                                <label class="sr-only">Pattern</label>
                                <input name="pattern"  type="text" class="form-control" placeholder="e.g. Kāyagat">
                            </div>
                            <br>
							
							
							
							
							
                            <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="language" <?php if (isset($language) && $language=="Pali") echo "checked";?> value="">Pali
  </div>
                          <div class="form-check form-check-inline">
  <input class="form-check-input"  type="radio" name="language" <?php if (isset($language) && $language=="-ru ") echo "checked";?> value="-ru">Рус
  </div>
    <div class="form-check form-check-inline">
  <input class="form-check-input"  type="radio" name="language" <?php if (isset($language) && $language=="-th ") echo "checked";?> value="-th">ไทย
  </div>
                              <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="language" <?php if (isset($language) && $language=="English") echo "checked";?> value="-en">Eng
  </div>
  <span class="error"><?php echo $languageErr;?></span>
  <br><br>
                        <button type="submit" name="submit"
				value="Search" class="btn btn-primary btn-lg">Find</button>  
			
			<div class="alert alert-primary" role="alert">
  This is a primary alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
<div class="alert alert-secondary" role="alert">
  This is a secondary alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
<div class="alert alert-success" role="alert">
  This is a success alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
<div class="alert alert-danger" role="alert">
  This is a danger alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
<div class="alert alert-warning" role="alert">
  This is a warning alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
<div class="alert alert-info" role="alert">
  This is a info alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
<div class="alert alert-light" role="alert">
  This is a light alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
<div class="alert alert-dark" role="alert">
  This is a dark alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
			
			
			
			
			<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Dropdown button <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
  
                              <div class="form-check form-check-inline">

  
    <li><a class="dropdown-item" name="language" <?php if (isset($language) && $language=="Pali") echo "checked";?> value="">Pali</a></li>
    <li><a class="dropdown-item" name="language" <?php if (isset($language) && $language=="English") echo "checked";?> value="-en">English</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
  </ul>
</div>

			
				
		
				<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
  <button type="button" class="btn btn-primary">1</button>
  <button type="button" class="btn btn-primary">2</button>


 <div class="d-flex justify-content-center">
  <div class="spinner-border" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>

				</form>
		
		
		<script type="text/javascript">
$(".dropdown-menu li a").click(function(){
  
  $(".btn:first-child").html($(this).text()+' <span class="caret"></span>');
  
});
</script>

 <div class="btn-group" role="group">
    <button type="button" class="btn btn-primary dropdown-toggle"  data-bs-toggle="dropdown" aria-expanded="false" data-toggle="dropdown">
      Dropdown <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Dropdown link</a></li>
      <li><a class="dropdown-item" href="#">Dropdown link</a></li>
    </ul>
  </div>
</div>

				
<div class="btn-group">
  <a class="btn dropdown-toggle" data-bs-toggle="dropdown" href="#">
    Dropdown <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
    <li><a href="#">Choice1</a></li>
    <li><a href="#">Choice2</a></li>
    <li><a href="#">Choice3</a></li>
    <li class="divider"></li>
    <li><a href="#">Choice..</a></li>
  </ul>
</div>



<script type="text/javascript">
  alert("This alert box was called with the onload event");
</script>

<?php

$arg = $language . ' ' . $pattern;
?>
 </div>
					</br>
	<?php
			    				echo $lang;
			$old_path = getcwd();
			$output = shell_exec("./scripts/finddhamma.sh $language $pattern"); 
			echo "<p>$output</p>";
			
	
		?>	
	<p><a class="outlink" href="/list.php">Search History</a></p>
                <!-- Masthead Subheading
                <p class="masthead-subheading font-weight-light mb-0"><a href='list.php' style="color:blue;">All Searches</a></p>
                -->
            </div>
        </header>
        
                   <div class="divider-custom-icon text-center">   
              <div class="sidebar-social">
<a href="URL-HERE" title="Facebook" target="_blank" rel="nofollow">
    <i class="fa-solid fa-book fa-4x" title="Exchange"></i> 
<span>Google plus</span>
  </a>
<a href="URL-HERE" title="Instagram" target="_blank" rel="nofollow">
    <i class="fa-solid fa-list fa-4x"></i>
    <span>Google plus</span>
  </a>
  
</div>
 </div> 
        <!-- Portfolio Section-->
        <section class="page-section portfolio" id="help">
            <div class="container">
        <div class="font-italic">  <p class="lead mb-5 font-italic text-center ">
                            All-round view on meaning, definitions, <br>
            metaphors, persons, locations and everithing else<br>
            from Pali Suttas and Vinaya<br> 
             in convenient tables for future reading. 

                        </p></div> 
         
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">How To Search</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fa-solid fa-dharmachakra"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Grid Items-->
                <div class="row justify-content-center">
                  
                                    <!-- Portfolio Item 5
               <h2 class="page-section-heading text-center">Video Demonstration</h2>
                    <div class="col-md-6 col-lg-4 mb-5 mb-md-0">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal5">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/safe.png" alt="..." />
                        </div>
                    </div>  -->
                                   <!--    Portfolio Item 6 -->
          <!-- <h2 class="page-section-heading text-center mb-4">Search Basics</h2> -->
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal6">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/submarine.png" alt="..." />
                        </div>
                    </div>
                    <!-- Portfolio Item 1
               <h2 class="page-section-heading text-center">The best is Pali</h2>
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal1">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/cabin.png" alt="..." />
                        </div>
                    </div>
                    <!-- Portfolio Item 2
           <h2 class="page-section-heading text-center">The best are Suttas</h2>
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal2">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/cake.png" alt="..." />
                        </div>
                    </div>
                    <!-- Portfolio Item 3
          <h2 class="page-section-heading text-center">the "Secret" Background Mode</h2>
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal3">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/circus.png" alt="..." />
                        </div>
                    </div>
                    <!-- Portfolio Item 4
            <h2 class="page-section-heading text-center">the "Secret" Mode for Vinaya</h2>
                    <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal4">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/game.png" alt="..." />
                        </div>
                    </div>
-->

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
                    <div class="divider-custom-icon"><i class="fa-solid fa-dharmachakra"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- About Section Content-->
                <div class="row">
                    <div class="col-lg-4 ms-auto"><p class="lead">Find.Dhamma.Gift is a Liberation Search Engine, it's search tool based on SuttaCentral.net and Theravada.ru materials. You can search in Pali, Russian and English for definitions, metaphors, explanations, people, locations etc. described in Suttas and Vinaya.
                    </p></div>
                    <div class="col-lg-4 me-auto"><p class="lead">Dhamma Enthusiasts, Developers and Contributors are warmly welcome, because project has great potential to find the real meaning of the texts. But! I'm not a developer and its just a bash script with php wrapper.😊</p></div>
                    
                </div>
                <!-- About Section Button-->
                <div class="text-center mt-4">
                    <a class="btn btn-xl btn-outline-light" href="https://github.com/o28o/find-dhamma">
                
                        Project on GitHub
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
          

                        <h4 class="text-uppercase mb-4">Research</h4>
               
                <div class="list-group">

  <a href="#page-top" class="list-group-item list-group-item-action active">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">find.dhamma.gift</h5>
      <small class="text-muted">online+offline</small>
    </div>
    <p class="mb-1">All encompassing search within all Suttas and Vinaya.</p>
    <small class="text-muted">Your search results are avalilable by link or for download.</small>
  </a>
        <a target="_blank" href="https://digitalpalidictionary.github.io/" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Digital Pali Dictionary</h5>
      <small class="text-muted">app</small>
    </div>
    <p class="mb-1">The biggest and quickest dictionary and pali grammar.</p>
    <small class="text-muted">Available for PC, Mac, Android, IOS</small>
  </a>


    <a target="_blank" href="https://www.wisdomlib.org/" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Wisdomlib.org</h5>
      <small class="text-muted">online</small>
    </div>
    <p class="mb-1">Excellent online collection of dictionaries. Not only Pali, but multiple spiritual traditions of India</p>
    <small class="text-muted">Might be very helpful for difficult terms.</small>
  </a>
  

      <a target="_blank" href="http://dictionary.tamilcube.com/pali-dictionary.aspx" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">TamilCube.com</h5>
      <small class="text-muted">online</small>
    </div>
    <p class="mb-1">Simple Online English-Pali Dictionary</p>
    <small class="text-muted">Might be very helpful</small>
  </a>

</div>  



                  
                        <p class="lead mb-0"> 
      
	  


                        </p>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Read</h4>
                       
 <div class="list-group">


  <a target="_blank" href="https://Suttacentral.net" class="list-group-item list-group-item-action" aria-current="true">
    <div class="d-flex w-100 justify-content-between text-left">
      <h5 class="mb-1">Suttacentral.net</h5>
      <small>online & offline</small>
    </div>
    <p class="mb-1 text-left">The most complete line-by-line Pali-English collection</p>
    <small>Pali lookup dictionary built-in</small>
  </a>
  
    <a href="https://www.digitalpalireader.online/" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Digital Pali Reader</h5>
      <small class="text-muted">online & offline</small>
    </div>
    <p class="mb-1">Very profound online tool for Pali researches.</p>
    <small class="text-muted">On click Pali-English Dictionary available</small>
  </a>
  
  <a href="https://tipitaka.theravada.su/toc/translations/1097" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Tipitaka.Theravada.su</h5>
      <small class="text-muted">online</small>
    </div>
    <p class="mb-1">Multiple translation options. Pali-English-Russian line-by-line.</p>
    <small class="text-muted">Expecially recommended for stuyding Digha Nikaya</small>
  </a>
  
  <a href="https://www.theravada.ru/" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Theravada.ru </h5>
      <small class="text-muted">online</small>
    </div>
    <p class="mb-1">The most complete translation of Suttanta in Russian.</p>
    <small class="text-muted"></small>
  </a>
  

  
  

  

</div>  

				
                    </div>
                    <!-- Footer About Text-->
                    <div id="contacts" class="col-lg-4">
                        <h4 class="text-uppercase mb-4">Contacts</h4>
						
                        <p class="lead mb-4">
                            Find the Noble Eightfold Path. Understand the Four Noble Truths. Dhamma - is Actuality.
                      
                        </p>
							   <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
						
                    </div>
                </div>
            </div>
        </footer>
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright &copy; Dhamma.gift 2022</small></div>
        </div>
        <!-- Portfolio Modals-->
        <!-- Portfolio Modal 1-->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" aria-labelledby="portfolioModal1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Log Cabin</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fa-solid fa-dharmachakra"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/cabin.png" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
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
        <!-- Portfolio Modal 2-->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" aria-labelledby="portfolioModal2" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Tasty Cake</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fa-solid fa-dharmachakra"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/cake.png" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
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
        <!-- Portfolio Modal 3-->
        <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" aria-labelledby="portfolioModal3" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Circus Tent</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fa-solid fa-dharmachakra"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/circus.png" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
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
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Controller</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fa-solid fa-dharmachakra"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/game.png" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
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
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Locked Safe</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fa-solid fa-dharmachakra"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/safe.png" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">TestLorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
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
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">How to Search</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fa-solid fa-dharmachakra"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/submarine.png" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">Tip #0<br>
                                    Use special characters ā ī ū ḍ ṁ ṁ ṇ ṅ ñ ṭ<br>
                                      Tip #1<br>
                                    Use stem of the word for broader results. play around with or without prefixes or endings. 
									<br>
									Tip #2<br>You have two options: results sorted by Suttas and by words. <br>
                                   Tip #3<br> Minimal length of search pattern is 3 symbols. But if possible search for longer patterns. Then you will get more precise results.<br>
                                   Tip #4<br>
                                   if your request fails due to timeout try background mode. it might work.<br>
                                   Tip #5<br> 
                                   if you're willing to search in Vinaya add -vin to your search request. For pali vinaya search for cetana the line will look like: -vin cetana <br>
								   Tip #6<br> 
                                   Searches in Pali will give the best results. But in cases when you're looking for animals, plants, etc. translations in other languages might help even better. e.g. there are at least 3 different pali words for a snake but in Russian or English - it's just "a snake". <br>
								   Tip #7<br>
								   If you're willing to search in Vinaya add -vin to your search request. For pali vinaya search for cetana the line will look like: -vin cetana <br>
								   
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
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
