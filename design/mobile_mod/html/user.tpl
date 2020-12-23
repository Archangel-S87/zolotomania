{* Шаблон страницы зарегистрированного пользователя *}
{$meta_title = "Личный кабинет" scope=root}
{$page_name = "Личный кабинет" scope=root}

<style>
	.user-form .row {
		width: 100%;
		display: flex;
		flex-direction: column;
		align-items: flex-start;
		margin: 0 auto;
	}
	.user-form .row label {
		width: 150px;
		text-align: left;
	}
	.user-form .user_form_block .form {
		float: none;
		width: auto;
	}
</style>

<div class="page-pg">
	{if isset($error)}
	<div class="message_error">
		{if $error == 'empty_name'}Введите имя
		{elseif $error == 'empty_phone'}Введите Телефон
		{elseif $error == 'invalid_tel'}Не корректный номер телефона
		{elseif $error == 'empty_email'}Введите email
		{elseif $error == 'empty_password'}Введите пароль
		{elseif $error == 'user_exists'}
			{if $user_exists_message == 'email'}
				Пользователь с таким email уже зарегистрирован
			{elseif $user_exists_message == 'phone'}
				Пользователь с таким телефоном уже зарегистрирован
			{else}
				Пользователь с таким email и телефоном уже зарегистрирован
			{/if}
		{elseif $error == 'empty_address'}Укажите адрес
		{elseif $error == 'user_exists'}Пользователь с таким email уже зарегистрирован
		{else}{$error}{/if}
	</div>
	{/if}

	<form class="form separator user-form" method="post">
		<div class="row">
			<label>ФИО</label>
			<input data-format=".+" data-notice="Введите имя" value="{if isset($name)}{$name|escape}{/if}" name="name" maxlength="255" type="text" required/>
		</div>
		<div class="row">
			<label for="tel">Телефон</label>
			<input id="tel" placeholder="+7(___) ___-__-__" data-format=".+" data-notice="Введите Телефон" value="{if isset($phone)}{$phone|escape}{/if}" name="tel" maxlength="255" type="tel"/>
		</div>
		<div class="row">
			<label for="birthday">День рождения</label>
			<input id="birthday" type="text" name="user_data[birthday]" value="{$user_data->birthday|date}">
		</div>

		<div class="row">
			<label>Адресс</label>
		</div>
		<div class="row">
			<label for="region">Область</label>
			<input id="region" type="text" name="user_data[region]" value="{$user_data->region}">
		</div>
		<div class="row">
			<label for="district">Район</label>
			<input id="district" type="text" name="user_data[district]" value="{$user_data->district}">
		</div>
		<div class="row">
			<label for="city">Город</label>
			<input id="city" type="text" name="user_data[city]" value="{$user_data->city}">
		</div>

		<div class="row">
			<label for="street">Улица</label>
			<input id="street" type="text" name="user_data[street]" value="{$user_data->street}">
		</div>
		<div class="row">
			<label for="house">Дом</label>
			<input id="house" type="text" name="user_data[house]" value="{$user_data->house}">
		</div>
		<div class="row">
			<label for="apartment">Квартира</label>
			<input id="apartment" type="text" name="user_data[apartment]" value="{$user_data->apartment}">
		</div>

		<label class="ch_passw"><a href='#' onclick="$('#password').show();return false;">Изменить пароль</a></label>
		<input placeholder="Введите новый пароль" id="password" value="" name="password" type="password" style="display:none; margin-bottom: 10px;"/>
		<input id="logininput" type="submit" class="button buttonblue" value="Сохранить">
	</form>
	<script src="/js/jquery/maskedinput/dist/jquery.maskedinput.min.js"></script>
	<script src="/js/jquery/datetime/jquery.datetimepicker.full.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/js/jquery/datetime/jquery.datetimepicker.css"/ >
	<script>
		$(function ($) {
			const tel = $("#tel");
			tel.click(function() {
				$(this).setCursorPosition(3);
			});
			tel.mask('+7(999) 999-99-99');
		});

		$.datetimepicker.setLocale('ru');
		$('#birthday').datetimepicker({
			timepicker: false,
			format: 'd.m.Y',
			formatDate: 'd.m.Y',
			startDate: '{$user_data->birthday|date}',
			defaultDate: '{$user_data->birthday|date}'
		});
	</script>

	{if !empty($user->comment)}
		<div class="mainproduct blue">Информация для пользователя:</div>
		<div class="user_comment">{$user->comment}</div>
	{/if}
	
	{if !empty($orders)}
		<h2 class="your_orders">Ваши заказы:</h2>
		<ul id="orders_history">
		{foreach name=orders item=order from=$orders}
			<li>
				{$order->date|date} {if $order->status != 3}<a href='order/{$order->url}'>Заказ №{$order->id}</a>{else}Заказ №{$order->id}{/if}
				{if $order->paid == 1}оплачен,{/if} 
				({if $order->status == 0}ждет обработки{elseif $order->status == 4}в обработке{elseif $order->status == 1}выполняется{elseif $order->status == 2}выполнен{elseif $order->status == 3}отменен{/if})
			</li>
		{/foreach}
		</ul>
	{/if}
	
	{if ($user->discount && in_array($settings->enable_groupdiscount, array(1,3,4))) || ($user->tdiscount && in_array($settings->enable_groupdiscount, array('5','4')))  || $user->order_payd>0 || $user->balance>0}
		<div class="discountsblock">
			{if $user->discount && in_array($settings->enable_groupdiscount, array(1,3,4))}
				<p><strong>Постоянная скидка:</strong> {$user->discount}%</p>
			{/if}
			{if $user->tdiscount && in_array($settings->enable_groupdiscount, array(5,4))}
				<p><strong>Накопительная скидка:</strong> {$user->tdiscount}%</p>
			{/if}
			{if $user->order_payd>0}
				<p><strong>Заказов оплачено на сумму:</strong> <span style="white-space:nowrap;">{$user->order_payd|convert} {$currency->sign|escape}</span></p>
			{/if}
			{if $user->balance>0}
				<div class="hasbonuses"><strong>Всего накоплено баллов на:</strong> <span style="white-space:nowrap;">{$user->balance|round|convert}&nbsp;{$currency->sign}</span>
				</div>
			{/if}
			{if $settings->bonus_link}
				<p class="about_bonus"><a class="bluelink" href="{$settings->bonus_link|escape}">Описание бонусной программы</a></p>
			{/if}
		</div>	
	{/if}
	
	{if !empty($settings->ref_order)}
		<div class="mainproduct ref_link_title">Ваша партнерская ссылка:</div>
		<div class="ref_link"><span>{$config->root_url}/?appid={$user->id}</span></div>
		<p>Также партнерская ссылка может указывать на любую страницу сайта:</p>
		<p>Например: {$config->root_url}/blog?appid={$user->id}</p>
		<p class="ref_you_get">Вы получаете <span class="ref_procent">{$settings->ref_order|escape}%</span> от платежей ваших рефералов</p>
		{if $settings->ref_link}<p class="about_ref"><a class="bluelink" href="{$settings->ref_link|escape}">Описание реферальной программы</a></p>{/if}
		<div class="withdrawal_title">Переходов по ссылкам: <span style="font-size:16px;color:#8ba76b;">{$user->ref_views}</span></div>
	{/if}
	
	{if !empty($settings->ref_order) && $referrals}
		<h3 class="referrals_title">Привлеченные клиенты:</h3>
		<div class="referrals">
			<div class="ref_item">
				<div class="ref_id">ID</div>
				<div class="ref_date">Регистрация</div>
				<div class="ref_ballov">Платежи</div>
				<div class="ref_profit">Прибыль</div>
			</div>
			{foreach $referrals as $ref}
			<div class="ref_item">
				<div class="ref_id">{$ref->id}</div>
				<div class="ref_date">{$ref->created}</div>
				<div class="ref_ballov">{$ref->order_payd|convert} {$currency->sign}</div>
				<div class="ref_profit">{($ref->order_payd/100*$settings->ref_order)|convert} {$currency->sign}</div>
			</div>
			{/foreach}
		</div>
	{/if}
	
	{if !empty($user->withdrawal)}
		<div class="withdrawal">
			<div class="withdrawal_title">Всего баллов выведено:</div>
			<ul>{$user->withdrawal}</ul>
		</div>
	{/if}

	<div class="separator">
		<a href="user/logout" class="button buttonblue">Разлогиниться</a>
	</div>

</div>
