<?php
/* Smarty version 3.1.33, created on 2020-11-12 15:35:10
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/cart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fad562e50e160_40626219',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3bf01d5cb7f437de97f3e6d5c5aead487d4bf4b1' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/cart.tpl',
      1 => 1605195302,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:cdek.tpl' => 1,
    'file:boxberry.tpl' => 1,
    'file:shiptor.tpl' => 1,
    'file:conf.tpl' => 1,
    'file:antibot.tpl' => 1,
  ),
),false)) {
function content_5fad562e50e160_40626219 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/Applications/MAMP/htdocs/zolotomania/Smarty/libs/plugins/function.math.php','function'=>'smarty_function_math',),));
?>

<?php $_smarty_tpl->_assignInScope('meta_title', "Корзина" ,false ,8);
$_smarty_tpl->_assignInScope('page_name', "Корзина" ,false ,8);
echo '<script'; ?>
 type="text/javascript">
	function hideShow(el){
	$(el).toggleClass('show').siblings('div#hideCont').slideToggle('fast');return false;
	};
<?php echo '</script'; ?>
>

<?php if ($_smarty_tpl->tpl_vars['cart']->value->purchases) {?>
<form method="post" name="cart"> <ul class="purchaseslist">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cart']->value->purchases, 'purchase');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['purchase']->value) {
?>
		<li class="purchase <?php if ($_smarty_tpl->tpl_vars['purchase']->value->variant->stock == 0) {?>out_of_stock<?php }?>"> <div class="image" onclick="window.location='products/<?php echo $_smarty_tpl->tpl_vars['purchase']->value->product->url;?>
'">
				<?php if (!empty($_smarty_tpl->tpl_vars['purchase']->value->product->images)) {?>
					<?php $_smarty_tpl->_assignInScope('image', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'first' ][ 0 ], array( $_smarty_tpl->tpl_vars['purchase']->value->product->images )));?>
					<img alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['purchase']->value->product->name, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['purchase']->value->product->name, ENT_QUOTES, 'UTF-8', true);?>
" src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'resize' ][ 0 ], array( $_smarty_tpl->tpl_vars['image']->value->filename,100,100 ));?>
">
				<?php } else { ?>
					<svg class="nophoto"><use xlink:href='#no_photo' /></svg>
				<?php }?>
			</div> <div class="product_info separator"> <a class="purchase-remove" href="cart/remove/<?php echo $_smarty_tpl->tpl_vars['purchase']->value->variant->id;?>
"> </a> <h3 class="purchasestitle"><a href="products/<?php echo $_smarty_tpl->tpl_vars['purchase']->value->product->url;?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['purchase']->value->product->name, ENT_QUOTES, 'UTF-8', true);?>
</a>
				<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['purchase']->value->variant->name, ENT_QUOTES, 'UTF-8', true);?>
</h3> <div class="price"> <span class="purprice"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( ($_smarty_tpl->tpl_vars['purchase']->value->variant->price) ));?>
</span> <span class="purcurr"><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</span> <span class="purx">&nbsp;x&nbsp;</span> </div> <div class="purchaseamount"> <input <?php if ($_smarty_tpl->tpl_vars['purchase']->value->variant->stock == 0) {?>disabled<?php }?> max="$purchase->variant->stock" type="number" name="amounts[<?php echo $_smarty_tpl->tpl_vars['purchase']->value->variant->id;?>
]" onchange="document.cart.submit();" value="<?php echo $_smarty_tpl->tpl_vars['purchase']->value->amount;?>
" /> <span> <?php if ($_smarty_tpl->tpl_vars['purchase']->value->variant->unit) {
echo $_smarty_tpl->tpl_vars['purchase']->value->variant->unit;
} else {
echo $_smarty_tpl->tpl_vars['settings']->value->units;
}?></span> </div> </div> </li>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</ul> <div class="cart-back"> <a name="#" onclick="if (document.referrer && document.referrer.indexOf('/cart')<0) {location.href=document.referrer;} else {location.href='/catalog';}" class="button buttonblue">Вернуться к выбору товаров</a> </div> <div id="purchases" class="purchases_middle">
				<?php if (!empty($_smarty_tpl->tpl_vars['cart']->value->full_discount)) {?>
			<div class="c_discount">
				<?php if (!empty($_smarty_tpl->tpl_vars['cart']->value->discount2)) {?>
					<p>Рег. скидка: <?php echo $_smarty_tpl->tpl_vars['cart']->value->discount2;?>
&nbsp;%</p>
				<?php }?>
				<?php if (!empty($_smarty_tpl->tpl_vars['cart']->value->value_discountgroup)) {?>
					<p>Скидка от суммы: <?php echo $_smarty_tpl->tpl_vars['cart']->value->value_discountgroup;?>
&nbsp;%</p>
				<?php }?>
				<?php if (!empty($_smarty_tpl->tpl_vars['cart']->value->full_discount)) {?>
					<p class="total_discount">Cкидка: <?php echo $_smarty_tpl->tpl_vars['cart']->value->full_discount;?>
&nbsp;%</p>   
				<?php }?>  
			</div>
		<?php } else { ?>
			<div class="nodiscount"></div>
		<?php }?>
	
			

		<?php if ($_smarty_tpl->tpl_vars['settings']->value->bonus_limit && isset($_smarty_tpl->tpl_vars['user']->value->balance) && $_smarty_tpl->tpl_vars['user']->value->balance > 0) {?>
			<div class="c_coupon bonusblock"> <label> <input type="checkbox" name="bonus" value="1"<?php if (!empty($_smarty_tpl->tpl_vars['bonus']->value)) {?> checked<?php }?> /> <span class="c_title">Оплатить баллами</span> </label> <div class="availbonuses">
						<?php if (($_smarty_tpl->tpl_vars['cart']->value->total_price*$_smarty_tpl->tpl_vars['settings']->value->bonus_limit/100) >= $_smarty_tpl->tpl_vars['user']->value->balance) {?>
							Доступно к списанию в данном заказе <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['user']->value->balance ));?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>

						<?php } else { ?>
							Доступно к списанию в данном заказе <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( ($_smarty_tpl->tpl_vars['cart']->value->total_price*$_smarty_tpl->tpl_vars['settings']->value->bonus_limit/100) ));?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>

						<?php }?>
				</div> </div>
		<?php }?>

		<?php if (!empty($_smarty_tpl->tpl_vars['coupon_request']->value)) {?>
			<div class="c_coupon"> <p class="c_title">Код купона:</p>
				<?php if (isset($_smarty_tpl->tpl_vars['coupon_error']->value)) {?>
				<div class="message_error">
					<?php if ($_smarty_tpl->tpl_vars['coupon_error']->value == 'invalid') {?>Купон недействителен<?php }?>
				</div>
				<?php }?>
		
				<div <?php if (!empty($_smarty_tpl->tpl_vars['cart']->value->coupon_discount)) {?> style="display: none"<?php }?>> <input type="text" name="coupon_code" value="<?php if (!empty($_smarty_tpl->tpl_vars['cart']->value->coupon->code)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['cart']->value->coupon->code, ENT_QUOTES, 'UTF-8', true);
}?>" class="coupon_code" autocomplete="off"/><input class="buttonblue" type="button" name="apply_coupon" value="Применить купон" onclick="document.cart.submit();" /> </div>
			
				<?php if (!empty($_smarty_tpl->tpl_vars['cart']->value->coupon->min_order_price)) {?><span class="coupondisc">Купон "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart']->value->coupon->code, ENT_QUOTES, 'UTF-8', true);?>
" <span>для заказов от <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value->coupon->min_order_price ));?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</span><?php }?>
				<?php if (!empty($_smarty_tpl->tpl_vars['cart']->value->coupon_discount)) {?><br /><span class="coupondiscount">Скидка по купону: <strong><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value->coupon_discount ));?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</strong></span><?php }?>
	
				
				<?php echo '<script'; ?>
>
				$("input[name='coupon_code']").keypress(function(event){
					if(event.keyCode == 13){
						$("input[name='name']").attr('data-format', '');
						$("input[name='email']").attr('data-format', '');
						document.cart.submit();
					}
				});
				<?php echo '</script'; ?>
>
				

			</div>
		<?php }?>

		<div class="c_total"> <p>Итого товаров <?php if (!empty($_smarty_tpl->tpl_vars['cart']->value->full_discount)) {?> со скидкой<?php }?> на:</p> <span id="ems-total-price"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value->total_price ));?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</span> </div> </div>

	<?php if ($_smarty_tpl->tpl_vars['cart']->value->total_price < $_smarty_tpl->tpl_vars['settings']->value->minorder) {?>
		<span class="minorder">Минимальная сумма заказа <strong style="white-space: nowrap;"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['settings']->value->minorder ));?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</strong><br/> Чтобы оформить заказ Вам нужно <a name="#" onclick="if (document.referrer && document.referrer.indexOf('/cart')<0) {location.href=document.referrer;} else {location.href='/catalog';}">добавить в корзину еще товаров!</a> </span> </form>
	<?php } else { ?>

	<?php $_smarty_tpl->_assignInScope('countpoints', 0);?>
		<?php if ($_smarty_tpl->tpl_vars['deliveries']->value) {?>
		<?php $_smarty_tpl->_assignInScope('countpoints', $_smarty_tpl->tpl_vars['countpoints']->value+1);?>
		<div class="cart-blue"> <span class="whitecube"><?php echo $_smarty_tpl->tpl_vars['countpoints']->value;?>
</span><h2>Куда привезти</h2> </div>

		<?php if ($_smarty_tpl->tpl_vars['cart']->value->total_weight > 0) {?>
			<p style="display:none;margin: 15px 0 0 10px;">Общий вес:
				<span id="ems-total-weight"><?php echo $_smarty_tpl->tpl_vars['cart']->value->total_weight;?>
</span>&nbsp;кг.
			</p>
		<?php }?> 

		<?php if ($_smarty_tpl->tpl_vars['cart']->value->total_volume > 0) {?>
			<p style="display:none;margin: 15px 0 0 10px;">Общий объем:
				<span id="total-volume"><?php echo $_smarty_tpl->tpl_vars['cart']->value->total_volume;?>
</span>&nbsp;куб.м
			</p>
						<?php if ($_smarty_tpl->tpl_vars['cart']->value->total_volume > 0) {
$_smarty_tpl->_assignInScope('volume', $_smarty_tpl->tpl_vars['cart']->value->total_volume);
} else {
$_smarty_tpl->_assignInScope('volume', 0.03);
}?>
			<?php echo smarty_function_math(array('assign'=>"side",'equation'=>"pow(vol*1000000, 1/3)",'vol'=>$_smarty_tpl->tpl_vars['volume']->value),$_smarty_tpl);?>

					<?php }?>
				<?php echo '<script'; ?>
>
				var curr_convert;
				<?php if ($_smarty_tpl->tpl_vars['currency']->value->rate_to == $_smarty_tpl->tpl_vars['currency']->value->rate_from) {?>
				curr_convert = 1;
				<?php } else { ?>
				curr_convert = <?php echo 1/$_smarty_tpl->tpl_vars['currency']->value->rate_to;?>
;
				<?php }?>
		<?php echo '</script'; ?>
>
		
		<ul id="deliveries">
			<?php $_smarty_tpl->_assignInScope('delivcount', 0);?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['deliveries']->value, 'delivery');
$_smarty_tpl->tpl_vars['delivery']->index = -1;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['delivery']->value) {
$_smarty_tpl->tpl_vars['delivery']->index++;
$_smarty_tpl->tpl_vars['delivery']->first = !$_smarty_tpl->tpl_vars['delivery']->index;
$__foreach_delivery_1_saved = $_smarty_tpl->tpl_vars['delivery'];
?>
				<?php if ($_smarty_tpl->tpl_vars['delivery']->first) {?>
					<div id="selected_delivery" style="display: none;"><?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
</div>
					<?php $_smarty_tpl->_assignInScope('delivcount', $_smarty_tpl->tpl_vars['delivcount']->value+1);?>
				<?php }?>
				<li id="li_delivery_<?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
"> <div class="checkbox"> <input class="<?php if ($_smarty_tpl->tpl_vars['delivery']->first) {?>first<?php } else { ?>other<?php }?> <?php if ($_smarty_tpl->tpl_vars['delivery']->value->id == 3 || $_smarty_tpl->tpl_vars['delivery']->value->id == 114 || $_smarty_tpl->tpl_vars['delivery']->value->id == 121 || $_smarty_tpl->tpl_vars['delivery']->value->widget == 1) {?>del_widget<?php }?>" type="radio" name="delivery_id" value="<?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['delivery']->first) {?>checked<?php }?> id="deliveries_<?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
" onchange="change_payment_method(<?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
)" 
							<?php if ($_smarty_tpl->tpl_vars['delivery']->value->payment_methods) {?>data-payments="<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['delivery']->value->payment_methods, 'payment_method');
$_smarty_tpl->tpl_vars['payment_method']->index = -1;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['payment_method']->value) {
$_smarty_tpl->tpl_vars['payment_method']->index++;
$_smarty_tpl->tpl_vars['payment_method']->first = !$_smarty_tpl->tpl_vars['payment_method']->index;
$__foreach_payment_method_2_saved = $_smarty_tpl->tpl_vars['payment_method'];
echo $_smarty_tpl->tpl_vars['payment_method']->value->id;?>
,<?php
$_smarty_tpl->tpl_vars['payment_method'] = $__foreach_payment_method_2_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>"<?php }?> 
							<?php if ($_smarty_tpl->tpl_vars['delivery']->value->free_from && $_smarty_tpl->tpl_vars['delivery']->value->free_from > 0) {?>data-freefrom="<?php echo $_smarty_tpl->tpl_vars['delivery']->value->free_from;?>
"<?php }?>
						/> </div> <div class="deliverywrapper"> <label for="deliveries_<?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['delivery']->value->description || $_smarty_tpl->tpl_vars['delivery']->value->id == 3 || $_smarty_tpl->tpl_vars['delivery']->value->id == 114 || $_smarty_tpl->tpl_vars['delivery']->value->id == 121 || $_smarty_tpl->tpl_vars['delivery']->value->widget == 1) {?>class="hideBtn" onclick="hideShow(this);$('#deliveries_<?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
').click();return false;"<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['delivery']->value->id == 3) {?>data-role="shiptor_widget_show"<?php }?>
						> <div class="delivery-header">				
								<?php echo $_smarty_tpl->tpl_vars['delivery']->value->name;?>

								
								<?php if ($_smarty_tpl->tpl_vars['delivery']->value->separate_payment) {?>[оплачивается отдельно]<?php }?> 
					
								(<span id="not-null-delivery-price-<?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
"><?php if ($_smarty_tpl->tpl_vars['delivery']->value->free_from > 0 && $_smarty_tpl->tpl_vars['cart']->value->total_price >= $_smarty_tpl->tpl_vars['delivery']->value->free_from) {?>бесплатно</span>)
								<?php } elseif (in_array($_smarty_tpl->tpl_vars['delivery']->value->id,array(3,114,121)) || $_smarty_tpl->tpl_vars['delivery']->value->widget == 1) {?>---</span>&nbsp;<?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
)
								<?php } elseif ($_smarty_tpl->tpl_vars['delivery']->value->price == 0 && $_smarty_tpl->tpl_vars['delivery']->value->price2 == 0) {?>бесплатно</span>)
								<?php } else {
if ($_smarty_tpl->tpl_vars['delivery']->value->price2 > 0) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( ($_smarty_tpl->tpl_vars['delivery']->value->price+($_smarty_tpl->tpl_vars['delivery']->value->price2*ceil($_smarty_tpl->tpl_vars['cart']->value->total_weight))) ));
} else {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['delivery']->value->price ));
}?></span>&nbsp;<?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
)
								<?php }?>
							</div> </label>

						<?php if (in_array($_smarty_tpl->tpl_vars['delivery']->value->id,array(3,114,121)) || $_smarty_tpl->tpl_vars['delivery']->value->widget == 1) {?>
							<a class="hideBtn show_map"
								<?php if ($_smarty_tpl->tpl_vars['delivery']->value->id == 3) {?>data-role="shiptor_widget_show"<?php }?> href="javascript://">выбрать на карте</a>
						<?php } elseif ($_smarty_tpl->tpl_vars['delivery']->value->description) {?>
								<a class="hideBtn" href="javascript://" onclick="hideShow(this);return false;">подробнее</a>
						<?php }?>
						<div class="description"
								<?php if (!in_array($_smarty_tpl->tpl_vars['delivery']->value->id,array(3,114,121,123)) && $_smarty_tpl->tpl_vars['delivery']->value->widget != 1) {?>id="hideCont"<?php }?>>

								<?php echo $_smarty_tpl->tpl_vars['delivery']->value->description;?>


								
								<?php if ($_smarty_tpl->tpl_vars['delivery']->value->id == 114) {?>
										<?php $_smarty_tpl->_subTemplateRender('file:cdek.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['delivery']->value->id == 121) {?>
										<?php $_smarty_tpl->_subTemplateRender('file:boxberry.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['delivery']->value->id == 3) {?>
										<?php $_smarty_tpl->_subTemplateRender('file:shiptor.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
								<?php }?>

								<?php if ($_smarty_tpl->tpl_vars['delivery']->value->widget == 1) {?>
										<?php echo $_smarty_tpl->tpl_vars['delivery']->value->code;?>

																				<div class="deliveryinfo_wrapper"> <div class="deliveryinfo"></div> <input name="widget_<?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
" type="hidden" id="widget_<?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
"/> </div>
																		<?php }?>

								<?php if ($_smarty_tpl->tpl_vars['delivery']->value->id == 123) {?>
									<label>Адрес доставки:</label> <input id="user_address" name="address" type="text" data-format=".+" data-notice="Укажите адрес"/>
								<?php }?>
						</div> </div> </li>
			<?php
$_smarty_tpl->tpl_vars['delivery'] = $__foreach_delivery_1_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</ul> <textarea style="display:none;" name="calc" hidden="hidden" id="calc_info"></textarea> <div class="hidden" style="display: none;"> <div id="shops-content"> <h2>Наши магазины</h2> <ul id="shop-list">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['shops']->value, 'shop');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['shop']->value) {
?>
						<li> <div class="checkbox"> <input id="shops_<?php echo $_smarty_tpl->tpl_vars['shop']->value->id;?>
" class="" type="radio" name="shop_id" value="<?php echo $_smarty_tpl->tpl_vars['shop']->value->id;?>
"/> </div> <label for="shops_<?php echo $_smarty_tpl->tpl_vars['shop']->value->id;?>
"> <span class="shop-header"><?php echo $_smarty_tpl->tpl_vars['shop']->value->address;?>
</span> </label> </li>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</ul> </div> </div> <?php echo '<script'; ?>
>
				$(window).on('load', function () {
						$(document).ready(function () {
								$('#deliveries input').change(function () {
										if ($(this).attr('id') === 'user_address') return false;
										const val = +$(this).val();
										if (val === 100) {
												$.fancybox({
														href: '#shops-content',
														hideOnContentClick: false,
														hideOnOverlayClick: false,
														enableEscapeButton: false,
														showCloseButton: false,
														padding: 20,
														scrolling: 'no'
												});
										}
										if (val === 123) {
												$('#li_delivery_123').find('.description').addClass('show').slideDown('normal');
												const user_address = $('#user_address');
												user_address.attr('data-format', '.+');
												user_address.attr('data-notice', 'Укажите адрес');
										} else {
												$('#li_delivery_123').find('.description').removeClass('show').slideUp('normal');
												const user_address = $('#user_address');
												user_address.removeAttr('data-format');
												user_address.removeAttr('data-notice');
										}
								});
								$('#shop-list input').change(function () {
										$.fancybox.close();
								});
						});
				});
		<?php echo '</script'; ?>
>
	<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['payment_methods']->value) {?>
				<?php $_smarty_tpl->_assignInScope('countpoints', $_smarty_tpl->tpl_vars['countpoints']->value+1);?>
				<div class="cart-blue"> <span class="whitecube"><?php echo $_smarty_tpl->tpl_vars['countpoints']->value;?>
</span><h2>Как буду платить</h2> </div> <div class="delivery_payment"> <ul id="payments">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['payment_methods']->value, 'payment_method');
$_smarty_tpl->tpl_vars['payment_method']->index = -1;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['payment_method']->value) {
$_smarty_tpl->tpl_vars['payment_method']->index++;
$_smarty_tpl->tpl_vars['payment_method']->first = !$_smarty_tpl->tpl_vars['payment_method']->index;
$__foreach_payment_method_4_saved = $_smarty_tpl->tpl_vars['payment_method'];
?>
							<li id="list_payment_<?php echo $_smarty_tpl->tpl_vars['payment_method']->value->id;?>
" style="display:none;"> <div class="checkbox" id="paym"> <input type="radio" name="payment_method_id" value="<?php echo $_smarty_tpl->tpl_vars['payment_method']->value->id;?>
"  id="payment_<?php echo $_smarty_tpl->tpl_vars['payment_method']->value->id;?>
"> </div> <div class="deliverywrapper"> <label for="payment_<?php echo $_smarty_tpl->tpl_vars['payment_method']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['payment_method']->value->description) {?>class="hideBtn" onclick="hideShow(this);$('#payment_<?php echo $_smarty_tpl->tpl_vars['payment_method']->value->id;?>
').click();return false;"<?php }?>> <div class="delivery-header"><?php echo $_smarty_tpl->tpl_vars['payment_method']->value->name;?>
</div> </label> <div class="description" id="hideCont"><?php echo $_smarty_tpl->tpl_vars['payment_method']->value->description;?>
</div> </div> </li>
						<?php
$_smarty_tpl->tpl_vars['payment_method'] = $__foreach_payment_method_4_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</ul> </div>  
			<?php }?>
				<?php echo '<script'; ?>
>
					function change_payment_method($id) {
						$('#calc_info').html( $("#li_delivery_"+$id+" .deliveryinfo").text() );
		  
						$("#payments li").hide();
						var data_payments = $("#deliveries_"+$id).attr('data-payments');
						if(data_payments != null){
							var arr = data_payments.split(',');
							$.each(arr,function(index,value){
								$("#list_payment_"+value.toString()).css("display","flex");
							});
						}	
						$('#payments li:visible:first input[name="payment_method_id"]').prop('checked',true);
						payment_first = $('#payments li:visible:first input[name="payment_method_id"]').val();
					}
					
					$(window).load(function(){ 
						delivery_num = $('#deliveries li:visible:first input[name="delivery_id"]').val();
						delivery_num_ajax = $('#deliveries li:first input[name="delivery_id"]').val();
						if(!delivery_num) {
							delivery_num=delivery_num_ajax;
							force_change = 1;
						}	
						change_payment_method(delivery_num);
					});
				<?php echo '</script'; ?>
> <div class="cart-blue"> <span class="whitecube"><?php echo $_smarty_tpl->tpl_vars['countpoints']->value+1;?>
</span><h2>Как со мной связаться</h2> </div> <div class="form cart_form">         
		<?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
		<div class="message_error">
			<?php if ($_smarty_tpl->tpl_vars['error']->value == 'empty_name') {?>Введите имя<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['error']->value == 'empty_email') {?>Введите email<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['error']->value == 'empty_phone') {?>Укажите телефон<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['error']->value == 'captcha') {?>Не пройдена проверка на бота<?php }?>
		</div>
		<?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['error_stock']->value)) {?>
		<div class="message_error">
			<?php if ($_smarty_tpl->tpl_vars['error_stock']->value == 'out_of_stock_order') {?>В вашем заказе есть закончившиеся товары<?php }?>
		</div>
		<?php }?>
		
		<input placeholder="ФИО*" name="name" type="text" value="<?php if (!empty($_smarty_tpl->tpl_vars['name']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);
}?>" data-format=".+" data-notice="Введите ФИО" required /> <input placeholder="Телефон*" id="phone" name="phone" type="tel" value="<?php if (!empty($_smarty_tpl->tpl_vars['phone']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['phone']->value, ENT_QUOTES, 'UTF-8', true);
}?>" data-format=".+" data-notice="Укажите телефон" required />
		
				<?php if ($_smarty_tpl->tpl_vars['settings']->value->attachment == 1 && empty($_smarty_tpl->tpl_vars['mobile_app']->value)) {?>
			<div class="separator"> <label>Прикрепить файл
					<span class="errorupload errortype" style="display:none; margin:0 0px 0 20px;">Неверный тип файла!</span> <span class="errorupload errorsize" style="display:none; margin:0 0px 0 20px;">Файл более <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->maxattachment, ENT_QUOTES, 'UTF-8', true);?>
 Мб!</span> </label> <input class='attachment' name=files[] type=file multiple accept='pdf/txt/doc/docx/xls/xlsx/odt/ods/odp/gif/jpg/jpeg/png/psd/cdr/ai/zip/rar/gzip' /> <span>Максимальный размер: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->maxattachment, ENT_QUOTES, 'UTF-8', true);?>
 Мб! Разрешенные типы: pdf, txt, doc(x), xls(x), odt, ods, odp, gif, jpg, png, psd, cdr, ai, zip, rar, gzip</span> </div> <?php echo '<script'; ?>
 type="text/javascript">
				$('.attachment').bind('change', function() {
					$('.errorsize, .errortype').hide();
					var size = this.files[0].size; 
					var name = this.files[0].name;
					if(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->maxattachment, ENT_QUOTES, 'UTF-8', true)*1024*1024;?>
<size){
						$('.errorsize').show();
						$('.attachment').val('');
						setTimeout(function(){ $('.errorsize').fadeOut('slow'); },3000);
					}
					var fileExtension = ['pdf', 'txt', 'doc', 'docx', 'xls', 'xlsx', 'odt', 'ods', 'odp', 'gif', 'jpg', 'jpeg', 'png', 'psd', 'cdr', 'ai', 'zip', 'rar', 'gzip'];
					if ($.inArray(name.split('.').pop().toLowerCase(), fileExtension) == -1) {
						$('.errortype').show();
						$('.attachment').val('');
						setTimeout(function(){ $('.errortype').fadeOut('slow'); },3000);
					}
				});
			<?php echo '</script'; ?>
>
		<?php }?>
				
		<textarea placeholder="Комментарий к заказу" name="comment" id="order_comment"><?php if (!empty($_smarty_tpl->tpl_vars['comment']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['comment']->value, ENT_QUOTES, 'UTF-8', true);
}?></textarea>
		
		<?php $_smarty_tpl->_subTemplateRender('file:conf.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		
		<div class="captcha-block">
			<?php $_smarty_tpl->_subTemplateRender('file:antibot.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		</div> <input type="submit" name="checkout" class="button hideablebutton" value="Оформить заказ" <?php if ($_smarty_tpl->tpl_vars['settings']->value->counters || $_smarty_tpl->tpl_vars['settings']->value->analytics) {?>onclick="<?php if ($_smarty_tpl->tpl_vars['settings']->value->counters) {?>ym(<?php echo $_smarty_tpl->tpl_vars['settings']->value->counters;?>
,'reachGoal','cart'); <?php }
if ($_smarty_tpl->tpl_vars['settings']->value->analytics) {?>ga ('send', 'event', 'cart', 'order_button');<?php }?> return true;"<?php }?> /> </div> </form>
<?php }?>

<?php } else { ?>
	<h2 class="page-pg">В корзине нет товаров</h2> <div class="have-no separator"> <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path d="M0 0h24v24H0zm18.31 6l-2.76 5z" fill="none"/> <path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-9.83-3.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4h-.01l-1.1 2-2.76 5H8.53l-.13-.27L6.16 6l-.95-2-.94-2H1v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.13 0-.25-.11-.25-.25z"/> </svg> </div>
<?php }
}
}
