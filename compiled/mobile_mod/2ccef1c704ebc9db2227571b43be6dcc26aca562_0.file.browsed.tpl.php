<?php
/* Smarty version 3.1.33, created on 2020-11-02 19:55:50
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/browsed.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fa06446e733d9_77823473',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2ccef1c704ebc9db2227571b43be6dcc26aca562' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/browsed.tpl',
      1 => 1604315638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fa06446e733d9_77823473 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('meta_title', "Просмотренные товары" ,false ,8);
$_smarty_tpl->_assignInScope('page_name', "Просмотренные товары" ,false ,8);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_browsed_products'][0], array( array('var'=>'browsed_products','limit'=>200),$_smarty_tpl ) );?>

<?php if (!empty($_smarty_tpl->tpl_vars['browsed_products']->value)) {?>
	<ul id="wished" class="tiny_products">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['browsed_products']->value, 'browsed_product');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['browsed_product']->value) {
?>
		 <li class="product"> <div class="image" onclick="window.location='products/<?php echo $_smarty_tpl->tpl_vars['browsed_product']->value->url;?>
'">
			<?php if (!empty($_smarty_tpl->tpl_vars['browsed_product']->value->image)) {?>
				<img src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'resize' ][ 0 ], array( $_smarty_tpl->tpl_vars['browsed_product']->value->image->filename,300,300 ));?>
" />
			<?php } else { ?>
				<svg class="nophoto"><use xlink:href='#no_photo' /></svg>
			<?php }?>
			</div> <div class="product_info separator"> <h3><a href="products/<?php echo $_smarty_tpl->tpl_vars['browsed_product']->value->url;?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['browsed_product']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a></h3> </div> </li>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</ul> <div class="separator" style="height:60px; padding:15px;">
		
			<a name="#" onclick="if (document.referrer) { location.href=document.referrer } else { history.go(-1) }" class="buttonblue">Вернуться</a>
		
	</div>
<?php } else { ?>
	<div class="page-pg"> <h2>Список пуст</h2> </div> <div class="have-no separator"> <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path d="M0 0h24v24H0z" fill="none"/> <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/> </svg> </div>
<?php }
}
}
