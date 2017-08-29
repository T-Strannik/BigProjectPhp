<div class="container">
	<div class="row">
		<h1 class="text-center text-primary">Создание галлереи</h1>
		<?php
			$folder_gall = 'images/galleries';

		?>

		<div class="col-sm-4">
			<form action="<?php echo $_SERVER ['PHP-SELF']?>?page=create_gallery" method="POST">
				<div class="form-group">
	    			<label for="new_gall">Введите название новой галлереии: </label>
	    			<input type="text" class="form-control" id="new_gall" name="new_gall">
  				</div>
  				<button type="submit" class="btn btn-default" name="button">Отправить</button>
			</form>
			<br>

			<?php
				if(!file_exists($folder_gall.'/'.$_POST['new_gall'])){
					mkdir($folder_gall.'/'.$_POST['new_gall']);
					echo '<b style="color: green;"> Галлерея "'.$_POST['new_gall'].'" успешно создана! </b>';
				}
				else{
					echo '<b style="color: red;">"'.$_POST['new_gall'].'" - такая галлерея уже есть! </b>';
				}
			?>
		</div>

		<div class="col-sm-8">
			<p>Существующие галлереии: </p>

			<?php
				if ($open = scandir($folder_gall)){
    				foreach ($open as $k => $v){
        				if ($v != "." && $v != ".."){
            				echo $v.'<br>';
        				}
    				}
				}
			?>
			
		</div>
	</div>
</div>