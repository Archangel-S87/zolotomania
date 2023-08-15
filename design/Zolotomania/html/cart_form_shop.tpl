<style>
    .check_block {
        display: none;
    }
    input:disabled {
        border-color: #ccc;
        background-color: #ddd;
    }
</style>

<script src="/js/jquery/maskedinput/dist/jquery.maskedinput.min.js"></script>
<script src="/js/jquery/datetime/jquery.datetimepicker.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="/js/jquery/datetime/jquery.datetimepicker.css"/>

<div id="error" class="row" style="color: red; text-align: center; max-width: 500px">
    {if isset($error)}
        <div class="message_error">
            {if $error == 'empty_name'}Введите имя{/if}
            {if $error == 'captcha'}Не пройдена проверка на бота{/if}
            {if $error == 'empty_address'}Введите адрес{/if}
            {if $error == 'min_order'}Сумма товаров в заказе меньше минимума{/if}
            {if $error == 'empty_shop_id'}Не найден магазин{/if}
            {if $error == 'empty_user'}Пользователь не найден{/if}
        </div>
    {/if}
</div>

<div class="form cart_form data-block">

    {include file='antibot.tpl'}

    <input id="user_id" name="user_id" type="hidden">
    <input id="shop_id" name="shop_id" value="{$user->id}" type="hidden">
    <input id="purchase_method" name="purchase_method" value="i_pickup" type="hidden">

    <div id="validate_form_phone_user" class="all-data-actions">
        <div class="row" style="width: 500px;max-width: 500px">
            <label for="user_phone" style="flex: 0 0 114px;">Телефон *</label>
            <input id="user_phone"
                   name="phone"
                   type="text"
                   data-format=".+"
                   value=""
                   style="width: 200px; margin-right: 20px;"
                   data-notice="Укажите телефон"/>

            <div id="sms_code" class="row" style="position:relative;flex:0 0 20px;">
                <label for="sms_code_input" style="width: 77px;">СМС код</label>
                <input id="sms_code_input"
                       type="text"
                       data-format=".+"
                       data-notice="Введите код из СМС"
                       autocomplete="off"
                       style="width: 100px;">
                <button id="check_sms_code" class="button">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="1171.000000pt" height="1280.000000pt" viewBox="0 0 1171.000000 1280.000000" preserveAspectRatio="xMidYMid meet"><g transform="translate(0.000000,1280.000000) scale(0.100000,-0.100000)" fill="green" stroke="none"><path d="M11555 12694 c-1288 -888 -2591 -2076 -3945 -3594 -1475 -1656 -3026 -3783 -4315 -5918 -72 -119 -115 -180 -123 -177 -8 3 -716 474 -1575 1048 -859 574 -1568 1047 -1576 1052 -11 6 -10 2 2 -16 98 -140 3704 -5078 3709 -5079 3 0 34 66 68 148 1225 2918 2422 5234 3838 7427 1148 1777 2481 3497 3899 5028 91 97 163 177 161 177 -2 0 -67 -43 -143 -96z"/></g></svg>
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <label for="user_name">ФИО *</label>
        <input id="user_name" name="name" type="text" data-format=".+" data-notice="Введите ФИО" disabled/>
    </div>

    <div class="row">
        <label for="birthday">День рождения</label>
        <input id="birthday" type="text" name="user_data[birthday]" data-format=".+" disabled>
    </div>

    <div class="row">
        <label for="comment"></label>
        {strip}
            <textarea id="comment"
                      name="comment"
                      rows="1"
                      placeholder="Комментарий к заказу">
                {if !empty($comment)}{$comment|escape}{/if}
            </textarea>
        {/strip}
    </div>

    <input type="submit"
           name="check_order"
           class="button hideablebutton"
           value="Заказать"/>
</div>

<script>
    jQuery(function ($)
    {
        $('.check_block input[name=bttrue]').prop('checked', true);
        $.datetimepicker.setLocale('ru');

        const tel = $("#user_phone");
        tel.click(function () {
            $(this).setCursorPosition(3);
        });
        tel.mask('+7(999) 999-99-99', {
            completed: function () {
                $('#error').html('').hide();

                $('#user_id').val('');
                $('#sms_code_input').val('');
                $('#check_sms_code').prop('disabled', false);
                $('#user_name').prop('disabled', true);
                $('#birthday').prop('disabled', true);

                const phone = $(this).val();
                $.ajax({
                    url: '/cart',
                    method: 'POST',
                    data: {
                        get_code: 1,
                        phone: phone
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.error) {
                            $('#error').html(data.error).show();
                        }
                        if (!data.is_code) return false;
                    }
                });
            }
        });

        $('#check_sms_code').on('click', function () {
            $.ajax({
                url: '/cart',
                method: 'POST',
                data: {
                    check_sms_code: 1,
                    sms_code: $('#sms_code input').val()
                },
                dataType: 'json',
                success: function (data) {
                    if (data.error) {
                        $('#error').html(data.error).show();
                        return false;
                    }

                    if (data.url) {
                        window.location = data.url;
                        return false;
                    }

                    if (data.user) {
                        $('#user_id').val(data.user.id);

                        $('#check_sms_code').prop('disabled', true);

                        $('#user_name').val(data.user.name).prop('disabled', false);

                        const birthday_input = $('#birthday'),
                            birthday = {
                            timepicker: false,
                            format: 'd.m.Y',
                            formatDate: 'd.m.Y'
                        }

                        if (data.user_data.birthday) {
                            const birthday = data.user_data.birthday;
                            birthday.startDate = birthday;
                            birthday.defaultDate = birthday;
                            birthday_input.val(birthday);
                        }

                        birthday_input.prop('disabled', false);
                        birthday_input.datetimepicker(birthday);
                    }

                    return false;
                }
            });
            return false;
        });
    });
</script>
