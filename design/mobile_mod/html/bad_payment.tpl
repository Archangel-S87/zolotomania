{$meta_title = 'Оплата не удалась!'}
{$page_name = 'Оплата не удалась!'}

<style>
    .error {
        display: inline-block;
        color: #d24a46;
        border: 1px solid #d24a46;
        border-radius: 4px;
        text-align: center;
        font-size: 18px;
        margin: 20px auto -20px auto;
        padding: 10px;
    }
</style>

{if (!$order->paid)}
    <div style="text-align: center;">
        <div class="error">При попытке оплаты произашла ошибка</div>
    </div>
{/if}

<h2 style="font-size: 30px; text-align: center; color: #d24a46;margin-top: 60px;">Детали заказа</h2>

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
<div id='total_price' class="price" style="margin: 20px 0;">
    Итого к оплате: {$order->total_price|convert} {$currency->sign}
</div>
</div>

{if (!$order->paid && $order->status != 3)}
    {if isset($payment_method) && $order->total_price > 0}
        {* Форма оплаты, генерируется модулем оплаты *}
        {checkout_form order_id=$order->id module=$payment_method->module}
    {/if}
{else}
    <div class="page-pg">
        <div class="attention" style="display:table;clear:both;width:300px;text-align:center;padding:15px 15px 8px 15px;margin: 20px auto 20px auto;background-color:#bcd4e4;color:#000;">
            <p style="font-size:16px;text-transform:uppercase;">Спасибо за заказ!</p>
        </div>
    </div>
{/if}
