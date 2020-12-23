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

{* Список покупок *}
<table id="purchases1">

    <tr id="carttitles">
        <td class="number">№</td>
        <td class="image" style="border-radius: 5px 0 0 5px;">Фото</td>
        <td class="name">Наименование</td>
        <td class="price">Цена</td>
    </tr>

    {foreach from=$purchases item=$purchase name=products}
        {if !empty($purchase->product->name)}
            <tr data-purchase-id="{$purchase->variant->id}">

                {* № *}
                <td style="text-align: center">{$smarty.foreach.products.iteration}</td>

                {* Изображение товара *}
                <td class="image">
                    {if !empty($purchase->product->images)}
                        {$image = $purchase->product->images|first}
                        <span class="purimage">
                                    <a href="{$image->filename|resize:800:600:w}" class="zoom">
                                        <img src="{$image->filename|resize:100:100}"
                                             alt="{$purchase->product->name|escape}">
                                    </a>
                                </span>
                    {else}
                        <span class="purimage"><svg class="nophoto"><use xlink:href='#no_photo'/></svg></span>
                    {/if}
                </td>

                {* Название товара *}
                <td class="name">
                    <div style="display: flex; justify-content: space-between; align-items: center">
                        <a href="products/{$purchase->product->url}"{if $purchase->variant->stock == 0 || $purchase->variant->reservation} class="no-stock"{/if}>{$purchase->product->name|escape}</a>
                    </div>
                </td>

                {* Сумма с учётом бонуса *}
                <td class="price">
                    {($purchase->variant->price)|convert} {$currency->sign}
                </td>
            </tr>
        {/if}
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
        <div class="attention" style="display:table;clear:both;width:300px;text-align:center;padding:15px 15px 8px 15px;margin: 20px auto 20px auto;background-color:#bcd4e4;color:#000;">
            <p style="font-size:16px;text-transform:uppercase;">Спасибо за заказ!</p>
        </div>
    </div>
{/if}
