<?php
include 'clZayavkiController.php';
require_once "clMain.php";

class clZayavkiView extends clMain{
	
	function __construct($Caption1='Заголовок'){
		parent::__construct($Caption1);
		
		//$this->params['toolbox_width'] = '800px';						// Устанавливаем ширину панели инструментов
		//$this->params['toolbox_panel0_width'] = '0';					// Ширина ToolBox.0 (основная панель)
		//$this->params['toolbox_findbox_width'] = '0';					// Ширина ToolBox.FindBox
		
		$this->caption = 'Интернет-приемная заявок';
	}
	
	protected function show_data(){										// Вывод данных
			
		If ($this->get_REQUEST_value('code') > 0) $code = $this->get_REQUEST_value('code');
		Else $code = 0;
		
		If ($code > 0 ){
		echo "<script type=\"text/javascript\"> 
				$(window).on('load',function(){
				$('#staticBackdrop').modal('show');
				keyboard: false;
				
			});
			</script>";
		}
		
		$Info_message = $this->get_POST_value('Info_message');
		$Actor = $this->get_POST_value('Actor');
		$Address = $this->get_POST_value('Address');
		$district = $this->get_POST_value('district');
		$Date = $this->get_POST_value('Date');
		$check_zayavky = $this->checkbox_verify('check_zayavky');
		
		//$this->showTextarea('message', 'Информационное сообщение *','Info_message',3,$Info_message,'invalid-message');
		$this->showTextarea('message', 'Информационное сообщение *','Info_message',3,$Info_message,'');
		//$this->showText('actor','Заявитель *','text','Actor','Фамилия Имя Отчество',$Actor,10,'invalid-actor');
		$this->showText('actor','Заявитель *','text','Actor','Фамилия Имя Отчество',$Actor,10,'');
		//$this->showText('Date','Дата *','date','Date','',$Date,3,'invalid-iddate');
		$this->showText('Date','Дата *','date','Date','',$Date,3,'');
		//$this->showText('Address','Адрес *','text','Address','Ул. Горького, д.34',$Address,10,'invalid-address');
		$this->showText('Address','Адрес *','text','Address','Ул. Горького, д.34',$Address,10,'');
		//$this->showText('district','Район *','text','district','',$district,10,'invalid-rayon');
		$this->showText('district','Район *','text','district','',$district,10,'');
		echo $this->showCheckbox('check_zayavky',$check_zayavky);
		?> <hr class='my-4'> <?php
		//echo $this->showButton('Отправить заявку','btnInsert','submit','onclick=post_ip();','w-100 btn btn-primary btn-lg','disabled');
		echo $this->showButton('Отправить заявку','btnInsert','submit','','w-100 btn btn-primary btn-lg','disabled','');
		?> <div class = "formstatus"><center> <?php
		echo $this->showButton('Отследить состояние отправленной заявки','btnCode','submit','document.location=clGetStatus.php','btn btn-secondary btn-sm-lg','','');
		?> </center></div> 					
			<style>
				.formstatus{
				padding: 10px;
				}
			</style></div></div>					
			<!-- Модальное окно -->
			<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">				  
					<h5 class="modal-title" id="staticBackdropLabel">Ваше обращение принято!</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
				  </div>
				  <div class="modal-body">
					<p>Код отслеживания: <?php echo $code ?> </p>
					<p>Запомните или скопируйте код для последующего отслеживаания состояния заявки.</p>
					<p>Для получения информации по Вашему обращению можно позвонить по телефонам 8(843)231-69-07, 8(843)231-69-06.</p>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" OnClick = 'window.location.replace("clZayavkiView.php")'> Закрыть </button>
				  </div>
				</div>
			  </div>
			</div>			
		<?php
	} 	
}

$temp1 = new clZayavkiView('Заявки');
$temp1->show();

