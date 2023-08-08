{* Features *}
<script src="/androidcore/priceslider.js"></script>

<form method="get" action="{url page=null}" id="cfeatures" class="features">

    {* price slider *}
    {if $minCost < $maxCost}
        <div class="filter-column price">
            <div class="column-head"><span>Цена</span></div>
            <div class="column-body">
                <div class="column-body-title">Цена</div>
                <div class="mpriceslider">
                    <div class="formCost">
                        <label>
                            <input type="number" name="minCurr" id="minCurr" value="{$minCurr}"/>
                            {$currency->sign|escape}
                        </label>
                        <label>
                            <input type="number" name="maxCurr" id="maxCurr" value="{$maxCurr}"/>
                            {$currency->sign|escape}
                        </label>
                    </div>
                    <div class="separator sliderpad">
                        <div id="line">
                            <div id="range"></div>
                            <div id="rele"></div>
                            <div id="reletwo"></div>
                        </div>
                    </div>
                    <div class="column-action">
                        <input type="submit" value="Ok" class="buttonblue">
                    </div>
                </div>
            </div>
        </div>
    {/if}
    {* price slider end *}

    {if !empty($features_variants1)}
        <div class="filter-column">
            <div class="column-head">
                <span>Размер</span>
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
                <span>Цвет</span>
            </div>
            <div class="column-body">
                <div class="column-body-title">Цвет</div>
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

</form>
<script>
    $(window).load(function () {
        $(document).on('click', '.column-head', function () {
            $('.filter-column').removeClass('show-body');
            $(this).closest('.filter-column').toggleClass('show-body');
            price_slider(
                    {if isset($minCurr)}{$minCurr}{else}0{/if},
                    {$minCost},
                    {$maxCurr},
                    {$maxCost},
                    {$maxCost - $minCost}
            );
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
{* Features end *}

