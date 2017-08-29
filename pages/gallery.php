<div class="container">
	<div class="row">
		<?php
			$folder = 'images/galleries';
			$dir = opendir($folder);//фция опендир открывает папку, и в переменную записывается путь к открытой папке
			$images = [];//пустой массив, чтобы узнать кол-во изображений
			while(($f = readdir($dir)) !==false){
				//echo filetype($folder.'/'.$f).'<br>';//filetype - возвращает тип файла (dir-папка или file-файл)
				if($f!='.' && $f!='..' && filetype($folder.'/'.$f)!='dir'){//чтобы не выводил точку и две точки как системные штуки, которые есть всегда. а также чтобы не выводил папки
					//echo '<img src="'.$folder.'/'.$f.'" class="img-responsive"><br>';
					$images[] = $folder.'/'.$f;
				}
			}
			//readdir - считывает текущий файл, возвращает его название, и перемещаетя на следуюющий файл. Когда дойдет до конца вернет false. Поэтому в условии пишем, что делай, пока не получишь false.
			closedir($dir);//обязательно закрывать папку после завершения с ней работы
		?>
		<!-- -->

		<?php
			if ($gallery_array = scandir($folder)) {
				foreach ($gallery_array as $key => $value) {
					if ($value != "." && $value != ".."){
		?>
						<h1 class="text-center" style="color: #475368;">Галерея "<?= $value ?>"</h1>
						<div class="slider">
		<?php
						if ($picture = scandir($folder.'/'.$value)) {
							foreach ($picture as $key2 => $value2){
								if ($value2 != "." && $value2 != ".."){
									// echo '<pre>'.print_r($value2).'</pre>';
		?>
									 

									<!-- <div class="slider"> -->
										<img src="<?= $folder.'/'.$value.'/'.$value2 ?>" alt="">
									<!-- </div> -->

		<?php
								}
							}
						}
		?>
						</div>
						<br>
		<?php
					}
				}
			}
		?>

	</div>

</div>