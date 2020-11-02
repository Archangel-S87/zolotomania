<?php
/* Smarty version 3.1.33, created on 2020-11-02 12:14:12
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/antibot.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5f9ff8146224d8_01514427',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ff3bab01d072a6c45e3d0997986a097d13662da2' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/antibot.tpl',
      1 => 1604315638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f9ff8146224d8_01514427 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- incl. antibot --> <div class="check_block"> <input class="check_inp" type="checkbox" name="btfalse" <?php if (!empty($_smarty_tpl->tpl_vars['btfalse']->value)) {?>checked<?php }?> /> <input class="check_inp" type="checkbox" name="bttrue" /> <div class="check_bt" onClick="$(this).parent().find('input[name=bttrue]').prop('checked', true);$(this).addClass('checked');"> <svg class="uncheckedconf"> <use xlink:href='#uncheckedconf' /> </svg> <svg class="checkedconf" style="display:none;"> <use xlink:href='#antibotchecked' /> </svg> <div class="not_bt">Я нe рoбoт</div> </div> </div> <!-- incl. antibot @ --><?php }
}
