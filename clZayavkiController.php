<?php

include 'clZayavkiModel.php';

if (isset($_POST["btnInsert"])){
	insertZ($dbh); 
}
if (isset($_POST["btnCode"])){
	header( 'Location: clGetStatus.php');
}
if (isset($_POST["checkCode"])){
	//header( 'Location: clGetStatus.php');
	//showAlert("Кнопка нажата");
	checkCode($dbh);
}
if (isset($_POST["Zayavki"])){
	header( 'Location: clZayavkiView.php');
}

return;

function get_POST_value($name1=''){									// Возвращает значение из _POST
	if (isset($_POST[$name1])) return $_POST[$name1];
	else return '';
}

function checkbox_verify($_name){
	$result = 0;															// прописываем, чтобы функция всегда возвращала результат
	if (isset($_REQUEST[$_name])){											// проверяем, а есть ли такой checkbox на html форме
		if ($_REQUEST[$_name]=='on') { $result=1; } else { $result=0; }
	}
	return $result;
}

function showAlert($msg1='Сообщение'){								// Вывод сообщения в окошко MessageBox
	echo "<script type=\"text/javascript\">alert('$msg1');</script>";
}

function removeSpecialChar($str) {
      $res = str_replace( array( '\'', '"', ',' , ';', '<', '>' ), ' ', $str);
      return $res;
}

function getDdMmYyyy($date1=''){									// Возвращает из YYYY-MM-DD->DD.MM.YYYY
	if (empty($date1)) return '';
	return substr($date1,8,2) ."-". substr($date1,5,2) ."-". substr($date1,0,4);
}
	
function insertZ($dbh){
	$Info_message = removeSpecialChar(get_POST_value('Info_message'));
	$Actor = removeSpecialChar(get_POST_value('Actor'));
	$Address = removeSpecialChar(get_POST_value('Address'));
	$district = removeSpecialChar(get_POST_value('district'));
	$Date = getDdMmYyyy(get_POST_value('Date'));
	$check_zayavky = checkbox_verify('check_zayavky');
	
	$sql = "Select MAX(code) From zayavky;"; 
	$result = $dbh->query($sql);	
	if ($result) {   
      if($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
          $code = $row[0]["MAX(code)"] + 1;
	  }
	}
	
	$sql = "INSERT INTO zayavky (Info_message, Actor, Date, Address, district, code, check_zayavky) VALUES ('" . $Info_message . "','" . $Actor . "','" . $Date . "','" . $Address . "','" . $district . "'," . $code ."," . $check_zayavky .");";
		
	$result = $dbh->exec($sql);
 	if ($result){
		$sql = "Select id_zayavky From zayavky Where code = " . $code; 
		$result = $dbh->query($sql);	
		if ($result) {   
			if($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
				$id_zayavky = $row[0]["id_zayavky"];
				$status = 1;
				$sql = "INSERT INTO action_zayavka (zayavka, date) VALUES (" . $id_zayavky . ", '" . $Date . "');";
				$result = $dbh->query($sql);
			}
		}		
		header( 'Location: clZayavkiView.php?code='.$code);
	} 	
}

function checkCode($dbh){
	$code = get_POST_value('codetext');
	//showAlert ($code);
	
	$status = 'Код заявки не найден';
	If ($code > 0 and is_numeric($code)) {
		$sql = "Select zayavky.Info_message, max(action_zayavka.date), status.Name_status 
				From zayavky 
				Left join action_zayavka on zayavky.id_zayavky = action_zayavka.zayavka
				Left join Status on action_zayavka.status = status.Id_status
				Where code = " . $code .";";
		
		$result = $dbh->query($sql);	
		if ($result) {   
		  if($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
			  $status = $row[0]["Name_status"];
		  }
		}
	}
	header( 'Location: clGetStatus.php?status=' . $status . ' & code=' . $code);
	 	
}


?>