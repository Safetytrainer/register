<?php
	$pathS = dirname(__FILE__);
    //Подключение шапки
    require_once("root_path.php");
	require_once($root_path."head.php");
    require_once($root_path."header.php");
?>

<!-- Блок для вывода сообщений -->
<div class="block_for_messages">
    <?php

        if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
            echo $_SESSION["error_messages"];

            //Уничтожаем чтобы не появилось заново при обновлении страницы
            unset($_SESSION["error_messages"]);
        }

        if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
            echo $_SESSION["success_messages"];
            
            //Уничтожаем чтобы не появилось заново при обновлении страницы
            unset($_SESSION["success_messages"]);
        }
    ?>
</div>

<?php
    //Проверяем, если пользователь не авторизован, то выводим форму авторизации, 
    //иначе выводим сообщение о том, что он уже авторизован
    if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
?>
<link rel="stylesheet" href="css/reg_and_auth.css" type="text/css"/>
<div class="login-page">
	<div class="form">
		<form class="regauth register-form" action="register.php" method="post" name="form_register">
			<span id="valid_email_message" class="mesage_error">логин</span>
			<input type="text" name="login" placeholder="логин"/>
			<span id="valid_email_message" class="mesage_error">имя</span>
			<input type="text" name="first_name" placeholder="имя"/>
			<span id="valid_email_message" class="mesage_error">фамилия</span>
			<input type="text" name="last_name" placeholder="фамилия"/>
			<span id="valid_email_message" class="mesage_error">отчество</span>
			<input type="text" name="patronymic" placeholder="отчество"/>
			<span id="valid_email_message" class="mesage_error">пол</span>
			<p><input type="radio" name="sex" value="male"/>мужской</p>
			<p><input type="radio" name="sex" value="female"/>женский</p>
			<span id="valid_email_message" class="mesage_error">учебная организация</span>
			<input type="text" name="organization" placeholder="учебная организация"/>
			<span id="valid_email_message" class="mesage_error">статус</span>
			<p><input type="radio" name="status" value="student"/>обучающийся</p>
			<p><input type="radio" name="status" value="teacher"/>преподаватель</p>
			<span id="valid_email_message" class="mesage_error">адрес электронной почты</span>
			<input type="text" name="email" placeholder="e-mail"/>
			<span id="valid_email_message" class="mesage_error">пароль</span>
			<input type="password" name="password" placeholder="пароль"/>
			<span id="valid_email_message" class="mesage_error">страна</span>
			<input type="text" name="country" placeholder="страна"/>
			<span id="valid_email_message" class="mesage_error">город</span>
			<input type="text" name="city" placeholder="город"/>
			<span id="valid_email_message" class="mesage_error">дата рождения</span>
			<input type="text" name="birth_date" placeholder="ДД.ММ.ГГГГ"/>
			<span id="valid_email_message" class="mesage_error">номер мобильного телефона</span>
			<input type="text" name="mobile" placeholder="+7 (000) 00-000-00"/>
			<img src="captcha.php?type=1" alt="Капча" />
			<input type="text" name="captcha" placeholder="проверочный код"/>
			<input type="submit" name="btn_submit_register" value="зарегистрироваться"/>
			<p class="message">Уже зарегистрированы? <a href="#">Войдите</a></p>
		</form>
		<form class="regauth login-form" action="auth.php" method="post" name="form_auth">
			<span id="valid_email_message" class="mesage_error">Логин</span>
				<input type="text" name="login" placeholder="e-mail"/>
			<span id="valid_password_message" class="mesage_error">Пароль</span>
				<input type="password" name="password" placeholder="минимум 6 символов"/>
			<img src="captcha.php?type=2" alt="Капча" />
				<input type="text" name="captcha" placeholder="введите капчу"/>
				<input type="submit" name="btn_submit_auth" value="Войти"/>
			<p class="message">Не зарегистрированы?<a href="#">Создайте аккаунт</a></p>
		</form>
	</div>
</div>
<script>
	$('.message a').click(function(){
		if(!($('.form .register-form').is(":visible"))){
			$('.login-page').css("width", 400);
			$('.form').css("max-width", 400);
		}else{
			$('.login-page').css("width", 360);
			$('.form').css("max-width", 360);
		}
		$('form.regauth').animate({height: "toggle", opacity: "toggle"}, "slow");
		
	});
</script>
<?php 
    }else{
?>
<div id="authorized">
	<h2>Вы уже авторизованы</h2>
</div>
        
<?php
    }
    //Подключение подвала
    require_once("footer.php");
?>