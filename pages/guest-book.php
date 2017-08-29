<?php
	if(isset($_POST['button'])){
		$email = isset($_POST['email'])?strip_tags($_POST['email']):'';
		$user = isset($_POST['user'])?strip_tags($_POST['user']):'';
		$message = isset($_POST['message'])?strip_tags($_POST['message']):'';
		if($email!='' && $user!='' && $message!=''){
			$f = fopen('guest.txt', 'a');//функция которя открывает файл, 1й парам - путь к файлу и его название, 2й парметр - режим открытия файла (r - режим предназначен только для чтения файла, если файл не найдет, то вернется False) (r+ - чтение/запись. Если файл не найден, возвращается false. Запись происходит в начало файла, и перезаписывает уже имеющиеся парметры) (a - запись в конец файла, если файл не найден, он создается) (а+ - запись/чтение, запись в конец файла, если файл не найден, он создается) (w - запись, при этом режиме открытия очищается все содержимое файла, если файл не найден, то он создается). 
			//чаще всего используется w и a
			//$f - указатель на файл (что это??)
			//var_dump($f);//смотрим что находится в файле
			fwrite($f, "$email|$user|$message|".time()."\r\n"); //ф-ция записи в файл, 1й парм - куда записывам, 2й парм - что записываем. Чтобы записы была с новой строки, то ставим двойные кавычки и пишем после того что нужно записать \r\n.
			//fputs($f, "2\r\n"); //точто такая же функция как и fwrite
			fclose($f); //сразу закрытие файла
		}
	}
?>
<div class="container">
	<div class="row">
		<h1 class="text-center text-primary">Гостевая книга</h1>
		<div class="col-sm-4">
			<form action="<?php echo $_SERVER ['PHP-SELF']?>?page=guest-book" method="POST">

				<div class="form-group">
	    			<label for="user">Имя:</label>
	    			<input type="text" class="form-control" id="user" name="user">
  				</div>

				<div class="form-group">
				    <label for="pwd">e-mail:</label>
				    <input type="email" class="form-control" id="email" name="email">
				</div>
				
				<div class="form-group">
				    <label for="pwd">Комментарий:</label>
				    <textarea class="form-control" id="pwd" name="message" id="msg"></textarea>
				</div>

				<button type="submit" class="btn btn-default" name="button">Отправить</button>

			</form>
		</div>

		<div class="col-sm-8">
			<?php
				if(!file_exists('guest.txt')){
					echo '<p>Сообщений нет</p>';
				}
				else{
					$f = fopen('guest.txt', 'r');
					/*while(!feof($f)){ //feof - ф-ция которая проверяет где находится указатель в файле. Возвращает false когда находится в конце файла
						$line = fgets($f);
						echo $line;
					}*/
					/*$data = fread($f, filesize('guest.txt'));//fread - считывает указанную длинну файла. 1-указатель на файл, 2парам - длинна считываемых символов в байтах //filesize - возвращает размер файла в байтах, нужно чтобы считать сразу весь файл
					echo $data;*/
					/*$data = file_get_contents('guest.txt')//ф-ция для считывания файла построчно;
					echo $data;*/
					$lines = file('guest.txt'); //file() - читает содержимое файла и помещает его в массив
					//echo '<pre>'.print_r($lines).'</pre>';
					//echo count($lines);
					$five = 5; //количество отзывов на одной странице
					$p=isset($_GET['p'])?$_GET['p']:'1';
					$pagination_pages = ceil(count($lines)/$five); //Сколько требуется страниц. ceil - окргуление в большую сторону.
					// echo '/index.php?page='.$page;
					$this_page = '/index.php?page='.$page;
					// echo $this_page;
					// echo $pagination_pages;

					// echo '<pre>'.print_r($lines).'</pre>';

					$separ = array_chunk($lines, 5);

					// echo '<pre>'.print_r($separ).'</pre> <br>'; //!!!!!!!!!!





					//for($i=0; $i<count($lines) - (count($lines)-$five); $i++){ //count - Принимает в качестве фактического параметра массив и возвращает количество непустых элементов в массиве
					
					for($i=($p-1)*5; $i<($p-1)*5+$five; $i++){
						$data = explode('|', $lines[$i]); //explode - Разбивает строку с помощью разделителя
						// print_r($data);
						// print_r($lines);
			?>
						<div class="panel panel-default">
  							<div class="panel-heading"><?= $data[1] ?> (<?= $data[0] ?>)
								<!-- <div class="pull-right"><?= date('d.m.Y G:i', $data[3]) ?></div> -->
  							</div>
  							<div class="panel-body"><?= $data[2] ?></div>
						</div>
			<?php
					}
					
					// show($lines);
					fclose($f);
				}
			?>
						<div style="text-align: center;">
							<a href="<?= $this_page ?>&p=<?=$p-1?>"><<</a>
			<?php
							for($p=1; $p<=$pagination_pages; $p++){
			?>
								<a href="<?= $this_page?>&p=<?=$p?>"><?=$p?></a>
			<?php
							}
							$p=isset($_GET['p'])?$_GET['p']:'1'; //опять перезаписал переменную $p, или по другому каждый раз после цикла будет выводится 8 страница $p=8

			?>
							<a href="<?= $this_page ?>&p=<?=$p+1?>">>></a>
						</div>
			
			
		</div>
	</div>
</div>