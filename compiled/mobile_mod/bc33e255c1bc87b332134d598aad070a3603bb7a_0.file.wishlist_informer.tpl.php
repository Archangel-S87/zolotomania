<?php
/* Smarty version 3.1.33, created on 2020-11-02 18:51:48
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/wishlist_informer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fa05544ec54d9_41815472',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bc33e255c1bc87b332134d598aad070a3603bb7a' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/wishlist_informer.tpl',
      1 => 1604342806,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fa05544ec54d9_41815472 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- wishlist_informer.tpl -->
<?php if (!empty($_smarty_tpl->tpl_vars['wished_products']->value)) {?>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 58.17 49.85"><g id="Слой_2" data-name="Слой 2"><g id="Слой_1-2" data-name="Слой 1"><path class="cls-1" fill="#ed1c2a" d="M54,4Q49.92,0,42.65,0a12.86,12.86,0,0,0-4.11.7,16.45,16.45,0,0,0-3.89,1.88c-1.2.79-2.23,1.53-3.1,2.22A30.63,30.63,0,0,0,29.08,7,30.63,30.63,0,0,0,26.61,4.8q-1.29-1-3.09-2.22A16.34,16.34,0,0,0,19.62.7a12.76,12.76,0,0,0-4.1-.7Q8.25,0,4.12,4T0,15.19a14.48,14.48,0,0,0,.76,4.48A20.1,20.1,0,0,0,2.5,23.6a29.54,29.54,0,0,0,2.21,3.16q1.23,1.54,1.8,2.13a9.69,9.69,0,0,0,.89.84L27.65,49.27a2.05,2.05,0,0,0,2.86,0L50.73,29.8q7.44-7.44,7.44-14.61T54,4ZM47.91,26.74,29.08,44.89,10.22,26.71c-4-4-6.06-7.89-6.06-11.52a14.29,14.29,0,0,1,.69-4.64,9.09,9.09,0,0,1,1.79-3.2A8.5,8.5,0,0,1,9.28,5.42a11.92,11.92,0,0,1,3.06-1,18.78,18.78,0,0,1,3.18-.26A9.38,9.38,0,0,1,19.15,5a16.82,16.82,0,0,1,3.59,2.08A36.56,36.56,0,0,1,25.55,9.4a26.92,26.92,0,0,1,1.94,2,2.12,2.12,0,0,0,3.18,0,25.33,25.33,0,0,1,1.95-2,36.56,36.56,0,0,1,2.81-2.34A16.74,16.74,0,0,1,39,5a9.42,9.42,0,0,1,3.64-.83,18.87,18.87,0,0,1,3.18.26,11.86,11.86,0,0,1,3.05,1,8.67,8.67,0,0,1,2.65,1.93,9.08,9.08,0,0,1,1.78,3.2,14,14,0,0,1,.7,4.64c0,3.63-2,7.49-6.1,11.55Z"/></g></g></svg> <div class="badge"><?php echo count($_smarty_tpl->tpl_vars['wished_products']->value);?>
</div>
<?php } else { ?>
	<div class="svgwrapper" title="Избранное"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 58.17 49.85"><g id="Слой_2" data-name="Слой 2"><g id="Слой_1-2" data-name="Слой 1"><path class="cls-1" fill="#ed1c2a" d="M54,4Q49.92,0,42.65,0a12.86,12.86,0,0,0-4.11.7,16.45,16.45,0,0,0-3.89,1.88c-1.2.79-2.23,1.53-3.1,2.22A30.63,30.63,0,0,0,29.08,7,30.63,30.63,0,0,0,26.61,4.8q-1.29-1-3.09-2.22A16.34,16.34,0,0,0,19.62.7a12.76,12.76,0,0,0-4.1-.7Q8.25,0,4.12,4T0,15.19a14.48,14.48,0,0,0,.76,4.48A20.1,20.1,0,0,0,2.5,23.6a29.54,29.54,0,0,0,2.21,3.16q1.23,1.54,1.8,2.13a9.69,9.69,0,0,0,.89.84L27.65,49.27a2.05,2.05,0,0,0,2.86,0L50.73,29.8q7.44-7.44,7.44-14.61T54,4ZM47.91,26.74,29.08,44.89,10.22,26.71c-4-4-6.06-7.89-6.06-11.52a14.29,14.29,0,0,1,.69-4.64,9.09,9.09,0,0,1,1.79-3.2A8.5,8.5,0,0,1,9.28,5.42a11.92,11.92,0,0,1,3.06-1,18.78,18.78,0,0,1,3.18-.26A9.38,9.38,0,0,1,19.15,5a16.82,16.82,0,0,1,3.59,2.08A36.56,36.56,0,0,1,25.55,9.4a26.92,26.92,0,0,1,1.94,2,2.12,2.12,0,0,0,3.18,0,25.33,25.33,0,0,1,1.95-2,36.56,36.56,0,0,1,2.81-2.34A16.74,16.74,0,0,1,39,5a9.42,9.42,0,0,1,3.64-.83,18.87,18.87,0,0,1,3.18.26,11.86,11.86,0,0,1,3.05,1,8.67,8.67,0,0,1,2.65,1.93,9.08,9.08,0,0,1,1.78,3.2,14,14,0,0,1,.7,4.64c0,3.63-2,7.49-6.1,11.55Z"/></g></g></svg> </div>
<?php }?>
<!-- wishlist_informer.tpl @ --><?php }
}
