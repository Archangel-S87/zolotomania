<?php
/* Smarty version 3.1.33, created on 2020-11-03 13:09:11
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/1click.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fa1567711cc31_78567106',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '222113d988589ba7e7bddbf6cafeee240305812f' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/1click.tpl',
      1 => 1604315638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:conf.tpl' => 1,
  ),
),false)) {
function content_5fa1567711cc31_78567106 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- incl. 1click --> <a href="#oneclick" class="various oneclick">купить в 1 клик</a> <div style="display: none;"> <div id="oneclick" class="window"> <div class="title"><?php echo rtrim(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->name, ENT_QUOTES, 'UTF-8', true));?>
</div> <ul> <li><input placeholder="* ФИО" class="onename" value="<?php if (!empty($_smarty_tpl->tpl_vars['comment_name']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['comment_name']->value, ENT_QUOTES, 'UTF-8', true);
}?>" type="text" /></li> <li><input placeholder="* Email" name="email" class="onemail" value="<?php if (!empty($_smarty_tpl->tpl_vars['user']->value->email)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->email, ENT_QUOTES, 'UTF-8', true);
}?>" type="text" /></li> <li><input placeholder="* Телефон" class="onephone" value="<?php if (!empty($_smarty_tpl->tpl_vars['phone']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['phone']->value, ENT_QUOTES, 'UTF-8', true);
} elseif (!empty($_smarty_tpl->tpl_vars['user']->value->phone)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->phone, ENT_QUOTES, 'UTF-8', true);
}?>" type="text" /></li> </ul> <div id="btf_result"></div>
		<?php $_smarty_tpl->_subTemplateRender('file:conf.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<button type="submit" name="enter" value="1" class="oneclickbuy buttonred hideablebutton" style="margin-right: 0px;" <?php if ($_smarty_tpl->tpl_vars['settings']->value->counters || $_smarty_tpl->tpl_vars['settings']->value->analytics) {?>onclick="<?php if ($_smarty_tpl->tpl_vars['settings']->value->counters) {?>ym(<?php echo $_smarty_tpl->tpl_vars['settings']->value->counters;?>
,'reachGoal','cart'); <?php }
if ($_smarty_tpl->tpl_vars['settings']->value->analytics) {?>ga ('send', 'event', 'cart', 'order_button');<?php }?> return true;"<?php }?>>Заказать</button> </div> </div> <!-- incl. 1click @ --><?php }
}
