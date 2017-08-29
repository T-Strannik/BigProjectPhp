<?php
	header('Content-type: image/jpg'); //задали каким будет тип файла
	$image = imagecreatetruecolor(80, 60);
	imagefill($image, 0, 0, 0xff9900); //заливка цветом(что заливаем, корд х и у начала завлики. цвет начинается с 0х...)
	imageellipse($image, 40, 30, 50, 50, 0xffffff); //рисует круг/элипс
	imagefilledellipse($image, 30, 20, 10, 10, 0xffffff); //заливка цветом элипса
	imagefilledellipse($image, 50, 20, 10, 10, 0xffffff); //заливка цветом элипса
	imageline($image, 40, 30, 40, 40, 0xffffff);//линия
	imagearc($image, 40, 30, 40, 40, 30, 90, 0xffffff); //дуга




	imagejpeg($image); // ф-ция imagejpeg выводит сгенерированную картинкую Если указываем только один парамер то выводится сразу. А если будет ставить два параметра, то изображение выводится не будет, а будет сохраятся по указанному пути. imagejpeg($image, 'images/1.jpg');
	imagedestroy($image); //освобождаем память выделенную под изображение
?>