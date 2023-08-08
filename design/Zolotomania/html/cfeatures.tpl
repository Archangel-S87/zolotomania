<!-- incl. cfeatures -->
<form method="get" action="{url page=null}">

    {*  price slider  *}
    {if $minCost<$maxCost}
        <script>
            minCost={$minCost};
            maxCost={$maxCost};
            minCurr={if isset($minCurr)}{$minCurr}{else}0{/if};
            maxCurr={$maxCurr};
            // priceslider
            {literal}
                $(document).ready(function(){
                    if(minCurr>=0 && maxCurr>0){
                        $("#cslider").slider({min:minCost,max:maxCost,values:[minCurr,maxCurr],range:true,stop:function(event,ui){
                                var mncurr = $("#cslider").slider("values",0);
                                var mxcurr = $("#cslider").slider("values",1);
                                $("input#minCurr").val(mncurr);$("input#maxCurr").val(mxcurr);
                            },slide:function(event,ui){$("input#minCurr").val(ui.values[0]);$("input#maxCurr").val(ui.values[1]);}});$("input#minCurr").change(function(){var value1=$("input#minCurr").val();var value2=$("input#maxCurr").val();if(parseInt(value1)>parseInt(value2)){value1=value2;$("input#minCurr").val(value1);}$("#cslider").slider("values",0,value1);});$("input#maxCurr").change(function(){var value1=$("input#minCurr").val();var value2=$("input#maxCurr").val();if(value2>maxCost){value2=maxCost;$("input#maxCurr").val(maxCost)}if(parseInt(value1)>parseInt(value2)){value2=value1;$("input#maxCurr").val(value2);}$("#cslider").slider("values",1,value2);});$('input.curr').keypress(function(event){var key,keyChar;if(!event)var event=window.event;if(event.keyCode)key=event.keyCode;else if(event.which)key=event.which;if(key==null||key==0||key==8||key==13||key==9||key==46||key==37||key==39)return true;keyChar=String.fromCharCode(key);if(!/\d/.test(keyChar))return false;});
                    }
                });
            {/literal}
            // priceslider end
        </script>
        <div class="filter-column price">
            <div class="column-head">
                <span>Цена</span>
                <svg><use xlink:href="#arrow-rounded-right-7x11"></use></svg>
            </div>
            <div class="column-body">
                <div class="column-body-title">Цена</div>
                <div class="mpriceslider" style="width: 390px; height: 174px;">
                    <div class="formCost">
                        <label>
                            <input type="text" name="minCurr" id="minCurr" value="{$minCurr}"/>
                            {$currency->sign|escape}
                        </label>
                        <label>
                            <input type="text" name="maxCurr" id="maxCurr" value="{$maxCurr}"/>
                            {$currency->sign|escape}
                        </label>
                    </div>
                    <div class="sliderCont">
                        <div id="cslider"></div>
                    </div>
                    <div class="column-action">
                        <input type="submit" value="Ok" class="buttonblue">
                    </div>
                </div>
            </div>
        </div>
    {else}
        <a href="{strtok($smarty.server.REQUEST_URI,'?')}" class="clear_filter">Сбросить фильтр</a>
    {/if}
    {*  price slider end  *}

    {if !empty($features_variants1)}
        <div class="filter-column">
            <div class="column-head">
                <span>Размер</span>
                <svg><use xlink:href="#arrow-rounded-right-7x11"></use></svg>
            </div>
            <div class="column-body">
                <div class="column-body-title">Размер</div>
                <div class="feature_values">
                    <ul>
                        {foreach $features_variants1 as $o}
                            {$is_checked = !empty($smarty.get.v1) && $o|in_array:$smarty.get.v1}
                            <li>
                                <label{if $is_checked} class="checked-active"{/if}>
                                    <input type="checkbox"
                                           name="v1[]"
                                           value="{$o}"
                                            {if $is_checked} checked{/if} />
                                    <span class="chbox-value">{$o|escape}</span>
                                </label>
                            </li>
                        {/foreach}
                    </ul>
                </div>
                <div class="column-action">
                    <input type="submit" value="Ok" class="buttonblue">
                </div>
            </div>
        </div>
    {/if}

    {if !empty($features_variants2)}
        <div class="filter-column">
            <div class="column-head">
                <span>Вес</span>
                <svg><use xlink:href="#arrow-rounded-right-7x11"></use></svg>
            </div>
            <div class="column-body">
                <div class="column-body-title">Вес, г</div>
                <div class="feature_values">
                    <ul>
                        {foreach $features_variants2 as $o}
                            {$is_checked = !empty($smarty.get.v2) && $o|in_array:$smarty.get.v2}
                            <li>
                                <label{if $is_checked} class="checked-active"{/if}>
                                    <input type="checkbox"
                                           name="v2[]"
                                           value="{$o}"
                                            {if $is_checked} checked{/if}/>
                                    <span class="chbox-value">{$o|escape}</span>
                                </label>
                            </li>
                        {/foreach}
                    </ul>
                </div>
                <div class="column-action">
                    <input type="submit" value="Ok" class="buttonblue">
                </div>
            </div>
        </div>

    {/if}

    {* Features *}
    {if !empty($features)}
        {foreach $features as $f}
            <div class="filter-column">
                <div class="column-head">
                    <span>{$f->name}</span>
                    <svg><use xlink:href="#arrow-rounded-right-7x11"></use></svg>
                </div>
                <div class="column-body">
                    <div class="column-body-title">{$f->name}</div>
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
                                    {$is_checked = !empty($filter_features.{$f->id}) && in_array($o->value,$filter_features.{$f->id})}
                                    <li>
                                        <label{if $is_checked} class="checked-active"{/if}>
                                            <input type="checkbox"
                                                   name="{$f->id}[]"
                                                   value="{$o->value|escape}"
                                                    {if $is_checked} checked{/if}/>
                                            <span class="chbox-value">{$o->value|escape}</span>
                                        </label>
                                    </li>
                                {/foreach}
                            </ul>
                        {/if}
                    </div>
                    <div class="column-action">
                        <input type="submit" value="Ok" class="buttonblue">
                    </div>
                </div>
            </div>
        {/foreach}
    {/if}
    {* Features end *}

    <script>
        $(window).load(function () {
            $(document).on('click', '.column-head', function () {
                $('.filter-column').removeClass('show-body');
                $(this).closest('.filter-column').toggleClass('show-body');
            });

            $(document).on('click', function (e) {
                if (!$(e.target).closest('.show-body').length) {
                    $('.filter-column').removeClass('show-body');
                }
            });

            // Отключаю стандартное событие плагина
            $(document).off("click", '#cfeatures input[type="checkbox"]');
            $(document).on("change", '#cfeatures input[type="checkbox"]', function () {
                $(this).parent().toggleClass('checked-active');
            });

            $(document).off("change", '#cfeatures input[type="text"]');
        });
    </script>

</form>

<script>
    // expand used feature column
    $("#cfeatures input:checked, #cfeatures select#choosenf").closest('#content .feature_column').addClass('active');

    $('#content .feature_column').each(function () {
        const inputs = $('input:checked', this);
        let selected = '';
        inputs.each(function (index) {
            selected += $(this).val();
            if (inputs.length !== ++index) {
                selected += ', ';
            }
        });
        $('.feature_selected', this).html(selected)
    });
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
