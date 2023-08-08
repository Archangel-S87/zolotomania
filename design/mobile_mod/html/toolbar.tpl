<!-- incl. toolbar -->
<div id="menutop">
	<div id="menutopbody">
		
		<div class="row">
			<div id="logo">
				<img onclick="window.location='/'" src="/files/logo/logo.svg" title="{$settings->site_name|escape}" alt="{$settings->site_name|escape}" />
			</div>
		</div>
		<div class="row">
			<div class="informers">
				{if $settings->purpose == 0 || in_array($module, array('ProductView', 'ProductsView', 'CartView', 'OrderView', 'BrowsedView', 'CompareView', 'WishlistView'))}

					{get_wishlist_products var=wished_products}
					<div id="wishlist" title="Избранное" onclick="window.location='/wishlist'">
						{include file='wishlist_informer.tpl'}
					</div>
				{/if}
				{if $settings->purpose == 0 || in_array($module, array('CartView', 'OrderView', 'ProductView', 'ProductsView'))}
					<div id="cart_informer" onclick="window.location='cart'">
						{include file='cart_informer.tpl'}
					</div>
				{/if}
			</div>
			{if isset($settings->phone)}
				<a href="tel:{$settings->phone|escape|replace:' ' :''}" class="topphone">
					<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone" class="svg-inline--fa fa-phone fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#70BF4C" d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"></path></svg>
				</a>
			{/if}
			<div class="servicesheader">
			{if $user}
				<span class="username" onclick="window.location='/user'">Кабинет</span>
				{*<span class="username" onclick="window.location='/responses'">отзывы</span>*}
				<span class="username" onclick="window.location='/user/logout'">выйти</span>
			{else}
				<span class="username" onclick="window.location='/user/login'">Хочу с вами</span>
			{/if}
			</div>
		</div>
	</div>
</div>


<div id="catoverlay" style="display:none;" onclick="hideShowOverlay(this);return false;">
</div>
<!-- incl. toolbar @ -->
