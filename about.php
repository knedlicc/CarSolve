<?php
  /** 
   * about.php page
   * @author Andrey Bortnikov
   * @package files
   * 
   */
  /**
   * Showing errors on the top of the page
   */
  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  /**
   * Connection to databse
   */
  require "db.php";
  $style1 = '<link rel="stylesheet" href="css/style.css">';
  $style2 = '<link rel="stylesheet" href="css/style2.css">';

  $style = isset($_COOKIE['style']) ? $_COOKIE['style'] : 1;

  if(isset($_POST['selectStyle']) && isset($_POST['style'])) {
      $style = $_POST['style'];
      setcookie('style',$style, time()+60*60*24*31, '/~bortnand/');
  }

  $selectedStyles = $style == 1 ? $style1 : $style2;
?>  
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>About</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/mdb.min.css" rel="stylesheet">
        <!-- <link href="css/style.css" rel="stylesheet"> -->
        <?php
        echo $selectedStyles;
        ?>
        <link rel="stylesheet" href="print.css" type="text/css" media="print">
      </head>

      <body>
       
          
          
          
            
            <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-darkgrey fixed-top scrolling-navbar" id='qwe'>
              <a class="navbar-brand" href="index.php">
                      <img src="pics/—Pngtree—vectorsportscaricon_4259167.png" width="50" height="50" alt="">
                      CarSolve
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto smooth-scroll">
                <li class="nav-item">
                  <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="2.php">Questions</a>
                </li>
              
                  <li class="nav-item active">
                    <a class="nav-link" href="about.php">About</a>
                  </li>
                 
                
              </ul>
              <ul class="navbar-nav ml-auto nav-flex-icons">
                <?php
                /**
                 * If user is logged in, shows user's email on top and log out button instead of 'log in' and 'sign up'
                 */
                if (isset($_SESSION['logged_user'])) : ?>
                <li>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><?php echo $_SESSION['logged_user']->email;?></button>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-default"
                    aria-labelledby="navbarDropdownMenuLink-333">
                    
                      <a class="dropdown-item" href="logout.php">Log out</a>  
                  </div>
                </li>
                <?php else : ?>  
                  <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-default"
                    aria-labelledby="navbarDropdownMenuLink-333">
                    
                      <a class="dropdown-item" href="login.php">Log in</a>  
                      <a class="dropdown-item" href="signup.php">Sign up</a>
                  </div>
                </li> 
                <?php endif; ?>
              </ul>
            </div>
            </nav>
          </header> 
          
      <!--Jumbotron-->    
    <div class="container-fluid" id="about">
        <div class="text-white text-center rgba-stylish-strong  sticky-top sticky-left" id="about2">
            <div class="py-5">
          
                <!-- Content -->
                <h1 class="h1 orange-text" id="ff"><i class="fas fa-info-circle"></i> About</h1>
                <h2 class="card-title h2 my-4 py-2">Why CarSolve exists</h2>
                <p class="mb-6 pb-4 px-md-7 mx-md-7" id="fff">Ask and answer the questions about your car. Search the answers we already have. We want to help each other to find information needed to solve any problem with your car. Try now!</p>
                
                <a class="btn peach-gradient" role='button' href="#read"><i class="fas fa-user left"></i>Ask author</a>
                
              </div>
            </div> 
            
    </div> 

  
    
  <div class="container" id="why">
    <div class='text-darkgrey text-center'>
      <h2 class='card-title h2'>Why CarSolve exists</h2>
      <p class='lead fluid my-5 mx-5 '>Our mission is to share and grow the world’s knowledge.
         A vast amount of the knowledge that would be valuable to many people is currently only 
         available to a few — either locked in people’s heads, or only accessible to select groups. We want 
         to connect the people who have knowledge to the people who need it, to bring together people with different 
         perspectives so they can understand each other better, and to empower everyone to share their knowledge for 
         the benefit of the rest of the world.</p>
      <hr class='md-5'>
      <h2 class="card-title h2">Gathering around a question</h2>
      <p class="lead fluid my-5 mx-5" > CarSolve is a place where you can ask questions you care about and get answers that are amazing.

          CarSolve has only one version of each question. It doesn’t have a left wing version, 
          a right wing version, a western version, and an eastern version. CarSolve brings together people
           from different worlds to answer the same question, in the same place — and to learn from each other.
            We want CarSolve to be the place to voice your opinion because CarSolve is where the debate is happening. 
            We want the CarSolve answer to be the definitive answer for everybody forever.</p><p id='read'></p>
    </div>
  </div>
  
  <hr class="md-5">
  <div class="container">
    <section class="team-section" >
      <p class='text-center h1 text-darkgrey mb-4'>Author</p>
      <div class="text-center" id='author'>
        <div class="col-md">
          <div class="avatar">
            <img src="pics/IMG_9589.jpg" alt class="rounded z-depth-1-half" id="photo">
          </div>
          <h4 class='font-weight-bold text-darkgrey my-4'>Andrey Bortnikov</h4>
          <h6 class="text-uppercase grey-text">CEO</h6>
          <h6 class="text-uppercase grey-text">front-end developer</h6>
          <h6 class="text-uppercase grey-text mb-4">back-end developer</h6>
          <p class="px-2 py-3"><a class="btn btn-warning btn-lg " href="contact.php" role="button">Contact</a></p>
          
        </div>
      </div>
    </section>
  </div>
    
   

    
    
    <footer id="ggg" class="page-footer font-small bg-darkgrey">

        <!-- Footer Elements -->
        <div class="container">
      
          <!-- Grid row-->
          <div class="row">
      
            <!-- Grid column -->
            <div class="col-sm-12 py-5">
              <div class="mb-4 flex-center">
      
                <!-- Facebook -->
                <a class="fb-ic" href="https://www.facebook.com/kisstrust" target="_blank">
                  <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-4 fa-3x"> </i>
                </a>
                
                <!--Instagram-->
                <a class="ins-ic" href="https://www.instagram.com/knedlicc/" target="_blank">
                  <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-4 fa-3x"> </i>
                </a>
                <a class="ins-ic" href='https://vk.com/bortand' target="_blank">
                    <i class="fab fa-vk fa-lg white-text mr-md-5 mr-4 fa-3x"> </i>
                  </a>
                  <a class="ins-ic" href="https://discord.gg/9ynzZj" target="_blank"> 
                      <i class="fab fa-discord fa-lg white-text mr fa-3x"></i>
                    </a> 
                
              </div>
            </div>
            <!-- Grid column -->
      
          </div>
          <!-- Grid row-->
      
        </div>
        <!-- Footer Elements -->
      
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2019 Copyright:
          <a href=""> Andrey Bortnikov</a>
        </div>
        <!-- Copyright -->
       <!-- SCRIPTS -->
  <!-- JQuery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script  src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script  src="js/mdb.min.js"></script>
  
      </footer>
    </body>  
</html>
