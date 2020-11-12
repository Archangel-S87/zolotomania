<?php
/* Smarty version 3.1.33, created on 2020-11-12 16:40:39
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/wishlist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fad6587efdf39_77001905',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '70ae7d77e6bcc7a27d1708da36908337163bf556' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/wishlist.tpl',
      1 => 1605199234,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fad6587efdf39_77001905 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('meta_title', "Избранное" ,false ,8);
$_smarty_tpl->_assignInScope('page_name', "Избранное" ,false ,8);
if (count($_smarty_tpl->tpl_vars['wished_products']->value)) {?>
	<ul id="wished" class="tiny_products">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['wished_products']->value, 'product');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
?>
		<li class="product"> <div class="image" onclick="window.location='products/<?php echo $_smarty_tpl->tpl_vars['product']->value->url;?>
'">
				<?php if (!empty($_smarty_tpl->tpl_vars['product']->value->image)) {?>
					<img src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'resize' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value->image->filename,300,300 ));?>
" />
				<?php } else { ?>
					<svg class="nophoto"><use xlink:href='#no_photo' /></svg>
				<?php }?>
			</div> <div class="product_info separator"> <a class="wish-remove" href="wishlist/remove/<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
"></a> <h3><a href="products/<?php echo $_smarty_tpl->tpl_vars['product']->value->url;?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a></h3> </div> </li>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</ul> <div class="separator">
		
			<a name="#" onclick="if (document.referrer) {location.href=document.referrer} else {history.go(-1)}" class="button buttonblue">Вернуться</a>
		
	</div>
<?php } else { ?>
	<div class="page-pg"> <h2>Сейчас список избранного пуст</h2> </div> <div class="have-no separator"> <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path d="M0 0h24v24H0z" fill="none"/> <path d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z"/> </svg> </div>
<?php }?>

<?php echo '<script'; ?>
>
	
	if (document.referrer) {history.replaceState(null, null, document.referrer)} else {history.replaceState(null, null, '/catalog')};
	
<?php echo '</script'; ?>
><?php }
}
