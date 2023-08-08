<!-- incl. cart_informer -->
<svg id="Слой_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 37.94 41.63"><path fill="#ED1C24" d="M33.42,31.61,31.7,14.88a1.36,1.36,0,0,0-1.35-1.22H27V10.31a7.8,7.8,0,0,0-15.6,0v3.35H7.68a1.36,1.36,0,0,0-1.35,1.22L4.56,31.61a5.25,5.25,0,0,0,5.2,5.76h18.5a5.16,5.16,0,0,0,3.83-1.7A5.23,5.23,0,0,0,33.42,31.61ZM14.16,10.31a5.08,5.08,0,0,1,10.16,0v3.35H14.16ZM30.08,33.85a2.42,2.42,0,0,1-1.82.8H9.76a2.54,2.54,0,0,1-2.5-2.76L8.9,16.38H29.12l1.6,15.5A2.54,2.54,0,0,1,30.08,33.85Z"/></svg>
{if !empty($cart) && $cart->total_products>0}<div class="badge" onclick="window.location='/cart'">{$cart->purchases|count}{*{$cart->total_products}*}</div>{/if}
{if !empty($mobile_app)}
	<script>
		try { 
			Android.sendTotalProducts("{$cart->purchases|count}{*{$cart->total_products}*}");
		} catch(e) {};
		try { 
			window.webkit.messageHandlers.cart.postMessage("{$cart->purchases|count}{*{$cart->total_products}*}");
		} catch(e) {};
	</script>
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
<!-- incl. cart_informer @ -->
