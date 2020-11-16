{* Шаблон корзины *}

{$meta_title = "Корзина" scope=root}
{$page_name = "Корзина" scope=root}
<script type="text/javascript">
	function hideShow(el){
	$(el).toggleClass('show').siblings('div#hideCont').slideToggle('fast');return false;
	};
</script>

{if $cart->purchases}
<form method="post" name="cart">
	<ul class="purchaseslist">
		{foreach from=$cart->purchases item=purchase}
		<li class="purchase {if $purchase->variant->stock == 0}out_of_stock{/if}">
			<div class="image" onclick="window.location='products/{$purchase->product->url}'">
				{if !empty($purchase->product->images)}
					{$image = $purchase->product->images|first}
					<img alt="{$purchase->product->name|escape}" title="{$purchase->product->name|escape}" src="{$image->filename|resize:100:100}">
				{else}
					<svg class="nophoto"><use xlink:href='#no_photo' /></svg>
				{/if}
			</div>
			<div class="product_info separator">
				<a class="purchase-remove" href="cart/remove/{$purchase->variant->id}">
					
				</a>
				<h3 class="purchasestitle"><a href="products/{$purchase->product->url}">{$purchase->product->name|escape}</a>
				{$purchase->variant->name|escape}</h3>
			<div class="price">
				<span class="purprice">{($purchase->variant->price)|convert}</span> <span class="purcurr">{$currency->sign}</span> <span class="purx">&nbsp;x&nbsp;</span>
			</div>
			<div class="purchaseamount">
				<input {if $purchase->variant->stock == 0}disabled{/if} max="$purchase->variant->stock" type="number" name="amounts[{$purchase->variant->id}]" onchange="document.cart.submit();" value="{$purchase->amount}" />
				<span> {if $purchase->variant->unit}{$purchase->variant->unit}{else}{$settings->units}{/if}</span>
			</div>
					
			</div>
		</li>
		{/foreach}
	</ul>

	<div class="cart-back">
		<a name="#" onclick="{literal}if (document.referrer && document.referrer.indexOf('/cart')<0) {location.href=document.referrer;} else {location.href='/catalog';}{/literal}" class="button buttonblue">Вернуться к выбору товаров</a>
	</div>

	<div id="purchases" class="purchases_middle">
		{* Discount *}
		{if !empty($cart->full_discount)}
			<div class="c_discount">
				{if !empty($cart->discount2)}
					<p>Рег. скидка: {$cart->discount2}&nbsp;%</p>
				{/if}
				{if !empty($cart->value_discountgroup)}
					<p>Скидка от суммы: {$cart->value_discountgroup}&nbsp;%</p>
				{/if}
				{if !empty($cart->full_discount)}
					<p class="total_discount">Cкидка: {$cart->full_discount}&nbsp;%</p>   
				{/if}  
			</div>
		{else}
			<div class="nodiscount"></div>
		{/if}
	
		{* Discount end *}	

		{if $settings->bonus_limit && isset($user->balance) && $user->balance > 0}
			<div class="c_coupon bonusblock">
				<label>
					<input type="checkbox" name="bonus" value="1"{if !empty($bonus)} checked{/if} /> <span class="c_title">Оплатить баллами</span>
				</label>
				<div class="availbonuses">
						{if ($cart->total_price * $settings->bonus_limit / 100) >= $user->balance}
							Доступно к списанию в данном заказе {$user->balance|convert}&nbsp;{$currency->sign}
						{else}
							Доступно к списанию в данном заказе {($cart->total_price * $settings->bonus_limit / 100)|convert}&nbsp;{$currency->sign}
						{/if}
				</div>	
			</div>
		{/if}

		{if !empty($coupon_request)}
			<div class="c_coupon">
				<p class="c_title">Код купона:</p>
				{if isset($coupon_error)}
				<div class="message_error">
					{if $coupon_error == 'invalid'}Купон недействителен{/if}
				</div>
				{/if}
		
				<div {if !empty($cart->coupon_discount)} style="display: none"{/if}>
				<input type="text" name="coupon_code" value="{if !empty($cart->coupon->code)}{$cart->coupon->code|escape}{/if}" class="coupon_code" autocomplete="off"/><input class="buttonblue" type="button" name="apply_coupon"  value="Применить купон" onclick="document.cart.submit();" />
				</div>
			
				{if !empty($cart->coupon->min_order_price)}<span class="coupondisc">Купон "{$cart->coupon->code|escape}" <span>для заказов от {$cart->coupon->min_order_price|convert} {$currency->sign}</span>{/if}
				{if !empty($cart->coupon_discount)}<br /><span class="coupondiscount">Скидка по купону: <strong>{$cart->coupon_discount|convert}&nbsp;{$currency->sign}</strong></span>{/if}
	
				{literal}
				<script>
				$("input[name='coupon_code']").keypress(function(event){
					if(event.keyCode == 13){
						$("input[name='name']").attr('data-format', '');
						$("input[name='email']").attr('data-format', '');
						document.cart.submit();
					}
				});
				</script>
				{/literal}

			</div>
		{/if}

		<div class="c_total">
			<p>Итого товаров {if !empty($cart->full_discount)} со скидкой{/if} на:</p>
			<span id="ems-total-price">{$cart->total_price|convert}&nbsp;{$currency->sign}</span>
		</div>

	</div>

	{if $cart->total_price < $settings->minorder}
		<span class="minorder">Минимальная сумма заказа <strong style="white-space: nowrap;">{$settings->minorder|convert} {$currency->sign}</strong><br/> Чтобы оформить заказ Вам нужно <a name="#" onclick="{literal}if (document.referrer && document.referrer.indexOf('/cart')<0) {location.href=document.referrer;} else {location.href='/catalog';}{/literal}">добавить в корзину еще товаров!</a>
		</span>
