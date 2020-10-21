<?php
  /** 
   * login.php page
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
  /**
   * Giving empty values to strings 
   */
  $err1 = "";
  $err2 = "";
  $suc = "";
  /**
   * Giving $data every data from $_POST
   */
  $data = $_POST;
  /**
   * Find the user in database
   * If the user is in database, doing log in and set session['logged_user']
   */
  if (isset($data['dologin'])) {  
    $user = R::findOne('uzivatele', 'email = ?', array($data['email']));
    /**
     * If user is not in databse, error strings will be diplayed on the page
     */
    if ($user) {
        if (password_verify($data['pass'], $user->pass)){
          
          $_SESSION['logged_user'] = $user;
          
          
          $suc = "You are successfully logged in";
        } else {
            $err1 = "Wrong password";
        }
    } else {
        $err2 =  "User not found";
    }
  }
  
  
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
    <title>Log In</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <?php
        echo $selectedStyles;
    ?>
    <script defer src='js_validation/login.js'></script>
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
          
          <div class="container-fluid" id="signup">
              <div class=" py-5 px-3" id="pad">
            <!-- log in form-->
            <form class="text-center p-5" action="login.php" id="form" method="post">
            <?php 
            /**
             * If user is logged in, shows a succes message
             */
            if (isset($_SESSION['logged_user'])) { ?>
                  <span class="h5" id='span3'> <?php echo $suc;?><br></span>
                  <hr>
                  <hr>
                  <p class="text-white">Now you can use all features of our forum!<br>Answer and help people, post your own question, comment other answers and so on</p>
                  <hr>
                  <p class="text-white">If you want to log out, just click on the user icon in upper right corner and choose "Log out"</p>
                  <hr>
                  <hr>
                  <hr>
                  <hr>
                  <p class="text-white h5">You can get back to the main page by cliking this button:<br></p>
                  <a class="btn btn-info my-3" href="index.php">Main page</a>
                  
                  <?php } else {?>
                  <p class="h4 mb-4  text-white">Log in</p>
            
                  <input type="email" id="eqmail" class="form-control mb-4" placeholder="E-mail (required)" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" value="<?php echo @htmlspecialchars($data['email']);?>">
                  <label for='eqmail'> </label>
                  
                  <input type="password" id="defaultRegisterFormPassword" class=" form-control mb-4" name="pass" placeholder="Password (required)" required pattern=".{0,30}" title="Six or more characters">
                  <label for='defaultRegisterFormPassword'> </label>
                  <span class='text-danger' id='error3'></span>
                  <span class="error h6" id='span2'> <?php echo $err1;?></span>
                  <span class=" error h6" id='span1'> <?php echo $err2;?><br></span>
                  
                  
               
            
                <!-- log in  button -->
                <button class="btn btn-info my-3" type="submit" name="dologin">Log in</button>

                <p class="text-white pt-4">Not a member?
                    <a id="link" href="signup.php">Register</a>
                </p>
                <hr>
                <hr>
                <?php } ?>
               
            
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
                              <i class="fab fa-vk fa-lg white-text mr-md-5 mr-4 fa-3x" > </i>
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
          <script  src="js/jquery-3.4.1.min.js"></script>
          <!-- Bootstrap tooltips -->
          <script  src="js/popper.min.js"></script>
          <!-- Bootstrap core JavaScript -->
          <script src="js/bootstrap.min.js"></script>
          <!-- MDB core JavaScript -->
          <script  src="js/mdb.min.js"></script>
          
              </footer>


</body>
</html>
