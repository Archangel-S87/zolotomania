<?php
/* Smarty version 3.1.33, created on 2020-11-12 16:43:15
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/register.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fad6623969978_76000625',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '393ebd4056f57b4d465151def8117881ce573400' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/register.tpl',
      1 => 1605196428,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:antibot.tpl' => 1,
    'file:conf.tpl' => 1,
  ),
),false)) {
function content_5fad6623969978_76000625 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('meta_title', "Регистрация" ,false ,8);
$_smarty_tpl->_assignInScope('page_name', "Регистрация" ,false ,8);
$_smarty_tpl->_assignInScope('canonical', "/user/register" ,false ,8);?>

<div class="page-pg">

	<?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
	<div class="message_error">
		<?php if ($_smarty_tpl->tpl_vars['error']->value == 'empty_name') {?>Введите имя
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'empty_email') {?>Введите email
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'empty_password') {?>Введите пароль
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'user_exists') {?>Пользователь с таким email уже зарегистрирован
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'captcha') {?>Не пройдена проверка на бота
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'ip') {?>Вы уже регистрировались. Если забыли пароль - воспользуйтесь его востановлением.
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'wrong_name') {?>В поле 'ФИО' может использоваться только кириллица		
		<?php } else {
echo $_smarty_tpl->tpl_vars['error']->value;
}?>
	</div>
	<?php }?>
	
	<form class="form register_form separator" method="post"> <input placeholder="ФИО" type="text" name="name" id="name" data-format=".+" data-notice="Введите ФИО" value="<?php if (!empty($_smarty_tpl->tpl_vars['name']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);
}?>" maxlength="255" required /> <input type="tel" name="tel" id="tel" data-format=".+" data-notice="Введите телефон" value="<?php if (isset($_smarty_tpl->tpl_vars['tel']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['tel']->value, ENT_QUOTES, 'UTF-8', true);
}?>" maxlength="20" placeholder="+7(___) ___-__-__" > <input placeholder="Пароль" type="password" name="password" id="password" data-format=".+" data-notice="Введите пароль" value="" /> <div class="captcha-block">
			<?php $_smarty_tpl->_subTemplateRender('file:antibot.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		</div> <input id="logininput" type="submit" class="button hideablebutton" name="register" value="Зарегистрироваться">
		<?php $_smarty_tpl->_subTemplateRender('file:conf.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	</form> <?php echo '<script'; ?>
 src="/js/jquery/maskedinput/dist/jquery.maskedinput.min.js"><?php echo '</script'; ?>
> <?php echo '<script'; ?>
>
		jQuery(function($){
			const tel = $("#tel");
			tel.click(function() {
				$(this).setCursorPosition(3);
			});
			tel.mask('+7(999) 999-99-99');
		});
	<?php echo '</script'; ?>
>
	<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value->ulogin)) {?>
		<div class="socialauth">Войти через соцсети:</div>
				<?php echo '<script'; ?>
 defer src="https://ulogin.ru/js/ulogin.js" ><?php echo '</script'; ?>
> <div id="uLogin" data-ulogin="display=panel;theme=flat;fields=first_name,last_name,email;providers=vkontakte,odnoklassniki,facebook,twitter,openid,googleplus,livejournal,yandex,google;hidden=;mobilebuttons=0;"></div>
			<?php }?>
</div><?php }
}
