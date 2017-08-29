
<div class="container">
	<div class="row">
		<h1 class="text-center text-primary">Вход</h1>
		<div class="col-sm-6 col-sm-offset-3">

			<?php show_message(); ?>

			<form action="<?php echo $_SERVER ['PHP-SELF']?>?page=login" method="POST" name="login">
				<div class="form-group">
				    <label for="email">e-mail:</label>
				    <input type="email" class="form-control" id="email" name="email">
				</div>
				
				<div class="form-group">
				    <label for="pwd">Пароль:</label>
				    <input type="password" class="form-control" id="pwd" name="pwd"></input>
				</div>

				<img src="pages/capcha.php" alt="">
				<div class="form-group">
				    <label for="cap">Введите капчу:</label>
				    <input type="text" class="form-control" id="cap" name="cap"></input>
				</div>

				<button type="submit" class="btn btn-default" name="login-btn">Войти</button>

			</form>
		</div>
	</div>
</div>	

<!-- Генерирование изображений на php. Не имеет отношение к проекту -->
<!-- <img src="pages/example.php" alt=""> -->
