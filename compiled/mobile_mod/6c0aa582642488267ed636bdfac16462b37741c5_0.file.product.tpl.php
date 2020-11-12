<?php
/* Smarty version 3.1.33, created on 2020-11-12 16:07:26
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/product.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fad5dbef15a00_55446404',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6c0aa582642488267ed636bdfac16462b37741c5' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/product.tpl',
      1 => 1605195789,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:wishcomp.tpl' => 2,
  ),
),false)) {
function content_5fad5dbef15a00_55446404 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/Applications/MAMP/htdocs/zolotomania/Smarty/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
$_smarty_tpl->_assignInScope('canonical', "/products/".((string)$_smarty_tpl->tpl_vars['product']->value->url) ,false ,8);?>
<div class="product"> <div style="position:relative;"> <div id="swipeimg" class="slider">
			<?php if (!empty($_smarty_tpl->tpl_vars['product']->value->images)) {?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value->images, 'image', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['image']->value) {
?>
					<div imcolor="<?php echo $_smarty_tpl->tpl_vars['image']->value->color;?>
" <?php if ($_smarty_tpl->tpl_vars['image']->value->color) {?>class="blockwrapp"<?php } else { ?>class="showanyway" style="visibility:visible;"<?php }?>> <div class="imgwrapper"> <img alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" class="blockimage" src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'resize' ][ 0 ], array( $_smarty_tpl->tpl_vars['image']->value->filename,800,600,'w' ));?>
" /> </div> </div>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php } else { ?>
				<div class="showanyway" style="visibility:visible;"> <div class="imgwrapper"> <svg class="nophoto"><use xlink:href='#no_photo' /></svg> </div> </div>
			<?php }?>
		</div>
		<?php if (!empty($_smarty_tpl->tpl_vars['product']->value->images) && count($_smarty_tpl->tpl_vars['product']->value->images) > 1) {?>
		<div class="directionNav"> <span onClick="Swipeslider.Prev();" class="prev"></span><span onClick="Swipeslider.Next();" class="next"></span> </div>
		<?php }?>
	</div>

		<div class="description">
		<?php $_smarty_tpl->_assignInScope('count_stock', 0);?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value->variants, 'pv');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pv']->value) {
?>
			<?php $_smarty_tpl->_assignInScope('count_stock', $_smarty_tpl->tpl_vars['count_stock']->value+$_smarty_tpl->tpl_vars['pv']->value->stock);?>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php if ($_smarty_tpl->tpl_vars['count_stock']->value > 0) {?>
			<?php $_smarty_tpl->_assignInScope('notinstock', 0);?>
		<?php } else { ?>
			<?php $_smarty_tpl->_assignInScope('notinstock', 1);?>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['notinstock']->value == 0) {?>
						<form class="variants" action="/cart"> <div class="bm_good"> <h1><?php if (!empty($_smarty_tpl->tpl_vars['product']->value->name)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->name, ENT_QUOTES, 'UTF-8', true);
}?></h1>
					<?php if ($_smarty_tpl->tpl_vars['product']->value->vproperties) {?>
						<?php $_smarty_tpl->_assignInScope('cntname1', 0);?>	
						<span class="pricelist" style="display:none;">
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value->variants, 'v');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
?>
								<?php $_smarty_tpl->_assignInScope('ballov', round(smarty_modifier_replace(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( ($_smarty_tpl->tpl_vars['v']->value->price*$_smarty_tpl->tpl_vars['settings']->value->bonus_order/100) )),' ','')));?>
								<span class="c<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
" v_stock="<?php if ($_smarty_tpl->tpl_vars['v']->value->stock < $_smarty_tpl->tpl_vars['settings']->value->max_order_amount) {
echo $_smarty_tpl->tpl_vars['v']->value->stock;
} else { ?>много<?php }?>" v_unit="<?php if ($_smarty_tpl->tpl_vars['v']->value->unit) {
echo $_smarty_tpl->tpl_vars['v']->value->unit;
} else {
echo $_smarty_tpl->tpl_vars['settings']->value->units;
}?>" v_sku="<?php if ($_smarty_tpl->tpl_vars['v']->value->sku) {?>Артикул <?php echo $_smarty_tpl->tpl_vars['v']->value->sku;
}?>" v_bonus="<?php echo $_smarty_tpl->tpl_vars['ballov']->value;?>
 <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'plural' ][ 0 ], array( $_smarty_tpl->tpl_vars['ballov']->value,'балл','баллов','балла' ));?>
"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['v']->value->price ));?>
</span>
								<?php if ($_smarty_tpl->tpl_vars['v']->value->name1) {
$_smarty_tpl->_assignInScope('cntname1', 1);
}?>
							<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						</span>
	
						<?php $_smarty_tpl->_assignInScope('cntname2', 0);?>
						<span class="pricelist2" style="display:none;">
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value->variants, 'v');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
?>
								<?php if ($_smarty_tpl->tpl_vars['v']->value->compare_price > 0) {?><span class="c<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['v']->value->compare_price ));?>
</span><?php }?>
								<?php if ($_smarty_tpl->tpl_vars['v']->value->name2) {
$_smarty_tpl->_assignInScope('cntname2', 1);
}?>
							<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						</span> <input id="vhidden" class="1clk" name="variant" value="" type="hidden" /> <div class="variantsblock" style="display:none;"> <select name="variant1" class="p0"<?php if ($_smarty_tpl->tpl_vars['cntname1']->value == 0) {?> style="display:none;"<?php }?>>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value->vproperties[0], 'pclass', false, 'pname');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pname']->value => $_smarty_tpl->tpl_vars['pclass']->value) {
?>
									<?php $_smarty_tpl->_assignInScope('size', explode("c",$_smarty_tpl->tpl_vars['pclass']->value));?>
									<option v_size="<?php echo $_smarty_tpl->tpl_vars['pname']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['pclass']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['pclass']->value;?>
" 
										<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['size']->value, 'sz');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sz']->value) {
if ($_smarty_tpl->tpl_vars['product']->value->variant->id == intval($_smarty_tpl->tpl_vars['sz']->value)) {?>selected<?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
									><?php echo $_smarty_tpl->tpl_vars['pname']->value;?>
</option>
								<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							</select> <select name="variant2" id="bigimagep1" class="p1"<?php if ($_smarty_tpl->tpl_vars['cntname2']->value == 0) {?> style="display:none;"<?php }?>>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value->vproperties[1], 'pclass', false, 'pname');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pname']->value => $_smarty_tpl->tpl_vars['pclass']->value) {
?>
									<?php $_smarty_tpl->_assignInScope('color', explode("c",$_smarty_tpl->tpl_vars['pclass']->value));?>
									<span><option v_color="<?php echo $_smarty_tpl->tpl_vars['pname']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['pclass']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['pclass']->value;?>
" 
										<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['color']->value, 'cl');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cl']->value) {
if ($_smarty_tpl->tpl_vars['product']->value->variant->id == intval($_smarty_tpl->tpl_vars['cl']->value)) {?>selected<?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
									><?php echo $_smarty_tpl->tpl_vars['pname']->value;?>
</option></span>
								<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							</select> </div> <div class="skustock"> <div class="skustockleft">
								
								<?php if ($_smarty_tpl->tpl_vars['settings']->value->showsku == 1) {?><p class="sku"><?php if ($_smarty_tpl->tpl_vars['product']->value->variant->sku) {?>Артикул <?php echo $_smarty_tpl->tpl_vars['product']->value->variant->sku;
}?></p><?php }?>
							</div> </div> <div class="amount-price"> <div class="price-block <?php if (!$_smarty_tpl->tpl_vars['product']->value->variant->compare_price > 0) {?>pricebig<?php }?>">
								<?php if ($_smarty_tpl->tpl_vars['product']->value->variant->compare_price > 0) {?>
									<div ID="priceold" class="compare_price"></div>
								<?php }?>
								<span ID="price" class="price"></span> <span class="currency"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->sign, ENT_QUOTES, 'UTF-8', true);?>
</span> </div> </div>
					<?php } else { ?>
										
						<div class="price"> <div class="price-block <?php if (!$_smarty_tpl->tpl_vars['product']->value->variant->compare_price > 0) {?>pricebig<?php }?>">
						
								<?php if ($_smarty_tpl->tpl_vars['product']->value->variant->compare_price > 0) {?>
									<div class="compare_price"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value->variant->compare_price ));?>
</div>
								<?php }?>
								<span class="price"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value->variant->price ));?>
</span> <span class="currency"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->sign, ENT_QUOTES, 'UTF-8', true);?>
</span> </div> </div>
					<?php }?>

					<?php if ($_smarty_tpl->tpl_vars['product']->value->body) {?>
						<div class="page-pg"><?php echo $_smarty_tpl->tpl_vars['product']->value->body;?>
</div>
					<?php }?>
					<div class="buttonsblock"> <input type="submit" class="buttonred" value="беру" data-result-text="добавлено" />
						<?php $_smarty_tpl->_subTemplateRender('file:wishcomp.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
					</div> </div> </form>
									<?php if (isset($_smarty_tpl->tpl_vars['product']->value->rating) && $_smarty_tpl->tpl_vars['product']->value->rating > 0) {?>
				<?php $_smarty_tpl->_assignInScope('rating', $_smarty_tpl->tpl_vars['product']->value->rating);?>
			<?php } else { ?>
				<?php $_smarty_tpl->_assignInScope('rating', floatval($_smarty_tpl->tpl_vars['settings']->value->prods_rating));?>
			<?php }?>	
			<?php $_smarty_tpl->_assignInScope('votes', intval($_smarty_tpl->tpl_vars['settings']->value->prods_votes)+$_smarty_tpl->tpl_vars['product']->value->votes);?>
			<?php $_smarty_tpl->_assignInScope('views', intval($_smarty_tpl->tpl_vars['settings']->value->prods_views)+$_smarty_tpl->tpl_vars['product']->value->views);?>
			
	
		<?php } else { ?>
			<?php if ($_smarty_tpl->tpl_vars['settings']->value->showsku == 1 && !empty($_smarty_tpl->tpl_vars['product']->value->variant->sku)) {?>
				<p class="page-pg sku">Артикул <?php echo $_smarty_tpl->tpl_vars['product']->value->variant->sku;?>
</p>
			<?php }?>
			<p class="page-pg not_in_stock_label">Нет в наличии</p> <div class="separator" style="margin-bottom:10px;">
				<?php $_smarty_tpl->_subTemplateRender('file:wishcomp.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
			</div> <input name="variant" v_name="" v_price="" style="display:none;"/>
		<?php }?>
	
	</div> </div><?php }
}
