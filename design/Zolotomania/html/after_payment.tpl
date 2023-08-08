{$messange_temp = 'Спасибо за заказ!'}
{if isset($payment_method)}
    {$messange_temp = 'Спасибо за покупку!'}
{/if}

{$meta_title = $messange_temp}
{$page_name = $messange_temp}

<h2 style="font-size: 3rem; margin: 100px auto 0 auto; text-align: center;">{$messange_temp}</h2>
<a href='/user' class="checkout_button" style="margin-top: 40px;">Личный кабинет</a>
