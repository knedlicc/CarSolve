<?php
/** 
 * contact.php page
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
 * Connections to database
 */
require "db.php";
/**
 * Giving an empty value '' 
 */
$messageErr = $emailErr= "";
$message = $email = "";
/**
 * Some conditions to validate contact form
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["message"])) {
    $messageErr = "Type your message";
  } else {
    $message = test_input($_POST["message"]);
    
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    
    
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
  
 /**
 * Mail function to send messages from the form to my email address
 */

  $subject = '=?utf-8?B?'.base64_encode('CarSolveContact')."?=";
  $headers = "From: $email\r\nReply-to: $email\r\nContent-type: text/html;charset=utf-8\r\n";

  mail('an.bortnikov@yandex.ru',$subject, $message, $headers);
  header("Location: contact.php");
}
/**
 * Function to protect from XSS attacks
 */
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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
    <title>Contact form</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <?php
        echo $selectedStyles;
    ?>
    <script defer src="js_validation/contact_val.js"></script>
    
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
          
          <div class="container-fluid" id="signupnew">
            <div class=" py-5 px-3" id="pad">
          <!--contact form-->
          <form class="text-center p-5"  id="form" >

              <p class="h4 mb-4  text-white" id='hid'>If you want to ask me something, please, use this form.</p>
              
              <br>
              <!-- <div class='note'></div> -->
              
              <div class="md-form">                 
 
                <input type="email" class="d-inline form-control text-white" id="form8" placeholder="Your e-mail (required)" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo @htmlspecialchars($_POST['email']);?>">
                <span class="error h6" id='span1'> <?php echo $emailErr;?></span>
                <label class='d-inline' for='form8'></label>
                <textarea class="form-control md-textarea text-white" id="form81" rows="10" name="message"  placeholder="Write your question here (required)"></textarea>
                <span class="error h6" id='span2'> <?php echo $messageErr;?></span>
                <label for="form81"> </label>
                <span class="text-danger font-weight-bold" id='error2'></span>
              </div>
              
              
              <!-- <div class="alert alert-danger"></div> -->
              
              
              <button class="btn btn-info my-4" type="submit" name='contact' id='ajaxknop'>Send</button>
              <br>        
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
          <script>
             
            jQuery(document).ready(function($) { 
            
            $("#form").on('submit', function (event) {
              event.preventDefault()
            var error = false;  
            var form = $(this); 
            form.find('input, textarea').each( function(){ // пробежим по каждому полю в форме
              if ($(this).val() == '') { // если находим пустое
                alert('Cannot be blank "'+$(this).attr('placeholder')+'"!'); // говорим заполняй!
                error = true; // ошибка
              }
            });
            var str = $(this).serialize();
            if (!error) {

            
            $.ajax({
                type: "POST",
                url: "contact.php",
                data: str,
                success: function() {
                  $("#hid").hide();
                  $(".md-form").hide();
                  $('#ajaxknop').hide();
                  
                  result =  '<br><br><br><br><p class="h4 my-4 py-4 text-white">Your message was sent, thank you!</p><br><br><br><br>';
                  $('#form').html(result);
                  }
                }); };
            });
            });
          </script>  
          <!-- Bootstrap tooltips -->
          <script  src="js/popper.min.js"></script>
          <!-- Bootstrap core JavaScript -->
          <script  src="js/bootstrap.min.js"></script>
          <!-- MDB core JavaScript -->
          <script  src="js/mdb.min.js"></script>
          
              </footer>


</body>
</html>
