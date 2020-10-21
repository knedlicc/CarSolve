<?php
 ini_set('error_reporting', E_ALL);
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);


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
<html lang='en'>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <?php
        echo $selectedStyles;
    ?>
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
              
                  <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                  </li>
                 
                
              </ul>
              <ul class="navbar-nav ml-auto nav-flex-icons">
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
              </ul>
            </div>
            </nav>
          </header> 
          
          <div class="container-fluid" id="signupnew">
              <div class=" py-5 px-3" id="pad">
            <!-- sign up form-->
            <form class="text-center p-5" action="check.php" id="form" method='post'>

                <p class="h3 mb-4  text-white">You are succesfully registered!</p>
            
                
                      
                
            
            
              
            
            
                <hr>
                
                <p class="mt-4 mb-4 text-white">Now you can log in: just click on the user icon in upper right corner and select "Log in" button</p>
                <hr>
            
                <p class=" mt-5 mb-3 text-white">Or you can push the button:</p>
                <a class="btn btn-success my-4 " role="button" href="login.php">Log in</a>

            </form>
         </div>
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
          <script  src="js/popper.min.js"></script>
          <!-- Bootstrap core JavaScript -->
          <script src="js/bootstrap.min.js"></script>
          <!-- MDB core JavaScript -->
          <script  src="js/mdb.min.js"></script>
          
              </footer>


</body>
</html>
