<!-- incl. antibot -->
<div class="check_block">		
	<input class="check_inp" type="checkbox" name="btfalse" {if !empty($btfalse)}checked{/if} />
	<input class="check_inp" type="checkbox" name="bttrue" />
	<div class="check_bt" onClick="$(this).parent().find('input[name=bttrue]').prop('checked', true);$(this).addClass('checked');">
		<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="meh" class="svg-inline--fa fa-meh fa-w-16 uncheckedconf" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="#d24a46" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-110.3 0-200-89.7-200-200S137.7 56 248 56s200 89.7 200 200-89.7 200-200 200zm-80-216c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm160-64c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zm8 144H160c-13.2 0-24 10.8-24 24s10.8 24 24 24h176c13.2 0 24-10.8 24-24s-10.8-24-24-24z"></path></svg>
		<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="grin" class="svg-inline--fa fa-grin fa-w-16 checkedconf" style="display:none;" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="#d24a46" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-110.3 0-200-89.7-200-200S137.7 56 248 56s200 89.7 200 200-89.7 200-200 200zm105.6-151.4c-25.9 8.3-64.4 13.1-105.6 13.1s-79.6-4.8-105.6-13.1c-9.9-3.1-19.4 5.4-17.7 15.3 7.9 47.1 71.3 80 123.3 80s115.3-32.9 123.3-80c1.6-9.8-7.7-18.4-17.7-15.3zM168 240c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm160 0c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32z"></path></svg>
		<div class="not_bt">Я нe рoбoт</div>
	</div>
</div>
<!-- incl. antibot @ -->
