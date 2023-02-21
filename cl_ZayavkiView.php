<!DOCTYPE html>
<?php
	//include 'zayavki_controller.php';
	//include 'dashboard/phpinfo.php';
	require_once "cl_Main.php";
	
	class cl_ZayavkiView extends cl_Main{
	protected $rowCurrent = 0;
	protected $showTables = "false";									// Показывать/скрывать таблицы Bills/Charges/Payments
	protected $ContractSaldo2 = 0.00;
	
	function __construct($Caption1='Заголовок'){
		parent::__construct($Caption1);
		
		$this->params['toolbox_width'] = '800px';						// Устанавливаем ширину панели инструментов
		$this->params['toolbox_panel0_width'] = '0';					// Ширина ToolBox.0 (основная панель)
		$this->params['toolbox_findbox_width'] = '0';					// Ширина ToolBox.FindBox
		
		$this->caption = 'Интернет-приемная заявок';
		//$this->params['id_current'] = $this->get_REQUEST_value('client') + 0;
	}
	
	protected function show_data(){										// Вывод данных
		$this->show_REQUEST();
		// $this->show_SESSION();
		//$this->caption = 'Интернет-приемная заявок';
		
		$this->show_input_hidden("id_tab1");
		$this->show_input_hidden("id_hidden", $this->params['id']);
		$this->show_input_hidden("id", $this->params['id']);
		$this->show_input_hidden("clientid", $this->get_REQUEST_value('clientid'));
		$this->show_input_hidden("ccpid", $this->get_REQUEST_value('ccpid'));
		
		$Info_message = $this->get_POST_value('Info_message');
		$Actor = $this->get_POST_value('Actor');
		$Address = $this->get_POST_value('Address');
		$district = $this->get_POST_value('district');
		$Date = $this->get_POST_value('Date');
		$check_zayavky = $this->checkbox_verify('check_zayavky');
		
		if ($this->params['mode_dialog'] > 0) $this->show_dialog_update();		// Отображаем содержимое диалогового окна. В конце EXIT!!!
		//$this->show_alert('Класс сформирован');
		
		$this->showTextarea('message', 'Информационное сообщение','Info_message',3,$Info_message,'invalid-message');
		$this->showText('actor','Заявитель','text','Actor','Фамилия Имя Отчество',$Actor,10,'invalid-actor');
		$this->showText('Date','Дата','date','Date','',$Date,3,'invalid-iddate');
		$this->showText('Address','Адрес','text','Address','Ул. Горького, д.34',$Address,10,'invalid-address');
		$this->showText('district','Район','text','district','',$district,10,'invalid-rayon');
		echo $this->showCheckbox('check_zayavky',$check_zayavky);
		?> <hr class='my-4'> <?php
		echo $this->showButton('Отправить заявку','btnInsert','submit','insert','w-100 btn btn-primary btn-lg');
		?> <div class = "formstatus"><center> <?php
		echo $this->showButton('Отследить состояние отправленной заявки','btnCode','button','document.location=get_status.php','btn btn-secondary btn-sm-lg');							
		?> </center></div> 					
			<style>
				.formstatus{
				padding: 10px;
				}
			</style></div></div>					
			<!-- Modal -->
			<div class="modal fade" id="modal_ip" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Интернет-заявки</h5>
						</div>
						<div class="modal-body">
							<p>Ваше обращение принято. Код отслеживания: <b id='code'></b></p>
							<p>Для получения информации по Вашему обращению можно позвонить по телефонам 8(843)231-69-07, 8(843)231-69-06.</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть окно</button>
						</div>
					</div>
				</div>
			</div>
		<?php
	}
	
	protected function do_action(){											// Выполнение операции по обработке событий по умолчанию
		if (!($this->params[0]=='insert' or $this->params[0]=='update_item' or $this->params[0]=='delete_item')) return;
				
		$Info_message = $this->get_POST_value('Info_message');
		$Actor = $this->get_POST_value('Actor');
		$Address = $this->get_POST_value('Address');
		$district = $this->get_POST_value('district');
		$Date = $this->get_POST_value('Date');
		$check_zayavky = $this->checkbox_verify('check_zayavky');
		
		
		$dtBegin = $this->get_YYYY_MM_DD($_POST['dtBegin1']);
		if (empty($dtBegin)) $dtBegin = date('Y.m.d'); else $dtBegin = "'".$dtBegin."'";	

		$sql = "INSERT INTO zayavky (Info_message, Actor, Date, Address, district, code, check_zayavky) VALUES ('" . $Info_message . "','" . $Actor . "'," . $Date . ",'" . $Address . "','" . $district . "'," . $code ."," . $check_zayavky .");";
		//echo $sql;
		//$result = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		$result = $dbh->exec($sql);
		
		
		if ($result){
			echo "запись добавлена";
		} 

		$query1 = null;
		if (!$this->run_query($SQL1, &$query)) return false;
 		if ($query) {
			$this->do_action_dbf();			
			header("Location: xsApplicationDocuments.php");
		} 
	}

	
}

$temp1 = new cl_ZayavkiView('Заявки');
$temp1->show();
	
?>
