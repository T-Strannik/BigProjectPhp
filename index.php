<?php require_once 'header.php'; ?>
<!-- //это проект, в котором мы всегда будем находится на странице index.php, а перемещатся между страницами с помощью GET-параметра -->
<!-- <div class="jumbotron">Lorem ipsum dolor sit amet.</div> используем этот класс из бутрапа для проверки подключения -->
<?php
	$page = isset($_GET['page'])?$_GET['page']:'';
	switch($page){
		case 'main':
		case '': //два кейс подряд, чтобы подключалось и при клике на хоум и только при загрузке
			require_once 'pages/main.php';
			break;
		case 'gallery':
			require_once 'pages/gallery.php';
			break;
		case 'guest-book':
			require_once 'pages/guest-book.php';
			break;
		case 'create_gallery':
			require_once 'pages/create_gallery.php';
			break;
		case 'upload-images':
			require_once 'pages/upload-images.php';
			break;
		case 'sign-up':
			require_once 'pages/sign-up.php';
			break;
		case 'login':
			require_once 'pages/login.php';
			break;
		default:
			require_once 'pages/404.php';
			break;
	}
?>



<?php require_once 'footer.php'; ?>