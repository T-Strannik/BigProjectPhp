<?php
	if(isset($_POST['button'])){
		// cropImg(); //придуманная ф-ция (Закоментили когда начали делать плагин джквери), Чтобы обрезать 70пх и 200пх так все работает и ниже ничего не надо
		$img = showImg();
	}

	if(isset($_POST['crop-btn'])){
		cropJsImage();
		registration();//ф-ция регистрации в functions.php
	}
?>

<div class="container">
	<div class="row">
		<h1 class="text-center text-primary">Регистрация</h1>
		<div class="col-sm-6 col-sm-offset-3">
		<?php show_message(); ?>
			<form action="<?php echo $_SERVER ['PHP-SELF']?>?page=sign-up" method="POST" enctype="multipart/form-data" name="signup">

				<div class="form-group">
	    			<label for="user">Имя:</label>
	    			<input type="text" class="form-control" id="user" name="name">
  				</div>

				<div class="form-group">
				    <label for="email">e-mail:</label>
				    <input type="email" class="form-control" id="email" name="email">
				</div>
				
				<div class="form-group">
				    <label for="pwd">Пароль:</label>
				    <input type="password" class="form-control" id="pwd" name="pwd"></input>
				</div>

				<div class="form-group">
				    <label for="rpwd">Подтвердите пароль:</label>
				    <input type="password" class="form-control" id="rpwd" name="rpwd"></input>
				</div>

				<div class="form-group">
				    <label for="ava">Выберите фото:</label>
				    <input type="file" class="form-control" id="ava" name="ava"></input>
				</div>

				<button type="submit" class="btn btn-default" name="button">Зарегистрироваться</button>

			</form>

			<?php
				if(isset($img)){
					echo "<img src='avatars/$img' id='target'>";
					?>
					<form action="<?php echo $_SERVER ['PHP-SELF']?>?page=sign-up" method="POST">
						<input type="hidden" name="name" value="<?=$_POST['name'] ?>">
						<input type="hidden" name="email" value="<?=$_POST['email'] ?>">
						<input type="hidden" name="pwd" value="<?=$_POST['pwd'] ?>">
						<!-- эти три скрытые инпута берутся из первой формы, чтобы при отправки второй формы, передавались данные и первой  -->
						
						<input type="hidden" name="x">
						<input type="hidden" name="y">
						<input type="hidden" name="w">
						<input type="hidden" name="h">
						<input type="hidden" name="file" value="<?php echo $img ?>">
						<input type="submit" name="crop-btn">
						
					</form>

					<?php
				}
			?>
		</div>
	</div>
</div>