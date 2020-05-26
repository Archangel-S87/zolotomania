<!-- incl. wishlist_informer -->
{if !empty($wished_products)}
	<div class="svgwrapper" style="cursor:pointer;" title="Избранное" onclick="window.location='/wishlist'">
		<span uk-icon="icon: heart; ratio: 1.25"></span>
		<span class="wisha">{$wished_products|count}</span>
	</div>
{else}
	<div class="svgwrapper" title="Избранное">
		<span uk-icon="icon: heart; ratio: 1.25"></span>
	</div>
{/if}
<!-- incl. wishlist_informer @ -->