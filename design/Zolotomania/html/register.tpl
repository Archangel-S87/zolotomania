{* Страница регистрации *}
{$meta_title = "Регистрация" scope=root}
{$page_name = "Регистрация" scope=root}
{$canonical="/user/register" scope=root}


{if isset($error)}
<div class="message_error">
	{if $error == 'empty_name'}Введите имя
	{elseif $error == 'empty_tel'}Введите телефон
	{elseif $error == 'invalid_tel'}Не корректный номер телефона
	{elseif $error == 'empty_password'}Введите пароль
	{elseif $error == 'user_exists'}
		{if $user_exists_message == 'email'}
			Пользователь с таким email уже зарегистрирован
		{elseif $user_exists_message == 'phone'}
			Пользователь с таким телефоном уже зарегистрирован
		{else}
			Пользователь с таким email и телефоном уже зарегистрирован
		{/if}
	{elseif $error == 'captcha'}Не пройдена проверка на бота
	{elseif $error == 'ip'}Вы уже регистрировались. Если забыли пароль - воспользуйтесь его востановлением.
	{elseif $error == 'wrong_name'}В поле ФИО может использоваться только кириллица
	{else}{$error}{/if}
</div>
{/if}

<style>
	.login-btn-wrap {
		margin: 50px auto 10px;
		display: flex;
		width: 400px;
		max-width: 400px;
		justify-content: space-around;
		align-items: center;
	}
	.login-btn {
		width: 40%;
		text-align: center;
	}
	.login-btn.active {
		background-color: #dbc0ce;
		border: 2px solid #dbc0ce;
	}
	.login-btn.active span {
		color: #d24a46;
	}
</style>

<div class="login-btn-wrap">
	<a href="/user/register" class="button login-btn active" onclick="window.location='/user/register'">
		<span class="username">Регистрация</span>
	</a>
	<a href="/user/login" class="button login-btn" onclick="window.location='/user/login'">
		<span class="username">Вход</span>
	</a>
</div>

<form class="form register_form" method="post" style="margin-top: 10px; position:relative;">
	<a href="/" class="form-back-page" onclick="window.history.back(); return false;"></a>
	<h1>Регистрация</h1>
	
	<input type="text" name="name" id="name" data-format=".+" data-notice="Введите имя" value="{if isset($name)}{$name|escape}{/if}" maxlength="255"   placeholder="ФИО" required/>

	<input type="tel" name="tel" id="tel" data-format=".+" data-notice="Введите телефон" value="{if isset($tel)}{$tel|escape}{/if}" maxlength="20"  placeholder="+7(___) ___-__-__" >
   
    <input type="password" name="password" id="password" data-format=".+" data-notice="Введите пароль" value="" placeholder="Пароль" />

    {include file='antibot.tpl'}

    <input style="margin-top:15px;" id="logininput" type="submit" class="button hideablebutton" name="register" value="Зарегистрироваться">

	{include file='conf.tpl'}

</form>

<script src="/js/jquery/maskedinput/dist/jquery.maskedinput.min.js"></script>
<script>
	jQuery(function($){
		const tel = $("#tel");
		tel.click(function() {
			$(this).setCursorPosition(3);
		});
		tel.mask('+7(999) 999-99-99');
	});
</script>

{if !empty($settings->ulogin)}
	<div class="socialauth">Войти через соцсети:</div>
	{* Ulogin *}
	<script defer src="https://ulogin.ru/js/ulogin.js" ></script>
	<div id="uLogin" data-ulogin="display=panel;theme=flat;fields=first_name,last_name,email;providers=vkontakte,odnoklassniki,facebook,twitter,openid,googleplus,livejournal,yandex,google;hidden=;mobilebuttons=0;"></div>
	{* Ulogin @ *}
{/if}

