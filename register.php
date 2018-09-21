<?php
	session_start();                    // Запускаем сессию
	require_once("dbconnect.php");      // Добавляем файл подключения к БД
	$_SESSION["error_messages"] = '';   // Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы
	$_SESSION["success_messages"] = ''; // Объявляем ячейку для добавления успешных сообщений

	function errorRedirect($message){
		$_SESSION["error_messages"] .= "<p class='mesage_error'>".$message."</p>";
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: ".$address_site."index.php");
		exit();
	}
	
	function checkField($field_name, $message_empty, $message_none){
		if(isset($_POST[$field_name])){
			$field = trim($_POST[$field_name]); //Обрезаем пробелы с начала и с конца строки
			if(!empty($field)){
				$field = htmlspecialchars($field, ENT_QUOTES); // Для безопасности, преобразуем специальные символы в HTML-сущности
				return $field;
			}else{ 
				errorRedirect($message_empty);
			}
		}else{
			errorRedirect($message_none);
		}
	}
	
	/*
	 * Проверяем была ли отправлена форма, то есть была ли нажата кнопка зарегистрироваться. 
	 * Если да, то идём дальше, если нет, значит пользователь зашёл на эту страницу напрямую. 
	 * В этом случае выводим ему сообщение об ошибке.
	 */
	if(isset($_POST["btn_submit_register"]) && !empty($_POST["btn_submit_register"])){
		$captcha = trim($_POST["captcha"]); //Обрезаем пробелы с начала и с конца строки
		if(isset($_POST["captcha"]) && !empty($captcha)){
			if(($_SESSION["rand_reg"] != $captcha) && ($_SESSION["rand_reg"] != "")){ //Сравниваем полученное значение с значением из сессии. 
				errorRedirect("<p class='mesage_error'><strong>Ошибка!</strong> Вы ввели неправильную капчу </p>");
			}
			
			/* 
			 * Проверяем если в глобальном массиве $_POST существуют данные отправленные из формы и заключаем переданные 
			 * данные в обычные переменные.
			 */
			
			$login = checkField("login", "Укажите Ваше логин", "Отсутствует поле с Вашим логином");
			$result_query = $mysqli->query("SELECT `login` FROM `person` WHERE `login`='".$login."'"); //Проверяем нет ли уже такого логина в БД.
			// Если кол-во полученных строк ровно единице, значит пользователь с таким почтовым адресом уже зарегистрирован
			
			if($result_query->num_rows == 1){
				//$result_query->close(); // закрытие выборки
				if(($row = $result_query->fetch_assoc()) != false){
					errorRedirect("<p class='mesage_error' >Пользователь с таким логином уже зарегистрирован</p>");
				}else{
					errorRedirect("<p class='mesage_error' >Ошибка в запросе к БД</p>");
				}
			}
			$result_query->close(); // закрытие выборки
			
			/*$sex = checkField("sex", "Укажите Ваш пол", "Отсутствует поле с Вашим полом");
			$status = checkField("status", "Укажите Ваш статус", "Отсутствует поле с Вашим статусом");
			$first_name = checkField("first_name", "Укажите Ваше имя", "Отсутствует поле с Вашим именем");
			$last_name = checkField("last_name", "Укажите Вашe фамилию", "Отсутствует поле с Вашей фамилией");
			$patronymic = checkField("patronymic", "Укажите Вашe отчество", "Отсутствует поле с Вашим отчеством");
			$organization = checkField("organization", "Укажите Вашу ответственную организацию", "Отсутствует поле с Вашей ораганизацией");
			$country = checkField("country", "Укажите Вашу страну", "Отсутствует поле с Вашей страной");
			$mobile = checkField("mobile", "Укажите Ваш мобильный номер", "Отсутствует поле с Вашим мобильным номером");
			$birth_date = checkField("birth_date", "Укажите Вашу дату рождения", "Отсутствует поле с Вашей датой рождения");
			$city = checkField("city", "Укажите Ваш город проживания", "Отсутствует поле с Вашим городом проживания");*/

			if(isset($_POST["email"])){
				$email = trim($_POST["email"]);
				if(!empty($email)){
					$email = htmlspecialchars($email, ENT_QUOTES);

					// (3) Место кода для проверки формата почтового адреса и его уникальности

					//Проверяем формат полученного почтового адреса с помощью регулярного выражения
					$reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";
					if( !preg_match($reg_email, $email)){
						errorRedirect("<p class='mesage_error' >Вы ввели неправельный email</p>");
					}
					$result_query = $mysqli->query("SELECT `email` FROM `person` WHERE `email`='".$email."'"); //Проверяем нет ли уже такого адреса в БД.

					// Если кол-во полученных строк ровно единице, значит пользователь с таким почтовым адресом уже зарегистрирован
					if($result_query->num_rows == 1){
						//$result_query->close(); // закрытие выборки
						if(($row = $result_query->fetch_assoc()) != false){
							errorRedirect("<p class='mesage_error' >Пользователь с таким почтовым адресом уже зарегистрирован</p>");
						}else{
							errorRedirect("<p class='mesage_error' >Ошибка в запросе к БД</p>");
						}
					}
					$result_query->close(); // закрытие выборки
				}else{
					errorRedirect("<p class='mesage_error' >Укажите Ваш email</p>");
				}

			}else{
				errorRedirect("<p class='mesage_error' >Отсутствует поле для ввода Email</p>");
			}
			if(isset($_POST["password"])){
				$password = trim($_POST["password"]); //Обрезаем пробелы с начала и с конца строки
				if(!empty($password)){
					$password = htmlspecialchars($password, ENT_QUOTES);
					$password = md5($password."top_secret"); //Шифруем папроль
				}else{
					errorRedirect("<p class='mesage_error' >Укажите Ваш пароль</p>");
				}
			}else{
				errorRedirect("<p class='mesage_error' >Отсутствует поле для ввода пароля</p>");
			}

			// (4) Место для кода добавления пользователя в БД

			//Запрос на добавления пользователя в БД
			$result_query_insert = $mysqli->query("INSERT INTO person(login, password, email) VALUES('".$login."', '".$password."', '".$email."');");

			if(!$result_query_insert){
				errorRedirect("<p class='mesage_error' >Ошибка запроса на добавления пользователя в БД</p>");
			}else{
				$_SESSION["success_messages"] = "<p class='success_message'>Регистрация прошла успешно!!! <br />Теперь Вы можете авторизоваться используя Ваш логин и пароль.</p>";
				header("HTTP/1.1 301 Moved Permanently"); //Отправляем пользователя на страницу авторизации
				header("Location: ".$address_site."/index.php");
			}
			$result_query_insert->close(); // Завершение запроса
			$mysqli->close(); //Закрываем подключение к БД
		}else{
			//Если капча не передана либо она является пустой
			exit("<p><strong>Ошибка!</strong> Отсутствует проверечный код, то есть код капчи. Вы можете перейти на <a href=".$address_site."> главную страницу </a>.</p>");
		}
	}else{
		exit('<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href="'.$address_site.'"> главную страницу </a>.</p>');
	}
?>
