{* Шаблон корзины *}

{$meta_title = "Корзина" scope=root}
{$page_name = "Корзина" scope=root}

<h1 style="margin-top: 20px;">Корзина</h1>

{if $cart->purchases}
    <form class="main_cart_form" method="post" name="cart"
          {if $settings->attachment == 1}enctype="multipart/form-data"{/if}>

        {if isset($error_stock)}
            <div class="message_error">
                {if $error_stock == 'out_of_stock_order'}В вашем заказе есть закончившиеся товары{/if}
            </div>
        {/if}

        {* Список покупок *}
        <table id="purchases1">

            <tr id="carttitles">
                <td class="image" style="border-radius: 5px 0 0 5px;">
                </td>
                <td class="name">
                    Мои покупки
                </td>
                <td class="price">
                    Цена
                </td>
                <td class="remove" style="border-radius: 0 5px 5px 0;">
                </td>
            </tr>

            {foreach from=$cart->purchases item=purchase}
                {if !empty($purchase->product->name)}
                    <tr data-purchase-id="{$purchase->variant->id}"
                        {if $purchase->variant->stock == 0}class="out_of_stock"{/if}>
                        {* Изображение товара *}
                        <td class="image">
                            {if !empty($purchase->product->images)}
                                {$image = $purchase->product->images|first}
                                <span class="purimage"><a href="{$image->filename|resize:800:600:w}" class="zoom"><img
                                                src="{$image->filename|resize:100:100}"
                                                alt="{$purchase->product->name|escape}"></a></span>
                            {else}
                                <span class="purimage"><svg class="nophoto"><use xlink:href='#no_photo'/></svg></span>
                            {/if}
                        </td>

                        {* Название товара *}
                        <td class="name">
                            <a href="products/{$purchase->product->url}">{$purchase->product->name|escape}</a>
                            {$purchase->variant->name|escape}
                        </td>

                        {* Цена за единицу *}
                        <td class="price">
                            {($purchase->variant->price)|convert} {$currency->sign} <span class="purx">&nbsp;x</span>
                        </td>

                        {* Удалить из корзины *}
                        <td class="remove">
                            <a href="cart/remove/{$purchase->variant->id}">
                                <img width="16" height="16" src="design/{$settings->theme}/images/delete.png"
                                     title="Удалить из корзины" alt="Удалить из корзины">
                            </a>
                        </td>

                    </tr>
                {/if}
            {/foreach}

        </table>
        <div class="cart__after uk-flex">
            <div class="cart-back">
                <a href="javascript:history.go(-1)" class="buttonblue">Вернутся к покупкам</a>
            </div>

            <div class="purchases_middle">
                {* Discount *}
                {if !empty($cart->full_discount)}
                    <div class="c_discount">
                        {*{if !empty($cart->discount2)}
                            <p>Рег. скидка: {$cart->discount2}&nbsp;%</p>
                        {/if}
                        {if !empty($cart->value_discountgroup)}
                            <p>Скидка от суммы: {$cart->value_discountgroup}&nbsp;%</p>
                        {/if}*}
                        {if !empty($cart->full_discount)}
                            <p class="total_discount">Скидка: {$cart->full_discount}&nbsp;%</p>
                        {/if}
                    </div>
                {else}
                    <div class="nodiscount"></div>
                {/if}
                {* Discount end *}

                {if $settings->bonus_limit && isset($user->balance) && $user->balance > 0}
                    <div class="c_coupon bonusblock">
                        <label>
                            <input type="checkbox" name="bonus" value="1"{if !empty($bonus)} checked{/if} /> <span
                                    class="c_title" style="text-transform:uppercase;">Оплатить баллами</span>
                        </label>
                        {*<div class="totalbonuses">Всего накоплено баллов на {$user->balance|convert}&nbsp;{$currency->sign}</div>*}
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
                        <p class="c_title">КУПОН:</p>
                        {if !empty($coupon_error)}
                            <div class="message_error">
                                {if $coupon_error == 'invalid'}Купон недействителен{/if}
                            </div>
                        {/if}
                        <div{if $cart->coupon_discount>0} style="display: none"{/if}>
                            <input type="text" name="coupon_code"
                                   value="{if !empty($cart->coupon->code)}{$cart->coupon->code|escape}{/if}"
                                   class="coupon_code" autocomplete="off"/><input class="buttonblue" type="button"
                                                                                  name="apply_coupon"
                                                                                  value="Применить купон"
                                                                                  onclick="document.cart.submit();"/>
                        </div>
                        {if !empty($cart->coupon->min_order_price)}<span
                                class="coupondisc">Купон "{$cart->coupon->code|escape}" <span>для заказов от {$cart->coupon->min_order_price|convert} {$currency->sign}</span>{/if}
                            {if $cart->coupon_discount>0}
                                <br/>
                                <span class="coupondiscount">Скидка по купону: <strong>{$cart->coupon_discount|convert}&nbsp;{$currency->sign}</strong>
                                </span>{/if}

                            {literal}
                                <script>
							$("input[name='coupon_code']").keypress(function (event) {
                                if (event.keyCode == 13) {
                                    $("input[name='name']").attr('data-format', '');
                                    $("input[name='email']").attr('data-format', '');
                                    document.cart.submit();
                                }
                            });
							</script>
                            {/literal}
                    </div>
                {/if}

                <div class="c_total rounded6">
                    <p>Итого товаров {if !empty($cart->full_discount)} со скидкой{/if} на:</p>
                    <span id="ems-total-price">{$cart->total_price|convert}</span>&nbsp;{$currency->sign}
                </div>

            </div>
        </div>
        <span style="{if $cart->total_price >= $settings->minorder}display:none;{/if}" class="minorder">Минимальная сумма заказа <strong
                    style="white-space: nowrap;">{$settings->minorder|convert} {$currency->sign}</strong><br/> Чтобы оформить заказ Вам нужно <a
                    href="/">добавить в корзину еще товаров!</a></span>

        <div class="del_pay_info" style="{if $cart->total_price < $settings->minorder}display:none;{/if}">

            {$countpoints=0}
            {* Доставка *}
            {if $deliveries}
                {$countpoints=$countpoints+1}
                <div class="cart-blue">
                    <span class="whitecube">{$countpoints}</span>
                    <h2>Куда привезти</h2>
                </div>
                {* Вес *}
            {if !empty($cart->total_weight)}
                <p style="display:none;margin-top: 15px;">Общий вес:
                    <span id="ems-total-weight">{$cart->total_weight}</span>&nbsp;кг.
                </p>
            {/if}
                {* Вес @ *}
                {* Объем *}
            {if !empty($cart->total_volume)}
                <p style="display:none;margin-top: 15px;">Общий объем:
                    <span id="total-volume">{$cart->total_volume}</span>&nbsp;куб.м
                </p>
                {$volume=$cart->total_volume}

                {* Calculate sides from volume in cm*}
                {math assign="side" equation="pow(vol*1000000, 1/3)" vol=$volume}
                <span id="cart-side" style="display: none;">{$side|round}</span>
                {* calculate sides from volume end *}
            {/if}
                {* Объем @ *}

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
                <ul id="deliveries" class="deliveries">
                    {foreach $deliveries as $delivery}
                        <li {if $delivery->price2 > 0}data-price="{$delivery->price|convert}"
                            data-price2="{$delivery->price2|convert}"{/if} id="li_delivery_{$delivery->id}">
                            <div class="checkbox">
                                <input class="{if $delivery@first}first{else}other{/if} {if in_array($delivery->id, array(3,114,121)) || $delivery->widget == 1}del_widget{/if}"
                                       type="radio" name="delivery_id" value="{$delivery->id}"
                                       {if $delivery@first}checked{/if} id="deliveries_{$delivery->id}"
                                       onchange="change_payment_method({$delivery->id})"
                                        {if $delivery->payment_methods}data-payments="{foreach $delivery->payment_methods as $payment_method}{$payment_method->id},{/foreach}"{/if}
                                        {if $delivery->free_from > 0}data-freefrom="{$delivery->free_from}"{/if}
                                />
                            </div>

                            <div>
                                <label for="deliveries_{$delivery->id}">
									<span class="delivery-header">
									{$delivery->name}

                                        {if $delivery->separate_payment}[оплачивается отдельно]{/if}
				
									(<span class="del_price"
                                           id="not-null-delivery-price-{$delivery->id}">{if $delivery->free_from > 0 && $cart->total_price >= $delivery->free_from}бесплатно</span>)
									{elseif (in_array($delivery->id, array(3,114,121)) || $delivery->widget == 1)}---</span>&nbsp;{$currency->sign}
                                    )
                                    {elseif $delivery->price == 0 && $delivery->price2 == 0}бесплатно</span>)
                                    {else}{if $delivery->price2 > 0}{($delivery->price + ($delivery->price2 * $cart->total_weight|ceil))|convert}{else}{$delivery->price|convert}{/if}</span>&nbsp;{$currency->sign}
                                    ){/if}
                                    </span>
                                </label>
                                {if in_array($delivery->id, array(3,114,121)) || $delivery->widget == 1}
                                    <a class="hideBtn show_map"
                                       {if $delivery->id == 3}data-role="shiptor_widget_show"{/if} href="javascript://">выбрать
                                        на карте</a>
                                {elseif $delivery->description}
                                    <a class="hideBtn" href="javascript://" onclick="hideShow(this);return false;">подробнее</a>
                                {/if}
                                <div class="description"
                                     {if $delivery->id != 3 && $delivery->id != 114 && $delivery->id != 121 && $delivery->widget != 1}id="hideCont"{/if}>

                                    {*{if !empty($delivery->free_from) && $delivery->free_from > 0}<p>Доставка бесплатна для заказов от {$delivery->free_from|convert} {$currency->sign}</p>{/if}*}

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
                                            <div class="deliveryinfo" style="margin-top:10px;"></div>
                                            <input name="widget_{$delivery->id}" type="hidden"
                                                   id="widget_{$delivery->id}"/>
                                        </div>
                                        {* calc (3) end *}
                                    {/if}
                                </div>
                            </div>
                        </li>
                    {/foreach}
                </ul>
                <textarea style="display:none;" name="calc" hidden="hidden" id="calc_info"></textarea>
                <div class="hidden" style="display: none;">
                    <div id="shops-content">
                        <h2 style="text-align: center; margin-bottom: 20px;">Наши магазины</h2>
                        <ul id="shop-list">
                            {foreach $shops as $shop}
                                <li style="display: flex">
                                    <div class="checkbox">
                                        <input id="shops_{$shop->id}" class="" type="radio" name="shop_id"
                                               value="{$shop->id}"/>
                                    </div>
                                    <label for="shops_{$shop->id}" style="margin-left: 10px; margin-bottom: 20px;">
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
                                if (+$(this).val() === 2) {
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
                    <span class="whitecube">{$countpoints}</span>
                    <h2>Как буду платить</h2>
                </div>
                <div class="delivery_payment">
                    <ul id="payments">
                        {foreach $payment_methods as $payment_method}
                            <li id="list_payment_{$payment_method->id}" style="display:none;">
                                <div class="checkbox" id="paym">
                                    <input type="radio" name="payment_method_id"
                                           value="{$payment_method->id}" {*{if $payment_method@first}checked{/if}*}
                                           id="payment_{$payment_method->id}">
                                </div>
                                <div><label for="payment_{$payment_method->id}"><span
                                                class="delivery-header">{$payment_method->name}</span></label>
                                    {if $payment_method->description}
                                        <a class="hideBtn" href="javascript://" onclick="hideShow(this);return false;">подробнее</a>
                                        <div class="description" id="hideCont">{$payment_method->description}</div>{/if}
                                </div>
                            </li>
                        {/foreach}
                    </ul>
                </div>
            {/if}
            <script>
                function change_payment_method($id) {
                    $('#calc_info').html($("#li_delivery_" + $id + " .deliveryinfo").text());

                    $("#payments li").hide();
                    var data_payments = $("#deliveries_" + $id).attr('data-payments');
                    if (data_payments != null) {
                        var arr = data_payments.split(',');
                        $.each(arr, function (index, value) {
                            $("#list_payment_" + value.toString()).css("display", "block");
                        });
                    }
                    $('#payments li:visible:first input[name="payment_method_id"]').attr('checked', 'checked');
                    payment_first = $('#payments li:visible:first input[name="payment_method_id"]').val();
                }

                $(window).load(function () {
                    delivery_num = $('#deliveries li:visible:first input[name="delivery_id"]').val();
                    change_payment_method(delivery_num);
                });
            </script>

            <div class="cart-blue">
                <span class="whitecube">{$countpoints+1}</span>
                <h2>Как со мной связаться</h2>
            </div>

            <div class="form cart_form">
                {if isset($error)}
                    <div class="message_error">
                        {if $error == 'empty_name'}Введите имя{/if}
                        {if $error == 'empty_email'}Введите email{/if}
                        {if $error == 'captcha'}Не пройдена проверка на бота{/if}
                        {if $error == 'min_order'}Сумма товаров в заказе меньше минимума{/if}
                    </div>
                {/if}

                <div class="del_main">
                    <div class="del_left">
                        <label>ФИО *</label>
                        <input name="name" type="text" value="{if !empty($name)}{$name|escape}{/if}" data-format=".+"
                               data-notice="Введите ФИО"/>
                    </div>

                    <div class="del_right">
                        <label>Email *</label>
                        <input name="email" type="email" value="{if !empty($email)}{$email|escape}{/if}"
                               data-format="email" data-notice="Введите email"/>
                    </div>

                    <div class="del_left">
                        <label>Телефон *</label>
                        <input id="phone" name="phone" type="text" data-format=".+"
                               value="{if !empty($phone)}{$phone|escape}{/if}" data-notice="Укажите телефон"/>
                    </div>

                    <div class="del_right">
                        <label>Адрес доставки</label>
                        <input name="address" type="text"
                               value="{if !empty($address)}{$address|escape}{/if}{if !empty($adress)}{$adress|escape}{/if}"/>
                    </div>
                </div>

                {* загрузка файлов *}
                {if $settings->attachment == 1}
                    <div class="separator" style="margin-bottom:10px;">
                        <label>Прикрепить файл
                            <span class="errorupload errortype" style="display:none; margin:0 0px 0 20px;">Неверный тип файла!</span>
                            <span class="errorupload errorsize"
                                  style="display:none; margin:0 0px 0 20px;">Файл более {$settings->maxattachment|escape} Мб!</span>
                        </label>
                        <input style="margin-right:20px;" class='attachment' name=files[] type=file multiple
                               accept='pdf/txt/doc/docx/xls/xlsx/odt/ods/odp/gif/jpg/jpeg/png/psd/cdr/ai/zip/rar/gzip'/>
                        <span style="font-size:12px;">Максимальный размер: {$settings->maxattachment|escape} Мб! Разрешенные типы: pdf, txt, doc(x), xls(x), odt, ods, odp, gif, jpg, png, psd, cdr, ai, zip, rar, gzip</span>
                    </div>
                    <script>
                        $('.attachment').bind('change', function () {
                            $('.errorsize, .errortype').hide();
                            var size = this.files[0].size;
                            var name = this.files[0].name;
                            if ({$settings->maxattachment|escape * 1024 * 1024}<
                            size
                        )
                            {
                                $('.errorsize').show();
                                $('.attachment').val('');
                                setTimeout(function () {
                                    $('.errorsize').fadeOut('slow');
                                }, 3000);
                            }
                            var fileExtension = ['pdf', 'txt', 'doc', 'docx', 'xls', 'xlsx', 'odt', 'ods', 'odp', 'gif', 'jpg', 'jpeg', 'png', 'psd', 'cdr', 'ai', 'zip', 'rar', 'gzip'];
                            if ($.inArray(name.split('.').pop().toLowerCase(), fileExtension) == -1) {
                                $('.errortype').show();
                                $('.attachment').val('');
                                setTimeout(function () {
                                    $('.errortype').fadeOut('slow');
                                }, 3000);
                            }
                        });
                    </script>
                {/if}
                {* загрузка файлов @ *}

                <label>Комментарий к заказу</label>
                <textarea name="comment" id="order_comment">{if !empty($comment)}{$comment|escape}{/if}</textarea>
                {include file='conf.tpl'}
                {include file='antibot.tpl'}
                <input {if $settings->counters || $settings->analytics}onclick="{if $settings->counters}ym({$settings->counters},'reachGoal','cart'); {/if}{if $settings->analytics}ga ('send', 'event', 'cart', 'order_button');{/if} return true;"{/if}
                       type="submit" name="checkout" class="button hideablebutton" value="Оформить заказ"/>

            </div>

        </div>

    </form>
{else}
    В корзине нет товаров
{/if}

{literal}
    <script>
        $(function () {
            $("a.zoom").fancybox({'hideOnContentClick': true});
        });

        function hideShow(el) {
            $(el).toggleText('подробнее', 'свернуть').toggleClass('show').siblings('div#hideCont').slideToggle('normal');
            return false;
        };
    </script>
{/literal}
				
