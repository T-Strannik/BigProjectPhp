<?php
	function show ($arr) {
		echo '<pre>'.print_r($arr, true).'</pre>';
	}

	function uploadUserFile (){

		global $success;
		global $error;

		$folder_gall = 'images/galleries';

		$f = isset($_FILES['user-file'])?$_FILES['user-file']:'';
		if($f==''){
			$error = 'Нет информации о файле';
		}
		else{ 
			if($f['error']!=0){
				$error = 'Ошибка загрузки файла';
				/*0 - нет ошибок
				1 - размер файла превышает допустимый размер заданный в php.ini
				2 - размер файла превышает значение MAX_FILE_SIZE
				3 - файл загружен частично
				4 - файл не загружен*/
				}
			else{
				$arrMime = ['image/png', 'image/jpeg', 'image/gif']; //допустимые типы файлов (форматы изображений)
				if(!in_array($f['type'], $arrMime)){
					$error = 'Недопустимый тип файла';
				}
				else{
					$arrExt = ['jpg', 'png', 'gif', 'jpeg'];
					$dot = strrpos($f['name'], '.');//ищет что-то в строке с конца
					$ext = strtolower(substr($f['name'], $dot+1));//возвращает часть строки с заданной позиции
					if(!in_array($ext, $arrExt)){
						$error = 'Недопустимое расширение файла';
					}
					else{
						// $folder = 'images'; //- было до того как начал загружать картинки по альбомам
						// if ($open = scandir($folder_gall)){
						// 	foreach ($open as $k => $v){
      //   						if ($v != "." && $v != ".."){
      //       						$folder = $v;
      //       					}
      //   					}
      //   				}
						$folder = $_POST['select_gallery'];
      					echo $folder;
      					echo 'fjhvkjdfhvk';
      					if(!file_exists($folder_gall.'/'.$folder))//файл_эксист - фция для проверки существования файлов/папок
    					{mkdir($folder_gall.'/'.$folder);//ф-ция для создания папок
						}
						
						if(!move_uploaded_file($f['tmp_name'], $folder_gall.'/'.$folder.'/'.$f['name']))//move_up_file-перемещение загруженного файла из временной папки(temp_name) в папку (в данном случае в корень, можно прописать ему путь 'images/'.$f['name']). time()-сколько секунд прошло с 1января1970г, rand(0.100) - случайное число от 0 до 100
						{
							$error = 'Ошибка перемещения файла';
						}
						else{
							$success = 'Файл успешно загружен';
						}
					}
				}
			}
		}
	}

	function uploadFile($folderName, $file){

		// global $success; - вместо этого создаем отдельную функцию show_message
		// global $error; - вместо этого создаем отдельную функцию show_message

		$f = isset($file)?$file:'';
		if($f==''){
			set_message('error', 'Нет информации о файле');
		}
		else{ 
			if($f['error']!=0){
				set_message('error', 'Ошибка загрузки файла');
				/*0 - нет ошибок
				1 - размер файла превышает допустимый размер заданный в php.ini
				2 - размер файла превышает значение MAX_FILE_SIZE
				3 - файл загружен частично
				4 - файл не загружен*/
				}
			else{
				$arrMime = ['image/png', 'image/jpeg', 'image/gif']; //допустимые типы файлов (форматы изображений)
				if(!in_array($f['type'], $arrMime)){
					set_message('error', 'Недопустимый тип файла');
				}					
				else{
					$arrExt = ['jpg', 'png', 'gif', 'jpeg'];
					$dot = strrpos($f['name'], '.');//ищет что-то в строке с конца??? или нет
					$ext = strtolower(substr($f['name'], $dot+1));//возвращает часть строки с заданной позиции
					if(!in_array($ext, $arrExt)){
						set_message('error', 'Недопустимое расширение файла');
					}
					else{
						$folder = $folderName;
						if(!file_exists($folder))//файл_эксист - фция для проверки существования файлов/папок
							{mkdir($folder);//ф-ция для создания папок
							}

						$filename = time().'-'.rand(0,100).'-'.$f['name'];

						if(!move_uploaded_file($f['tmp_name'], $folder.'/'.$filename))//move_up_file-перемещение загруженного файла из временной папки(temp_name) в папку (в данном случае в корень, можно прописать ему путь 'images/'.$f['name']). time()-сколько секунд прошло с 1января1970г, rand(0.100) - случайное число от 0 до 100
						{	
							set_message('error', 'Ошибка перемещения файла');
						}
						else{
							set_message('succes', 'Файл успешно загружен!');
							return $filename;
						}
					}
				}
			}
		}
	}

	function cropImg(){
		$f = uploadFile('avatars', $_FILES['ava']);
		//echo $f; получили путь к файлу

		//Обрезка фото
		$src = imagecreatefromjpeg("avatars/$f");//ф-ция создает изображение на основе пути к файлу
		$w_src = imagesx($src);//узнаем ширину ибображеня
		$h_src = imagesy($src);//узнаем высоту изображения

		//Обрезка фото авы до 70х70
		$w = 70;
		$dest = imagecreatetruecolor($w, $w);//ф-ция для создания нового изображения. Получили пустую квадратную картинку

		if($w_src>$h_src){
			imagecopyresized($dest, $src, 0, 0, ($w_src-$h_src)/2, 0, $w, $w, $h_src, $h_src);//ф-ция !!сюда запиши все что в скобках все что значит!!!! Для горизонтального jpg
		}
		elseif($h_src.$w_src){ //в пхп можно писать elseif вместе, хрен его почему
				imagecopyresized($dest, $src, 0, 0, 0, ($h_src - $w_src)/2, $w, $w, $w_src, $w_src); //Для вертикального jpg
			}
			else{
				imagecopyresized($dest, $src, 0, 0, 0, 0, $w, $w, $w_src, $h_src); //просто уменьшаем до максимальной стороны в 70px
			}


		//Пропорционально уменьшаем width=200, height=auto
		$w = 200;
		$ratio = $w_src/$w;
		$w_dest = $w_src/$ratio;
		$h_dest = $h_src/$ratio;
		$dest2 = imagecreatetruecolor($w_dest, $h_dest);
		imagecopyresized($dest2, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);



		imagejpeg($dest, "avatars/70_$f", 100);//ф-ция сохраняет изображение, какое и куда (сохранили изображение $dest с новым именем). 3й парам - качество сохраняемого изображения в %
		imagejpeg($dest2, "avatars/200_$f", 100);

		imagedestroy($src);//очищаем оперативную память обяазательно!
		imagedestroy($dest);
		imagedestroy($dest2);//очищаем оперативную память обяазательно!
	}

	function showImg(){
		$f = uploadFile('avatars', $_FILES['ava']);
		// return "<img src='avatars/$f' id='target'>"; для обрезки вручную
		return $f;//для обрезки плагином
	}

	function cropJsImage(){
		$f = $_POST['file'];//какой файл обрезать
		$src = imagecreatefromjpeg("avatars/$f");
		$w_src = imagesx($src);
		$h_src = imagesy($src);
		$w = 100;
		$dest = imagecreatetruecolor($w, $w);
		imagecopyresized($dest, $src, 0, 0, $_POST['x'], $_POST['y'], $w, $w, $_POST['w'], $_POST['h']);
		imagejpeg($dest, "avatars/100_$f", 100);
		imagedestroy($src);
		imagedestroy($dest);

	}

	function registration (){
		$email = strip_tags(trim($_POST['email']));
		$login = strip_tags(trim($_POST['name']));
		$password = strip_tags(trim($_POST['pwd']));
		$file = strip_tags(trim($_POST['file']));

		if($email!='' && $login!='' && $password!='' && file!=''){
			if(file_exists('user.txt')){
				$f = fopen('user.txt', 'r');
				$lines = file('user.txt');
				for ($i=0; $i<count($lines); $i++) {
					$data = explode('|', $lines[$i]);
					if($data[0] == $email){
						set_message('error', 'Такой email уже существует');
						fclose($f);
						return;
					}
				}
			}
			$f = fopen('user.txt', 'a');
			fputs($f, "$email|$login|$password|$file\r\n");
			fclose($f);
			set_message('succes', 'Congratulations!');
		}
	}

	function login(){

		$email = strip_tags(trim($_POST['email']));
		$password = strip_tags(trim($_POST['pwd']));
		$cap = strip_tags(trim($_POST['cap']));
		if($cap != $_SESSION['capcha']){
			set_message('error', 'Bad capcha');
			return false;
		}

		if(file_exists('user.txt')){
			$f = fopen('user.txt', 'r');
			$lines = file('user.txt');
			for($i=0; $i<count($lines); $i++){
				$data = explode('|', $lines[$i]);
				if($data[0]==$email && $data[2]==$password){
					//session_start();//запуск сессии - будет ошибка, чтобы не было ошибки, запускаем сессию в самом верху в файле header.php
					$_SESSION['user'] = $data[1];//глобальный ассоциативный массив [придуманное имя сессии]
					$_SESSION['ava'] = $data[3];
					
					set_message('succes', 'Hello!');

    				header('Location: index.php'); //ф-ция php перенаправления на какую-либо страницу
    				return true;//return возвращает значение, и останавливает выполнение ф-ции
				}
			}
		}
		// return 'Error!';
		set_message('error', 'Неверный логин или пароль!');
		return false;

	}

	function show_message(){
		if(isset($_SESSION['error'])): ?> 
			<div class="alert alert-danger">
				<?= $_SESSION['error'] ?> 
			</div>
			<?php 
			unset( $_SESSION['error'] );
		endif ?>

		<?php if(isset($_SESSION['succes'])): ?>
			<div class="alert alert-success">
				<?=$_SESSION['succes']?>
			</div>
			<?php 
			unset( $_SESSION['succes']);
		endif;
	}

	function set_message($type, $mess){
		$_SESSION[$type] = $mess;
	}