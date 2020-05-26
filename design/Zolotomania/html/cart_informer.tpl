<!-- incl. cart_informer -->
<!--noindex-->
{if $cart->total_products>0}
    <div class="fixed-cart__count">{$cart->purchases|count} </div>
    {*{$cart->total_products} {$cart->total_products|plural:'товар':'товаров':'товара'}*}

    {*if !empty($cart->full_discount)}(-{$cart->full_discount}%){/if*}
{else}
    <div class="fixed-cart__count">0</div>
{/if}

<div style="display:none">
    <div id="data">
        <div class="content">
            {if !empty($cart) && $cart->total_products>0}
                <div class="checkout">
                    <div class="button fleft" onClick="$.fancybox.close();">Продолжить покупки</div>
                    <div class="button fright" onClick="window.location='/cart'"><span>Оформить заказ</span></div>
                </div>
            {else}
                <span id="cart_total">Ваша корзина пуста</span>
                <div class="checkout" style="margin-top: 20px;">
                    <div style="float: none;" class="button fleft" onClick="$.fancybox.close();">Продолжить покупки
                    </div>
                </div>
            {/if}
        </div>

    </div>
</div>
<!--/noindex-->
<!-- incl. cart_informer @ -->
