<div class="wishcomp">
	<div class="wishprod">
		<div class="wishlist towish">
			{if !empty($wished_products) && $product->id|in_array:$wished_products}
			{else}
				<span class="basewc buttonred" data-wish="{$product->id}">Подумаю</span>
			{/if}
		</div>
	</div>
</div>