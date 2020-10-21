<?php
  /** 
   * signup.php page
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
   * Connection to database
   */
  require "db.php";
  /**
   * Giving $data every data from $_POST
   */
  $data = $_POST;
  
  /**
   * Writing user data to our database with some conditions
   * @package database
   */
  if (isset($data['do']) )
  {
    /**
     * We have array with errors to show error on the page if at least one exists
     */
    $errors = array();
    
    if(trim($data['name']) == '')
    {
      $errors[] = 'Type your first name';
    }
    if(trim($data['name2']) == '')
    {
      $errors[] = 'Type your last name';
    }
    if(trim($data['email']) == '')
    {
      $errors[] = 'Type your email';
    }
    if(trim($data['pass']) == '')
    {
      $errors[] = 'Type your password';
    }
    if(R::count('uzivatele',"email = ?", array($data['email'])) > 0 ) 
    {
      $errors[] = "User with this email is already registered";    
    }
    if(trim($data['pass']) != trim($data['passcon'])) {
      $errors[] = "Passwords don't match";
    }
    if (strlen(trim($data['pass'])) > 30 || strlen(trim($data['pass'])) < 6 ) {
      $errors[] = "Password must be at least 6 characters and max 30";
    }  

    if (empty($errors))
    {
      
      /**
       * Writing to database
       * Using htmlspecialchars function to avoid XSS attacks
       * Using function trim to trim spaces
       * Using password_hash to protect password, password will be hashed and salted 
       */
      $user = R::dispense('uzivatele');
      $user->email =htmlspecialchars(trim($data['email']));
      $user->pass = password_hash(trim($data['pass']), PASSWORD_DEFAULT);
      $user->name = htmlspecialchars(trim($data['name']));
      $user->lastname = htmlspecialchars(trim($data['name2']));
      $user->role = 0;
      R::store($user);
      header('Location: congrats.php');
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <?php
        echo $selectedStyles;
    ?>
		<script defer src="js_validation/signup.js"></script>
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
            <form class="text-center p-5 formWithValidation form1" action="signup.php" id="form" method='post'>

                <p class="h4 mb-4  text-white">Sign up</p>
            
                <div class="form-row mb-0">
                    <div class="col" id='pname'>
                        
                        <input type="text" id="FirstName" class="form-control  firstname formy" placeholder="First name (required)" required pattern=".{1,30}[A-Za-z]" name='name' value="<?php echo @htmlspecialchars($data['name']);?>">
                        <label for='FirstName'></label>
                    </div>
                    <div class="col">
                        
                        <input type="text" id="LastName" class="form-control  lastname formy" name="name2" placeholder="Last name (required)" required pattern=".{1,30}[A-Za-z]" value="<?php echo @htmlspecialchars($data['name2']);?>">
                        <label for='LastName'> </label>
                    </div>
                </div>
                  <hr>
                  <label for='email'></label>
                  <input type="email" id='email' class="form-control mb-4 email1 formy" placeholder="E-mail (required)" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name='email' value="<?php echo @htmlspecialchars($data['email']);?>">
                  
                
                  
                    <label for='password1'></label>
                    <input type="password" class="form-control mt-4 mb-4 password1" placeholder="Password (required)" required pattern=".{6,30}" id='password1' name='pass'>
                    
                    <input type="password" class="form-control mb-4 confirm_heslo" placeholder="Repeat Password (required)" required pattern=".{6,30}"  id='confirm_password' name='passcon'>
                    <label for='confirm_password'></label>

                    
                    <span class='text-danger' id='error1'></span>
                    
                    <?php 
                    /**
                     * Showing errors if at least one exists
                     */
                    if(empty($errors)) {} else {?>
                    <span class="error h6" id='span1'><?php echo array_shift($errors) ?><br></span>
                    <?php } ?>
                    <small id="defaultRegisterFormPasswordHelpBlock" class="mt-3 form-text text-white text-center">
                    Password must be at least 6 characters and max 30 characters
                    </small>
                      
                
                    
                
                
                <!-- Sign up button -->
                <button class="btn btn-info my-4 validateBtn" name="do" type="submit" id='knopka'>Sign up</button>
            
                <hr>
            
                <!-- Terms of service -->
                <p class="text-white">By clicking
                    <em>Sign up</em> you agree to our
                    <a id="link" href="terms.html" target="_blank">terms of service</a>
            
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
          <script  src="js/jquery-3.4.1.min.js"></script>
          <!-- Bootstrap tooltips -->
          <script  src="js/popper.min.js"></script>
          <!-- Bootstrap core JavaScript -->
          <script  src="js/bootstrap.min.js"></script>
          <!-- MDB core JavaScript -->
          <script  src="js/mdb.min.js"></script>
          
              </footer>


</body>
</html>
