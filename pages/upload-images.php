<?php
	//show($_FILES); //глабальный масив files содержит загруженные изображения

	if(isset($_POST['upload-img'])){
		uploadUserFile();
	}

	$folder_gall = 'images/galleries';


?>

<div class="container">
	<div class="row">
		<h1 class="text-center text-primary">Загрузка изображений</h1>
		<!--<?php if(isset($error)): ?> 
			<div class="alert alert-danger">
				<?=$error ?> 
			</div>
		<?php endif ?>

		<?php if(isset($success)): ?>
			<div class="alert alert-success"><?=$success?></div>
		<?php endif ?>-->

		<form action="<?php echo $_SERVER ['PHP-SELF']?>?page=upload-images" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="user-file">Выберите изображение:</label>
				<input type="file" name="user-file" id="user-file">
			</div>

			<select name="select_gallery" id="select_gallery">
				

				<?php
					if ($open = scandir($folder_gall)){
	    				foreach ($open as $k => $v){
	        				if ($v != "." && $v != ".."){
	            				echo '<option value="'.$v.'">'.$v.'</option>';
	        				}
	    				}
					}
				?>
				
			</select>

			<input type="submit" class="btn btn-primary" name="upload-img">
		</form>
	</div>
</div>