?>
<SCRIPT type = "text/javascript">

	(function() {
    $('form > div > main > div > div > div > input').keyup(function() {

        var empty = false;
        $('form > div > main > div > div > div > input').each(function() {
            if ($(this).val() == '') {
                empty = true;
            }
        });

        if (empty) {
            $('#btnInsert').attr('disabled', 'disabled');
        } else {
            $('#btnInsert').removeAttr('disabled');
        }
    });
	})()
	
	Info_message.onblur = function() {
	  if (!$('#Info_message').val()) { 
		console.log('Не указано сообщение');
		$('#invalid-message').show();
		$('#Info_message').addClass('is-invalid');
	  }
	};
 	Info_message.onfocus = function() {
		if (!$('#Info_message').val()) {
			$('#Info_message').removeClass('is-invalid');
		}
	};

	Actor.onblur = function() {
	  if (!$('#Actor').val()) { 
		console.log('Не указано сообщение');
		$('#invalid-actor').show();
		$('#Actor').addClass('is-invalid');
	  }
	};	
 	Actor.onfocus = function() {
		if (!$('#Actor').val()) {
			$('#Actor').removeClass('is-invalid');
		}
	};
	
	Date.onblur = function() {
	  if (!$('#Date').val()) { 
		console.log('Не указано сообщение');
		$('#invalid-iddate').show();
		$(Date).addClass('is-invalid');
	  }
	};
 	Date.onfocus = function() {
		if (!$('#Date').val()) {
			$('#Date').removeClass('is-invalid');
		}
	};
	
	Address.onblur = function() {
	  if (!$('#Address').val()) { 
		console.log('Не указано сообщение');
		$('#invalid-address').show();
		$(Address).addClass('is-invalid');
	  }
	};
 	Address.onfocus = function() {
		if (!$('#Address').val()) {
			$('#Address').removeClass('is-invalid');
		}
	}; 

	district.onblur = function() {
	  if (!$('#district').val()) { 
		console.log('Не указано сообщение');
		$('#invalid-rayon').show();
		$(district).addClass('is-invalid');
	  }
	};
 	district.onfocus = function() {
		if (!$('#district').val()) {
			$('#district').removeClass('is-invalid');
		}
	};
		
/* 	function post_ip (){
		$('#code').html('');

		$('#invalid-message').hide();
		$('#invalid-actor').hide();
		$('#invalid-iddate').hide();
		$('#invalid-address').hide();
		$('#invalid-rayon').hide();
		
		//var $namepattern=/^[^ ]([a-zA-Zа-яА-ЯІіЇїЄє']|\s)*$/;
		
		var Info_message = $('#Info_message').val();
		var Actor = $('#Actor').val();
		var Address = $('#Address').val();
		var district = $('#district').val();
		var Date = $('#Date').val();
		
		var success2 = 1;
		
		if (Info_message == ''){
			console.log('Не указано сообщение');
			$('#invalid-message').show();
			$('#Info_message').addClass('is-invalid');
			success2 = 0;
		} else {
			$('#Info_message').removeClass('is-invalid');
		}
		
		if (Actor == ''){
			console.log('Не указано ФИО');
			$('#invalid-actor').show();
			$('#Actor').addClass('is-invalid');
			success2 = 0;
		} else {
			$('#Actor').removeClass('is-invalid');
		}
		
		if (Address == ''){
			console.log('Не указан адрес');
			$('#invalid-address').show();
			$('#Address').addClass('is-invalid');
			success2 = 0;
		} else {
			$('#Address').removeClass('is-invalid');
		}
		
		if (district == ''){
			console.log('Не указан район');
			$('#invalid-rayon').show();
			$('#district').addClass('is-invalid');
			success2 = 0;
		} else {
			$('#district').removeClass('is-invalid');
		}
		
		if (Date == ''){
			console.log('Не указана дата');
			$('#invalid-iddate').show();
			$('#Date').addClass('is-invalid');
			success2 = 0;
		} else {
			$('#Date').removeClass('is-invalid');
		}
	
		if (success2 == 0){
			return;
		}
		
	} */
	
</SCRIPT>	