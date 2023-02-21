<?php
include 'clZayavkiController.php';
require_once "clMain.php";

class clGetStatus extends clMain{
	
	function __construct($Caption1='Заголовок'){
		parent::__construct($Caption1);
		
		//$this->params['toolbox_width'] = '800px';						// Устанавливаем ширину панели инструментов
		//$this->params['toolbox_panel0_width'] = '0';					// Ширина ToolBox.0 (основная панель)
		//$this->params['toolbox_findbox_width'] = '0';					// Ширина ToolBox.FindBox
		
		$this->caption = 'Состояние запроса или обращения';
	}
	
	protected function show_data(){										// Вывод данных
			
		If ($this->get_REQUEST_value('code') > 0) $code = $this->get_REQUEST_value('code');
		Else $code = '';
		If ($this->get_REQUEST_value('status')) $status = $this->get_REQUEST_value('status');
		//Else $status = '';
		echo $this->getInputHidden("code", $code);
/* 		If ($code > 0 ){

		} */
		
		?> 
		<center><div class="col-md-9">
		<!-- <h4 class="mb-3">Состояние запроса или обращения</h4> -->
		<div class="accordion accordion-flush shadow-sm mx-1 my-1" id="accordionFlushExample">
		<div class="accordion-item">
		<h2 class="accordion-header" id="flush-headingOne">
		<?php
		echo $this->showButton('Более подробная информация о сервисе','','button','','accordion-button collapsed','','data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne"');
		?>
			</h2>
			<div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
			  <div class="accordion-body">
			  <p>Сервис позволяет уточнить информацию о текущем этапе выполнения запроса заявителя.</p>
			  <p>Отслеживание осуществляется по персональному коду, присвоенному системой обращению.</p>
			  <p>Для отслеживания запроса Вам необходимо ввести регистрационный код Вашего заявления.
			  </div>
			</div>
		</div>
		</div>		
		<br>
		<br>
		<div class = "shadow-sm mx-1 my-1">
			<!-- <label class="form-label">Узнать состояние отслеживания</label>
			<label for="textcode" class="form-label">Код отслеживания</label> -->
			<?php
			$this->showText('','Введите код отслеживания *','text','codetext','1111',$code,6,'');		
			?>
		<div class="form-group">  
			<div class="col-sm-offset-2 col-xs-10">
				<?php
				//echo $this->showButton('Отследить','checkCode','submit','','btn btn-secondary','','');
				echo $this->showButton('Отследить','checkCode','submit','','btn btn-secondary','disabled','');
				echo $this->showButton('Перейти к заявкам','Zayavki','submit','document.location=clZayavkiView.php','btn btn-secondary','','');
				?>				
			</div>
		</div>
		<br>
		<?php
		if (isset($status)) {
			echo "<div class = \"\" id = \"divid\">";
			echo "<strong>Код вашей заявки: ", $code , "</strong><p>";
			echo "<strong>Статус вашей заявки: ", $status , "</strong><br>";			
			echo "</div>";	
		}
		
		?>
		</div></center>
		<?php	  

	}
}

$temp1 = new clGetStatus('Состояние заявки');
$temp1->show();

?>
<SCRIPT type = "text/javascript">

	if ($('#codetext').val()) {
		$('#checkCode').removeAttr('disabled');
	};

	$('#codetext').bind('input', function(){
			$('#checkCode').removeAttr('disabled');		
	});

	codetext.onblur = function() {
	  if (!$('#codetext').val()) { 
		console.log('Не указан код');
		$('#invalid-message').show();
		$('#codetext').addClass('is-invalid');
		$('#checkCode').attr('disabled','disabled');
	  }
	  else {
		  $('#checkCode').removeAttr('disabled');
	  }
	};
 	codetext.onfocus = function() {
		if (!$('#codetext').val()) {
			$('#codetext').removeClass('is-invalid');
		}
	};
  
	$('#checkCode').on('click',function(){
		if (!$('#codetext').val()) {
			//alert('Введите код отслеживания');
			return;
		}
  });
	
</SCRIPT>	