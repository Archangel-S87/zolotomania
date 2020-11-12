<?php
/* Smarty version 3.1.33, created on 2020-11-12 16:42:19
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fad65ebbdb813_91097843',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b3505f5d731c65c0ed62aec4c018f85e2034174b' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/login.tpl',
      1 => 1605195466,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fad65ebbdb813_91097843 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('meta_title', "Вход" ,false ,8);
$_smarty_tpl->_assignInScope('page_name', "Вход" ,false ,8);
$_smarty_tpl->_assignInScope('canonical', "/user/login" ,false ,8);?>
<div class="page-pg">
	<?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
	<div class="message_error">
		<?php if ($_smarty_tpl->tpl_vars['error']->value == 'login_incorrect') {?>Неверный логин или пароль
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'user_disabled') {?>Ваш аккаунт еще не активирован
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'captcha') {?>Не пройдена проверка на бота
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'ip') {?>Подозрительная активность
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'wrong_name') {?>В поле Имя может использоваться только кириллица
		<?php } else {
echo $_smarty_tpl->tpl_vars['error']->value;
}?>
	</div>
	<?php }?>
		<?php if (!isset($_smarty_tpl->tpl_vars['hideform']->value)) {?>	
		<form class="form login_form separator" method="post"> <label>Телефон</label> <input id="login" type="text" name="user_login" data-format=".+" data-notice="Введите номер телефона" value="<?php if (isset($_smarty_tpl->tpl_vars['email']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['email']->value, ENT_QUOTES, 'UTF-8', true);
}?>" maxlength="255" placeholder="+7(___) ___-__-__"/> <label>Пароль (<a href="user/preminder">напомнить</a>)</label> <input type="password" name="password" data-format=".+" data-notice="Введите пароль" value="" /> <input type="submit" class="button" name="login" value="Войти"> <a class="logreg" href="/user/register">Зарегистрироваться</a> </form> <?php echo '<script'; ?>
 src="/js/jquery/maskedinput/dist/jquery.maskedinput.min.js"><?php echo '</script'; ?>
> <?php echo '<script'; ?>
>
			$(function ($) {
				const login = $("#login");
				login.click(function() {
					$(this).setCursorPosition(3);
				});
				login.mask('+7(999) 999-99-99');
			});
		<?php echo '</script'; ?>
>
		<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value->ulogin)) {?>
			<div class="socialauth">Войти через соцсети:</div>
						<?php echo '<script'; ?>
 defer src="https://ulogin.ru/js/ulogin.js" ><?php echo '</script'; ?>
> <div id="uLogin" data-ulogin="display=panel;theme=flat;fields=first_name,last_name,email;providers=vkontakte,odnoklassniki,facebook,twitter,openid,googleplus,livejournal,yandex,google;hidden=;mobilebuttons=0;"></div>
					<?php }?>
	<?php }?>
</div><?php }
}
