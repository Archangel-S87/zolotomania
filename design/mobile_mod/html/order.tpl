{* Страница заказа *}
{$meta_title = "Ваш заказ №`$order->id`" scope=root}
{$page_name = "Заказ №`$order->id`" scope=root}

<div class="user-name" style="">{$order->name|escape}</div>

<h2 style="text-transform:uppercase;">Детали заказа:</h2>
{* Список покупок *}
<ul class="purchaseslist">
    {foreach $purchases as $purchase}
        <li class="purchase">
            {* Изображение товара *}
            <div class="image">
                {if !empty($purchase->product->images)}
                    {$image = $purchase->product->images|first}
                    <a href="products/{$purchase->product->url}"><img src="{$image->filename|resize:100:100}"
                                                                      alt="{$purchase->product->name|escape}"></a>
                {else}
                    <a href="products/{$purchase->product->url}">
                        <svg class="nophoto">
                            <use xlink:href='#no_photo'>
                        </svg>
                    </a>
                {/if}
            </div>
            <div class="product_info separator">
                {* Название товара *}
                <h3 class="purchasestitle">
                    <a href="products/{$purchase->product->url}">{$purchase->product->name|escape}</a>
                    {$purchase->variant->name|escape}
                    {if $order->paid && $purchase->variant->attachment}
                        <a class="download_attachment" href="order/{$order->url}/{$purchase->variant->attachment}">скачать
                            файл</a>
                    {/if}
                </h3>
                {* Цена за единицу *}
                <div class="price">
                    <span class="purprice">{($purchase->price)|convert}</span>
                    <span class="purcurr">{$currency->sign}</span>
                    <span class="purx" style="display:none">&nbsp;x&nbsp;</span>
                </div>
                {* Количество *}
                <div class="purchaseamount amount" style="display:none">
                    {$purchase->amount}&nbsp;{if $purchase->unit}{$purchase->unit}{else}{$settings->units}{/if}
                </div>
                {* Цена *}
                <div class="price" style="display:none">
                    {($purchase->price*$purchase->amount)|convert}&nbsp;{$currency->sign}
                </div>
            </div>
        </li>
    {/foreach}
</ul>
<div class="page-pg separator ordersummary">
    {* Скидка, если есть *}
    {if $order->discount > 0}
        <p id="discount" style="height: 30px; background:none;">
            <span class="image"></span>
            <span class="name">Скидка</span>
            <span class="price1"></span>
            <span class="amount"></span>
            <span class="price">
				{$order->discount}&nbsp;%
			</span>
        </p>
    {/if}
    {* Купон, если есть *}
    {if $order->coupon_discount > 0}
        <p id="discount" style="height: 30px; background:none;">
            <span class="image"></span>
            <span class="name">Купон</span>
            <span class="price1"></span>
            <span class="amount"></span>
            <span class="price">
				&minus;{$order->coupon_discount|convert}&nbsp;{$currency->sign}
			</span>
        </p>
    {/if}
    {* Если стоимость доставки входит в сумму заказа *}
    {if $delivery && !$order->separate_delivery}
        <p id="discount">
            <span class="image"></span>
            <span class="name">
				Доставка: {$delivery->name|escape}
                {*{if $total_weight>0}
                <p style="font-size: 13px; font-weight: 400;">Общий вес: {$total_weight}&nbsp;кг.</p>
                {/if}
                {if $total_volume>0}
                <p style="font-size: 13px; font-weight: 400;">Общий объем: {$total_volume}&nbsp;куб.м.</p>
                {/if} *}
			</span>
            <span class="price1"></span>
            <span class="amount"></span>
            <span class="price">
				{if $order->delivery_price > 0}
                    {$order->delivery_price|convert}&nbsp;{$currency->sign}
                {else}
                    бесплатно
                {/if}
			</span>
        </p>
    {/if}
    {* Итого *}
    <p id="discount">
        <span class="image"></span>
        <span class="name">Итого:</span>
        <span class="price1"></span>
        <span class="amount"></span>
        <span class="price">
			{$order->total_price|convert}&nbsp;{$currency->sign}
		</span>
    </p>
    {* Если стоимость доставки не входит в сумму заказа *}
    {if $order->separate_delivery}
        <p>
            <span class="image"></span>
            <span class="name">Доставка: {$delivery->name|escape} (оплачивается отдельно)</span>
            <span class="price1"></span>
            <span class="amount"></span>
            <span class="price">
				{$order->delivery_price|convert}&nbsp;{$currency->sign}
			</span>
        </p>
    {/if}
</div>

{if $group && $group->name == 'Магазины'}
    <div class="page-pg">
        <div class="attention"
             style="display:table;clear:both;width:300px;text-align:center;padding:5px;margin: 20px auto 20px auto;background-color:#bcd4e4;color:#000;">
            <p style="font-size:16px;text-transform:uppercase;margin:10px;">Спасибо за заказ!</p>
        </div>
    </div>
{/if}

