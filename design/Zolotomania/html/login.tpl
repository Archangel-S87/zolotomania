{* Страница входа пользователя *}
{$meta_title = "Вход" scope=root}
{$page_name = "Вход" scope=root}
{$canonical="/user/login" scope=root}


{if isset($error)}
<div class="message_error">
	{if $error == 'login_incorrect'}Неверный логин или пароль
	{elseif $error == 'user_disabled'}Ваш аккаунт еще не активирован
	{elseif $error == 'captcha'}Не пройдена проверка на бота
	{elseif $error == 'ip'}Подозрительная активность
	{elseif $error == 'wrong_name'}В поле Имя может использоваться только кириллица
	{else}{$error}{/if}
</div>
{/if}

{* Если не отписка от рассылки*}
{if !isset($hideform)}
	<form class="form login_form" method="post" style="margin-top: 70px; position:relative;">
		<a href="/" class="form-back-page" onclick="window.history.back(); return false;"></a>
		<h1>Вход</h1>
		<input id="login" type="text" name="user_login" data-format=".+" data-notice="Введите номер телефона" value="{if isset($email)}{$email|escape}{/if}" maxlength="255" placeholder="+7(___) ___-__-__"/>

		<input type="password" name="password" data-format=".+" data-notice="Введите пароль" value="" placeholder="Пароль" />
		<a class="remember-password" href="user/preminder">Забыли пароль?</a>
		<input type="submit" class="button" name="login" value="Войти">
		<div class="login_register">или <a class="bluelink" href="user/register">зарегистрироваться</a></div>
	</form>

	<script src="/js/jquery/maskedinput/dist/jquery.maskedinput.min.js"></script>
	<script>
		$(function ($) {
			const login = $("#login");
			login.click(function() {
				$(this).setCursorPosition(3);
			});
			login.mask('+7(999) 999-99-99');
		});
	</script>

	{if !empty($settings->ulogin)}
		<div class="socialauth">Войти через соцсети:</div>
		<script defer src="https://ulogin.ru/js/ulogin.js" ></script>
		<div id="uLogin" data-ulogin="display=panel;theme=flat;fields=first_name,last_name,email;providers=vkontakte,odnoklassniki,facebook,twitter,openid,googleplus,livejournal,yandex,google;hidden=;mobilebuttons=0;"></div>
	{/if}
{/if}
