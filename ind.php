<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8">

<title>find.Dhamma.gift - For Suttas and Vinaya it's better then Google</title>

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!-- Favicon-->
		
		    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="find.Dhamma.gift - Liberation Search Engine" />
    <meta property="og:description" content="Search for Pali Suttas and Vinaya in Pali, Russian, English and Thai" />

    <meta property="og:url" content="https://find.dhamma.gift/" />
    <meta property="og:site_name" content="find.Dhamma.gift" />
    <meta property="og:image" itemprop="image" content="https://find.dhamma.gift/assets/social_sharing_gift.jpg" />
	
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="find.Dhamma.gift - Liberation Search Engine">
	<meta name="twitter:description" content="Search for Pali Suttas and Vinaya in Pali, Russian, English and Thai">
	
	
	
	<link rel="icon" type="image/png" href="./assets/favico.png" />
    
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/extrastyles.css" rel="stylesheet" />
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
            <a class="navbar-brand mobile-center" href="/"> <div class="container"><img src="./assets/dhammafindlogo.png"  style="width:100px;"></a>
                <a class="navbar-brand mobile-none" href="/#page-top">find.dhamma.gift</a>
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
			
				
				</form>
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
        <!-- Portfolio Section-->
        <section class="page-section portfolio" id="help">
            <div class="container">
        <div class="font-italic">  <p class="lead mb-5 font-italic text-center ">  All-round view on meanings, definitions, <br>
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
                  
                                 
								 
         <h4 class="page-section-heading text-center mb-4">Search Basics</h4>
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
                    <div class="divider-custom-icon"><i class="fa-solid fa-dharmachakra"></i></div>
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
          

                        <h4 class="text-uppercase mb-4">Research</h4>
               
                <div class="list-group">

  <a href="#page-top" class="list-group-item list-group-item-action active">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">find.dhamma.gift</h5>
      <small class="text-muted">online</small>
    </div>
    <p class="mb-1">All encompassing search within all Suttas and Vinaya.</p>
    <small class="text-muted"></small>
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
    <small class="text-muted">Especially recommended for stuyding Digha Nikaya</small>
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
                    <!-- Footer About Text-->
                    <div id="contacts" class="col-lg-4">
                        <h4 class="text-uppercase mb-4">Contacts</h4>
						
                        <p class="lead mb-4">
                            Find the Noble Eightfold Path. Understand the Four Noble Truths. Dhamma - is Actuality.
                      
                        </p>
							   <a  target="_blank"  class="btn btn-outline-light btn-social mx-1" href="https://github.com/o28o/find-dhamma#readme"><i class="fa-brands fa-github"></i></a>
                        <a  target="_blank"  class="btn btn-outline-light btn-social mx-1" href="mailto:o@dhamma.gift"><i class="fa-solid fa-at"></i></a>
						
                    </div>
                </div>
            </div>
        </footer>
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright &copy; Dhamma.gift 2022</small></div>
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
								   To add variations you may add [], e.g. nand[iī] this will search for both nani and nandī matches.
								 <br><br>
								  
									<strong>Tip #3</strong><br>
								   If you want to find words beginning or ending from some pattern use \\\\b before and\or in the end of the pattern. e.g. <strong>\\\\bkummo\\\\b</strong> will search for only kummo and will skip kummova and any other<br><br>
									<strong>Tip #4</strong><br>
								   You may use regexes that are applicable in GNU grep -E statements. With propper escaping (\\\\) they should work.<br><br>
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
                                    <p class="mb-4">
									<strong>Tip #1</strong><br> 
                                   We highly recommend to search in Pali. As it will give the best results and you will develop a very important habbit to look into Pali and do not rely blindly on the translations. But oviously you can get some benefits from searches in translations. If you are looking for animals, plants, etc. There are at least 4 different pali words for a snake but in Russian or English - it's just "a snake" or "a viper". <br><br>
				
									<strong>Tip #2</strong><br>
                                   if your request fails due to timeout try longer search pattern.  <br><br>
								   <strong>Tip #3</strong><br>
                                   if your request fails due to timeout and you can't use longer search pattern try background mode menu option. It might work.<br><br> 
								   
                                   <strong>Tip #4</strong><br> 
                                   if you're willing to search in Vinaya add -vin to your search request. For pali vinaya search for cetana the line will look like: -vin cetana <br><br>
									
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
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">How to Search</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fa-solid fa-dharmachakra"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/submarine.png" alt="..." /> -->
									<!-- Portfolio Modal - Text-->
                                     <p class="mb-4"><strong>Tip #0</strong><br>
										If you search in Pali you don't need to check it in options. Pali is default.<br><br>
									 <strong>Tip #1</strong><br>
                                    Use special characters ā ī ū ḍ ṁ ṁ ṇ ṅ ñ ṭ<br><br>
                                     <strong>Tip #2</strong><br>
									 Search is perfomed in All DN, MN, SN, AN, and following books of KN: Dhammapada, Udāna, Itivuttaka, Suttanipāta, Theragāthā, Therīgāthā. Other books of KN will not be used in the search, you may use alternative services to make searches in Jatakas and other book of KN.<br><br>

									 <strong>Tip #3</strong><br>
                                    Use stem of the word for broader results with or without prefixes or endings. 
									<br><br>
									                                      <strong>Tip #4</strong><br>
                                    Prefer Pali over other languages. Pali is the language in which the oldest Dhamma related texts are written.	
									<br><br>
									<strong>Tip #5</strong><br>For Pali search results you have two options: results sorted by Suttas/Texts with quotes and by words. Use both to get some extra details.<br><br>
                                   <strong>Tip #6</strong><br>Minimal length of search pattern is 3 symbols. But if possible search for longer patterns. Then you will get more precise results.<br><br>
                                   
								 
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