{* Для всех кроме магазинов *}
{if !$group || ($group && $group->name != 'Магазины')}

    {if (!$order->paid && $order->status != 3)}
        {if isset($payment_method) && $order->total_price > 0}
            {* Форма оплаты, генерируется модулем оплаты *}
            {checkout_form order_id=$order->id module=$payment_method->module}
        {/if}
    {/if}

    <div class="page-pg">
        <div class="attention" style="display:table;clear:both;width:300px;text-align:center;padding:0 15px 8px 15px;margin: 20px auto 20px auto;background-color:#bcd4e4;color:#000;">
            <p style="font-size:16px;text-transform:uppercase;">Спасибо за заказ!</p>
        </div>
    </div>

{*    *}{* Не даем оплачивать пока не разрешено *}
{*    {api module=delivery method=get_deliveries var=deliveries enabled=1}*}

{*    {if !$order->paid && $order->status != 3}*}
{*        *}{* Выбор способа оплаты *}
{*        {if $payment_methods && !isset($payment_method) && $order->total_price>0}*}
{*            <div class="cart-blue">*}
{*                <span class="whitecube">3</span>*}
{*                <h2>Выберите вариант оплаты</h2>*}
{*            </div>*}
{*            <form id="orderform" method="post">*}
{*                <ul id="deliveries">*}
{*                    {foreach $payment_methods as $payment_method}*}
{*                        <li>*}
{*                            <div class="checkbox">*}
{*                                <input type=radio name=payment_method_id value='{$payment_method->id}'*}
{*                                       {if $payment_method@first}checked{/if} id=payment_{$payment_method->id}>*}
{*                            </div>*}
{*                            <span class="delivery-header">*}
{*								<label for="payment_{$payment_method->id}">	{$payment_method->name}, к оплате {$order->total_price|convert:$payment_method->currency_id}&nbsp;{if isset($all_currencies[$payment_method->currency_id]->sign)}{$all_currencies[$payment_method->currency_id]->sign}{/if}</label>*}
{*							</span>*}
{*                            {if $payment_method->description}*}
{*                                <a class="hideBtn" href="javascript://"*}
{*                                   onclick="hideShow(this);return false;">подробнее</a>*}
{*                            {/if}*}
{*                            <div class="description" id="hideCont">*}
{*                                {$payment_method->description}*}
{*                            </div>*}
{*                        </li>*}
{*                    {/foreach}*}
{*                </ul>*}
{*                <input type='submit' class="button buttonblue" value='Подтвердить выбор' style="margin-bottom:15px;">*}
{*            </form>*}
{*            {$payment_control = 0}*}
{*        {elseif !empty($payment_method)}*}
{*            <div class="page-pg">*}
{*                {if empty($settings->payment_control) ||*}
{*                ( $settings->payment_control==1 && in_array($order->status, array(1,2)) ) ||*}
{*                ( $settings->payment_control==2 && (empty($deliveries|count) || !empty($delivery)) )*}
{*                }*}
{*                    {$payment_control = 1}*}
{*                    <p class="orderstatus separator">*}
{*                        К оплате: {$order->total_price|convert:$payment_method->currency_id}*}
{*                        &nbsp;{if isset($all_currencies[$payment_method->currency_id]->sign)}{$all_currencies[$payment_method->currency_id]->sign}{/if}*}
{*                    </p>*}
{*                    *}{* Форма оплаты, генерируется модулем оплаты *}
{*                    {checkout_form order_id=$order->id module=$payment_method->module}*}
{*                {/if}*}

{*                *}{* Выбраный способ оплаты *}
{*                <p class="orderstatus">Способ оплаты: {$payment_method->name}</p>*}
{*                <form id="paymentform" method=post>*}
{*                    <input type=submit*}
{*                           id="reset_payment"*}
{*                           class="button buttonblue"*}
{*                           name='reset_payment_method'*}
{*                           value='Выбрать другой способ оплаты'>*}
{*                </form>*}
{*            </div>*}
{*        {/if}*}
{*    {/if}*}
{*    <div class="page-pg">*}
{*        <div class="attention">*}
{*            <p style="font-size:16px;text-transform:uppercase;">Спасибо за заказ!</p>*}
{*            {if empty($order->paid) && $order->status != 3}*}
{*                <div>*}
{*                    {if !empty($payment_control) && $order->payment_method_id == 40}*}
{*                        <p>Вы выбрали вариант онлайн-оплаты, произведите ее на этой странице.</p>*}
{*                    {/if}*}
{*                </div>*}
{*            {/if}*}
{*        </div>*}
{*    </div>*}
{/if}
