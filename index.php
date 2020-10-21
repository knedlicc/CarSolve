<?php
  /** 
     * index.php page
     * @author Andrey Bortnikov
     * @package files
     * 
     */
  /**
   * Connections to database
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
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>CarSolve</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/mdb.min.css" rel="stylesheet">
    <?php
        echo $selectedStyles;
    ?>
  <!-- <link href="css/style.css" rel="stylesheet"> -->
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
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="2.php">Questions</a>
        </li>
      
        <li class="nav-item">
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

<!--Carousel Wrapper-->
<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">

    <!--Indicators-->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-1z" data-slide-to="1"></li>
      <li data-target="#carousel-example-1z" data-slide-to="2"></li>
    </ol>
    <!--/.Indicators-->

    <!--Slides-->
    <div class="carousel-inner" role="listbox">

      <!--First slide-->
      <div class="carousel-item active">
        <div class="view" id="q">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>Have a problem with your car?</strong>
              </h1>

              <p>
                <strong>Somebody can help you!</strong>
              </p>

              <p class="mb-4 d-none d-md-block">
                <strong>Ask and answer the questions about your car. Search the answers we already have.</strong>
              </p>
              <?php if (isset($_SESSION['logged_user'])) : ?>
              <a href="2.php" class="btn btn-outline-white btn-lg"> Read the questions or post your own </a>
              <?php else : ?>
                <a href="login.php" class="btn btn-outline-white btn-lg"> Log in
                <i class="fas fa-user ml-2"></i>
                </a>
              <?php endif; ?>  

            </div>
            <!-- Content -->

          </div>
          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/First slide-->

      <!--Second slide-->
      <div class="carousel-item">
        <div class="view" id="qq">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>Have a problem with your car?</strong>
              </h1>

              <p>
                <strong>Somebody can help you!</strong>
              </p>

              <p class="mb-4 d-none d-md-block">
                <strong>Ask and answer the questions about your car. Search the answers we already have.</strong>
              </p>
              <?php if (isset($_SESSION['logged_user'])) : ?>
              <a href="2.php" class="btn btn-outline-white btn-lg"> Read the questions or post your own </a>
              <?php else : ?>
                <a href="login.php" class="btn btn-outline-white btn-lg"> Log in
                <i class="fas fa-user ml-2"></i>
                </a>
              <?php endif; ?>  
            </div>
            <!-- Content -->

          </div>
          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/Second slide-->

      <!--Third slide-->
      <div class="carousel-item">
        <div class="view" id="qqq">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>Have a problem with your car?</strong>
              </h1>

              <p>
                <strong>Somebody can help you!</strong>
              </p>

              <p class="mb-4 d-none d-md-block">
                <strong>Ask and answer the questions about your car. Search the answers we already have.</strong>
              </p>
              <?php if (isset($_SESSION['logged_user'])) : ?>
              <a href="2.php" class="btn btn-outline-white btn-lg"> Read the questions or post your own </a>
              <?php else : ?>
                <a href="login.php" class="btn btn-outline-white btn-lg"> Log in
                <i class="fas fa-user ml-2"></i>
                </a>
              <?php endif; ?>  
             
            </div>
            <!-- Content -->

          </div>
          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/Third slide-->

    </div>
    <!--/.Slides-->

  </div>
  <!--/.Carousel Wrapper-->
<!-- Card -->

<section class="view text-center" id='cards' >
  <p class="text-center h1 text-white rgba-black-light text-uppercase" id="int">Interesting questions</p>
    <!--Grid row-->
    <div class="row mb-4 wow fadeIn mt">

      <div class="col-md-4">
          <div class="card hoverable">
              <!-- Card image -->
              <div class="view overlay">
                <img class="card-img-top" src="pics/question-mark.jpg" alt="Card image cap">
                <a href="#!">
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
            
              <!-- Card content -->
              
              <div class="card-body">
            
                <!-- Title -->
                <h4 class="card-title">Maxima wheels on a 350z... need help/advice</h4>
                <!-- Text -->
                <p class="card-text">Need help... would like to know if I can put 18 inch Nissan Maxima wheels on my 08 350z</p>
                <!-- Button -->
                <a href="question.php?id=1?page=1" class="btn btn-primary">Read</a>
              </div>
          </div> 
      </div>
         
     
    <div class="col-md-4">
      <div class="card hoverable">
        <div class="view overlay">
            <img class="card-img-top" src="pics/question-mark.jpg" alt="Card image cap">
            <a href="#!">
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>
        
        
          <!-- Card content -->
          <div class="card-body">
        
            <!-- Title -->
            <h4 class="card-title">Let's talk premium SUVs, $30k-$50k</h4>
            <!-- Text -->
            <p class="card-text">Keeping it short and sweet, my wife is ready to move on from her Civic and into a larger c...</p>
            <!-- Button -->
            <a href="question.php?id=2?page=1" class="btn btn-primary">Read</a>
      
          </div>
        </div>    
    </div>  
    <div class="col-md-4">
        <div class="card hoverable">
          <div class="view overlay">
              <img class="card-img-top" src="pics/question-mark.jpg" alt="Card image cap">
              <a href="#!">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>
          
          
            <!-- Card content -->
            <div class="card-body">
          
              <!-- Title -->
              <h4 class="card-title">Please Help! C63 AMG vs. Jaguar XFR</h4>
              <!-- Text -->
              <p class="card-text">Hello everyone, I am totally new to this website but I need your expert advise asap! I am ...</p>
              <!-- Button -->
              <a href="question.php?id=3?page=1" class="btn btn-primary">Read</a>
        
            </div>
          </div>    
      </div>  
     
    
    
</div> 
</section>

<!-- Footer -->
<footer id="ggg" class="page-footer font-small bg-darkgrey">
    <div id='steely'>
    <div class='text-center pt-3'>
        <form action='#' method = 'post'>
              <label>
                <input type='radio' name='style' <?php echo $style == 1 ? 'checked' :'' ?> value="1"> Style 1
              </label>  
              <br>
              <label>
                <input type='radio' name='style' <?php echo $style == 2 ? 'checked' :'' ?> value="2"> Style 2
              </label>
              <br>
              <input class='btn btn-outline-info btn-sm' type="submit" name="selectStyle" value="Set style">
        </form>

    </div>
    </div>
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
  
  </footer>
  <!-- Footer -->
  
 

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script  src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script  src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script src="js/mdb.min.js"></script>
</body>

</html>
