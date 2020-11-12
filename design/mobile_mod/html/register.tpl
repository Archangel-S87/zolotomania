{$meta_title = "Регистрация" scope=root}
{$page_name = "Регистрация" scope=root}
{$canonical="/user/register" scope=root}

<div class="page-pg">

	{if isset($error)}
	<div class="message_error">
		{if $error == 'empty_name'}Введите имя
		{elseif $error == 'empty_email'}Введите email
		{elseif $error == 'empty_password'}Введите пароль
		{elseif $error == 'user_exists'}Пользователь с таким email уже зарегистрирован
		{elseif $error == 'captcha'}Не пройдена проверка на бота
		{elseif $error == 'ip'}Вы уже регистрировались. Если забыли пароль - воспользуйтесь его востановлением.
		{elseif $error == 'wrong_name'}В поле 'ФИО' может использоваться только кириллица		
		{else}{$error}{/if}
	</div>
	{/if}
	
	<form class="form register_form separator" method="post">
		<input placeholder="ФИО" type="text" name="name" id="name" data-format=".+" data-notice="Введите ФИО" value="{if !empty($name)}{$name|escape}{/if}" maxlength="255" required />
		
		<input type="tel" name="tel" id="tel" data-format=".+" data-notice="Введите телефон" value="{if isset($tel)}{$tel|escape}{/if}" maxlength="20"  placeholder="+7(___) ___-__-__" >
	
	  <input placeholder="Пароль" type="password" name="password" id="password" data-format=".+" data-notice="Введите пароль" value="" />
	
		<div class="captcha-block">
			{include file='antibot.tpl'}
		</div>
		<input id="logininput" type="submit" class="button hideablebutton" name="register" value="Зарегистрироваться">
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
		{* Ulogin end *}
	{/if}
</div>
