<?php
/* Smarty version 3.1.33, created on 2020-11-12 15:56:39
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/cfeatures.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fad5b37023903_91248546',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '95b0d3a046432e9fb27add30e377ad02a3f6ba5a' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/cfeatures.tpl',
      1 => 1605195392,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fad5b37023903_91248546 (Smarty_Internal_Template $_smarty_tpl) {
?>		<form method="get" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>null),$_smarty_tpl ) );?>
" id="cfeatures" class="features">
					<?php if (!empty($_smarty_tpl->tpl_vars['features_variants']->value)) {?>
						<div class="feature_column"> <div class="feature_values"> <ul>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['features_variants']->value, 'o');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['o']->value) {
?>
                            <li> <label for="feature1 "> <input type="checkbox" name="v[]" value="<?php echo $_smarty_tpl->tpl_vars['o']->value;?>
"<?php if (!empty($_GET['v']) && in_array($_smarty_tpl->tpl_vars['o']->value,$_GET['v'])) {?> checked<?php }?> /> <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['o']->value, ENT_QUOTES, 'UTF-8', true);?>
</span> </label> </li>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </ul> </div> </div>
					<?php }?>
					<?php if (!empty($_smarty_tpl->tpl_vars['features_variants1']->value)) {?>
						<div class="feature_column feature_column-size"> <div class="feature_name" onclick="hideShow1(this);return false;">Размер</div> <div class="feature_values feature_values-size"> <ul>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['features_variants1']->value, 'o');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['o']->value) {
?>
                            <li> <label <?php if (!empty($_GET['v1']) && in_array($_smarty_tpl->tpl_vars['o']->value,$_GET['v1'])) {?> class="checked-active"<?php }?>> <input type="checkbox" name="v1[]" value="<?php echo $_smarty_tpl->tpl_vars['o']->value;?>
"<?php if (!empty($_GET['v1']) && in_array($_smarty_tpl->tpl_vars['o']->value,$_GET['v1'])) {?> checked<?php }?> /><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['o']->value, ENT_QUOTES, 'UTF-8', true);?>

                                </label> </li>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </ul> </div> </div>
					<?php }?>
						
					<?php if (!empty($_smarty_tpl->tpl_vars['features_variants2']->value)) {?>
						<div class="feature_column"> <div class="feature_values"> <ul>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['features_variants2']->value, 'o');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['o']->value) {
?>
                            <li> <input type="checkbox" id="feature3" name="v2[]" value="<?php echo $_smarty_tpl->tpl_vars['o']->value;?>
"<?php if (!empty($_GET['v2']) && in_array($_smarty_tpl->tpl_vars['o']->value,$_GET['v2'])) {?> checked<?php }?> /> <label for="feature3"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['o']->value, ENT_QUOTES, 'UTF-8', true);?>
</label> </li>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </ul> </div> </div>
					<?php }?>
				
				
				
								<?php if (!empty($_smarty_tpl->tpl_vars['features']->value)) {?>
			    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['features']->value, 'f');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['f']->value) {
?>
						<div class="feature_column"> <div class="feature_name" data-feature="<?php echo $_smarty_tpl->tpl_vars['f']->value->id;?>
" onclick="hideShow1(this);return false;"><?php echo $_smarty_tpl->tpl_vars['f']->value->name;?>
</div> <div class="feature_values">
									<?php if ($_smarty_tpl->tpl_vars['f']->value->in_filter == 2) {?>
										<?php $_smarty_tpl->_assignInScope('f_min', "min[".((string)$_smarty_tpl->tpl_vars['f']->value->id)."]");?>
										<?php $_smarty_tpl->_assignInScope('f_max', "max[".((string)$_smarty_tpl->tpl_vars['f']->value->id)."]");?> 
										<select <?php if (!empty($_GET['min'][$_smarty_tpl->tpl_vars['f']->value->id]) || !empty($_GET['max'][$_smarty_tpl->tpl_vars['f']->value->id])) {?>id="choosenf"<?php }?> onchange="clickerdiapmin(this);"> <option value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('params'=>array($_smarty_tpl->tpl_vars['f_min']->value=>null)),$_smarty_tpl ) );?>
"></option>
											<?php $_smarty_tpl->_assignInScope('i', 0);?>
											<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['f']->value->options, 'o');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['o']->value) {
?>
												<?php $_smarty_tpl->_assignInScope('i', $_smarty_tpl->tpl_vars['i']->value+1);
if ($_smarty_tpl->tpl_vars['i']->value == 1) {
$_smarty_tpl->_assignInScope('omin', $_smarty_tpl->tpl_vars['o']->value->value);
}?>
												<option value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('params'=>array($_smarty_tpl->tpl_vars['f_min']->value=>$_smarty_tpl->tpl_vars['o']->value->value)),$_smarty_tpl ) );?>
" <?php if (!empty($_GET['min'][$_smarty_tpl->tpl_vars['f']->value->id]) && $_GET['min'][$_smarty_tpl->tpl_vars['f']->value->id] == $_smarty_tpl->tpl_vars['o']->value->value) {?>selected<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['o']->value->value, ENT_QUOTES, 'UTF-8', true);?>
</option>
											<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
										</select>
										- 
										<select onchange="clickerdiapmax(this)"> <option value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('params'=>array($_smarty_tpl->tpl_vars['f_max']->value=>null)),$_smarty_tpl ) );?>
"></option>
										<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['f']->value->options, 'o');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['o']->value) {
?>
										<option value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('params'=>array($_smarty_tpl->tpl_vars['f_max']->value=>$_smarty_tpl->tpl_vars['o']->value->value)),$_smarty_tpl ) );?>
" <?php if (!empty($_GET['max'][$_smarty_tpl->tpl_vars['f']->value->id]) && $_GET['max'][$_smarty_tpl->tpl_vars['f']->value->id] == $_smarty_tpl->tpl_vars['o']->value->value) {?>selected<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['o']->value->value, ENT_QUOTES, 'UTF-8', true);?>
</option>
										<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
										</select> <input class="diapmin" id="min<?php echo $_smarty_tpl->tpl_vars['f']->value->id;?>
" type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['f_min']->value;?>
" checked="checked" value="<?php if (!empty($_GET['min'][$_smarty_tpl->tpl_vars['f']->value->id])) {
echo $_GET['min'][$_smarty_tpl->tpl_vars['f']->value->id];
}?>" <?php if (empty($_GET['min'][$_smarty_tpl->tpl_vars['f']->value->id])) {?>disabled<?php }?>/> <input class="diapmax" id="max<?php echo $_smarty_tpl->tpl_vars['f']->value->id;?>
" type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['f_max']->value;?>
" checked="checked" value="<?php if (!empty($_GET['max'][$_smarty_tpl->tpl_vars['f']->value->id])) {
echo $_GET['max'][$_smarty_tpl->tpl_vars['f']->value->id];
}?>" <?php if (empty($_GET['max'][$_smarty_tpl->tpl_vars['f']->value->id])) {?>disabled<?php }?>/>
					
									<?php } else { ?>
										<ul>
											<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['f']->value->options, 'o', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['o']->value) {
?>
											<li> <label <?php if (!empty($_smarty_tpl->tpl_vars['filter_features']->value[$_smarty_tpl->tpl_vars['f']->value->id]) && in_array($_smarty_tpl->tpl_vars['o']->value->value,$_smarty_tpl->tpl_vars['filter_features']->value[$_smarty_tpl->tpl_vars['f']->value->id])) {?> class="checked-active"<?php }?>> <input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['f']->value->id;?>
[]"
																		<?php if (!empty($_smarty_tpl->tpl_vars['filter_features']->value[$_smarty_tpl->tpl_vars['f']->value->id]) && in_array($_smarty_tpl->tpl_vars['o']->value->value,$_smarty_tpl->tpl_vars['filter_features']->value[$_smarty_tpl->tpl_vars['f']->value->id])) {?>checked="checked"<?php }?> value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['o']->value->value, ENT_QUOTES, 'UTF-8', true);?>
"/>
														<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['o']->value->value, ENT_QUOTES, 'UTF-8', true);?>

												</label> </li>
											<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
										</ul>
									<?php }?>
								</div> </div> </div>
			    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				<?php }?>
				<?php if (!empty($_smarty_tpl->tpl_vars['category']->value->brands) && count($_smarty_tpl->tpl_vars['category']->value->brands) > 1 && empty($_smarty_tpl->tpl_vars['brand']->value)) {?>
					<div class="feature_column"> <div class="feat-block"> <div class="hidetitle" href="javascript://" onclick="hideShow1(this);return false;"> <svg viewBox="0 0 20 20" > <path d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"/> <path d="M0-.25h24v24H0z" fill="none"/> </svg> <a class="hidetitle1" href="javascript://" onclick="hideShow1(this);return false;">Бренд</a> </div> <div class="feature_values"> <ul>
		                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['category']->value->brands, 'b', false, NULL, 'brands', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['b']->value) {
?>
		                    <li> <label> <div class="chbox"> <input type="checkbox" name="b[]" value="<?php echo $_smarty_tpl->tpl_vars['b']->value->id;?>
" <?php if (!empty($_GET['b']) && in_array($_smarty_tpl->tpl_vars['b']->value->id,$_GET['b'])) {?> checked<?php }?> /> </div> <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['b']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</span> </label> </li>
		                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		                </ul> </div> </div> </div>
				<?php }?>

								<?php if ($_smarty_tpl->tpl_vars['minCost']->value < $_smarty_tpl->tpl_vars['maxCost']->value) {?>
					<div class="price-slider" style="display:none"> <div class="mpriceslider"> <div class="formCost"> <span class="pr-cost">Цена: </span><span class="frommincurr" for="minCurr">от</span> <input class="curr" type="number" name="minCurr" id="minCurr" value="<?php echo $_smarty_tpl->tpl_vars['minCurr']->value;?>
"/> <span class="tomaxcurr" for="maxCurr">до</span> <input class="curr" type="number" name="maxCurr" id="maxCurr" value="<?php echo $_smarty_tpl->tpl_vars['maxCurr']->value;?>
"/> </div> <div class="separator sliderpadd"> <div id="line"> <div id="rele"></div> <div id="reletwo"></div> </div> </div> </div> </div> <?php echo '<script'; ?>
 type="text/javascript">
						var currentPos=<?php if (isset($_smarty_tpl->tpl_vars['minCurr']->value)) {
echo $_smarty_tpl->tpl_vars['minCurr']->value;
} else { ?>0<?php }?>;
						var minCount=<?php echo $_smarty_tpl->tpl_vars['minCost']->value;?>
;
						var currentPostwo=<?php echo $_smarty_tpl->tpl_vars['maxCurr']->value;?>
;
						var maxCount=<?php echo $_smarty_tpl->tpl_vars['maxCost']->value;?>
;
						var Count=<?php echo $_smarty_tpl->tpl_vars['maxCost']->value-$_smarty_tpl->tpl_vars['minCost']->value;?>
;
					<?php echo '</script'; ?>
>	
				<?php }?>
				
			
				<?php if (!empty($_smarty_tpl->tpl_vars['keyword']->value)) {?><div style="display:none;"><input type="checkbox" name="keyword" value="<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
" checked="checked"/></div><?php }?>
				
			
			<?php echo '<script'; ?>
>
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
							<?php echo '</script'; ?>
> </form> <?php echo '<script'; ?>
>
    // expand used feature column
    $("#cfeatures input:checked, #cfeatures select#choosenf").closest('#cfeatures .feature_column').find('.feature_name').addClass('checked');
    $("#cfeatures input:checked, #cfeatures select#choosenf").closest('#content .feature_values').fadeIn('normal');
    // expand used feature column end
	<?php echo '</script'; ?>
>
	<?php }
}
