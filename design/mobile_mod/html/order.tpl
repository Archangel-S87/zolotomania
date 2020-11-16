{if $order->status == 0}{$order_status = "ждет обработки"}{elseif $order->status == 4}{$order_status = "в обработке"}{elseif $order->status == 1}{$order_status = "выполняется"}{elseif $order->status == 2}{$order_status = "выполнен"}{elseif $order->status == 3}{$order_status = "отменен"}{/if}{if $order->paid == 1}{$order_paid = ", оплачен"}{else}{$order_paid = ""}{/if}
{$meta_title = "Ваш заказ №`$order->id` `$order_status``$order_paid`" scope=root}
{$page_name = "Заказ №`$order->id` `$order_status``$order_paid`" scope=root}

<script type="text/javascript">
	function hideShow(el){
	$(el).toggleClass('show').siblings('div#hideCont').slideToggle('normal');return false;
	};
</script>

{api module=delivery method=get_deliveries var=deliveries enabled=1}
	{if empty($payment_methods) || !empty($payment_method)}{$show_greetings = 1}{/if}
	{if empty($order->paid) && $order->status != 3}
	<h2 style="text-transform:uppercase;">Детали заказа:</h2>
	<ul class="purchaseslist">
		{foreach $purchases as $purchase}
		<li class="purchase">
			<div class="image">
				{if !empty($purchase->product->images)}
					{$image = $purchase->product->images|first}
					<a href="products/{$purchase->product->url}"><img alt="{$purchase->product->name|escape}" title="{$purchase->product->name|escape}" src="{$image->filename|resize:100:100}"></a>
				{else}
					<svg class="nophoto" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
						<circle cx="12" cy="12" r="3.2"/>
						<path d="M9 2L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2h-3.17L15 2H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"/>
						<path d="M0 0h24v24H0z" fill="none"/>
					</svg>
				{/if}
			</div>
			
			<div class="product_info separator">
				<h3 class="purchasestitle"><a href="products/{$purchase->product->url}">{$purchase->product->name|escape}</a>
				{$purchase->variant->name|escape}</h3>
				<div class="price">
					<span class="purprice">{($purchase->price)|convert}</span> <span class="purcurr">{$currency->sign}</span> <span class="purx">&nbsp;x&nbsp;</span>
				</div>
				<div class="purchaseamount">
					{$purchase->amount}&nbsp;{if $purchase->unit}{$purchase->unit}{else}{$settings->units}{/if}
				</div>
			</div>
		</li>
		{/foreach}
	</ul>

	<div class="page-pg separator ordersummary">
		{if isset($order->discount) && $order->discount > 0}
		<p>Скидка: {$order->discount}&nbsp;%</p>
		{/if}

		{if isset($order->coupon_discount) && $order->coupon_discount > 0}
		<p>Купон: &minus;{$order->coupon_discount|convert}&nbsp;{$currency->sign}</p>
		{/if}

		{if empty($order->separate_delivery) && !empty($delivery)}
		<p>Доставка: {$delivery->name|escape} 
			{if $order->delivery_price > 0}
				{$order->delivery_price|convert}&nbsp;{$currency->sign}
			{else}
				бесплатно
			{/if}
		</p>
		{/if}

		<p>Итого: {$order->total_price|convert}&nbsp;{$currency->sign}</p>
			
		{if !empty($order->separate_delivery) && !empty($delivery)}
		<p>Доставка: {$delivery->name|escape} (оплачивается отдельно) 
			{if $order->delivery_price > 0}
				{$order->delivery_price|convert}&nbsp;{$currency->sign}
			{else}
				бесплатно
			{/if}
		</p>
		{/if}
	</div>



		{* Выбор способа оплаты *}
		{if !empty($payment_methods) && empty($payment_method) && !empty($order->total_price)}
			<div class="cart-blue">
				<span class="whitecube">3</span><h2>Выберите вариант оплаты</h2>
			</div>
	
			<form id="orderform" method="post">
				<ul id="deliveries">
					{foreach $payment_methods as $payment_method}
						<li>
							<div class="checkbox">
								<input type=radio name=payment_method_id value='{$payment_method->id}' {if $payment_method@first}checked{/if} id=payment_{$payment_method->id}>
							</div>	
							<div class="deliverywrapper">
								<label for="payment_{$payment_method->id}" {if $payment_method->description}class="hideBtn" onclick="hideShow(this);$('#payment_{$payment_method->id}').click();return false;"{/if}><div class="delivery-header">{$payment_method->name}, к оплате {$order->total_price|convert:$payment_method->currency_id} {if !empty($all_currencies[$payment_method->currency_id]->sign)}{$all_currencies[$payment_method->currency_id]->sign}{/if}</div></label>
				
								<div class="description" id="hideCont">
									{$payment_method->description}
								</div>
							</div>
						</li>
					{/foreach}
				</ul>
				<div class="page-pg"><input type='submit' class="button buttonblue" value='Сохранить вариант оплаты'></div>
			</form>
		{elseif !empty($payment_method)}
			<div class="page-pg">
				{if empty($settings->payment_control) || 
					( $settings->payment_control==1 && in_array($order->status, array(1,2)) ) ||
					( $settings->payment_control==2 && (empty($deliveries|count) || !empty($delivery)) )
				}
					{$payment_control = 1}
					<p class="orderstatus separator">
						К оплате {$order->total_price|convert:$payment_method->currency_id}&nbsp;{$all_currencies[$payment_method->currency_id]->sign}
					</p>
					{* TODO Видимо из-за ошибки у меня перестала выводиться кнопка оплатить *}
					{checkout_form order_id=$order->id module=$payment_method->module}
				{/if}
				
				<p class="orderstatus">Способ оплаты - {$payment_method->name}</p>
		
				<form id="paymentform" method=post>
					<input type=submit id="reset_payment" class="button buttonblue" name='reset_payment_method' value='Выбрать другой способ оплаты'>
				</form>
		
				
			</div>
		{/if}
	{/if}

	{if !empty($show_greetings)}
	<div class="page-pg">
		<div class="attention">
			<p>Спасибо за заказ!</p>
			{if empty($order->paid) && $order->status != 3}
				<div >
					{if !empty($payment_control) && $order->payment_method_id == 40}
						<p>Вы выбрали вариант онлайн-оплаты, произведите ее на этой странице.</p>
					{/if}
				</div>
			{/if}
		</div>
	</div>
	{/if}



 