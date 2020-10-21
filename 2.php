<?php 
  /** 
   * 2.php page
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
  $connect = mysqli_connect("localhost", "bortnand", "634863qQ", "bortnand");
  require "db.php";
  

  /**
   * Getting page number
   */
  if(!isset($_GET['page'])) $page = 1; else $page = mysqli_real_escape_string($connect,$_GET['page']);
  if(ctype_digit($page) === false) $page = 1;

  /**
	* Pagination
	* @package pagination
	*/
  $count_query = $connect->query("SELECT COUNT(*) FROM posts1");
  $count_array = $count_query->fetch_array(MYSQLI_NUM);
  $count = $count_array[0];
  $limit = 9;
  $start = ($page*$limit)-$limit;
  $len = ceil($count/$limit);


  if((int)$page > $len || $page <= 0) $start = 0;
  $query = mysqli_query($connect, "SELECT * FROM posts1 ORDER BY id DESC LIMIT $start, $limit");

  function pagination($len,$page) {
    
    /**
    * Some conditions to make pagination look better on the page
    */
    if($len < 5)
    foreach(range(1,$len) as $p) 
      if($p == $page) {
        echo  '<div class="pagination">
              <a class="active" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      } else {
        echo '<div class="pagination">
              <a class="" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      }
    

    if($len > 4 && $page < 5)
    foreach(range(1,5) as $p)
      if($p == $page) {
        echo  '<div class="pagination">
              <a class="active" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      } else {
        echo '<div class="pagination">
              <a class="" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      }
    


    if($len-5 < 5 && $page > 5 && $len-5 > 0)
    foreach(range($len-4,$len) as $p) 
      if($p == $page) {
        echo  '<div class="pagination">
              <a class="active" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      } else {
        echo '<div class="pagination">
              <a class="" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      }
  

    if($len == 5 && $len - 5 < 5 && $page == 5)
    foreach(range($page-4,$len) as $p) 
      if($p == $page) {
        echo  '<div class="pagination">
              <a class="active" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      } else {
        echo '<div class="pagination">
              <a class="" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      }

    if($len == 6 && $page == 5)
    foreach(range($page-3,$len) as $p) 
      if($p == $page) {
        echo  '<div class="pagination">
              <a class="active" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      } else {
        echo '<div class="pagination">
              <a class="" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      }  

    if($len == 7 && $page == 5)
    foreach(range($page-2,$len) as $p) 
      if($p == $page) {
        echo  '<div class="pagination">
              <a class="active" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      } else {
        echo '<div class="pagination">
              <a class="" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      }    

    if($len ==8 && $len-5<5 && $page == 5)
    foreach(range($page-1,$len) as $p) 
      if($p == $page) {
        echo  '<div class="pagination">
              <a class="active" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      } else {
        echo '<div class="pagination">
              <a class="" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      }  

    if($len ==9 && $len-5<5 && $page == 5)
    foreach(range($page,$len) as $p) 
      if($p == $page) {
        echo  '<div class="pagination">
              <a class="active" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      } else {
        echo '<div class="pagination">
              <a class="" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      } 

    if($len > 4 && $len -5 > 5 && $page >= 5 && $page <= $len-4)
    foreach(range($page-2,$page+2) as $p) 
      if($p == $page) {
        echo  '<div class="pagination">
              <a class="active" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      } else {
        echo '<div class="pagination">
              <a class="" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      }
  

    if($len > 4 && $len -5 >= 5 && $page > $len-4)
    foreach(range($len-4,$len) as $p) 
      if($p == $page) {
        echo  '<div class="pagination">
              <a class="active" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
      } else {
        echo '<div class="pagination">
              <a class="" href="2.php?page='.$p.'">'.$p.'</a>
              </div>';
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
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Questions</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/mdb.min.css" rel="stylesheet">
        <?php
        echo $selectedStyles;
        ?>
        <!-- <link href="css/style.css" rel="stylesheet"> -->
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
                <li class="nav-item active">
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


  
  <div class="view" id="jumbo">
    <div class="container-fluid rgba-stylish-light py-3 px-3">
      <h1 class="display-4 mt-5 white-text px-3 py-3">There are some questions to discuss</h1>
      <h3 class="white-text py-3 px-3" id="1">Maybe you will find something to solve your problem?</h3>
      <h3 class="white-text px-3" id='2'>Or you know how to help others?</h3>

      <p class="px-2 py-3">
        <a class="btn btn-warning btn-lg " href="write.php" role="button">Ask</a>
        <a class="btn btn-warning btn-lg " href="#cards" role="button">Answer</a>
      </p>
    </div>
    
  </div>
  
  
  <hr class=" my-5">
 
  
  <div id="data-container">

  <p class='text-center text-white rgba-black-light h1 my-4' id='cards'>Questions</p>
      <!--Section: Cards-->
      <section class="view text-center" id='section'>
      <?php 
      /**
       * If no question exists shows 'There are no questions yet...'
       */
      if(mysqli_num_rows($query) == 0)  { ?>
          <p class='text-center h5 my-4'>There are no questions yet...</p>
        <?php } ?>  
        <!--Grid row-->
        <div class="row mb-4 wow fadeIn">
        
        <?php 
        /**
         * If at least one questions exists, shows it on the page
         */
        while($article = mysqli_fetch_assoc($query)) { ?>
          <!--Grid column-->
          <div class="col-md-4 mb-4">

            <!--Card-->
            <div class="hoverable card">

              <!--Card image-->
              <div class="view overlay">
                  <img src="pics/question-mark.jpg" class="card-img-top"
                    alt="">
                 
                </div>  

              <!--Card content-->
              <div class="card-body">
                <!--Title-->
                <h4 class="card-title"><?=$article['title']?></h4>
                <!--Text-->
                <p class="card-text"><?=$article['discription']?></p>
                <?php
                  echo '<a href="question.php?id='.$article['id'].'?page=1" class="btn btn-warning btn-md">Read<i class="fas fa-play ml-2"></i></a>'
                ?>
              </div>

            </div>
            <!--/.Card-->

          </div>
          <!--Grid column-->
       <?php } ?>
       
       
    
        
        </div>
        <?php if(mysqli_num_rows($query) == 0)  {} else { ?>
        <div>
        <?php pagination($len,$page); ?>
        </div>
        <?php } ?>
        
        
      </section>
        </div>
      <!--Section: Cards-->

    
  

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
  <script  src="js/pagination.js"></script>
  <!-- Bootstrap tooltips -->
  <script src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script  src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script src="js/mdb.min.js"></script>
  
      </footer>
    </body>  
</html>
