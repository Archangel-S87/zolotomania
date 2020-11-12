<?php
/* Smarty version 3.1.33, created on 2020-11-12 09:56:27
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/password_remind.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fad06cb9215b1_71567404',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '477d464411b1ddc8e7da62c684db5c7eece317a4' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/password_remind.tpl',
      1 => 1605174986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fad06cb9215b1_71567404 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('meta_title', "Восстановление пароля" ,false ,8);
$_smarty_tpl->_assignInScope('page_name', "Восстановление пароля" ,false ,8);
if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
	<div class="message_error">
		<?php if ($_smarty_tpl->tpl_vars['error']->value == 'user_not_found') {?>Пользователь не найден
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'sms_send') {?>Вам уже отправлено sms с кодом
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'error_code') {?>Неверный код
		<?php } else {
echo $_smarty_tpl->tpl_vars['error']->value;
}?>
	</div>
<?php }
if (isset($_smarty_tpl->tpl_vars['send_code']->value)) {?>
	<form class="form activate_form separator" method="post"> <p>На номер телефона <?php if (isset($_smarty_tpl->tpl_vars['phone']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['phone']->value, ENT_QUOTES, 'UTF-8', true);
}?> отправлен код подтверждения</p> <input type="text" name="sms_code" data-format=".+" data-notice="Код из СМС" value="" maxlength="5" required placeholder="Код из СМС"/> <input id="logininput" style="margin-top: 20px;" type="submit" class="button" value="Отправить"/> </form>
<?php } else { ?>
    <form class="form password_remind separator" method="post"> <p>На указаный номер телефона будет отправлено смс с кодом подтверждения</p> <input id="phone" type="text" name="phone" data-format=".+" data-notice="Введите номер телефона" value="<?php if (isset($_smarty_tpl->tpl_vars['phone']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['phone']->value, ENT_QUOTES, 'UTF-8', true);
}?>" maxlength="255" placeholder="+7(___) ___-__-__" /> <input id="logininput" type="submit" class="button" value="Вспомнить"/> </form> <?php echo '<script'; ?>
 src="js/jquery/maskedinput/dist/jquery.maskedinput.min.js"><?php echo '</script'; ?>
> <?php echo '<script'; ?>
>
      jQuery(function ($) {
        const phone = $("#phone");
				phone.click(function () {
          $(this).setCursorPosition(3);
        });
				phone.mask('+7(999) 999-99-99');
			});
    <?php echo '</script'; ?>
>
<?php }
}
}
