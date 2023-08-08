{get_slidesm var=slidem}
{if !empty($slidem)}
	<div id="slider" class="swipe" style="display: none;">
		<div class="swipe-wrap">
			{foreach $slidem as $s}
				{if !empty($s->image)}
					<div>
						<img loading="lazy" {if $s->url}onclick="window.location='{$s->url}'"{/if} src="{$s->image}" alt="{if !empty($s->name)}{$s->name}{/if}" {if !empty($s->name)}title="{$s->name}"{/if} />
					</div>
				{/if}
			{/foreach}
		</div>
	</div>
	<div class="sliderdots">
		<div class="dotswrapper">
			{$cslidem = 0}
			{foreach $slidem as $s}
				{if !empty($s->image)}
					<div id="{$cslidem}" class="dot{if $cslidem == 0} active{/if}"></div>
					{$cslidem = $cslidem + 1}
				{/if}
			{/foreach}
		</div>
	</div>

	<script src="/androidcore/slider.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(window).load(function() {
			const element = document.getElementById('slider');
			$(element).show();
			window.mySwipe = new Swipe(element, {
				startSlide: 0,
				auto: 5000,
				draggable: true,
				autoRestart: true,
				continuous: true,
				disableScroll: false,
				stopPropagation: false,
				callback: function(index, element) {
					$('.dot').removeClass('active');$('#'+index).addClass('active');
				},
				transitionEnd: function(index, element) {
				}
			});
		});
	</script>
{/if}
