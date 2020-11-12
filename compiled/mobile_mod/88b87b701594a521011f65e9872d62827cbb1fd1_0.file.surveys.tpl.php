<?php
/* Smarty version 3.1.33, created on 2020-11-02 20:04:15
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/surveys.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fa0663f5a3f29_34487740',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '88b87b701594a521011f65e9872d62827cbb1fd1' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/surveys.tpl',
      1 => 1604315638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fa0663f5a3f29_34487740 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'surveys_categories_tree2' => 
  array (
    'compiled_filepath' => '/Applications/MAMP/htdocs/zolotomania/compiled/mobile_mod/88b87b701594a521011f65e9872d62827cbb1fd1_0.file.surveys.tpl.php',
    'uid' => '88b87b701594a521011f65e9872d62827cbb1fd1',
    'call_name' => 'smarty_template_function_surveys_categories_tree2_17070219045fa0663f46af56_33115972',
  ),
));
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {?>
    <?php $_smarty_tpl->_assignInScope('wrapper', '' ,false ,8);?>
    	
	<input class="refresh_title" type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true);
if ($_smarty_tpl->tpl_vars['current_page_num']->value > 1) {?> - страница <?php echo $_smarty_tpl->tpl_vars['current_page_num']->value;
}?>" />
<?php }?>

<?php if (!empty($_smarty_tpl->tpl_vars['category']->value)) {?>
	<?php ob_start();
if ($_smarty_tpl->tpl_vars['current_page_num']->value > 1) {
echo "?page=";
echo (string)$_smarty_tpl->tpl_vars['current_page_num']->value;
}
$_prefixVariable1=ob_get_clean();
$_smarty_tpl->_assignInScope('canonical', "/surveys/".((string)$_smarty_tpl->tpl_vars['category']->value->url).$_prefixVariable1 ,false ,8);
} else { ?>
	<?php ob_start();
if ($_smarty_tpl->tpl_vars['current_page_num']->value > 1) {
echo "?page=";
echo (string)$_smarty_tpl->tpl_vars['current_page_num']->value;
}
$_prefixVariable2=ob_get_clean();
$_smarty_tpl->_assignInScope('canonical', "/surveys".$_prefixVariable2 ,false ,8);
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
	
<?php if (!empty($_smarty_tpl->tpl_vars['page']->value->url) && $_smarty_tpl->tpl_vars['page']->value->url == 'surveys') {?>
		<?php if (!empty($_smarty_tpl->tpl_vars['category']->value->subcategories)) {?>
	<ul class="category_products separator">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['category']->value->subcategories, 'c', false, NULL, 'cats', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
?>
			<?php if ($_smarty_tpl->tpl_vars['c']->value->visible) {?>
				<li class="product" onClick="window.location='surveys/<?php echo $_smarty_tpl->tpl_vars['c']->value->url;?>
'"> <div class="image">
					<?php if (!empty($_smarty_tpl->tpl_vars['c']->value->image)) {?>
						<img src="files/surveys-categories/<?php echo $_smarty_tpl->tpl_vars['c']->value->image;?>
" />
					<?php } else { ?>
						<svg class="nophoto"><use xlink:href='#folder' /></svg>
					<?php }?>
					</div> <div class="product_info"> <h3><?php echo $_smarty_tpl->tpl_vars['c']->value->name;?>
</h3> </div> </li>
			<?php }?>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</ul>
	<?php } else { ?>
		
	<?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'surveys_categories_tree2', array('surveys_categories'=>$_smarty_tpl->tpl_vars['surveys_categories']->value), true);?>

	<?php }?>
	<?php }?>

<?php if (!empty($_smarty_tpl->tpl_vars['page']->value->body) || !empty($_smarty_tpl->tpl_vars['category']->value->description)) {?>
	<div class="blog-pg">	
		<?php if (!empty($_smarty_tpl->tpl_vars['page']->value->body)) {
echo $_smarty_tpl->tpl_vars['page']->value->body;
}?>
		<?php if ($_smarty_tpl->tpl_vars['current_page_num']->value == 1 && !empty($_smarty_tpl->tpl_vars['category']->value->description)) {?>
			<?php echo $_smarty_tpl->tpl_vars['category']->value->description;?>

		<?php }?>
	</div>
<?php }
if ($_smarty_tpl->tpl_vars['total_posts_num']->value == 0) {?>
	<div class="nomore_polls"> <div class="nomore_mbody"> <svg fill="#1B6F9F" height="48" viewBox="0 0 24 24" width="48" xmlns="http://www.w3.org/2000/svg"> <path d="M0 0h24v24H0z" fill="none"/> <path d="M1 21h4V9H1v12zm22-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 1 7.59 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-1.91l-.01-.01L23 10z"/> </svg> <p>На сегодня задания закончились.</p> <p>Но скоро здесь появятся новые!</p> </div> </div>
<?php }
if (!empty($_smarty_tpl->tpl_vars['posts']->value) && empty($_smarty_tpl->tpl_vars['category']->value->subcategories)) {?>
	<div class="ajax_pagination">

		
		
		<?php if ($_smarty_tpl->tpl_vars['current_page_num']->value >= 2) {?>
			<div class="infinite_prev" style="display:none;"> <div class="trigger_prev infinite_button">Загрузить пред. страницу</div> </div>
		<?php }?>

		<ul id="blogposts" class="comment_list polls infinite_load" style="margin-top:0;">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>
				<li id="poll_<?php echo $_smarty_tpl->tpl_vars['post']->value->id;?>
" class="polls_item color_<?php if (!empty($_smarty_tpl->tpl_vars['post']->value->is_actual)) {
echo $_smarty_tpl->tpl_vars['post']->value->poll_type;
} else { ?>grey<?php }?>" onclick="window.location='survey/<?php echo $_smarty_tpl->tpl_vars['post']->value->url;?>
'"> <div class="poll_icon">
						<?php if ($_smarty_tpl->tpl_vars['post']->value->vote_type == 1) {?>
						<svg fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"> <path d="M0 0h24v24H0z" fill="none"/> <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/> </svg>
						<?php } elseif ($_smarty_tpl->tpl_vars['post']->value->vote_type == 2) {?>
						<svg fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"> <path d="M0 0h24v24H0z" fill="none"/> <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/> </svg>
						<?php } elseif ($_smarty_tpl->tpl_vars['post']->value->vote_type == 3) {?>
						<svg fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"> <path d="M0 0h24v24H0z" fill="none"/> <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm4.24 16L12 15.45 7.77 18l1.12-4.81-3.73-3.23 4.92-.42L12 5l1.92 4.53 4.92.42-3.73 3.23L16.23 18z"/> </svg>
						<?php } elseif ($_smarty_tpl->tpl_vars['post']->value->vote_type == 4) {?>
						<svg fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"> <path d="M20 6h-2.18c.11-.31.18-.65.18-1 0-1.66-1.34-3-3-3-1.05 0-1.96.54-2.5 1.35l-.5.67-.5-.68C10.96 2.54 10.05 2 9 2 7.34 2 6 3.34 6 5c0 .35.07.69.18 1H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-5-2c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM9 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm11 15H4v-2h16v2zm0-5H4V8h5.08L7 10.83 8.62 12 11 8.76l1-1.36 1 1.36L15.38 12 17 10.83 14.92 8H20v6z"/> <path d="M0 0h24v24H0z" fill="none"/> </svg>
						<?php }?>
					</div> <div class="poll_name"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</div>
					<?php if ($_smarty_tpl->tpl_vars['post']->value->points > 0) {?>
						<div class="poll_bonus"> <div class="bonus_number">+<?php echo $_smarty_tpl->tpl_vars['post']->value->points;?>
</div> <div class="bonus_text"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'plural' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value->points,'балл','баллов','балла' ));?>
</div> </div>
					<?php }?>
				</li>

			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</ul>
		<?php if ($_smarty_tpl->tpl_vars['total_pages_num']->value > 1) {?>
			<div class="infinite_pages infinite_button" style="display:none;margin:0px auto 15px auto;"> <div>Стр. <?php echo $_smarty_tpl->tpl_vars['current_page_num']->value;?>
 из <?php echo $_smarty_tpl->tpl_vars['total_pages_num']->value;?>
</div> </div> <div class="infinite_trigger"></div>
		<?php }?>
	</div> <div style="display:none;"> <div id="none_userid" class="poll_popup" style="width:270px;"> <div class="vote_mtitle">Вы не авторизованы</div>
						<div class="twobutton"> <div class="leftbutton" onclick="window.location='/user/login?goto=auth'">Логин</div> <div class="rightbutton" onclick="window.location='/user/register?goto=signup'">Регистрация</div> </div> </div> </div> <?php echo '<script'; ?>
>
		
			$(window).on('load', function() {
				$(document).ready(function(){
					
						<?php if (empty($_smarty_tpl->tpl_vars['user']->value->id)) {?>
							
							$('body').css('overflow','hidden');
							$.fancybox({
				             		'href' : '#none_userid',
									'hideOnContentClick' : false,
									'hideOnOverlayClick' : false,
									'enableEscapeButton' : false,
									'showCloseButton' : false,
									'padding' : 0,
									'scrolling' : 'no'
			             	});
							//$('#fancybox-overlay, #fancybox-close').click(function() { location.reload(); });
							return false;
							
						<?php }?>
					
				});
			})
		
	<?php echo '</script'; ?>
>
<?php } else { ?>
	<?php if ($_smarty_tpl->tpl_vars['keyword']->value && count($_smarty_tpl->tpl_vars['posts']->value) == 0) {?><div class="blog-pg">Статьи не найдены</div><?php }
}
}
/* smarty_template_function_surveys_categories_tree2_17070219045fa0663f46af56_33115972 */
if (!function_exists('smarty_template_function_surveys_categories_tree2_17070219045fa0663f46af56_33115972')) {
function smarty_template_function_surveys_categories_tree2_17070219045fa0663f46af56_33115972(Smarty_Internal_Template $_smarty_tpl,$params) {
$params = array_merge(array('level'=>1), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

			<?php if (!empty($_smarty_tpl->tpl_vars['surveys_categories']->value) && count($_smarty_tpl->tpl_vars['surveys_categories']->value) > 1) {?>
				<ul class="category_products separator">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['surveys_categories']->value, 'ac2');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ac2']->value) {
?>
						<?php if ($_smarty_tpl->tpl_vars['ac2']->value->visible) {?>
							<li class="product" onClick="window.location='surveys/<?php echo $_smarty_tpl->tpl_vars['ac2']->value->url;?>
'"> <div class="image">
								<?php if ($_smarty_tpl->tpl_vars['ac2']->value->image) {?>
									<img src="files/surveys-categories/<?php echo $_smarty_tpl->tpl_vars['ac2']->value->image;?>
" />
								<?php } else { ?>
									<svg class="nophoto"><use xlink:href='#folder' /></svg>
								<?php }?>
								</div> <div class="product_info"> <h3><?php echo $_smarty_tpl->tpl_vars['ac2']->value->name;?>
</h3> </div> </li>
						<?php }?>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</ul>
			<?php }?>
		<?php
}}
/*/ smarty_template_function_surveys_categories_tree2_17070219045fa0663f46af56_33115972 */
}
