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
        //Если в сессии существуют сообщения об ошибках, то выводим их
        if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
            echo $_SESSION["error_messages"];

            //Уничтожаем чтобы не выводились заново при обновлении страницы
            unset($_SESSION["error_messages"]);
        }

        //Если в сессии существуют радостные сообщения, то выводим их
        if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
            echo $_SESSION["success_messages"];
            
            //Уничтожаем чтобы не выводились заново при обновлении страницы
            unset($_SESSION["success_messages"]);
        }
    ?>
</div>

<?php 
    //Проверяем, если пользователь не авторизован, то выводим форму регистрации, 
    //иначе выводим сообщение о том, что он уже зарегистрирован
    if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
?>

<style>
	td,h2{
		color: black;
	}
	#form_register{
		padding: 40px;
		width: 400px;
		height: 850px;
		margin: 0 auto;
	}
</style>
<div id="form_register">
    <h2>Форма регистрации</h2>

    <form action="register.php" method="post" name="form_register">
        <table>
            <tr>
                <td> имя: </td>
                <td>
                    <input type="text" name="first_name" required="required"/>
                </td>
            </tr>

            <tr>
                <td> фамилия: </td>
                <td>
                    <input type="text" name="last_name" required="required" />
                </td>
            </tr>
			
			<tr>
                <td> отчество: </td>
                <td>
                    <input type="text" name="patronymic" required="required" />
                </td>
            </tr>
			
			<tr>
                <td> пол: </td>
                <td>
                    <input type="checkbox" name="sex_m" />
					<input type="checkbox" name="sex_f" />
                </td>
            </tr>
			
			<tr>
                <td> учебная организация: </td>
                <td>
                    <input type="text" name="organization" required="required" />
                </td>
            </tr>
     
            <tr>
                <td> Email: </td>
                <td>
                    <input type="email" name="email" required="required" /><br />
                    <span id="valid_email_message" class="mesage_error"></span>
                </td>
            </tr>
     
            <tr>
                <td> Пароль: </td>
                <td>
                    <input type="password" name="password" placeholder="минимум 6 символов" required="required" /><br />
                    <span id="valid_password_message" class="mesage_error"></span>
                </td>
            </tr>
			
			<tr>
                <td> страна: </td>
                <td>
                    <input type="text" name="country" required="required" /><br />
                </td>
            </tr>
			
			<tr>
                <td> город: </td>
                <td>
                    <input type="text" name="city" required="required" /><br />
                </td>
            </tr>
			
			<tr>
                <td> дата рождения: </td>
                <td>
                    <input type="text" name="birth_date" required="required" /><br/>
                </td>
            </tr>
			
			<tr>
                <td> мобильный: </td>
                <td>
                    <input type="text" name="mobile" required="required" /><br/>
                </td>
            </tr>
            <tr>
                <td> Введите капчу: </td>
                <td>
                    <p>
                        <img src="captcha.php" alt="Капча" /> <br />
                        <input type="text" name="captcha" placeholder="Проверочный код" required="required" />
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="btn_submit_register" value="Зарегистрироватся!" />
                </td>
            </tr>
        </table>
    </form>
</div>
<?php 
    }else{
?>
    <div id="authorized">
        <h2>Вы уже зарегистрированы</h2>
    </div>

<?php
    }
    
    //Подключение подвала
    require_once("footer.php");
?>