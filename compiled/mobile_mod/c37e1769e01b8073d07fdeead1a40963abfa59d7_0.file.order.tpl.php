<?php
/* Smarty version 3.1.33, created on 2020-11-12 11:15:28
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/order.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fad1950f2dc60_74147168',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c37e1769e01b8073d07fdeead1a40963abfa59d7' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/order.tpl',
      1 => 1605179669,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fad1950f2dc60_74147168 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['order']->value->status == 0) {
$_smarty_tpl->_assignInScope('order_status', "ждет обработки");
} elseif ($_smarty_tpl->tpl_vars['order']->value->status == 4) {
$_smarty_tpl->_assignInScope('order_status', "в обработке");
} elseif ($_smarty_tpl->tpl_vars['order']->value->status == 1) {
$_smarty_tpl->_assignInScope('order_status', "выполняется");
} elseif ($_smarty_tpl->tpl_vars['order']->value->status == 2) {
$_smarty_tpl->_assignInScope('order_status', "выполнен");
} elseif ($_smarty_tpl->tpl_vars['order']->value->status == 3) {
$_smarty_tpl->_assignInScope('order_status', "отменен");
}
if ($_smarty_tpl->tpl_vars['order']->value->paid == 1) {
$_smarty_tpl->_assignInScope('order_paid', ", оплачен");
} else {
$_smarty_tpl->_assignInScope('order_paid', '');
}
$_smarty_tpl->_assignInScope('meta_title', "Ваш заказ №".((string)$_smarty_tpl->tpl_vars['order']->value->id)." ".((string)$_smarty_tpl->tpl_vars['order_status']->value).((string)$_smarty_tpl->tpl_vars['order_paid']->value) ,false ,8);
$_smarty_tpl->_assignInScope('page_name', "Заказ №".((string)$_smarty_tpl->tpl_vars['order']->value->id)." ".((string)$_smarty_tpl->tpl_vars['order_status']->value).((string)$_smarty_tpl->tpl_vars['order_paid']->value) ,false ,8);?>

<?php echo '<script'; ?>
 type="text/javascript">
	function hideShow(el){
	$(el).toggleClass('show').siblings('div#hideCont').slideToggle('normal');return false;
	};
<?php echo '</script'; ?>
>

<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['api'][0], array( array('module'=>'delivery','method'=>'get_deliveries','var'=>'deliveries','enabled'=>1),$_smarty_tpl ) );?>

	<?php if (empty($_smarty_tpl->tpl_vars['payment_methods']->value) || !empty($_smarty_tpl->tpl_vars['payment_method']->value)) {
$_smarty_tpl->_assignInScope('show_greetings', 1);
}?>
	<?php if (empty($_smarty_tpl->tpl_vars['order']->value->paid) && $_smarty_tpl->tpl_vars['order']->value->status != 3) {?>
				<?php if (!empty($_smarty_tpl->tpl_vars['payment_methods']->value) && empty($_smarty_tpl->tpl_vars['payment_method']->value) && !empty($_smarty_tpl->tpl_vars['order']->value->total_price)) {?>
			<div class="cart-blue"> <span class="whitecube">3</span><h2>Выберите вариант оплаты</h2> </div> <form id="orderform" method="post"> <ul id="deliveries">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['payment_methods']->value, 'payment_method');
$_smarty_tpl->tpl_vars['payment_method']->index = -1;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['payment_method']->value) {
$_smarty_tpl->tpl_vars['payment_method']->index++;
$_smarty_tpl->tpl_vars['payment_method']->first = !$_smarty_tpl->tpl_vars['payment_method']->index;
$__foreach_payment_method_0_saved = $_smarty_tpl->tpl_vars['payment_method'];
?>
						<li> <div class="checkbox"> <input type=radio name=payment_method_id value='<?php echo $_smarty_tpl->tpl_vars['payment_method']->value->id;?>
' <?php if ($_smarty_tpl->tpl_vars['payment_method']->first) {?>checked<?php }?> id=payment_<?php echo $_smarty_tpl->tpl_vars['payment_method']->value->id;?>
> </div> <div class="deliverywrapper"> <label for="payment_<?php echo $_smarty_tpl->tpl_vars['payment_method']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['payment_method']->value->description) {?>class="hideBtn" onclick="hideShow(this);$('#payment_<?php echo $_smarty_tpl->tpl_vars['payment_method']->value->id;?>
').click();return false;"<?php }?>><div class="delivery-header"><?php echo $_smarty_tpl->tpl_vars['payment_method']->value->name;?>
, к оплате <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value->total_price,$_smarty_tpl->tpl_vars['payment_method']->value->currency_id ));?>
 <?php if (!empty($_smarty_tpl->tpl_vars['all_currencies']->value[$_smarty_tpl->tpl_vars['payment_method']->value->currency_id]->sign)) {
echo $_smarty_tpl->tpl_vars['all_currencies']->value[$_smarty_tpl->tpl_vars['payment_method']->value->currency_id]->sign;
}?></div></label> <div class="description" id="hideCont">
									<?php echo $_smarty_tpl->tpl_vars['payment_method']->value->description;?>

								</div> </div> </li>
					<?php
$_smarty_tpl->tpl_vars['payment_method'] = $__foreach_payment_method_0_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</ul> <div class="page-pg"><input type='submit' class="button buttonblue" value='Сохранить вариант оплаты'></div> </form>
		<?php } elseif (!empty($_smarty_tpl->tpl_vars['payment_method']->value)) {?>
			<div class="page-pg"> <p class="orderstatus">Способ оплаты - <?php echo $_smarty_tpl->tpl_vars['payment_method']->value->name;?>
</p> <form id="paymentform" method=post> <input type=submit id="reset_payment" class="button buttonblue" name='reset_payment_method' value='Выбрать другой способ оплаты'> </form>
		
				<?php if (empty($_smarty_tpl->tpl_vars['settings']->value->payment_control) || ($_smarty_tpl->tpl_vars['settings']->value->payment_control == 1 && in_array($_smarty_tpl->tpl_vars['order']->value->status,array(1,2))) || ($_smarty_tpl->tpl_vars['settings']->value->payment_control == 2 && (empty(count($_smarty_tpl->tpl_vars['deliveries']->value)) || !empty($_smarty_tpl->tpl_vars['delivery']->value)))) {?>
					<?php $_smarty_tpl->_assignInScope('payment_control', 1);?>
					<p class="orderstatus separator">
						К оплате <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value->total_price,$_smarty_tpl->tpl_vars['payment_method']->value->currency_id ));?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['all_currencies']->value[$_smarty_tpl->tpl_vars['payment_method']->value->currency_id]->sign;?>

					</p>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['checkout_form'][0], array( array('order_id'=>$_smarty_tpl->tpl_vars['order']->value->id,'module'=>$_smarty_tpl->tpl_vars['payment_method']->value->module),$_smarty_tpl ) );?>

				<?php }?>
			</div>
		<?php }?>
	<?php }?>

	<?php if (!empty($_smarty_tpl->tpl_vars['show_greetings']->value)) {?>
	<div class="page-pg"> <div class="attention"> <p>Спасибо за заказ!</p>
			<?php if (empty($_smarty_tpl->tpl_vars['order']->value->paid) && $_smarty_tpl->tpl_vars['order']->value->status != 3) {?>
				<?php if (!empty($_smarty_tpl->tpl_vars['payment_control']->value)) {?>
					<p>Если вы выбрали вариант онлайн-оплаты, то произведите ее на этой странице.</p>
				<?php }?>
				<p>С вами в ближайшее время свяжется наш менеджер.</p>
			<?php }?>
		</div> </div>
	<?php }?>

	<ul class="purchaseslist">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['purchases']->value, 'purchase');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['purchase']->value) {
?>
			<li class="purchase"> <div class="image">
					<?php if (!empty($_smarty_tpl->tpl_vars['purchase']->value->product->images)) {?>
						<?php $_smarty_tpl->_assignInScope('image', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'first' ][ 0 ], array( $_smarty_tpl->tpl_vars['purchase']->value->product->images )));?>
						<a href="products/<?php echo $_smarty_tpl->tpl_vars['purchase']->value->product->url;?>
"><img alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['purchase']->value->product->name, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['purchase']->value->product->name, ENT_QUOTES, 'UTF-8', true);?>
" src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'resize' ][ 0 ], array( $_smarty_tpl->tpl_vars['image']->value->filename,100,100 ));?>
"></a>
					<?php } else { ?>
						<svg class="nophoto" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <circle cx="12" cy="12" r="3.2"/> <path d="M9 2L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2h-3.17L15 2H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"/> <path d="M0 0h24v24H0z" fill="none"/> </svg>
					<?php }?>
				</div> <div class="product_info separator"> <h3 class="purchasestitle"><a href="products/<?php echo $_smarty_tpl->tpl_vars['purchase']->value->product->url;?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['purchase']->value->product->name, ENT_QUOTES, 'UTF-8', true);?>
</a>
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['purchase']->value->variant->name, ENT_QUOTES, 'UTF-8', true);?>
</h3> <div class="price"> <span class="purprice"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( ($_smarty_tpl->tpl_vars['purchase']->value->price) ));?>
</span> <span class="purcurr"><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</span> <span class="purx">&nbsp;x&nbsp;</span> </div> <div class="purchaseamount">
						<?php echo $_smarty_tpl->tpl_vars['purchase']->value->amount;?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['purchase']->value->unit) {
echo $_smarty_tpl->tpl_vars['purchase']->value->unit;
} else {
echo $_smarty_tpl->tpl_vars['settings']->value->units;
}?>
					</div> </div> </li>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</ul> <div class="page-pg separator ordersummary">
			<?php if (isset($_smarty_tpl->tpl_vars['order']->value->discount) && $_smarty_tpl->tpl_vars['order']->value->discount > 0) {?>
			<p>Скидка: <?php echo $_smarty_tpl->tpl_vars['order']->value->discount;?>
&nbsp;%</p>
			<?php }?>

			<?php if (isset($_smarty_tpl->tpl_vars['order']->value->coupon_discount) && $_smarty_tpl->tpl_vars['order']->value->coupon_discount > 0) {?>
			<p>Купон: &minus;<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value->coupon_discount ));?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</p>
			<?php }?>

			<?php if (empty($_smarty_tpl->tpl_vars['order']->value->separate_delivery) && !empty($_smarty_tpl->tpl_vars['delivery']->value)) {?>
			<p>Доставка: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['delivery']->value->name, ENT_QUOTES, 'UTF-8', true);?>
 
				<?php if ($_smarty_tpl->tpl_vars['order']->value->delivery_price > 0) {?>
					<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value->delivery_price ));?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>

				<?php } else { ?>
					бесплатно
				<?php }?>
			</p>
			<?php }?>

			<p>Итого: <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value->total_price ));?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</p>
				
			<?php if (!empty($_smarty_tpl->tpl_vars['order']->value->separate_delivery) && !empty($_smarty_tpl->tpl_vars['delivery']->value)) {?>
			<p>Доставка: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['delivery']->value->name, ENT_QUOTES, 'UTF-8', true);?>
 (оплачивается отдельно) 
				<?php if ($_smarty_tpl->tpl_vars['order']->value->delivery_price > 0) {?>
					<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value->delivery_price ));?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>

				<?php } else { ?>
					бесплатно
				<?php }?>
			</p>
			<?php }?>
	</div> <div class="page-pg"> <table class="order_info"> <tr> <td>Дата заказа</td> <td>
					<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value->date ));?>
 в
					<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'time' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value->date ));?>

				</td> </tr>
			<?php if ($_smarty_tpl->tpl_vars['order']->value->name) {?>
			<tr> <td>Имя</td> <td>
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->name, ENT_QUOTES, 'UTF-8', true);?>

				</td> </tr>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['order']->value->email) {?>
			<tr> <td>Email</td> <td>
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->email, ENT_QUOTES, 'UTF-8', true);?>

				</td> </tr>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['order']->value->phone) {?>
			<tr> <td>Телефон</td> <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->phone, ENT_QUOTES, 'UTF-8', true);?>
</td> </tr>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['order']->value->address) {?>
			<tr> <td>Адрес</td> <td>
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->address, ENT_QUOTES, 'UTF-8', true);?>

				</td> </tr>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['order']->value->comment) {?>
			<tr> <td>Комментарий</td> <td>
					<?php echo nl2br(htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->comment, ENT_QUOTES, 'UTF-8', true));?>

				</td> </tr>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['order']->value->calc) {?>
			<tr> <td>Данные по доставке</td> <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->calc, ENT_QUOTES, 'UTF-8', true);?>
</td> </tr>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['order']->value->track) {?>
			<tr> <td>Трек-код</td> <td>
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->track, ENT_QUOTES, 'UTF-8', true);?>

				</td> </tr>
			<?php }?>
		</table> </div><?php }
}
