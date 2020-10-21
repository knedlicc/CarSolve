<?php 
  /** 
   * question.php page
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
  $connect = mysqli_connect("localhost", "bortnand", "634863qQ", "bortnand");
  /**
  * Checking if '?page=' string is in URL address 
  */
  $test = mb_ereg_match(".*?page=", $_SERVER['REQUEST_URI']);
  /**
  * If it's not, we can get id with $_GET
  * If it is, we cut everything from the URL string after ?page= 
  * Then we cut every thing before ?id= to get id
  * then we get id by removing '?id='
  */
  if($test == false){
    $pag = mysqli_real_escape_string($connect, $_GET['id']);
  } else {
    $pag = strstr($_SERVER['REQUEST_URI'],"?page=",true);
    $pag = strstr($pag,"?id=");
    $pag = mysqli_real_escape_string($connect,trim($pag,'?id='));
  }
  if(ctype_digit($pag) === false) exit("Wrong get request");
  
   /**
   * Looking in database questions with current id
   */
  $query = mysqli_query($connect, "SELECT * FROM posts1 WHERE id='$pag' ");
  

  /**
  * If ?page= is not in URL, setting page number as 1
  * If ?page= is in URL, getting page number by cutting everything from URL
  */
  if($test == false) {
     $page = 1;
    } else {
      
      $page = strstr($_SERVER['REQUEST_URI'],"?page=");
      $page = mysqli_real_escape_string($connect,trim($page,"?page="));

    }
  if(ctype_digit($page) === false) $page = 1;
  

	/**
	* Pagination
	* @package pagination
	*/
  $count_query = $connect->query("SELECT COUNT(*) FROM comments WHERE pageid='$pag'");
  $count_array = $count_query->fetch_array(MYSQLI_NUM);
  $count = $count_array[0];
  $limit = 5;
  $start = ($page*$limit)-$limit;
  $len = ceil($count/$limit);


  if((int)$page > $len || $page <= 0) $start = 0;
  $answer = mysqli_query($connect, "SELECT * FROM comments WHERE pageid='$pag' ORDER BY id DESC LIMIT $start, $limit");
  

  function pagination($len,$page) {
    $test = mb_ereg_match(".*?page=", $_SERVER['REQUEST_URI']);
    $connect1 = mysqli_connect("localhost", "bortnand", "634863qQ", "bortnand");
    if($test == false){
      $pagq = mysqli_real_escape_string($connect,$_GET['id']);
    } else {
      $pagq = strstr($_SERVER['REQUEST_URI'],"?page=",true);
      $pagq = strstr($pagq,"?id=");
      $pagq = mysqli_real_escape_string($connect1, trim($pagq,'?id='));
    }
  
    if(ctype_digit($pagq) === false) exit("Wrong get request");

    
    
    
    
	/**
	* Some conditions to make pagination look better on the page
	*/
    if($len < 5)
    foreach(range(1,$len) as $p) 
      if($p == $page) {
        echo  ' <div class="pagination2">
                                      
              <a class="active" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      } else {
        echo ' <div class="pagination2">
                                      
              <a class="" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      }

    if($len > 4 && $page < 5)
    foreach(range(1,5) as $p)
      if($p == $page) {
        echo  ' <div class="pagination2">
                                      
              <a class="active" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      } else {
        echo ' <div class="pagination2">
                                      
              <a class="" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      }

    if($len-5 < 5 && $page > 5 && $len-5 > 0)
    foreach(range($len-4,$len) as $p) 
      if($p == $page) {
        echo  ' <div class="pagination2">
                                      
              <a class="active" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      } else {
        echo ' <div class="pagination2">
                                      
              <a class="" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      }

    if($len == 5 && $len - 5 < 5 && $page == 5)
    foreach(range($page-4,$len) as $p) 
      if($p == $page) {
        echo  ' <div class="pagination2">
                                      
              <a class="active" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      } else {
        echo ' <div class="pagination2">
                                      
              <a class="" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      }

    if($len == 6 && $len - 5 < 5 && $page == 5)
    foreach(range($page-3,$len) as $p) 
      if($p == $page) {
        echo  ' <div class="pagination2">
                                      
              <a class="active" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      } else {
        echo ' <div class="pagination2">
                                      
              <a class="" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      }

    if($len == 7 && $len - 5 < 5 && $page == 5)
    foreach(range($page-2,$len) as $p) 
      if($p == $page) {
        echo  ' <div class="pagination2">
                                      
              <a class="active" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      } else {
        echo ' <div class="pagination2">
                                      
              <a class="" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      }


    if($len == 8 && $len - 5 < 5 && $page == 5)
    foreach(range($page-1,$len) as $p) 
      if($p == $page) {
        echo  ' <div class="pagination2">
                                      
              <a class="active" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      } else {
        echo ' <div class="pagination2">
                                      
              <a class="" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      }

    if($len == 9 && $len - 5 < 5 && $page == 5)
    foreach(range($page,$len) as $p) 
      if($p == $page) {
        echo  ' <div class="pagination2">
                                      
              <a class="active" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      } else {
        echo ' <div class="pagination2">
                                      
              <a class="" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      }
    if($len > 4 && $len -5 > 5 && $page >= 5 && $page <= $len-4)
    foreach(range($page-2,$page+2) as $p) 
      if($p == $page) {
        echo  ' <div class="pagination2">
                                      
              <a class="active" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      } else {
        echo ' <div class="pagination2">
                                      
              <a class="" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      }

    if($len > 4 && $len -5 >= 5 && $page > $len-4)
    foreach(range($len-4,$len) as $p) 
      if($p == $page) {
        echo  ' <div class="pagination2">
                                      
              <a class="active" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      } else {
        echo ' <div class="pagination2">
                                      
              <a class="" href="question.php?id='.$pagq.'?page='.$p.'">'.$p.'</a>
              
              </div>';
      }
  }



  /**
   * Giving $data every data from $_POST
   */
  $data = $_POST;
  if(isset($_SESSION['logged_user'])) {
	$author = $_SESSION['logged_user'];
  }
  /**
   * Writing answer data to our database with some conditions
   * @package database
   */
  if (isset($data['doanswer']) )
  {
	/**
     * We have array with errors to show error on the page if at least one exists
     */
    $errors = array();
    
    if(trim($data['content']) == '')
    {
      $errors[] = 'Type your answer';
    }
    if(trim($data['content']) > 400)
    {
      $errors[] = 'Your answer is too long. Max length is 200';
    }
    
		/**
       * Writing to database
       * Using htmlspecialchars and strip_tags functions to avoid XSS attacks
       */
    if (empty($errors))
    {
      $content = htmlspecialchars(trim($data['content']));
      $content = strip_tags($content);

      $comment = R::dispense('comments');
      $comment->author = $author['name'];
      $comment->lastname = $author['lastname'];
      $comment->email = $author['email'];
      $comment->text = $content;
      $comment->date = date("d/m/Y H:i:s");
      $comment->pageid = $pag;
      R::store($comment);
      header('Location: question.php?id='.$pag.'?page=1');
    }
  }    
  /**
  * Removing from database
  * $del for answer delete
  * $del2 for question delete
  */
  $del = mb_ereg_match(".*?del=", $_SERVER['REQUEST_URI']);
  if ($del == true) {
    $id = strstr($_SERVER['REQUEST_URI'],"?del=");
    $id = mysqli_real_escape_string($connect, trim($id,"?del="));
    if(ctype_digit($id) === false) { 
      exit("Wrong get request");
    } else {
      $delete = "DELETE FROM comments WHERE id=$id";
      mysqli_query($connect, $delete) or die('Error querying database.');
      header('Location: question.php?id='.$pag.'?page='.$page.'');
    }
    
  }
  $del2 = mb_ereg_match(".*?del2=", $_SERVER['REQUEST_URI']);
  if ($del2 == true) {
    $id2 = strstr($_SERVER['REQUEST_URI'],"?del2=");
    $id2 = mysqli_real_escape_string($connect, trim($id2,"?del2="));
    if(ctype_digit($id2) === false) { 
      exit("Wrong get request");
    } else {
    $delete2 = "DELETE FROM posts1 WHERE id=$id2";
    mysqli_query($connect, $delete2) or die('Error querying database.');
    $delete = "DELETE FROM comments WHERE pageid=$id2";
    mysqli_query($connect, $delete) or die('Error querying database.');
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
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Question</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <?php
        echo $selectedStyles;
    ?>
    <script defer src='js_validation/answer.js'></script>
</head>

<body id="questionpage">
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
        
        <?php 
		
		while($article = mysqli_fetch_assoc($query)) { ?>
          
         <!-- Jumbotron -->
            <div class='mt-4 pt-4 container' id='ques'>
            <div class=" pt-4 jumbotron text-center" id='ques1'>

            <!-- Title -->
            <h4 class="card-title text-white h4 pb-2"><strong>Question #<?= $article['id']; ?></strong></h4>
            <?php //echo $_GET['page']; ?>
            <!-- Card image -->
            <div class="mt-4" >
              <img src="pics/question-mark.jpg" class="img-fluid" id='pikcha' alt="">
              <a href="#">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <h2 class="text-warning h2 my-4" id='article'><?=$article['title']?></h2>

            <p class="font-weight-light text-white h5 pb-0" id='content'><?=$article['text']?></p>
            <hr>
            <p class="d-inline text-white h6">Author:</p><p class='d-inline text-warning h6'> <?=$article['author']?> <?= $article['lastname']?></p>
            <?php if (isset($_SESSION['logged_user'])) { ?>
                  <?php 
				  /**
				  * If user is logged in and has admin status(1), shows delete button to delete from database
				  */
				  if ($_SESSION['logged_user']['role'] == 1) { ?>
                    <p><a class='btn btn-danger mt-4' href="question.php?id=<?=$pag?>?page=<?=$page?>?del2=<?=$article['id']?>">delete</a></p>
                  <?php } 
				  /**
				  * If user is logged in, shows delete button only if it is a current user question
				  */
				  else { 
                    if ($article['email'] == $_SESSION['logged_user']['email']) { ?>
                    <p><a class='btn btn-danger mt-4' href="question.php?id=<?=$pag?>?page=<?=$page?>?del2=<?=$article['id']?>">delete</a></p>
                  
                <?php } } } ?>
            

          
            </div>
            
          
          
        <?php } ?>  
        
       <!-- Comment box --> 
          
        <div class="container mb-4 pb-2">
                    
         
          <form class="text-center p-4" id="ques2" method ="post">
          
              <p class="h5 text-white">Do you have an answer?</p>
              <div class="md-form">
                  
                  <input type="hidden" value="" name = "session_username"><i class="fa fa-ij prefix text-white"></i>
                  <textarea class="md-textarea text-white" id="form9" rows="1"
                  placeholder="Write your answer here (Keep it simple and clear)" name="content" required  ></textarea>
                  <label for="form9"> </label>
                  <span class='text-danger' id='error5'> </span>
              </div>
                  
           
              
              <?php if (isset($_SESSION['logged_user'])) : ?>
              <?php 
			  /**
			  * Showing error if at least one exists
			  * Otherwise shows answer button
			  */
			  if(empty($errors)) {} else {?>
                  <span class="error h6" id='span1'><?php echo array_shift($errors) ?><br></span>
              <?php } ?>
             
              <button class="btn btn-warning my-2" type="submit" name='doanswer'>Answer</button>
              <?php else : ?>
              <p class="error h6" id="span1">You cannot post answers if you are not logged in</p>
              <?php endif; ?>  
          
              <br>              
          </form>
      </div>
      </div>
    <!--answers-->   
    <div class="container">
      <div id="ques3">
        <h2 class="pl-4 pt-4 text-white">Answers</h2>
       
        
        
        <?php 
		/**
		* If no answers, shows 'No answers yet'
		*/
		if(mysqli_num_rows($answer) == 0) { ?>
              <ul>
                <li>
                  <div class="text-muted h5 my-4 pb-4">
                    
                    No answers yet
                  </div>
                </li>  
              </ul>
        <?php  }  ?>

        <?php 
		/**
		* If at least one answer exists, showing it on the page
		*/
		while($com = mysqli_fetch_assoc($answer)) { ?>
          
         
        <ul class="text-white comments-list">
          <li>
            <div class="text-muted comment-main-level">
                            
              <div class="comment-box">
                            
                <div class="comment-head">
                                <div class="d-inline comment-avatar"><img src="pics/person.png" height="50" width="50" alt=""></div>
                  <h6 class="d-inline text-warning comment-name by-author"><?=$com['author']?> <?=$com['lastname']?></h6>					
                            </div>
                            <span><?=$com['date']?></span>
                <i class="fa fa-reply"></i>

                <?php if (isset($_SESSION['logged_user'])) { ?>
                  <?php 
				  /**
				  * If user is logged in and has admin status(1), shows delete button to delete from database
				  */
				  if ($_SESSION['logged_user']['role'] == 1) { ?>
                  <a class='text-danger' href="question.php?id=<?=$pag?>?page=<?=$page?>?del=<?=$com['id']?>">&#8195 delete</a>
                  <?php } else { 
                    
					/**
				    * If user is logged in, shows delete button only if it is a current user answer
				    */
					if ($com['email'] == $_SESSION['logged_user']['email']) { ?>
                    <a class='text-danger' href="question.php?id=<?=$pag?>?page=<?=$page?>?del=<?=$com['id']?>">&#8195 delete</a>
                  
                <?php } } } ?>
                    
               
                            
                <div class="text-white pr-4 comment-content">
                  <?= $com['text']?>
                </div>
                <hr>
              </div>
            </div>
            </li> 
          </ul> 
          <?php } ?>
        
          <?php if(mysqli_num_rows($answer) == 0) {} else { ?>
            
              <div class='text-center'>
                <div>
              <?php pagination($len,$page); ?>
                </div>
          </div>    
          <?php } ?>

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
