<?php
/* Smarty version 3.1.33, created on 2020-11-12 16:07:31
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/user.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fad5dc33bbe15_75741103',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8cbc3cd157fe3770826e0577959c74a785659d37' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/user.tpl',
      1 => 1605196785,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fad5dc33bbe15_75741103 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('meta_title', "Личный кабинет" ,false ,8);
$_smarty_tpl->_assignInScope('page_name', "Личный кабинет" ,false ,8);?>
<div class="page-pg">
	<?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
	<div class="message_error">
		<?php if ($_smarty_tpl->tpl_vars['error']->value == 'empty_name') {?>Введите имя
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'empty_email') {?>Введите email
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'empty_phone') {?>Введите Телефон
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'empty_password') {?>Введите пароль
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'user_exists') {?>Пользователь с таким email уже зарегистрирован
		<?php } else {
echo $_smarty_tpl->tpl_vars['error']->value;
}?>
	</div>
	<?php }?>
	

	<form class="form separator" method="post"> <label>ФИО</label> <input data-format=".+" data-notice="Введите имя" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
" name="name" maxlength="255" type="text" required/> <label>Телефон</label> <input data-format=".+" data-notice="Введите Телефон" value="<?php if (!empty($_smarty_tpl->tpl_vars['phone']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['phone']->value, ENT_QUOTES, 'UTF-8', true);
}?>" name="phone" maxlength="255" type="tel" required/> <label>Адресс</label> <textarea name="address" type="text" rows="1" value=""><?php if (isset($_smarty_tpl->tpl_vars['address']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['address']->value, ENT_QUOTES, 'UTF-8', true);
}?></textarea> <label class="ch_passw"><a href='#' onclick="$('#password').show();return false;">Изменить пароль</a></label> <input id="password" value="" name="password" type="password" style="display:none; margin-bottom: 20px;"/> <input id="logininput" type="submit" class="button buttonblue" value="Сохранить"> </form>
	
	<?php if (!empty($_smarty_tpl->tpl_vars['user']->value->comment)) {?>
		<div class="mainproduct blue">Информация для пользователя:</div> <div class="user_comment"><?php echo $_smarty_tpl->tpl_vars['user']->value->comment;?>
</div>
	<?php }?>
	
	<?php if (!empty($_smarty_tpl->tpl_vars['orders']->value)) {?>
		<h2 class="your_orders">Ваши заказы:</h2> <ul id="orders_history">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['orders']->value, 'order', false, NULL, 'orders', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['order']->value) {
?>
			<li>
				<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value->date ));?>
 <?php if ($_smarty_tpl->tpl_vars['order']->value->status != 3) {?><a href='order/<?php echo $_smarty_tpl->tpl_vars['order']->value->url;?>
'>Заказ №<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
</a><?php } else { ?>Заказ №<?php echo $_smarty_tpl->tpl_vars['order']->value->id;
}?>
				<?php if ($_smarty_tpl->tpl_vars['order']->value->paid == 1) {?>оплачен,<?php }?> 
				(<?php if ($_smarty_tpl->tpl_vars['order']->value->status == 0) {?>ждет обработки<?php } elseif ($_smarty_tpl->tpl_vars['order']->value->status == 4) {?>в обработке<?php } elseif ($_smarty_tpl->tpl_vars['order']->value->status == 1) {?>выполняется<?php } elseif ($_smarty_tpl->tpl_vars['order']->value->status == 2) {?>выполнен<?php } elseif ($_smarty_tpl->tpl_vars['order']->value->status == 3) {?>отменен<?php }?>)
			</li>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</ul>
	<?php }?>
	
	<?php if (($_smarty_tpl->tpl_vars['user']->value->discount && in_array($_smarty_tpl->tpl_vars['settings']->value->enable_groupdiscount,array(1,3,4))) || ($_smarty_tpl->tpl_vars['user']->value->tdiscount && in_array($_smarty_tpl->tpl_vars['settings']->value->enable_groupdiscount,array('5','4'))) || $_smarty_tpl->tpl_vars['user']->value->order_payd > 0 || $_smarty_tpl->tpl_vars['user']->value->balance > 0) {?>
		<div class="discountsblock">
			<?php if ($_smarty_tpl->tpl_vars['user']->value->discount && in_array($_smarty_tpl->tpl_vars['settings']->value->enable_groupdiscount,array(1,3,4))) {?>
				<p><strong>Постоянная скидка:</strong> <?php echo $_smarty_tpl->tpl_vars['user']->value->discount;?>
%</p>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['user']->value->tdiscount && in_array($_smarty_tpl->tpl_vars['settings']->value->enable_groupdiscount,array(5,4))) {?>
				<p><strong>Накопительная скидка:</strong> <?php echo $_smarty_tpl->tpl_vars['user']->value->tdiscount;?>
%</p>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['user']->value->order_payd > 0) {?>
				<p><strong>Заказов оплачено на сумму:</strong> <span style="white-space:nowrap;"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['user']->value->order_payd ));?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->sign, ENT_QUOTES, 'UTF-8', true);?>
</span></p>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['user']->value->balance > 0) {?>
				<div class="hasbonuses"><strong>Всего накоплено баллов на:</strong> <span style="white-space:nowrap;"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( round($_smarty_tpl->tpl_vars['user']->value->balance) ));?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</span> </div>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['settings']->value->bonus_link) {?>
				<p class="about_bonus"><a class="bluelink" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->bonus_link, ENT_QUOTES, 'UTF-8', true);?>
">Описание бонусной программы</a></p>
			<?php }?>
		</div>	
	<?php }?>
	
	<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value->ref_order)) {?>
		<div class="mainproduct ref_link_title">Ваша партнерская ссылка:</div> <div class="ref_link"><span><?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/?appid=<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
</span></div> <p>Также партнерская ссылка может указывать на любую страницу сайта:</p> <p>Например: <?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/blog?appid=<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
</p> <p class="ref_you_get">Вы получаете <span class="ref_procent"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->ref_order, ENT_QUOTES, 'UTF-8', true);?>
%</span> от платежей ваших рефералов</p>
		<?php if ($_smarty_tpl->tpl_vars['settings']->value->ref_link) {?><p class="about_ref"><a class="bluelink" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->ref_link, ENT_QUOTES, 'UTF-8', true);?>
">Описание реферальной программы</a></p><?php }?>
		<div class="withdrawal_title">Переходов по ссылкам: <span style="font-size:16px;color:#8ba76b;"><?php echo $_smarty_tpl->tpl_vars['user']->value->ref_views;?>
</span></div>
	<?php }?>
	
	<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value->ref_order) && $_smarty_tpl->tpl_vars['referrals']->value) {?>
		<h3 class="referrals_title">Привлеченные клиенты:</h3> <div class="referrals"> <div class="ref_item"> <div class="ref_id">ID</div> <div class="ref_date">Регистрация</div> <div class="ref_ballov">Платежи</div> <div class="ref_profit">Прибыль</div> </div>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['referrals']->value, 'ref');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ref']->value) {
?>
			<div class="ref_item"> <div class="ref_id"><?php echo $_smarty_tpl->tpl_vars['ref']->value->id;?>
</div> <div class="ref_date"><?php echo $_smarty_tpl->tpl_vars['ref']->value->created;?>
</div> <div class="ref_ballov"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['ref']->value->order_payd ));?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</div> <div class="ref_profit"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( ($_smarty_tpl->tpl_vars['ref']->value->order_payd/100*$_smarty_tpl->tpl_vars['settings']->value->ref_order) ));?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</div> </div>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</div>
	<?php }?>
	
	<?php if (!empty($_smarty_tpl->tpl_vars['user']->value->withdrawal)) {?>
		<div class="withdrawal"> <div class="withdrawal_title">Всего баллов выведено:</div> <ul><?php echo $_smarty_tpl->tpl_vars['user']->value->withdrawal;?>
</ul> </div>
	<?php }?>

	<div class="separator"> <a href="user/logout" class="button buttonblue">Разлогиниться</a> </div> </div><?php }
}
