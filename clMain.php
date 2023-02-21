<?php
session_start();
include "zayavki_model.php";

class clMain {
	protected $caption = '';
	protected $params = array();												// Параметры документа
	
	function __construct($Caption1='Заголовок'){								// Конструктор класса
		$this->params['caption'] = $Caption1;									// Заголовок документа
		$this->params['start_time'] = microtime(true);
	}

	function __destruct(){
		error_reporting (0);
		//mssql_close($this->connects['mssql']);
		error_reporting (E_ALL);
		
		$exec_time1 = microtime(true) - $this->params['start_time'];
		if ($exec_time1 > 10) $exec_time1 = substr($exec_time1,0,7) . ' | БОЛЕЕ 10 сек.';
		else $exec_time1 = substr($exec_time1,0,7);
	}
	
	public function showAlert($msg1='Сообщение'){								// Вывод сообщения в окошко MessageBox
		echo "<script type=\"text/javascript\">alert('$msg1');</script>";
	}

	public function show_REQUEST(){												// Вывод _REQUEST
		echo "<H1>Отображение данных REQUEST</H1>";
		echo "<HR>";
		echo "<Table cellspacing=0 border=0 width=100%> <Col width=20%><Col width=80%>";
		foreach ($_REQUEST as $key => $value){
			echo "<tr>";
			if (is_array($value))
				foreach ($value as $item){
					echo "<td>$key</td>";
					echo "<td>$item</td>";
				}
			else {
				echo "<td>$key</td>";
				echo "<td>$value</td>";
			}
		}
		echo "</Table><HR>";
	}

	public function get_POST_value($name1=''){									// Возвращает значение из _POST
		if (isset($_POST[$name1])) return $_POST[$name1];
		else return '';
	}
	
	public function get_REQUEST_value($name1=''){								// Возвращает значение из _REQUEST
		if (isset($_REQUEST[$name1])) return $_REQUEST[$name1];
		else return '';
	}
	
	function checkbox_verify($_name){
		$result = 0;															// обязательно прописываем, чтобы функция всегда возвращала результат 
		if (isset($_REQUEST[$_name])){											// проверяем, а есть ли вообще такой checkbox на html форме, а то часто промахиваются
			if ($_REQUEST[$_name]=='on') { $result=1; } else { $result=0; }
		}
		return $result;
	}
	
	protected function get_connect($dbh){	// Установка соединия с БД
		if (!$dbh){ $this->show_alert("Нет соединения с базой данных"); die; }
		return $dbh;
	}
	
	protected function show_html_head_jQuery(){
		echo "\n<script src='http://code.jquery.com/jquery.js'></script>";	
	}
	
	protected function show_html_head(){														// Вывод шапки HTML-документа
		?>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">		
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		
		<?php
		$this->show_html_head_jQuery();
		?>
		<script src="js/bootstrap.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
				
		<?php

			echo '
				<link type="text/css" rel="stylesheet" href="/jquery-ui-1.9.0.custom/css/smoothness/jquery-ui.css">
				<script type="text/javascript" src="/jquery-ui-1.9.0.custom/js/jquery-ui-1.9.0.custom.min.js"></script>
				<script type="text/javascript" src="/jquery-ui-1.9.0.custom/js/ui.datepicker-ru.js"></script>
				';
		?>
				
		<script type="text/javascript" src="js/maskInput/jquery.numberMask.js"></script>	<!-- Маски ввода для чисел -->
		<?php
	}
	
	protected function html_header($title1='',$htmlVersion=4){					// Вывод шапки HTML-документа
		if (empty($title1)) $title1 = $this->params['caption'];
		echo '<!DOCTYPE html>';
			
		echo "
			<html>
			<head>
				<title>", $title1, '</title>';
		$this->show_html_head();
		echo "\n</head>";
		
		echo "\n<body>";	
		//echo "\n<form id='sampleform' name='sampleform' action='", $_SERVER["SCRIPT_NAME"], "' method=\"POST\" enctype=\"multipart/form-data\" style='margin-top:0px;'>\n";
		echo "\n<form class='needs-validation' method='post' id='internet_zayavki' enctype='multipart/form-data' novalidate>\n";
		
	}
	
	protected function html_footer(){											// Закрываем HTML-документа
		echo "\n</form>	\n</body></html>";
		echo "<script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js' integrity='sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p' crossorigin='anonymous'></script>";
		echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js' integrity='sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF' crossorigin='anonymous'></script>";
	}
	
	protected function show_caption($caption){											// Вывод заголовка документа
		echo "<h4 class='mb-3'>", $caption;
		echo "</h4>\n";
		echo "<p><small>Обращаем Ваше внимание, что МУП 'Водоканал' г.Казани обслуживает централизованные сети водоснабжения и водоотведения только <br>на территории города Казани.</small></p>";
	}
	
