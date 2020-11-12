<?php
/* Smarty version 3.1.33, created on 2020-11-12 15:35:48
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/products.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fad5654d2c728_05246138',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ee49c9ce858f2ab7f11f4b179e5aff123a30c70b' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/products.tpl',
      1 => 1605193780,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:wishcomp.tpl' => 2,
  ),
),false)) {
function content_5fad5654d2c728_05246138 (Smarty_Internal_Template $_smarty_tpl) {
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {?>
    <?php $_smarty_tpl->_assignInScope('wrapper', '' ,false ,8);?>
	<input class="refresh_title" type="hidden" value="
		<?php if (!empty($_smarty_tpl->tpl_vars['metadata_page']->value)) {?>
			<?php if ($_smarty_tpl->tpl_vars['metadata_page']->value->meta_title) {?>
				<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['metadata_page']->value->meta_title, ENT_QUOTES, 'UTF-8', true);
if ($_smarty_tpl->tpl_vars['current_page_num']->value > 1) {?> - страница <?php echo $_smarty_tpl->tpl_vars['current_page_num']->value;
}?>
			<?php } else { ?>
				<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true);
if ($_smarty_tpl->tpl_vars['current_page_num']->value > 1) {?> - страница <?php echo $_smarty_tpl->tpl_vars['current_page_num']->value;
}?>
			<?php }?>
		<?php } else { ?>
			<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true);
if ($_smarty_tpl->tpl_vars['current_page_num']->value > 1) {?> - страница <?php echo $_smarty_tpl->tpl_vars['current_page_num']->value;
}?>
		<?php }?>
	" />
<?php }?>

<?php if (!empty($_smarty_tpl->tpl_vars['metadata_page']->value)) {?>
	<?php $_smarty_tpl->_assignInScope('canonical', ((string)$_SERVER['REQUEST_URI']) ,false ,8);
} elseif (!empty($_smarty_tpl->tpl_vars['filter_features']->value) && $_smarty_tpl->tpl_vars['settings']->value->filtercan == 1) {?>
	<?php $_smarty_tpl->_assignInScope('canonical', ((string)$_SERVER['REQUEST_URI']) ,false ,8);
} elseif (!empty($_smarty_tpl->tpl_vars['filter_features']->value) && $_smarty_tpl->tpl_vars['settings']->value->filtercan == 0) {?>
	<?php $_smarty_tpl->_assignInScope('canonical', "/catalog/".((string)$_smarty_tpl->tpl_vars['category']->value->url) ,false ,8);
} elseif (!empty($_smarty_tpl->tpl_vars['category']->value) && !empty($_smarty_tpl->tpl_vars['brand']->value)) {?>
	<?php $_smarty_tpl->_assignInScope('canonical', "/catalog/".((string)$_smarty_tpl->tpl_vars['category']->value->url)."/".((string)$_smarty_tpl->tpl_vars['brand']->value->url) ,false ,8);
} elseif (!empty($_smarty_tpl->tpl_vars['category']->value)) {?>
	<?php $_smarty_tpl->_assignInScope('canonical', "/catalog/".((string)$_smarty_tpl->tpl_vars['category']->value->url) ,false ,8);
} elseif (!empty($_smarty_tpl->tpl_vars['brand']->value)) {?>
	<?php $_smarty_tpl->_assignInScope('canonical', "/brands/".((string)$_smarty_tpl->tpl_vars['brand']->value->url) ,false ,8);
} elseif (!empty($_smarty_tpl->tpl_vars['keyword']->value)) {?>
	<?php ob_start();
echo htmlspecialchars($_smarty_tpl->tpl_vars['keyword']->value, ENT_QUOTES, 'UTF-8', true);
$_prefixVariable1=ob_get_clean();
$_smarty_tpl->_assignInScope('canonical', "/products?keyword=".$_prefixVariable1 ,false ,8);
} else { ?>
	<?php $_smarty_tpl->_assignInScope('canonical', "/products" ,false ,8);
}?>

<?php if ($_smarty_tpl->tpl_vars['settings']->value->filtercan == 1 && (!empty($_smarty_tpl->tpl_vars['filter_features']->value) || !empty($_GET['b']))) {?>
	<?php if (!empty($_smarty_tpl->tpl_vars['meta_title']->value)) {
$_smarty_tpl->_assignInScope('mt', htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true));
}?>
	
	<?php if (!empty($_smarty_tpl->tpl_vars['category']->value->name) && !empty($_smarty_tpl->tpl_vars['brand']->value->name)) {?>
    	<?php $_smarty_tpl->_assignInScope('ht', htmlspecialchars(((htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true)).(' | ')).($_smarty_tpl->tpl_vars['brand']->value->name), ENT_QUOTES, 'UTF-8', true));?>
    <?php } elseif (!empty($_smarty_tpl->tpl_vars['brand']->value->name)) {?>
		<?php $_smarty_tpl->_assignInScope('ht', htmlspecialchars($_smarty_tpl->tpl_vars['brand']->value->name, ENT_QUOTES, 'UTF-8', true));?>
	<?php } elseif (!empty($_smarty_tpl->tpl_vars['category']->value->name)) {?>
		<?php $_smarty_tpl->_assignInScope('ht', htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true));?>
	<?php }?>
	
	<?php $_smarty_tpl->_assignInScope('seo_description', ((($_smarty_tpl->tpl_vars['meta_title']->value).($_smarty_tpl->tpl_vars['settings']->value->seo_description)).(" ★ ")).($_smarty_tpl->tpl_vars['settings']->value->site_name));?>
	<?php if (!empty($_smarty_tpl->tpl_vars['meta_description']->value)) {
$_smarty_tpl->_assignInScope('md', htmlspecialchars($_smarty_tpl->tpl_vars['meta_description']->value, ENT_QUOTES, 'UTF-8', true));
} elseif (!empty($_smarty_tpl->tpl_vars['seo_description']->value)) {
$_smarty_tpl->_assignInScope('md', htmlspecialchars($_smarty_tpl->tpl_vars['seo_description']->value, ENT_QUOTES, 'UTF-8', true));
}?>
	
	<?php if (!empty($_GET['b']) && !empty($_smarty_tpl->tpl_vars['category']->value->brands)) {?>
    	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['category']->value->brands, 'b', false, NULL, 'brands', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['b']->value) {
?>
			<?php if (in_array($_smarty_tpl->tpl_vars['b']->value->id,$_GET['b'])) {?>
				<?php $_smarty_tpl->_assignInScope('mt', htmlspecialchars((($_smarty_tpl->tpl_vars['mt']->value).(' | ')).($_smarty_tpl->tpl_vars['b']->value->name), ENT_QUOTES, 'UTF-8', true));?>
				<?php $_smarty_tpl->_assignInScope('md', htmlspecialchars((($_smarty_tpl->tpl_vars['md']->value).(' ★ ')).($_smarty_tpl->tpl_vars['b']->value->name), ENT_QUOTES, 'UTF-8', true));?>
				<?php $_smarty_tpl->_assignInScope('ht', htmlspecialchars((($_smarty_tpl->tpl_vars['ht']->value).(' | ')).($_smarty_tpl->tpl_vars['b']->value->name), ENT_QUOTES, 'UTF-8', true));?>
			<?php }?>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	<?php }?>
	
	<?php if (!empty($_GET['v']) && !empty($_smarty_tpl->tpl_vars['features_variants']->value)) {?>
    	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['features_variants']->value, 'o');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['o']->value) {
?>
			<?php if (in_array($_smarty_tpl->tpl_vars['o']->value,$_GET['v'])) {?>
				<?php $_smarty_tpl->_assignInScope('mt', htmlspecialchars((($_smarty_tpl->tpl_vars['mt']->value).(' | ')).($_smarty_tpl->tpl_vars['o']->value), ENT_QUOTES, 'UTF-8', true));?>
				<?php $_smarty_tpl->_assignInScope('md', htmlspecialchars((($_smarty_tpl->tpl_vars['md']->value).(' ★ ')).($_smarty_tpl->tpl_vars['o']->value), ENT_QUOTES, 'UTF-8', true));?>
				<?php $_smarty_tpl->_assignInScope('ht', htmlspecialchars((($_smarty_tpl->tpl_vars['ht']->value).(' | ')).($_smarty_tpl->tpl_vars['o']->value), ENT_QUOTES, 'UTF-8', true));?>
			<?php }?>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	<?php }?>
	<?php if (!empty($_GET['v1']) && !empty($_smarty_tpl->tpl_vars['features_variants1']->value)) {?>
    	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['features_variants1']->value, 'o');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['o']->value) {
?>
			<?php if (in_array($_smarty_tpl->tpl_vars['o']->value,$_GET['v1'])) {?>
				<?php $_smarty_tpl->_assignInScope('mt', htmlspecialchars((($_smarty_tpl->tpl_vars['mt']->value).(' | ')).($_smarty_tpl->tpl_vars['o']->value), ENT_QUOTES, 'UTF-8', true));?>
				<?php $_smarty_tpl->_assignInScope('md', htmlspecialchars((($_smarty_tpl->tpl_vars['md']->value).(' ★ ')).($_smarty_tpl->tpl_vars['o']->value), ENT_QUOTES, 'UTF-8', true));?>
				<?php $_smarty_tpl->_assignInScope('ht', htmlspecialchars((($_smarty_tpl->tpl_vars['ht']->value).(' | ')).($_smarty_tpl->tpl_vars['o']->value), ENT_QUOTES, 'UTF-8', true));?>
			<?php }?>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	<?php }?>
	<?php if (!empty($_GET['v2']) && !empty($_smarty_tpl->tpl_vars['features_variants2']->value)) {?>
    	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['features_variants2']->value, 'o');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['o']->value) {
?>
			<?php if (in_array($_smarty_tpl->tpl_vars['o']->value,$_GET['v2'])) {?>
				<?php $_smarty_tpl->_assignInScope('mt', htmlspecialchars((($_smarty_tpl->tpl_vars['mt']->value).(' | ')).($_smarty_tpl->tpl_vars['o']->value), ENT_QUOTES, 'UTF-8', true));?>
				<?php $_smarty_tpl->_assignInScope('md', htmlspecialchars((($_smarty_tpl->tpl_vars['md']->value).(' ★ ')).($_smarty_tpl->tpl_vars['o']->value), ENT_QUOTES, 'UTF-8', true));?>
				<?php $_smarty_tpl->_assignInScope('ht', htmlspecialchars((($_smarty_tpl->tpl_vars['ht']->value).(' | ')).($_smarty_tpl->tpl_vars['o']->value), ENT_QUOTES, 'UTF-8', true));?>
			<?php }?>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	<?php }?>
    
    <?php if (!empty($_smarty_tpl->tpl_vars['filter_features']->value) && !empty($_smarty_tpl->tpl_vars['features']->value)) {?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['features']->value, 'f');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['f']->value) {
?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['f']->value->options, 'o');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['o']->value) {
?>
				<?php if (!empty($_smarty_tpl->tpl_vars['filter_features']->value[$_smarty_tpl->tpl_vars['f']->value->id]) && in_array($_smarty_tpl->tpl_vars['o']->value->value,$_smarty_tpl->tpl_vars['filter_features']->value[$_smarty_tpl->tpl_vars['f']->value->id])) {?>                        
					<?php $_smarty_tpl->_assignInScope('mt', (((($_smarty_tpl->tpl_vars['mt']->value).(' | ')).($_smarty_tpl->tpl_vars['f']->value->name)).(' - ')).($_smarty_tpl->tpl_vars['o']->value->value));?>
					<?php $_smarty_tpl->_assignInScope('md', (((($_smarty_tpl->tpl_vars['md']->value).(' ★ ')).($_smarty_tpl->tpl_vars['f']->value->name)).(' - ')).($_smarty_tpl->tpl_vars['o']->value->value));?>
					<?php $_smarty_tpl->_assignInScope('ht', (((($_smarty_tpl->tpl_vars['ht']->value).(' | ')).($_smarty_tpl->tpl_vars['f']->value->name)).(' - ')).($_smarty_tpl->tpl_vars['o']->value->value));?>
				<?php }?>       
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>
	
	<?php if (!empty($_smarty_tpl->tpl_vars['mt']->value)) {?>
    	<?php $_smarty_tpl->_assignInScope('meta_title', $_smarty_tpl->tpl_vars['mt']->value ,false ,8);?>
    <?php }?>	
    <?php if (!empty($_smarty_tpl->tpl_vars['ht']->value)) {?>
    	<?php $_smarty_tpl->_assignInScope('page_name', $_smarty_tpl->tpl_vars['ht']->value ,false ,8);?>
    <?php }?>
	<?php if (!empty($_smarty_tpl->tpl_vars['md']->value)) {?>
		<?php $_smarty_tpl->_assignInScope('meta_description', $_smarty_tpl->tpl_vars['md']->value ,false ,8);?>
	<?php }
}?>

<input class="curr_page" type="hidden" data-url="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['current_page_num']->value),$_smarty_tpl ) );?>
" value="<?php echo $_smarty_tpl->tpl_vars['current_page_num']->value;?>
" /> <input class="refresh_curr_page" type="hidden" data-url="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['current_page_num']->value),$_smarty_tpl ) );?>
" value="<?php echo $_smarty_tpl->tpl_vars['current_page_num']->value;?>
" />
<?php if ($_smarty_tpl->tpl_vars['current_page_num']->value < $_smarty_tpl->tpl_vars['total_pages_num']->value) {?><input class="refresh_next_page" type="hidden" data-url="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['current_page_num']->value+1),$_smarty_tpl ) );?>
" value="<?php echo $_smarty_tpl->tpl_vars['current_page_num']->value+1;?>
" /><?php }
if ($_smarty_tpl->tpl_vars['current_page_num']->value == 2) {?><input class="refresh_prev_page" type="hidden" data-url="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>null),$_smarty_tpl ) );?>
" value="<?php echo $_smarty_tpl->tpl_vars['current_page_num']->value-1;?>
" /><?php }
if ($_smarty_tpl->tpl_vars['current_page_num']->value > 2) {?><input class="refresh_prev_page" type="hidden" data-url="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['current_page_num']->value-1),$_smarty_tpl ) );?>
" value="<?php echo $_smarty_tpl->tpl_vars['current_page_num']->value-1;?>
" /><?php }?>
<input class="total_pages" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['total_pages_num']->value;?>
" />


<?php if (!empty($_smarty_tpl->tpl_vars['metadata_page']->value->description)) {?>		
	<div class="page-pg categoryintro" style="margin-bottom:16px;"><div class="top cutouter" style="max-height:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->cutmob, ENT_QUOTES, 'UTF-8', true);?>
px;"><div class="disappear" style="display:none;"></div><div class="cutinner"><!--desc--><?php echo $_smarty_tpl->tpl_vars['metadata_page']->value->description;?>
<!--/desc--></div></div><div class="top cutmore" style="display:none;">Развернуть...</div></div>	
<?php } elseif (!empty($_smarty_tpl->tpl_vars['page']->value->body)) {?>
	<div class="page-pg categoryintro" style="margin-bottom:16px;"><div class="top cutouter" style="max-height:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->cutmob, ENT_QUOTES, 'UTF-8', true);?>
px;"><div class="disappear" style="display:none;"></div><div class="cutinner"><!--desc--><?php echo $_smarty_tpl->tpl_vars['page']->value->body;?>
<!--/desc--></div></div><div class="top cutmore" style="display:none;">Развернуть...</div></div>
<?php } else { ?>
	<?php if ($_smarty_tpl->tpl_vars['current_page_num']->value == 1) {?>
		<div class="page-pg categoryintro" style="<?php if (!empty($_smarty_tpl->tpl_vars['brand']->value->description) || !empty($_smarty_tpl->tpl_vars['category']->value->description)) {?>margin-bottom:16px;<?php } else { ?>margin:0 15px;<?php }?>"><div class="top cutouter" style="max-height:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->cutmob, ENT_QUOTES, 'UTF-8', true);?>
px;"><div class="disappear" style="display:none;"></div><div class="cutinner"><!--desc--><?php if (!empty($_smarty_tpl->tpl_vars['brand']->value->description)) {
echo $_smarty_tpl->tpl_vars['brand']->value->description;
} elseif (!empty($_smarty_tpl->tpl_vars['category']->value->description)) {
echo $_smarty_tpl->tpl_vars['category']->value->description;
}?><!--/desc--></div></div><div class="top cutmore" style="display:none;">Развернуть...</div></div>
	<?php }
}
if (!empty($_smarty_tpl->tpl_vars['category']->value->subcategories)) {?>
	<ul class="category_products separator">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['category']->value->subcategories, 'c', false, NULL, 'cats', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
?>
		<?php if ($_smarty_tpl->tpl_vars['c']->value->visible) {?>
		<li class="product" onClick="window.location='catalog/<?php echo $_smarty_tpl->tpl_vars['c']->value->url;?>
'"> <div class="product_info"> <h3><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</h3> </div> <div class="image">
				<?php if ($_smarty_tpl->tpl_vars['c']->value->image) {?>
					<img loading="lazy" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" src="<?php echo $_smarty_tpl->tpl_vars['config']->value->categories_images_dir;
echo $_smarty_tpl->tpl_vars['c']->value->image;?>
" />
				<?php } else { ?>
					<svg class="nophoto"><use xlink:href='#folder' /></svg>
				<?php }?>
			</div> </li>
		<?php }?>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</ul>
	<?php } else { ?>
	<?php if (!empty($_smarty_tpl->tpl_vars['products']->value)) {?>
		<div class="ajax_pagination">
					
			<?php if ($_smarty_tpl->tpl_vars['current_page_num']->value >= 2) {?>
				<div class="infinite_prev" style="display:none;"> <div class="trigger_prev infinite_button">Загрузить пред. страницу</div> </div>
			<?php }?>

			<ul id="start" class="tiny_products infinite_load">

				<?php $_smarty_tpl->_assignInScope('numdashed', 0);?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
?>

				<li class="product <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value->show_cart_wishcomp)) {?>visible_button<?php }?>"> <div class="image qwbox" onclick="window.location='products/<?php echo $_smarty_tpl->tpl_vars['product']->value->url;?>
'">
						<?php if (!empty($_smarty_tpl->tpl_vars['product']->value->image)) {?>
							<img loading="lazy" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" class="lazy" src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'resize' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value->image->filename,300,300 ));?>
" />
						<?php } else { ?>
							<svg class="nophoto"><use xlink:href='#no_photo' /></svg>
						<?php }?>
					</div> <div class="product_info separator"> <h3><a href="products/<?php echo $_smarty_tpl->tpl_vars['product']->value->url;?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a></h3>

				
						<?php if (!empty($_smarty_tpl->tpl_vars['product']->value->variants) && count($_smarty_tpl->tpl_vars['product']->value->variants) > 0) {?>
							<form class="variants" action="/cart">
							<?php if ($_smarty_tpl->tpl_vars['product']->value->vproperties) {?>
								<?php $_smarty_tpl->_assignInScope('cntname1', 0);?>	
								<span class="pricelist" style="display:none;">
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value->variants, 'v');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
?>
										<span class="c<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
" v_unit="<?php if ($_smarty_tpl->tpl_vars['v']->value->unit) {
echo $_smarty_tpl->tpl_vars['v']->value->unit;
} else {
echo $_smarty_tpl->tpl_vars['settings']->value->units;
}?>"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['v']->value->price ));?>
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
								</span> <input id="vhidden" name="variant" value="" type="hidden" /> <div style="display: none; margin-bottom: 5px; height: 20px;"> <select class="p0"<?php if ($_smarty_tpl->tpl_vars['cntname1']->value == 0) {?> style="display:none;"<?php }?>>
										<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value->vproperties[0], 'pclass', false, 'pname');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pname']->value => $_smarty_tpl->tpl_vars['pclass']->value) {
?>
											<option value="<?php echo $_smarty_tpl->tpl_vars['pclass']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['pclass']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pname']->value;?>
</option>
										<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
									</select> <select class="p1"<?php if ($_smarty_tpl->tpl_vars['cntname2']->value == 0) {?> style="display:none;"<?php }?>>
												<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value->vproperties[1], 'pclass', false, 'pname');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pname']->value => $_smarty_tpl->tpl_vars['pclass']->value) {
?>
										<span><option value="<?php echo $_smarty_tpl->tpl_vars['pclass']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['pclass']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pname']->value;?>
</option></span>
												<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
									</select> </div> <div class="pricecolor">
								<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value->show_cart_wishcomp)) {?>
									<span class="amount_wrap" style="display:none;"><input type="number" min="1" size="2" name="amount" value="1">&nbsp;x&nbsp;</span>
								<?php }?>
								<span ID="priceold" class="compare_price"></span> <span ID="price" class="price"></span> <span class="currency"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->sign, ENT_QUOTES, 'UTF-8', true);
if ($_smarty_tpl->tpl_vars['settings']->value->b9manage) {?>/<span class="unit"><?php if ($_smarty_tpl->tpl_vars['product']->value->variant->unit) {
echo $_smarty_tpl->tpl_vars['product']->value->variant->unit;
} else {
echo $_smarty_tpl->tpl_vars['settings']->value->units;
}?></span><?php }?></span> </div>
				
							<?php } else { ?>
								<?php if (count($_smarty_tpl->tpl_vars['product']->value->variants) == 1 && !$_smarty_tpl->tpl_vars['product']->value->variant->name) {?>
									<span style="display: none; height: 20px;"></span>
								<?php }?>

								<select class="b1c_option" name="variant" style="display:none;"<?php if (count($_smarty_tpl->tpl_vars['product']->value->variants) == 1 && !$_smarty_tpl->tpl_vars['product']->value->variant->name) {?>style='display:none;'<?php }?>>
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value->variants, 'v');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
" v_unit="<?php if ($_smarty_tpl->tpl_vars['v']->value->unit) {
echo $_smarty_tpl->tpl_vars['v']->value->unit;
} else {
echo $_smarty_tpl->tpl_vars['settings']->value->units;
}?>" <?php if ($_smarty_tpl->tpl_vars['v']->value->compare_price > 0) {?>compare_price="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['v']->value->compare_price ));?>
"<?php }?> price="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['v']->value->price ));?>
" click="<?php echo $_smarty_tpl->tpl_vars['v']->value->name;?>
">
											<?php echo $_smarty_tpl->tpl_vars['v']->value->name;?>

										</option>
									<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
								</select> <div class="price">
									<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value->show_cart_wishcomp)) {?>
									<span class="amount_wrap" style="display:none;"> <input size="2" name="amount" min="1" type="number" value="1">&nbsp;x&nbsp;
									</span>
									<?php }?>
									<?php if ($_smarty_tpl->tpl_vars['product']->value->variant->compare_price > 0) {?>
										<span class="compare_price"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value->variant->compare_price ));?>
</span>
									<?php }?>
									<span class="price"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value->variant->price ));?>
</span> <span class="currency"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->sign, ENT_QUOTES, 'UTF-8', true);
if ($_smarty_tpl->tpl_vars['settings']->value->b9manage) {?>/<span class="unit"><?php if ($_smarty_tpl->tpl_vars['product']->value->variant->unit) {
echo $_smarty_tpl->tpl_vars['product']->value->variant->unit;
} else {
echo $_smarty_tpl->tpl_vars['settings']->value->units;
}?></span><?php }?></span> </div>
							<?php }?>
								<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value->show_cart_wishcomp)) {?>
									<div class="sub_wishcomp_wrap" style="display:none;"> <input type="submit" class="buttonred" value="в корзину" data-result-text="добавлено"/>
										<?php $_smarty_tpl->_subTemplateRender('file:wishcomp.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
									</div>
								<?php }?>
							</form>
						<?php } else { ?>
								<div style="display: table; margin-top: 15px; margin-bottom: 15px;">Нет в наличии</div>
								<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value->show_cart_wishcomp)) {
$_smarty_tpl->_subTemplateRender('file:wishcomp.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>
							</form>
						<?php }?>

					</div> </li>

				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				
			</ul>

			<?php if ($_smarty_tpl->tpl_vars['total_pages_num']->value > 1) {?>
				<div class="infinite_pages infinite_button" style="display:none;"> <div>Стр. <?php echo $_smarty_tpl->tpl_vars['current_page_num']->value;?>
 из <?php echo $_smarty_tpl->tpl_vars['total_pages_num']->value;?>
</div> </div> <div class="infinite_trigger"></div>
			<?php }?>
				

		</div> <?php echo '<script'; ?>
>
			function clicker(that) {
				var pick = that.options[that.selectedIndex].value;
				location.href = pick;
			};
		<?php echo '</script'; ?>
>

	<?php } else { ?>
		<div class="page-pg"><p>Товары не найдены</p></div>
	<?php }?>	
<?php }?>


<?php if (!empty($_smarty_tpl->tpl_vars['brand']->value) && !empty($_smarty_tpl->tpl_vars['brand_cat']->value) && count($_smarty_tpl->tpl_vars['brand_cat']->value) > 1 && $_smarty_tpl->tpl_vars['current_page_num']->value && $_smarty_tpl->tpl_vars['current_page_num']->value == 1) {?>
	<div class="page-pg brand_cat"> <div class="brand_disc">Категории:</div> <a class="brand_item <?php if ((strstr($_SERVER['REQUEST_URI'],'brands'))) {?>selected<?php }?>" href="brands/<?php echo $_smarty_tpl->tpl_vars['brand']->value->url;?>
">Все категории</a>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['brand_cat']->value, 'bc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['bc']->value) {
?>
		<a class="brand_item <?php if (!empty($_smarty_tpl->tpl_vars['category']->value->url) && $_smarty_tpl->tpl_vars['category']->value->url == $_smarty_tpl->tpl_vars['bc']->value->url) {?>selected<?php }?>" href="catalog/<?php echo $_smarty_tpl->tpl_vars['bc']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['brand']->value->url;?>
"><?php echo $_smarty_tpl->tpl_vars['bc']->value->name;?>
</a>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</div>
<?php }?>



<?php if ($_smarty_tpl->tpl_vars['current_page_num']->value == 1) {?>
	<div class="page-pg categoryintro"> <div class="bottom cutouter" style="max-height:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->cutmob, ENT_QUOTES, 'UTF-8', true);?>
px;"> <div class="disappear"></div> <div class="cutinner"><!--seo--><?php if (!empty($_smarty_tpl->tpl_vars['brand']->value->description_seo)) {
echo $_smarty_tpl->tpl_vars['brand']->value->description_seo;
} elseif (!empty($_smarty_tpl->tpl_vars['category']->value->description_seo)) {
echo $_smarty_tpl->tpl_vars['category']->value->description_seo;
}?><!--/seo--></div> </div> <div class="bottom cutmore" style="display:none;">Развернуть...</div> </div>
<?php }?>

<?php if (empty($_smarty_tpl->tpl_vars['mobile_app']->value)) {?>
	<?php echo '<script'; ?>
>
		window.addEventListener("orientationchange", function() {
			location.reload();
		}, false);
	<?php echo '</script'; ?>
>
<?php }
}
}