</form>
	{else}

	{$countpoints=0}
	{* Доставка *}
	{if $deliveries}
		{$countpoints=$countpoints+1}
		<div class="cart-blue">
			<span class="whitecube">{$countpoints}</span><h2>Куда привезти</h2>
		</div>

		{if $cart->total_weight > 0}
			<p style="display:none;margin: 15px 0 0 10px;">Общий вес:
				<span id="ems-total-weight">{$cart->total_weight}</span>&nbsp;кг.
			</p>
		{/if} 

		{if $cart->total_volume > 0}
			<p style="display:none;margin: 15px 0 0 10px;">Общий объем:
				<span id="total-volume">{$cart->total_volume}</span>&nbsp;куб.м
			</p>
			{* calculate sides from volume *}
			{if $cart->total_volume > 0}{$volume=$cart->total_volume}{else}{$volume=0.03}{/if}
			{math assign="side" equation="pow(vol*1000000, 1/3)" vol=$volume}
			{* calculate sides from volume end *}
		{/if}
		{* Rate / Пересчет в текущий курс по базовой валюте *}
		<script>
				var curr_convert;
				{if $currency->rate_to == $currency->rate_from}
				curr_convert = 1;
				{else}
				curr_convert = {1/$currency->rate_to};
				{/if}
		</script>
		{* Rate @ *}

		<ul id="deliveries">
			{$delivcount=0}
			{foreach $deliveries as $delivery}
				{if $delivery@first}
					<div id="selected_delivery" style="display: none;">{$delivery->id}</div>
					{$delivcount=$delivcount+1}
				{/if}
				<li id="li_delivery_{$delivery->id}">
					<div class="checkbox">
						<input class="{if $delivery@first}first{else}other{/if} {if $delivery->id == 3 ||$delivery->id == 114 || $delivery->id == 121 || $delivery->widget == 1}del_widget{/if}" type="radio" name="delivery_id" value="{$delivery->id}" {if $delivery@first}checked{/if} id="deliveries_{$delivery->id}" onchange="change_payment_method({$delivery->id})" 
							{if $delivery->payment_methods}data-payments="{foreach $delivery->payment_methods as $payment_method}{$payment_method->id},{/foreach}"{/if} 
							{if $delivery->free_from && $delivery->free_from > 0}data-freefrom="{$delivery->free_from}"{/if}
						/>
					</div>
			
					<div class="deliverywrapper">
						<label for="deliveries_{$delivery->id}" {if $delivery->description || $delivery->id == 3 ||$delivery->id == 114 || $delivery->id == 121 || $delivery->widget == 1}class="hideBtn" onclick="hideShow(this);$('#deliveries_{$delivery->id}').click();return false;"{/if}
							{if $delivery->id == 3}data-role="shiptor_widget_show"{/if}
						>
							<div class="delivery-header">				
								{$delivery->name}
								
								{if $delivery->separate_payment}[оплачивается отдельно]{/if} 
					
								(<span id="not-null-delivery-price-{$delivery->id}">{if $delivery->free_from > 0 && $cart->total_price >= $delivery->free_from}бесплатно</span>)
								{elseif in_array($delivery->id, array(3,114,121)) || $delivery->widget == 1}---</span>&nbsp;{$currency->sign})
								{elseif $delivery->price==0 && $delivery->price2 == 0}бесплатно</span>)
								{else}{if $delivery->price2 > 0}{($delivery->price + ($delivery->price2 * $cart->total_weight|ceil))|convert}{else}{$delivery->price|convert}{/if}</span>&nbsp;{$currency->sign})
								{/if}
							</div>
						</label>

						{if in_array($delivery->id, array(3,114,121)) || $delivery->widget == 1}
							<a class="hideBtn show_map"
								{if $delivery->id == 3}data-role="shiptor_widget_show"{/if} href="javascript://">выбрать на карте</a>
						{elseif $delivery->description}
								<a class="hideBtn" href="javascript://" onclick="hideShow(this);return false;">подробнее</a>
						{/if}
						<div class="description"
								{if !in_array($delivery->id, [3, 114, 121, 123]) && $delivery->widget != 1}id="hideCont"{/if}>

								{$delivery->description}

								{*  Инструкция для виджетов: https://5cms.ru/blog/delivery-2-0 *}

								{if $delivery->id == 114}
										{include file='cdek.tpl'}
								{/if}
								{if $delivery->id == 121}
										{include file='boxberry.tpl'}
								{/if}
								{if $delivery->id == 3}
										{include file='shiptor.tpl'}
								{/if}

								{if $delivery->widget == 1}
										{$delivery->code}
										{* calc (3) *}
										<div class="deliveryinfo_wrapper">
												<div class="deliveryinfo"></div>
												<input name="widget_{$delivery->id}" type="hidden" id="widget_{$delivery->id}"/>
										</div>
										{* calc (3) end *}
								{/if}

								{if $delivery->id == 123}
									<label>Адрес доставки:</label>
									<input id="user_address"
													name="address"
													type="text"
													data-format=".+"
													data-notice="Укажите адрес"/>
								{/if}
						</div>
					</div>
				</li>
			{/foreach}
		</ul>
		<textarea style="display:none;" name="calc" hidden="hidden" id="calc_info"></textarea>
		<div class="hidden" style="display: none;">
			<div id="shops-content">
				<h2>Наши магазины</h2>
				<ul id="shop-list">
					{foreach $shops as $shop}
						<li>
							<div class="checkbox">
								<input id="shops_{$shop->id}" class="" type="radio" name="shop_id" value="{$shop->id}"/>
							</div>
							<label for="shops_{$shop->id}">
								<span class="shop-header">{$shop->address}</span>
							</label>
						</li>
					{/foreach}
				</ul>
			</div>
		</div>
		<script>
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
		</script>
	{/if}

			{if $payment_methods}
				{$countpoints=$countpoints+1}
				<div class="cart-blue">
					<span class="whitecube">{$countpoints}</span><h2>Как буду платить</h2>
				</div>

				<div class="delivery_payment">             
					<ul id="payments">
						{foreach $payment_methods as $payment_method}
							<li id="list_payment_{$payment_method->id}" style="display:none;">
								<div class="checkbox" id="paym">
									<input type="radio" name="payment_method_id" value="{$payment_method->id}" {*{if $payment_method@first}checked{/if}*} id="payment_{$payment_method->id}">
								</div>            
								<div class="deliverywrapper">
									<label for="payment_{$payment_method->id}" {if $payment_method->description}class="hideBtn" onclick="hideShow(this);$('#payment_{$payment_method->id}').click();return false;"{/if}>
										<div class="delivery-header">{$payment_method->name}</div>
									</label>
									
									<div class="description" id="hideCont">{$payment_method->description}</div>
									
								</div>
							</li>
						{/foreach}
					</ul>
				</div>  
			{/if}
				<script>
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
				</script>

	<div class="cart-blue">
		<span class="whitecube">{$countpoints+1}</span><h2>Как со мной связаться</h2>
	</div>
	
	<div class="form cart_form">         
		{if isset($error)}
		<div class="message_error">
			{if $error == 'empty_name'}Введите имя{/if}
			{if $error == 'empty_email'}Введите email{/if}
			{if $error == 'empty_phone'}Укажите телефон{/if}
			{if $error == 'captcha'}Не пройдена проверка на бота{/if}
		</div>
		{/if}
		{if isset($error_stock)}
		<div class="message_error">
			{if $error_stock == 'out_of_stock_order'}В вашем заказе есть закончившиеся товары{/if}
		</div>
		{/if}
		
		<input placeholder="ФИО*" name="name" type="text" value="{if !empty($name)}{$name|escape}{/if}" data-format=".+" data-notice="Введите ФИО" required />
		<input type="tel" name="tel" id="tel" data-format=".+" data-notice="Введите телефон" value="{if isset($tel)}{$tel|escape}{/if}" maxlength="20"  placeholder="+7(___) ___-__-__" >
		
		{* загрузка файлов *}
		{if $settings->attachment == 1 && empty($mobile_app)}
			<div class="separator">
				<label>Прикрепить файл
					<span class="errorupload errortype" style="display:none; margin:0 0px 0 20px;">Неверный тип файла!</span>
					<span class="errorupload errorsize" style="display:none; margin:0 0px 0 20px;">Файл более {$settings->maxattachment|escape} Мб!</span>
				</label>
				<input class='attachment' name=files[] type=file multiple accept='pdf/txt/doc/docx/xls/xlsx/odt/ods/odp/gif/jpg/jpeg/png/psd/cdr/ai/zip/rar/gzip' />
				<span>Максимальный размер: {$settings->maxattachment|escape} Мб! Разрешенные типы: pdf, txt, doc(x), xls(x), odt, ods, odp, gif, jpg, png, psd, cdr, ai, zip, rar, gzip</span>
			</div>
		
			<script type="text/javascript">
				$('.attachment').bind('change', function() {
					$('.errorsize, .errortype').hide();
					var size = this.files[0].size; 
					var name = this.files[0].name;
					if({$settings->maxattachment|escape * 1024 * 1024}<size){
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
			</script>
		{/if}
		{* загрузка файлов @ *}
		
		<textarea placeholder="Комментарий к заказу" name="comment" id="order_comment">{if !empty($comment)}{$comment|escape}{/if}</textarea>
		
		{include file='conf.tpl'}
		
		<div class="captcha-block">
			{include file='antibot.tpl'}
		</div>

		<input type="submit" name="checkout" class="button hideablebutton" value="Оформить заказ" {if $settings->counters || $settings->analytics}onclick="{if $settings->counters}ym({$settings->counters},'reachGoal','cart'); {/if}{if $settings->analytics}ga ('send', 'event', 'cart', 'order_button');{/if} return true;"{/if} />
	</div>
	
</form>
<script src="/js/jquery/maskedinput/dist/jquery.maskedinput.min.js"></script>
<script>
	jQuery(function($){
		const tel = $("#tel");
		tel.click(function() {
			$(this).setCursorPosition(3);
		});
		tel.mask('+7(999) 999-99-99');
	});
</script>
{/if}

{else}
	<h2 class="page-pg">В корзине нет товаров</h2>
	<div class="have-no separator">
		<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    		<path d="M0 0h24v24H0zm18.31 6l-2.76 5z" fill="none"/>
    		<path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-9.83-3.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4h-.01l-1.1 2-2.76 5H8.53l-.13-.27L6.16 6l-.95-2-.94-2H1v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.13 0-.25-.11-.25-.25z"/>
		</svg>
	</div>
{/if}

