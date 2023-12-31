{$meta_title = "Восстановление пароля" scope=root}
{$page_name = "Восстановление пароля" scope=root}
{if isset($error)}
	<div class="message_error">
		{if $error == 'user_not_found'}Пользователь не найден
		{elseif $error == 'sms_send'}Вам уже отправлено sms с кодом
		{elseif $error == 'error_code'}Неверный код
		{else}{$error}{/if}
	</div>
{/if}
{if isset($send_code)}
	<form class="form activate_form separator" method="post">
		<p>На номер телефона {if isset($phone)}{$phone|escape}{/if} отправлен код подтверждения</p>
		<input type="text" name="sms_code" data-format=".+" data-notice="Код из СМС" value="" maxlength="5" required placeholder="Код из СМС"/>
		<input id="logininput" style="margin-top: 20px;" type="submit" class="button" value="Отправить"/>
	</form>
{else}
    <form class="form password_remind separator" method="post">
      <p>На указаный номер телефона будет отправлено смс с кодом подтверждения</p>
      <input id="phone" type="text" name="phone" data-format=".+" data-notice="Введите номер телефона" value="{if isset($phone)}{$phone|escape}{/if}" maxlength="255" placeholder="+7(___) ___-__-__" />
      <input id="logininput" type="submit" class="button" value="Вспомнить"/>
    </form>

    <script src="js/jquery/maskedinput/dist/jquery.maskedinput.min.js"></script>
    <script>
      jQuery(function ($) {
        const phone = $("#phone");
				phone.click(function () {
          $(this).setCursorPosition(3);
        });
				phone.mask('+7(999) 999-99-99');
			});
    </script>
{/if}
