<?php
//error_reporting(E_ALL);
	error_reporting (0);
	session_start();
	error_reporting (E_ALL & ~E_NOTICE);
	date_default_timezone_set('Europe/Moscow');

	$dbh = new PDO("sqlite:/SQLiteStudio/vodokanalmobile1.db");

	if(!$dbh) {
		//echo "bad"; 
		echo "<script type='text/javascript'>alert('Ошибка: Невозможно установить соединение с базой данных.');</script>";
		echo "<b style='color: red'>Ошибка установки соединения с базой данных. Повторите операцию, обратитесь к администратору БД.</b>";
		die(); }
	else {
		//echo "Есть соединение с БД"; 
	}

?>