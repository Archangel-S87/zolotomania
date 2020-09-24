{$meta_title = "Восстановление пароля" scope=root}
{$page_name = "Восстановление пароля" scope=root}

{* Письмо пользователю для восстановления пароля *}

{if isset($email_sent)}
	<h1 style="margin-top: 30px; position:relative;">Вам отправлено письмо</h1>

	<p>На {$email|escape} отправлено письмо для восстановления пароля.</p>
{else}
	{if isset($error)}
	<div class="message_error">
		{if $error == 'user_not_found'}Пользователь не найден
		{else}{$error}{/if}
	</div>
	{/if}

	<form class="form login_form" method="post" style="margin-top: 30px; position:relative;">
		<a href="/" class="form-back-page" onclick="window.history.back(); return false;"></a>
		<h1>Напоминание пароля</h1>
		<label>Введите email, который вы указывали при регистрации</label>
		<input type="text" name="email" data-format="email" data-notice="Введите email или номер телефона" value="{if isset($email)}{$email|escape}{/if}"  maxlength="255"/>
		<input id="logininput" type="submit" class="button" value="Вспомнить" />
	</form>
{/if}
