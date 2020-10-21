<?php
  /** 
   * write.php page
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
  require "db.php";

  /**
   * Giving $data every data from $_POST
   */
  $data = $_POST;
  /**
   * Giving $author data from session with name 'logged_user'
   * It's a session of logged in user
   */
  if(isset($_SESSION['logged_user'])){
  $author = $_SESSION['logged_user'];
  }
  /**
   * Writing question data to our database with some conditions
   * @package database
   */
  if (isset($data['doask']) )
  {
    /**
     * We have array with errors to show error on the page if at least one exists
     */
    $errors = array();
    if(trim($data['title']) == '')
    {
      $errors[] = 'Type your title';
    }
    if(trim($data['content']) == '')
    {
      $errors[] = 'Type your question';
    }
    if (empty($errors))
    {
      /**
       * If content is too long, we can't show it on the question card
       * thats why we cut it to 90 symbols and show THEM on the card
       */
      if (strlen($data['content']) < 91) {
        
        $description = trim($data['content']);
        $description = htmlspecialchars($description);



      } else { 
        $description = $data['content'];
        $description = strip_tags($description);
        $description = substr($description,0,90);
        $description = rtrim($description, "!,.-");
        $description = $description."...";
        
      }
      /**
       * The same as content we trim title
       */
      if (strlen($data['title'])< 71) {

        $title = $data['title'];
        $title = htmlspecialchars($title);
        $title = strip_tags($title);
      } else {

        $title = $data['title'];
        $title = strip_tags($title);
        $title = substr($title,0,70);
        $title = rtrim($title, "!,.-");
        $title = $title."...";
      }

      /**
       * Writing to database
       */
      $post = R::dispense('posts1');
      $post->title =$title;
      $post->text = htmlspecialchars(trim($data['content']));
      $post->discription =$description;
      $post->author = $author['name'];
      $post->lastname= $author['lastname'];
      $post->email = $author['email'];
      R::store($post);
      header('Location: 2.php');
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
    <title>Ask</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <?php
        echo $selectedStyles;
    ?>
    <script defer src='js_validation/ask.js'></script>
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
          <!--ask form-->
          <form class="text-center p-5" action="write.php" id="form" method ="post">

              <p class="h4 mb-4  text-white">Ask it! What are you waiting for?</p>
              <br>
          
              <div class="md-form">
                  
                <input type="hidden" value="" name = "session_username"><i class="fa fa-ij prefix text-white"></i>
                <input type="text" class="input-group text-white" id="form8" placeholder="Title (required)" name="title" required pattern='.{9,30}[a-zA-Z0-9]' value="<?php echo @htmlspecialchars($data['title']);?>">
                <label for="form8"> </label>
                <textarea class="md-textarea text-white" id="form9" rows="10"
                placeholder="Write your question here (required)" name="content"  required ></textarea>
                <label for="form9"> </label>
                <span class='text-danger' id='error4'></span>
            </div>
                
                
              
             <?php 
             /**
              * If user is logged in, shows the button to post a question
              * Showing errors, if at least one exists
              */
             if (isset($_SESSION['logged_user'])) : ?>
             <?php if(empty($errors)) {} else {?>
                  <span class="error h6" id='span1'><?php echo array_shift($errors) ?><br></span>
             <?php } ?>
              <!-- ask button -->
              <button class="btn btn-info my-4" type="submit" name='doask'>Ask</button>
            <?php else : ?>
              <p class="error h5" id="span1">You cannot post questions if you are not logged in</p>
            <?php endif; ?>  
            

             
          
            
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
          <!-- Bootstrap tooltips -->
          <script src="js/popper.min.js"></script>
          <!-- Bootstrap core JavaScript -->
          <script  src="js/bootstrap.min.js"></script>
          <!-- MDB core JavaScript -->
          <script src="js/mdb.min.js"></script>
          
              </footer>


</body>
</html>
