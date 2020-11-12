<?php
/* Smarty version 3.1.33, created on 2020-11-12 12:11:03
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/responses.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fad2657380e38_82036673',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ef5b1f3184cba7f556cd38636d766a4c952c78c2' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/responses.tpl',
      1 => 1605183043,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:antibot.tpl' => 1,
    'file:conf.tpl' => 1,
  ),
),false)) {
function content_5fad2657380e38_82036673 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('canonical', "/".((string)$_smarty_tpl->tpl_vars['page']->value->url) ,false ,8);?>

<?php if (!empty($_smarty_tpl->tpl_vars['metadata_page']->value->description) || !empty($_smarty_tpl->tpl_vars['page']->value->body)) {?>
	<div class="page-pg" itemprop="description">
		<?php if (!empty($_smarty_tpl->tpl_vars['metadata_page']->value->description)) {
echo $_smarty_tpl->tpl_vars['metadata_page']->value->description;
} elseif (!empty($_smarty_tpl->tpl_vars['page']->value->body)) {
echo $_smarty_tpl->tpl_vars['page']->value->body;
}?>
	</div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['settings']->value->hidecomment == 0) {?>
		<div id="comments">
		<?php if ($_smarty_tpl->tpl_vars['comments']->value) {?>
						<ul class="comment_list">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['comments']->value, 'comment');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['comment']->value) {
?>
				<li> <a name="comment_<?php echo $_smarty_tpl->tpl_vars['comment']->value->id;?>
"></a> <div class="comment_header" id="comment_<?php echo $_smarty_tpl->tpl_vars['comment']->value->id;?>
">	
						<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['comment']->value->name, ENT_QUOTES, 'UTF-8', true);?>
 <i><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['comment']->value->date ));?>
, <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'time' ][ 0 ], array( $_smarty_tpl->tpl_vars['comment']->value->date ));?>
</i> </div>
					<?php if (!$_smarty_tpl->tpl_vars['comment']->value->approved) {?><div class="moderation">(на модерации)</div><?php }?>
					<div class="comment_body"><?php echo nl2br(htmlspecialchars($_smarty_tpl->tpl_vars['comment']->value->text, ENT_QUOTES, 'UTF-8', true));?>
</div>
			
					<?php if ($_smarty_tpl->tpl_vars['comment']->value->otvet) {?>
					<div class="comment_admint">Администрация:</div> <div class="comment_admin">
						<?php echo $_smarty_tpl->tpl_vars['comment']->value->otvet;?>

					</div>
					<?php }?>
				</li>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</ul>
			<?php if (count($_smarty_tpl->tpl_vars['comments']->value) > 10) {?>	
				<input type='hidden' id='current_page' /> <input type='hidden' id='show_per_page' /> <div class="separator"><div id="page_navigation" class="pagination"></div></div>
			<?php }?>
					<?php }?>
	
			
		<form class="comment_form" method="post" action=""> <h2>Написать отзыв</h2>
			<?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
			<div class="message_error">
				<?php if ($_smarty_tpl->tpl_vars['error']->value == 'captcha') {?>
				Не пройдена проверка на бота
				<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'empty_name') {?>
				Введите имя
				<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'empty_comment') {?>
				Введите комментарий
				<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'empty_email') {?>
				Введите E-Mail
				<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'wrong_name') {?>
				В поле 'Имя' может использоваться только кириллица	
				<?php }?>
			</div>
			<?php }?>
			<textarea class="comment_textarea" id="comment_text" name="text" data-format=".+" data-notice="Введите комментарий" required><?php if (!empty($_smarty_tpl->tpl_vars['comment_text']->value)) {
echo $_smarty_tpl->tpl_vars['comment_text']->value;
}?></textarea> <div> <input style="margin-top:7px;" placeholder="Имя" class="input_name" type="text" id="comment_name" name="name" value="<?php if (!empty($_smarty_tpl->tpl_vars['comment_name']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['comment_name']->value, ENT_QUOTES, 'UTF-8', true);
}?>" data-format=".+" data-notice="Введите имя" required/> <input style="margin-top:10px;" placeholder="E-mail" class="input_name" type="email" id="comment_email" name="email" value="<?php if (!empty($_smarty_tpl->tpl_vars['comment_email']->value)) {
echo $_smarty_tpl->tpl_vars['comment_email']->value;
}?>" data-format=".+" data-notice="Введите E-Mail" required/> <div class="captcha-block">
				<?php $_smarty_tpl->_subTemplateRender('file:antibot.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			</div>
			<?php $_smarty_tpl->_subTemplateRender('file:conf.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<input class="button hideablebutton" type="submit" name="comment" value="Отправить" /> </div> </form> </div>
<?php }
}
}
