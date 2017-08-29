<?php require_once 'config.php';?>
<?php require_once 'functions.php';?>
<?php
  session_start();//при записи и выводе из сессии, необходимо ее открывать
  //echo $_SESSION['user'];//пишем сюда чтобы отображалось на каждой странице
  if(isset($_POST['login-btn'])){
    if(login()) exit; //exit - останавливает выполнение всего дальнейшего кода
  }
  
  if($_GET['page']=='logout'){
    unset($_SESSION['user']);//ф-ция удаления чего либо -  переменные, массивы, элементы массива
    unset($_SESSION['ava']);//ф-ция удаления чего либо -  переменные, массивы, элементы массива
    //никогда не удаляем сам массив $_SESSION! иначе он перестанет существовать, и мы не сможем ничего туда записать
    header('Location: index.php'); //ф-ция php перенаправления на какую-либо страницу

  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery.Jcrop.min.css">
  <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
  <style>
    /*body{
      background: #475368;
    }*/
  </style>
</head>
<body>
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
       			<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
      			</button>
      			<a class="navbar-brand" href="#">WebSiteName</a>
   			</div>
    		<div class="collapse navbar-collapse" id="myNavbar">
     			<ul class="nav navbar-nav">
       				<?php foreach($menu as $text => $link): 
						    $active = ($_GET['page']==$link || (!isset($_GET['page']) && $text=='Home'))?'class="active"':'';?>
        				<li <?=$active?>><a href="index.php?page=<?=$link?>"><?=$text?></a></li>
        			<?php endforeach; ?>
      			</ul>
      			<ul class="nav navbar-nav navbar-right">
              <?php
                if(!isset($_SESSION['user'])): ?> <!-- проверяет зареган пользователь или нет -->
       				     <li><a href="index.php?page=sign-up"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        			     <li><a href="index.php?page=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              <?php
                else: ?>
                  <li><a href="#">Hello, <?=$_SESSION['user'] ?> <img src="avatars/100_<?= $_SESSION['ava']?>" alt="" style="height: 25px"></a></li>
                  <li><a href="index.php?page=logout"><span class="glyphicon glyphicon-log-out"></span> LogOut</a></li>

              <?php
                endif; ?>

      			</ul>
    		</div>
  		</div>
	</nav> 
	
