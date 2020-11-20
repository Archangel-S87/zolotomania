<!-- incl. cfeatures -->
<form method="get" action="{url page=null}">

    <style>
        #cfeatures .feature_column {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 8px;
            margin: 0 12px;
            border-radius: 5px;
            background: linear-gradient(0deg, #f4f4f4, #f9f9f9, #f4f4f4);
            flex: 0 1 400px;
            position: relative;
        }
        #cfeatures .feature_column.active .feature_name {
            color: #d24a46;
        }
        #cfeatures .feature_name {
            display: flex;
            align-items: center;
            color: #272727;
            font-weight: 500;
            text-align: left;
            border-bottom: 1px solid #d24a46;
            width: 100%;
            height: 100%;
            margin: 0 10px 0 0;
            padding: 0 4px;
        }
        #cfeatures .feature_values {
            display: none;
            position: absolute;
            z-index: 20;
            top: 100%;
            margin: 0;
            background: #fff;
            border: 1px solid #d24a46;
            border-radius: 5px;
            padding: 8px 0 8px 12px;
            width: calc(100% - 30px);
        }
        #cfeatures .hide_feat {
            width: 30px;
            height: 30px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 8px;
            right: 15px;
            padding: 0;
        }
        #cfeatures .hide_feat span {
            border-top: 4px solid;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            display: block;
        }
        #cfeatures .hide_feat.show {
            transform: rotate(180deg);
        }
    </style>

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
        <div class="feature_column features-variants-1">
            <div class="feature_name" data-feature="variant_1">Размер</div>
            <div class="hide_feat"><span></span></div>
            <div class="feature_values">
                <ul>
                    {foreach $features_variants1 as $o}
                        <li>
                            <label{if !empty($smarty.get.v1) && $o|in_array:$smarty.get.v1} class="checked-active"{/if}>
                                <input type="checkbox"
                                       name="v1[]"
                                       value="{$o}"{if !empty($smarty.get.v1) && $o|in_array:$smarty.get.v1} checked{/if} />
                                <span class="chbox-value">{$o|escape}</span>
                            </label>
                        </li>
                    {/foreach}
                </ul>
            </div>
        </div>
    {/if}
    {if !empty($features_variants2)}
        <div class="feature_column features-variants-2">
            <div class="feature_name" data-feature="variant_2">Цвет</div>
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

    <script>
        $(window).load(function () {
            // Отключаю стандартное событие плагина
            $(document).off("click", '#cfeatures input[type="checkbox"]');
            // Новое поведение submit формы
            $(document).on("click", '#cfeatures input[type="checkbox"]', function () {
                const input = this,
                    filter_form = $('#cfeatures form');

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
                $('#cfeatures form').submit();
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

    {* Features *}
    {if !empty($features)}
        {foreach $features as $f}
            <div class="feature_column feature-others">
                <div class="feature_name" data-feature="{$f->id}">{$f->name}</div>
                <div class="hide_feat"><span></span></div>
                <div class="feature_values">
                    {if $f->in_filter==2}
                        {$f_min="min[`$f->id`]"}
                        {$f_max="max[`$f->id`]"}
                        <select {if !empty($smarty.get.min.{$f->id}) || !empty($smarty.get.max.{$f->id})}id="choosenf"{/if}
                                onchange="clickerdiapmin(this);">
                            <option label="от" value="{url params=[$f_min=>null]}"></option>
                            {$i=0}
                            {foreach $f->options as $o}
                                {$i=$i+1}{if $i==1}{$omin=$o->value}{/if}
                                <option value="{url params=[$f_min=>$o->value]}"
                                        {if !empty($smarty.get.min.{$f->id}) && $smarty.get.min.{$f->id} == $o->value}selected{/if}>{$o->value|escape}</option>
                            {/foreach}
                        </select>
                        -
                        <select onchange="clickerdiapmax(this)">
                            <option label="до" value="{url params=[$f_max=>null]}"></option>
                            {foreach $f->options as $o}
                                <option value="{url params=[$f_max=>$o->value]}"
                                        {if !empty($smarty.get.max.{$f->id}) && $smarty.get.max.{$f->id} == $o->value}selected{/if}>{$o->value|escape}</option>
                            {/foreach}
                        </select>
                        <input class="diapmin diaps" type="hidden" name="{$f_min}"
                               value="{if !empty($smarty.get.min.{$f->id})}{$smarty.get.min.{$f->id}}{/if}"
                               {if empty($smarty.get.min.{$f->id})}disabled{/if}/>
                        <input class="diapmax diaps" type="hidden" name="{$f_max}"
                               value="{if !empty($smarty.get.max.{$f->id})}{$smarty.get.max.{$f->id}}{/if}"
                               {if empty($smarty.get.max.{$f->id})}disabled{/if}/>
                    {else}
                        <ul>
                            {foreach $f->options as $k=>$o}
                                <li>
                                    <label{if !empty($filter_features.{$f->id}) && in_array($o->value,$filter_features.{$f->id})} class="checked-active"{/if}>
                                        <input type="checkbox"
                                               name="{$f->id}[]"
                                               {if !empty($filter_features.{$f->id}) && in_array($o->value,$filter_features.{$f->id})}checked="checked"{/if}
                                               value="{$o->value|escape}"/>
                                        <span class="chbox-value">{$o->value|escape}</span>
                                    </label>
                                </li>
                            {/foreach}
                        </ul>
                    {/if}
                </div>
            </div>
        {/foreach}
    {/if}

    <div class="price-brands">
        {if !empty($category->brands) && $category->brands|count>1 && empty($brand)}
            {* Brands *}
            <div class="feature_column brandcol">
                <div class="feature_name">Бренд</div>
                <div class="hide_feat">
                    <svg>
                        <use xlink:href='#b_plus'/>
                    </svg>
                </div>
                <div class="feature_values">
                    <ul>
                        {foreach name=brands item=b from=$category->brands}
                            <li>
                                <label>
		                            <span class="chbox">
										<input type="checkbox" name="b[]"
                                               value="{$b->id}" {if !empty($smarty.get.b) && $b->id|in_array:$smarty.get.b} checked{/if} />
									</span>
                                    <span>{$b->name|escape}</span>
                                </label>
                            </li>
                        {/foreach}
                    </ul>
                </div>
            </div>
            {* Brands end *}
        {/if}

        {*  price slider  *}
        <div class="mpriceslider">
            <div class="formCost">
                <span class="pr-cost">Цена:</span><input type="text" name="minCurr" id="minCurr"
                                                         onchange="ajax_filter();" value="{$minCurr}"/>
                <label for="maxCurr">-</label> <input type="text" name="maxCurr" id="maxCurr"
                                                      onchange="ajax_filter();" value="{$maxCurr}"/>
            </div>
            <div class="sliderCont">
                <div id="cslider"></div>
            </div>
            <a href="{strtok($smarty.server.REQUEST_URI,'?')}" class="clear_filter">Сбросить фильтр</a>
        </div>

        {if !empty($keyword)}
            <div style="display:none;">
                <input type="checkbox" name="keyword" value="{$keyword}" checked="checked"/>
            </div>
        {/if}
        {*  price slider end  *}
    </div>
    {* Features end *}
</form>

<script>
    // expand used feature column
    $("#cfeatures input:checked, #cfeatures select#choosenf").closest('#content .feature_column').addClass('active');
    // expand used feature column end
</script>

{* svg sprite *}
<svg style="display:none;">
    <symbol id="b_plus" fill="#1b6f9f" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
	<g id="Bounding_Boxes_cf">
        <g id="ui_x5F_spec_x5F_header_copy_3_cf" display="none">
        </g>
        <path fill="none" d="M0,0h24v24H0V0z"/>
    </g>
        <g id="Outline_cf">
            <g id="ui_x5F_spec_x5F_header_cf" display="none">
            </g>
            <path d="M13,7h-2v4H7v2h4v4h2v-4h4v-2h-4V7z M12,2C6.48,2,2,6.48,2,12s4.48,10,10,10s10-4.48,10-10S17.52,2,12,2z M12,20
			c-4.41,0-8-3.59-8-8s3.59-8,8-8s8,3.59,8,8S16.41,20,12,20z"/>
        </g>
	</symbol>
</svg>
{* svg sprite end *}
<!-- incl. cfeatures @ -->		
