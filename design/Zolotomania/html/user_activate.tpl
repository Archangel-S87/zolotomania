{$meta_title = "Активация аккаунта" scope=root}
{$page_name = "Активация аккаунта" scope=root}

{* СМС пользователю для активации аккаунта *}

{if isset($error)}
    <div class="message_error">
        {if $error == 'user_not_found'}Пользователь не найден
        {elseif $error == 'invalid_phone'}Не корректный номер телефона
        {elseif $error == 'has_password'}Ваш аккаунт активирован. Вы можете авторизоваться или востановить пароль
        {elseif $error == 'sms_send'}Вам уже отправлено sms с кодом
        {elseif $error == 'error_code'}Неверный код
        {elseif $error == 'user_exists'}Пользователь с таким нлмером телефона уже зарегистрирован
        {else}{$error}{/if}
    </div>
{/if}

{if isset($send_code)}
    <form class="form activate_form" method="post" style="margin-top: 70px; position:relative;">

        <p>На номер телефона {if isset($phone)}{$phone|escape}{/if} отправлен код подтверждения</p>

        <input type="text" name="sms_code" data-format=".+" data-notice="Код из СМС" value=""
               maxlength="5" required placeholder="Код из СМС"/>

        <input id="logininput" style="margin-top: 20px;" type="submit" class="button" value="Активировать"/>

    </form>
{else}
    {if isset($error) && $error == 'user_not_found'}
        <p>Во время регистрации произошла ошибка. Попробцйте повторить <a href="user/register" style="">Регистрацию</a></p>
    {elseif isset($error) && $error == 'has_password'}
        <a href="user/login" style="">Авторизоваться</a>
        <a href="user/preminder" style="margin-left: 20px;">Востановить пароль</a>
    {else}
        <form class="form activate_form" method="post" style="margin-top: 70px; position:relative;">
            <h1>Активация аккаунта</h1>
            <p>На указаный номер телефона будет отправлено смс с кодом подтверждения</p>

            <input id="tel" type="text" name="phone" data-format=".+" data-notice="Введите телефон"
                   value="{if isset($phone)}{$phone|escape}{/if}" maxlength="20"/>

            <input id="logininput" type="submit" class="button" value="Получить код"/>

        </form>
    {/if}

    <script src="js/jquery/maskedinput/dist/jquery.maskedinput.min.js"></script>
    <script>
        jQuery(function ($) {
            const tel = $("#tel");
            tel.click(function() {
                $(this).setCursorPosition(3);
            });
            tel.mask('+7(999) 999-99-99');
        });
    </script>
{/if}

