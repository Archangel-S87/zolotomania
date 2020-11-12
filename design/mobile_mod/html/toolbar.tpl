<!-- incl. toolbar -->
<div id="menutop">
	<div id="menutopbody">
		
		<div class="row">
			<div id="logo">
				<img onclick="window.location='/'" src="files/logo/logo.png?v={filemtime('files/logo/logo.png')}" title="{$settings->site_name|escape}" alt="{$settings->site_name|escape}" />
			</div>
			{* TODO Вывод телефона с админки *}
			<a href="tel:8800123-45-67" class="topphone">8 (800) 123-45-67</a>
		</div>
		<div class="row">
			{if $settings->purpose == 0 || in_array($module, array('ProductView', 'ProductsView', 'CartView', 'OrderView', 'BrowsedView', 'CompareView', 'WishlistView'))}

				{get_wishlist_products var=wished_products}
				{* TODO при переходе на страницу wishlist адресная строка не меняется *}
				<div id="wishlist" title="Избранное" onclick="window.location='/wishlist'">
					{include file='wishlist_informer.tpl'}
				</div>
			{/if}
			{if $settings->purpose == 0 || in_array($module, array('CartView', 'OrderView', 'ProductView', 'ProductsView'))}
				<div id="cart_informer" onclick="window.location='cart'">
					{include file='cart_informer.tpl'}
				</div>
			{/if}
			{if $user}
				<span class="username" onclick="window.location='/user'">личный кабинет</span>
				<span class="username" onclick="window.location='/responses'">отзывы</span>
				<span class="username" onclick="window.location='/user/logout'">выйти</span>
			{else}
				<span class="username" onclick="window.location='/user/login'">Вход</span>
				<span class="username" onclick="window.location='/responses'">отзывы</span>
				<span class="username" onclick="window.location='/user/register'">Регистрация</span>
			{/if}
		</div>
	</div>
</div>


<div id="catoverlay" style="display:none;" onclick="hideShowOverlay(this);return false;">
</div>
<!-- incl. toolbar @ -->