	protected function getInputHidden($name1='name1', $value1=''){
		return "\n<input type=hidden value='$value1' id=\"$name1\" name=\"$name1\">";
	}
	
	protected function showTextarea($for='for1',$label='label1',$name='name1',$row='invalid-message',$value='',$id=''){	// Вывод стандартного поля ввода
		//$retval1 = "\n<textarea id='$name1' name='$name1' ";		
		echo "\n<div class='col-sm-12'>";
		echo "<strong><label for='", $for, "' class='form-label'>", $label, "</label></strong>";
		echo "\n<textarea class='form-control' id='", $name, "' name='", $name, "' value='", $value, "' rows='", $row, "' required></textarea>";
		echo "\n<div id='", $id, "' class='invalid-feedback'> Поле обязательно к заполнению </div>";
		echo "</div><br>";		
	}

	protected function showText($for='for1',$label='label1',$type='text',$name='name1',$placeholder='',$value='',$size=10, $id=''){	// Вывод стандартного поля ввода
		echo "\n<div class='col-sm-", $size, "'>";
		echo "<strong><label for='", $for, "' class='form-label'>", $label, "<span class='text-muted'></span></label></strong>";
		echo "\n<input type=", $type, " class='form-control' id='", $name, "' name='", $name, "' placeholder='", $placeholder, "' value='", $value, "'>";
		echo "\n<div id='", $id, "' class='invalid-feedback'> Поле обязательно к заполнению </div>";
		echo "</div><br>";				
	}

	protected function showTextDate($for='for1',$label='label1',$type='date',$name='name1',$placeholder='',$value='',$size=3, $id=''){	// Вывод стандартного поля ввода
		echo "\n<div class='col-sm-'", $size, "'>";
		echo "<strong><label for='", $for, "' class='form-label'>", $label, "</label></strong>";
		echo "\n<input type=", $type, " class='form-control' id='", $name, "' name='", $name, "' placeholder='", $placeholder, "' value='", $value, "'  required>";
		echo "\n<div id='", $id, "' class='invalid-feedback'> Поле обязательно к заполнению </div>";
		echo "</div><br>";				
	}
	
	protected function showCheckbox($name='name1',$value=0): string {
		$rezult = "\n<hr class='my-4'><div class='form-check'>\n<input class='form-check-input' type='checkbox' id='$name' name='$name'";
		if ($value>0) $rezult .= " checked";
		$rezult .= "><label class='form-check-label' for='$name'>
					Согласен(а) на обработку, хранение и направление моих персональных данных в целях рассмотрения обращения
					</label></div></hr>";
		return $rezult;
	}

	protected function showButton($caption='Нажми меня',$name='',$type='button',$onclick='',$class='', $disabled='', $params=''): string {	// Возвращает описание стандартной кнопки
		$rezult = "\n<button class='$class'";
		if (!empty($name)) $rezult .= " id=\"$name\" name=\"$name\"";
		if (empty($type)) $rezult .= " type=\"button\"";
		else $rezult .= " type=\"$type\"";
		//$ButtonStr1 .= " type=\"submit\"";
		if (!empty($onclick)) $rezult .= " ONCLICK=\"$onclick\"";
		if (!empty($params)) $rezult .= " " . $params;
		if (!empty($disabled)) $rezult .= " disabled=\"$disabled\"";		
		$rezult .= ">$caption</button>";
		return $rezult;			
	}
	
	protected function get_input_checkbox($name1='name1',$value1=0,$attr1='',$style1=''){
		$retval1 = "\n<input type='checkbox' id='$name1' name='$name1'";
		if ($value1>0) $retval1 .= " checked";
		if (!empty($attr1)) $retval1 .= " $attr1";
		$retval1 .= " style='margin: -2px 0px; $style1'";
		return $retval1 . ">";
	}
	
	protected function get_input_checkbox2($name1='name1',$value1=0,$attr1='',$style1='',$label=''){
		$retval1 = "<input type='checkbox' id='$name1' name='$name1'";
		if ($value1>0) $retval1 .= " checked";
		if (!empty($attr1)) $retval1 .= " $attr1";
		$retval1 .= " style='margin: -2px 0px; $style1' >";
		if (!empty($label))
			$retval1 .= " <label for='$name1' class='lbCheck'>$label</label>";
		return $retval1;
	}
		
	protected function show_data(){}										// Абстрактный метод вывода данных, переписывается в дочерних классах

	public function show(){

		$this->html_header();												// Вывод шапки HTML-документа

		echo "\n <div class='container my-3'>
				<main>
					<div class='row g-5 col-12'>					
						<div class='col-md-9'>";
		$this->show_caption($this->caption);									// Вывод заголовка документа

		$this->show_data();										// Вывод данных
		echo "\n</div>
				</div>
				</main>
				</div>";
	
		$this->html_footer();												// Закрываем HTML-документа
	}
}

?>
