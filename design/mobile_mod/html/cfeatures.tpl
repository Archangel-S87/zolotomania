
	{* Features *}
		<form method="get" action="{url page=null}" id="cfeatures" class="features">
					{if !empty($features_variants)}
						<div class="feature_column">
                <div class="feature_values">
                    <ul>
                        {foreach $features_variants as $o }
                            <li>
                                <label for="feature1 ">
                                    <input type="checkbox" name="v[]"
                                           value="{$o}"{if !empty($smarty.get.v) && $o|in_array:$smarty.get.v} checked{/if} />
                                    <span>{$o|escape}</span>
                                </label>
                            </li>
                        {/foreach}
                    </ul>
                </div>
            </div>
					{/if}
					{if !empty($features_variants1)}
						<div class="feature_column feature_column-size">
                <div class="feature_name" onclick="hideShow1(this);return false;">Размер</div>
                <div class="feature_values feature_values-size">
                    <ul>
                        {foreach $features_variants1 as $o  }
                            <li>
                                <label {if !empty($smarty.get.v1) && $o|in_array:$smarty.get.v1} class="checked-active"{/if}>
                                    <input type="checkbox" name="v1[]"
                                           value="{$o}"{if !empty($smarty.get.v1) && $o|in_array:$smarty.get.v1} checked{/if} />{$o|escape}
                                </label>
                            </li>
                        {/foreach}
                    </ul>
                </div>
            </div>
					{/if}
						
					{if !empty($features_variants2)}
						<div class="feature_column">
                <div class="feature_values">
                    <ul>
                        {foreach $features_variants2 as $o}
                            <li>
                                <input type="checkbox" id="feature3" name="v2[]"
                                       value="{$o}"{if !empty($smarty.get.v2) && $o|in_array:$smarty.get.v2} checked{/if} />
                                <label for="feature3">{$o|escape}</label>
                            </li>
                        {/foreach}
                    </ul>
                </div>
            </div>
					{/if}
				
				
				
				{* Features *}
				{if !empty($features)}
			    {foreach $features as $f}
						<div class="feature_column">
							<div class="feature_name" data-feature="{$f->id}" onclick="hideShow1(this);return false;">{$f->name}</div>
								<div class="feature_values">
									{if $f->in_filter==2}
										{$f_min="min[`$f->id`]"}
										{$f_max="max[`$f->id`]"} 
										<select {if !empty($smarty.get.min.{$f->id}) || !empty($smarty.get.max.{$f->id})}id="choosenf"{/if} onchange="clickerdiapmin(this);">
											<option value="{url params=[$f_min=>null]}"></option>
											{$i=0}
											{foreach $f->options as $o}
												{$i=$i+1}{if $i==1}{$omin=$o->value}{/if}
												<option value="{url params=[$f_min=>$o->value]}" {if !empty($smarty.get.min.{$f->id}) && $smarty.get.min.{$f->id} == $o->value}selected{/if}>{$o->value|escape}</option>
											{/foreach}
										</select>
										- 
										<select onchange="clickerdiapmax(this)">
										<option value="{url params=[$f_max=>null]}"></option>
										{foreach $f->options as $o}
										<option value="{url params=[$f_max=>$o->value]}" {if !empty($smarty.get.max.{$f->id}) && $smarty.get.max.{$f->id} == $o->value}selected{/if}>{$o->value|escape}</option>
										{/foreach}
										</select>	
										<input class="diapmin" id="min{$f->id}" type="hidden" name="{$f_min}" checked="checked" value="{if !empty($smarty.get.min.{$f->id})}{$smarty.get.min.{$f->id}}{/if}" {if empty($smarty.get.min.{$f->id})}disabled{/if}/>
										<input class="diapmax" id="max{$f->id}" type="hidden" name="{$f_max}" checked="checked" value="{if !empty($smarty.get.max.{$f->id})}{$smarty.get.max.{$f->id}}{/if}" {if empty($smarty.get.max.{$f->id})}disabled{/if}/>
					
									{else}
										<ul>
											{foreach $f->options as $k=>$o}
											<li>
												<label {if !empty($filter_features.{$f->id}) && in_array($o->value,$filter_features.{$f->id})} class="checked-active"{/if}>
													<input type="checkbox" name="{$f->id}[]"
																		{if !empty($filter_features.{$f->id}) && in_array($o->value,$filter_features.{$f->id})}checked="checked"{/if} value="{$o->value|escape}"/>
														{$o->value|escape}
												</label>
											</li>
											{/foreach}
										</ul>
									{/if}
								</div>
							</div>
						</div>
			    {/foreach}
				{/if}
				{if !empty($category->brands) && $category->brands|count>1 && empty($brand)}
					<div class="feature_column">
						<div class="feat-block">
							<div class="hidetitle" href="javascript://" onclick="hideShow1(this);return false;">
							<svg viewBox="0 0 20 20" >
							    <path d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"/>
							    <path d="M0-.25h24v24H0z" fill="none"/>
							</svg>
							<a class="hidetitle1" href="javascript://" onclick="hideShow1(this);return false;">Бренд</a>
						</div>
			            <div class="feature_values">
		                <ul>
		                    {foreach name=brands item=b from=$category->brands}
		                    <li>
		                        <label>
		                            <div class="chbox">
										<input type="checkbox" name="b[]" value="{$b->id}" {if !empty($smarty.get.b) && $b->id|in_array:$smarty.get.b} checked{/if} />
									</div>
									<span>{$b->name|escape}</span>
		                        </label>
		                    </li>
		                    {/foreach}
		                </ul>
		            </div>
						</div>
					</div>
				{/if}

				{* price slider *}
				{if $minCost<$maxCost}
					<div class="price-slider" style="display:none">	
						<div class="mpriceslider">
							<div class="formCost">
								<span class="pr-cost">Цена: </span><span class="frommincurr" for="minCurr">от</span> <input class="curr" type="number" name="minCurr" id="minCurr" value="{$minCurr}"/>
								<span class="tomaxcurr" for="maxCurr">до</span> <input class="curr" type="number" name="maxCurr"  id="maxCurr" value="{$maxCurr}"/>
							</div>
						
							<div class="separator sliderpadd">			
								<div id="line">
									<div id="rele"></div>
									<div id="reletwo"></div>
								</div>
							</div>
						</div>
					</div>
		
					<script type="text/javascript">
						var currentPos={if isset($minCurr)}{$minCurr}{else}0{/if};
						var minCount={$minCost};
						var currentPostwo={$maxCurr};
						var maxCount={$maxCost};
						var Count={$maxCost - $minCost};
					</script>	
				{/if}
				
			
				{if !empty($keyword)}<div style="display:none;"><input type="checkbox" name="keyword" value="{$keyword}" checked="checked"/></div>{/if}
				{* price slider end *}

			
			<script>
        $(window).load(function () {
            // Отключаю стандартное событие плагина
            $(document).off("click", '#cfeatures input[type="checkbox"]');
            // Новое поведение submit формы
            $(document).on("click", '#cfeatures input[type="checkbox"]', function () {
                const input = this,
                    filter_form = $('#cfeatures');

                if ($(input).hasClass('checked-active')) {
                    $(input).removeAttr('checked');
                }

                // $('input[type="checkbox"]', filter_form).each(function (index, item) {
                //     if (input !== item) {
                //         $(item).removeAttr('checked');
                //     }
                // });

                filter_form.submit();
            });

            $(document).off("change", '#cfeatures input[type="text"]');
            $(document).on("change", '#cfeatures input[type="text"]', function () {
                $('#cfeatures').submit();
            });
        });
				{*
        // Пока не использую
        function mod_ajax_filter(current_input) {
            if (ajax_process) return false;

            ajax_process = true;

            const cfeatures = $('#cfeatures'),
                filter_form = $('#cfeatures form'),
                price_min = filter_form.find('#minCurr'),
                price_max = filter_form.find('#maxCurr'),
                inputs = filter_form.find(current_input);

            filter_form.find('input[type="checkbox"]').each(function (index, item) {
                if (current_input !== item) {
                    $(item).removeAttr('checked');
                } else {
                    $(current_input).attr('checked', '');
                }
            });

            let url = current_url + '?aj_f=true',
                params = '&';

            cfeatures.css('opacity', '0.5');

            debugger;

            inputs.each(function () {
                params += $(this).attr('name') + "=" + encodeURIComponent($(this).val()) + "&";
            });

            const diaps = filter_form.find('input.diaps');
            diaps.each(function () {
                params += $(this).attr('name') + "=" + encodeURIComponent($(this).val()) + "&";
            });

            if (!$(price_min).is(":disabled")) {
                params += 'minCurr=' + encodeURIComponent(price_min.val()) + "&";
            }

            if (!$(price_max).is(":disabled")) {
                params += 'maxCurr=' + encodeURIComponent(price_max.val()) + "&";
            }

            url += params;

            $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
                options.async = true;
            });

            $.ajax({
                url: url,
                dataType: 'json',
                success: function (data) {
                    if (!data.filter_block) return false;
                    cfeatures.html(data.filter_block);
                    ajax_process = false;
                    cfeatures.css('opacity', '1');
                    //$('input.buttonblue').click();
                },
                error: function (jqXHR, exception) {
                    ajax_process = false;
                    $('#cfeatures').css('opacity', '1');
                }
            });
        }
        *}
			</script>
		</form>
		<script>
    // expand used feature column
    $("#cfeatures input:checked, #cfeatures select#choosenf").closest('#cfeatures .feature_column').find('.feature_name').addClass('checked');
    $("#cfeatures input:checked, #cfeatures select#choosenf").closest('#content .feature_values').fadeIn('normal');
    // expand used feature column end
	</script>
	{* Features end *}

