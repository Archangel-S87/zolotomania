<div class="wishcomp">
	<!--div class="compare addcompare" title="Сравнение">
		{if !empty($compare_informer->items_id[{$product->id}])}
			<span class="gocompare activewc" onclick="window.location='/compare'">
				Сравнить
			</span>
		{else}
			<span style="display:none;" class="gocompare activewc" onclick="window.location='/compare'">
				В сравнение
			</span>
			<svg class="basewc" data-wish="{$product->id}"><use xlink:href='#basec' /></svg>
		{/if}
	</div-->
	<div class="wishprod">
		<div class="wishlist towish" title="Избранное">
			{if !empty($wished_products) && $product->id|in_array:$wished_products}
				<span onclick="window.location='/wishlist'" class="inwish activewc">
					<span xlink:href='#activew' class="button button-default">В избранное</span>
				</span>
			{else}
				<span style="display:none;" onclick="window.location='/wishlist'" class="inwish activewc">
					<span xlink:href='#activew' class="button button-default">В избранное</span>
				</span>
				<span class="basewc" data-wish="{$product->id}" xlink:href='#basew' class="button button-default">Подумаю</span>
			{/if}
		</div>
	</div>
</div>