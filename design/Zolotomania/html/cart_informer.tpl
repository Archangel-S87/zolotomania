<!-- incl. cart_informer -->
<!--noindex-->
{if $cart->total_products > 0}
    <a href="/cart" class="svgwrapper" title="Корзина">
        <img id="icon_cart" src="design/{$settings->theme|escape}/images/free-icon-cart.svg" alt="cart">
    </a>
    <div class="fixed-cart__count count">{$cart->purchases|count}</div>
{else}
    <div class="svgwrapper" title="Корзина">
        <img id="icon_cart" src="design/{$settings->theme|escape}/images/free-icon-cart.svg" alt="cart">
    </div>
{/if}

<div style="display:none">
    <div id="data">
        <div class="content">
            {if !empty($cart) && $cart->total_products>0}
                <div class="checkout">
                    <div class="button fleft" onClick="$.fancybox.close();">Продолжить покупки</div>
                    <div class="button fright" onClick="window.location='/cart'"><span>Купить эту красоту</span></div>
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
