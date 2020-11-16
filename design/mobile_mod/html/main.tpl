<!-- main.tpl -->
{$wrapper = 'index.tpl' scope=root}

{* Канонический адрес страницы *}
{$canonical="" scope=root}

{* {include file='slides_mob.tpl'} *}
<img alt="{$c->name|escape}" title="{$c->name|escape}" src="design/mobile_mod/images/banner.jpg" srcset="design/mobile_mod/images/banner@2x.jpeg" class="banner"/>
{* categories start *}
<section class="main">
	<a class="main__gold" href="/catalog/zoloto-585">
		
		<div class="container">
			<div class="main__link main__gold--link">золото 585</div>
		</div>
		<img src="design/mobile_mod/images/zoloto.jpg" srcset="design/mobile_mod/images/zoloto@2x.jpg" alt="bg">
	</a>
	<a class="main__silver" href="/catalog/serebro-925">
		
		<div class="container">
			<div class="main__link main__silver--link">Серебро 925</div>
		</div>
		<img src="design/mobile_mod/images/serebro.jpg" srcset="design/mobile_mod/images/serebro@2x.jpg" alt="bg">
	</a>
</section>
<!-- main.tpl @ -->