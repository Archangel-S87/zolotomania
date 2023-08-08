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
        margin: 60px auto -40px auto;
        padding: 10px;
    }
</style>

{if (!$order->paid)}
    <div style="text-align: center;">
        <div class="error">При попытке оплаты произашла ошибка</div>
    </div>
{/if}

<h2 style="font-size: 30px; text-align: center; color: #d24a46;margin-top: 60px;">Детали заказа</h2>

<style>
    #purchases1 .missing-items {
        text-decoration: line-through;
    }
</style>

{* Список покупок *}
<table id="purchases1">

    <tr id="carttitles">
        <td class="image"></td>
        <td class="name">Наименование</td>
        <td class="price">Цена за шт.</td>
        <td class="amount">Кол-во</td>
        <td class="price">Итого</td>
    </tr>

    {foreach from=$purchases item=$purchase name=purchase}
        <tr>
            {* Изображение товара *}
            <td class="image">
                {if !empty($purchase->product->images)}
                    {$image = $purchase->product->images|first}
                    <span class="purimage">
						<a href="products/{$purchase->product->url}"><img src="{$image->filename|resize:100:100}" alt="{$purchase->product->name|escape}"></a>
					</span>
                {elseif !empty($purchase->product->url)}
                    <span class="purimage">
						<a href="products/{$purchase->product->url}">
                            <img loading="lazy" src="/design/Zolotomania/images/no-photo.png" alt="no-photo"/>
                        </a>
					</span>
                {else}
                    <span class="purimage">
						<img loading="lazy" src="/design/Zolotomania/images/no-photo.png" alt="no-photo"/>
					</span>
                {/if}
            </td>

            {* Название товара *}
            <td class="name">
                {if !empty($purchase->product->url)}
                    <a href="products/{$purchase->product->url}">{$purchase->product_name|escape}        {$purchase->variant_name|escape}</a>
                {else}
                    <span class="missing-items">
                        {$purchase->product_name|escape}
                        {$purchase->variant_name|escape}
                    </span>
                {/if}
                {if $order->paid && !empty($purchase->variant->attachment)}
                    <a class="download_attachment" href="order/{$order->url}/{$purchase->variant->attachment}">скачать
                        файл</a>
                {/if}
            </td>

            {* Цена за единицу *}
            <td class="price">
                {($purchase->price)|convert}&nbsp;{$currency->sign}
            </td>

            {* Количество *}
            <td class="amount">
                {$purchase->amount}&nbsp;{if $purchase->unit}{$purchase->unit}{else}{$settings->units}{/if}
            </td>

            {* Цена *}
            <td class="price">
                {($purchase->price*$purchase->amount)|convert}&nbsp;{$currency->sign}
            </td>
        </tr>
    {/foreach}

    {* Итого *}
    <tr>
        <td>Итого:</td>
        <td></td>
        <td>
            {if $order->bonus_discount > 0}
                Списано маннингов: {$order->bonus_discount|convert}
            {/if}
        </td>
        <td id='total_price' class="price">
            {$order->total_price|convert} {$currency->sign}
        </td>
    </tr>
</table>

{if (!$order->paid && $order->status != 3)}
    {if isset($payment_method) && $order->total_price > 0}
        {* Форма оплаты, генерируется модулем оплаты *}
        {checkout_form order_id=$order->id module=$payment_method->module}
    {/if}
{else}
    <div class="page-pg">
        <div class="attention"
             style="display:table;clear:both;width:300px;text-align:center;padding:15px 15px 8px 15px;margin: 20px auto 20px auto;background-color:#bcd4e4;color:#000;">
            <p style="font-size:16px;text-transform:uppercase;">Спасибо за заказ!</p>
        </div>
    </div>
{/if}
