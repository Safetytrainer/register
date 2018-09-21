<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru" >
	<head>
		<meta charset="UTF-8">
		<title>Форма авторизации</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		
		<div class="login-page">
			<div class="error-message">
			<?php

				if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
				    print($_SESSION["error_messages"]);

				    //Уничтожаем чтобы не появилось заново при обновлении страницы
				    unset($_SESSION["error_messages"]);
				}

				if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
				    print($_SESSION["success_messages"]);
				    
				    //Уничтожаем чтобы не появилось заново при обновлении страницы
				    unset($_SESSION["success_messages"]);
				}
			?>
			</div>
			
			<div class="form">
				<?php
					//Проверяем, если пользователь не авторизован, то выводим форму авторизации, 
					//иначе выводим сообщение о том, что он уже авторизован
					if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
				?>
				<form class="register-form" action="register.php" method="post" name="form_register">
					<input type="text" name="login" placeholder="логин"/>
					<input type="password" name="password" placeholder="пароль"/>
					<input type="text" name="email" placeholder="email"/>
					<img src="captcha.php?type=1" alt="Капча" />
					<input type="text" name="captcha" placeholder="проверочный код"/>
					<input class="nonselect button" type="submit" name="btn_submit_register" value="Зарегистрироваться"/>
					<!--<button class="nonselect">Зарегистрироваться</button>!-->
					
				</form>
				<form class="login-form" action="auth.php" method="post" name="form_auth">
					<input type="text" name="login" placeholder="логин"/>
					<input type="password" name="password" placeholder="пароль"/>
					<div class="checkboxelem nonselect"><label><input type="checkbox" style="display:inline; width:20px; float:left;"/>чужой компьютер</label></div> 
					<img src="captcha.php?type=2" alt="Капча" />
					<input type="text" name="captcha" placeholder="проверочный код"/>
					<input class="nonselect button" type="submit" name="btn_submit_auth" value="Войти"/>					
					<!--<button class="nonselect">Войти</button>!-->
					
				</form>
				<?php 
					}else{
				?>
				<div>Вы уже авторизованны. <a href="logout.php">Выйти?</a></div>

				<?php
					}
				?>
			</div>
			<?php
				//Проверяем, если пользователь не авторизован, то выводим форму авторизации, 
				//иначе выводим сообщение о том, что он уже авторизован
				if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
			?>
			<div class="login-info" id="pid1" style="display:block;"><p class="message">Не зарегистрированны? <a href="#" onclick="inverser();">Создайте аккаунт</a></p></div>
			<div class="login-info" id="pid2" style="display:none;"><p class="message">Уже зарегистрированны? <a href="#" onclick="inverser();">Войдите</a></p></div>
			<?php
				}
			?>
		</div>
		<div id="signature" class="nonselect"> Made by Savelyevich</div>
		 <img src="fon.jpg" class="backgroundf"/>
		<div class="footer">
			<a href="#">cправка</a>
			<a href="#">помощь</a>
			<a href="#">предложения</a>
			<a href="#">контакты</a>
		</div>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

		<script  src="js/index.js"></script>
	</body>
</html>
