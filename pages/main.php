<?php show_message();


?>



<div class="container">
	<div class="row">
		
		<div class="col-sm-6">
			<h1 class="text-center text-primary">Голосование</h1>
			<p>Выберите цвет: </p>
			<form action="<?php echo $_SERVER ['PHP-SELF']?>?page=main" method="POST">
				<input type="radio" name="golos" value="red"> Красный <br>
				<input type="radio" name="golos" value="blue"> Синий <br>
				<input type="radio" name="golos" value="green"> Зеленый <br><br>
				<button type="submit" class="btn btn-default" name="voting">Проголосовать</button>

			</form>
		</div>

		<div class="col-sm-6">
			<h1 class="text-center text-primary">Результаты голосования</h1>
			<?php
				
				if($_POST['golos'] == 'red')
				{
					$red='Красный';
					echo 'Вы выбрали "'.$red.'"<br><br>';
					$f = fopen('golos.txt', 'a');
					fwrite($f, "$red"."\r\n");
					fclose($f);
					
				}
				else if($_POST['golos'] == 'blue')
				{
					$blue='Синий';
					echo 'Вы выбрали "'.$blue.'"<br><br>';
					$f = fopen('golos.txt', 'a');
					fwrite($f, "$blue"."\r\n");
					fclose($f);
				
				}
				else if($_POST['golos'] == 'green')
				{
					$green='Зеленый';
					echo 'Вы выбрали "'.$green.'"<br><br>';
					$f = fopen('golos.txt', 'a');
					fwrite($f, "$green"."\r\n");
					fclose($f);
				
				}	
				else
				{
					echo '<p style="color: red;" > Выберите цвет! </p>';
				}	
				
				$count_elem = file('golos.txt');//file()-Читает содержимое файла и помещает его в массив
				// echo '<pre>'.print_r($count_elem, true).'</pre>';

				$rez = array_count_values($count_elem);
				// echo '<pre>'.print_r($rez, true).'</pre>';

				reset($rez);
				$first_red = current($rez);
				$second_blue = next($rez);
				$third_green = next($rez);

				// узнаем процент ответов
				// 1 - узнаем сумму всех ответов
				$summa = $first_red+$second_blue+$third_green;
				//echo 'Сумма всех ответов '.$summa.'<br>';
				// 2 - узнаем множитель
				$mnozh = 100/$summa;
				//echo 'Множитель '.$mnozh.'<br>';

				$percent_red = round($first_red*$mnozh);
				$percent_blue = round($second_blue*$mnozh);
				$percent_green = round($third_green*$mnozh);


				echo 'Красный - '.$first_red.' голосов - '.$percent_red.'% <br>';
				echo 'Синий - '.$second_blue.' голосов - '.$percent_blue.'% <br>';
				echo 'Зеленый - '.$third_green.' голосов - '.$percent_green.'% <br>';

				$diagramma = array($percent_red, $percent_blue, $percent_green);
				$color = array('red', 'blue', 'green');
			?>

			<!-- Тут надо доделать цикл в вцикле!!! -->
			 <?php
				for ($i=0; $i<count($diagramma); $i++) { 
			?>
				<div style='background: lightgrey; height:100px; width:130px; float:left; border-left:1px solid white; color: black; text-align:center; font-size:small; position:relative; margin-left: 20px;'>
					<div class='graf' style='margin:0 auto; margin-top:3px'>
						<?=$diagramma[$i]?>%
					</div>
					<div style='height: <?=$diagramma[$i]?>px; width:100%; background: <?= $color[$i]?>
			 ; position:absolute; bottom:0;'>
					</div>
				</div>

			<?php
				}
			?>

			

		</div>

	</div>
</div>

