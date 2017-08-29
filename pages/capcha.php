<?php
	header('Content-type: image/jpg'); //задали каким будет тип файла
	$image = imagecreatetruecolor(120, 40);

	//imagestring($image, 4, 10, 10, 'hello', 0xffffff); // ф-ция для вывода текста на изображение (файл, размер теста, координаты, текст, цвет). Размер шрифта от 1 до 7. Плохо регулируется парметры шрифта, не спользовать.

	imagefill($image, 0, 0, 0xffffff);
	for($i=0; $i<1000; $i++){
		imagesetpixel($image, rand(0, 120), rand(0, 40), 0xcccccc);
	}

	$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    $len = strlen($letters);

    $word = '';

    for($i=0; $i<2; $i++){
	    $letter = $letters[rand(0, $len - 1)];
    	imagettftext($image, 20, rand(-15, 15), 20+$i*15, 30, 0x000000, '../fonts/arial.ttf', $letter);
    	$word.=$letter; //$word.$letter=$letter; конкатенация в строку.
    }
    session_start(); //пишем каждый раз когда надо что-то записать в сессию
    $_SESSION['capcha'] = $word;


	
	
	imagejpeg($image); // ф-ция imagejpeg выводит сгенерированную картинкую Если указываем только один парамер то выводится сразу. А если будет ставить два параметра, то изображение выводится не будет, а будет сохраятся по указанному пути. imagejpeg($image, 'images/1.jpg');
	imagedestroy($image); //освобождаем память выделенную под изображение
?>