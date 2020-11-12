<?php
/* Smarty version 3.1.33, created on 2020-11-02 15:52:47
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/feedback.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fa02b4f1f08b6_84308511',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8029aa2e57fd9fb0b2e86e95dc11f1034b6ea4f3' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/feedback.tpl',
      1 => 1604315638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:antibot.tpl' => 1,
    'file:conf.tpl' => 1,
  ),
),false)) {
function content_5fa02b4f1f08b6_84308511 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('canonical', "/".((string)$_smarty_tpl->tpl_vars['page']->value->url) ,false ,8);?>

<div class="page-pg">
	<?php echo $_smarty_tpl->tpl_vars['page']->value->body;?>

</div>

<?php if (isset($_smarty_tpl->tpl_vars['message_sent']->value)) {?>
	<div class="page-pg"> <strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
, ваше сообщение отправлено.</strong> </div>
<?php } else { ?>
<form class="form feedback_form" method="post"> <h2>Обратная связь:</h2>
	<?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
	<div class="message_error">
		<?php if ($_smarty_tpl->tpl_vars['error']->value == 'captcha') {?>
		Не пройдена проверка на бота
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'empty_name') {?>
		Введите имя
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'empty_email') {?>
		Введите email
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'empty_text') {?>
		Введите сообщение
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'wrong_name') {?>
		В поле 'Имя' может использоваться только кириллица	
		<?php }?>
	</div>
	<?php }?>
	<input placeholder="* Имя" data-format=".+" data-notice="Введите имя" value="<?php if (!empty($_smarty_tpl->tpl_vars['name']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);
}?>" name="name" maxlength="255" type="text" required /> <input placeholder="* E-mail" data-format="email" data-notice="Введите E-mail" value="<?php if (!empty($_smarty_tpl->tpl_vars['email']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['email']->value, ENT_QUOTES, 'UTF-8', true);
}?>" name="email" maxlength="255" type="email" required /> <textarea placeholder="Сообщение" data-format=".+" data-notice="Введите сообщение" name="message" required ><?php if (!empty($_smarty_tpl->tpl_vars['message']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['message']->value, ENT_QUOTES, 'UTF-8', true);
}?></textarea> <div class="captcha-block">
		<?php $_smarty_tpl->_subTemplateRender('file:antibot.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	</div>
	<?php $_smarty_tpl->_subTemplateRender('file:conf.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	<input class="button hideablebutton" type="submit" name="feedback" value="Отправить" /> </form>
<?php }
}
}
