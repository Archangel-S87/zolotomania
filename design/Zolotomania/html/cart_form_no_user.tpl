{if isset($error)}
    <div class="message_error">
        {if $error == 'empty_phone'}Введите телефон{/if}
        {if $error == 'invalid_phone'}Не корректный номер телефона{/if}
    </div>
{/if}

<style>
    .data-block {
        padding: 20px;
    }
    #error {
        padding: 10px;
    }
    #check_sms_code {
        padding: 2px;
        display: block;
        background: none !important;
        border: 1px solid #d24a46;
        line-height: 1;
        margin: 0 0 10px 4px;
    }
    #check_sms_code svg {
        width: 20px;
        height: 20px;
        cursor: pointer;
    }
</style>

<div class="flex button-block">
    <div class="row" style="justify-content: space-between">
        <button id="bring_me" class="button{if $purchase_method =='bring_me'} active{/if}" style="width: 48%;" >Доставьте мне</button>
        <button id="i_pickup" class="button{if $purchase_method =='i_pickup'} active{/if}" style="width: 48%;">Заберу в
            магазине
        </button>
    </div>
    <input id="purchase_method"
           name="purchase_method"
            {if isset($purchase_method)}
                value="{$purchase_method|escape}"
            {/if}
           type="hidden">
</div>
<div class="form cart_form data-block">

    <div class="row">
        <label for="user_phone" style="width: 100px;">Телефон *</label>
        <input id="user_phone"
               name="phone"
               type="text"
               data-format=".+"
               value="{if !empty($phone)}{$phone|escape}{/if}"
               style="width: 200px; margin-right: 20px;"
               data-notice="Укажите телефон"/>

        <div id="sms_code" class="row" style="display: none;position:relative;flex:0 0 200px;">
            <label for="sms_code_input" style="width: 77px;">СМС код</label>
            <input id="sms_code_input" type="text" style="width: 100px;">
            <button id="check_sms_code" class="button">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="1171.000000pt" height="1280.000000pt" viewBox="0 0 1171.000000 1280.000000" preserveAspectRatio="xMidYMid meet"><g transform="translate(0.000000,1280.000000) scale(0.100000,-0.100000)" fill="green" stroke="none"><path d="M11555 12694 c-1288 -888 -2591 -2076 -3945 -3594 -1475 -1656 -3026 -3783 -4315 -5918 -72 -119 -115 -180 -123 -177 -8 3 -716 474 -1575 1048 -859 574 -1568 1047 -1576 1052 -11 6 -10 2 2 -16 98 -140 3704 -5078 3709 -5079 3 0 34 66 68 148 1225 2918 2422 5234 3838 7427 1148 1777 2481 3497 3899 5028 91 97 163 177 161 177 -2 0 -67 -43 -143 -96z"/></g></svg>
            </button>
        </div>
    </div>

    <script src="/js/jquery/maskedinput/dist/jquery.maskedinput.min.js"></script>
    <script>
        jQuery(function ($) {
            const tel = $("#user_phone");
            tel.click(function () {
                $(this).setCursorPosition(3);
            });
            tel.mask('+7(999) 999-99-99', {
                completed: function () {
                    $('#error').html('').hide();
                    $('#sms_code').hide();
                    $('#check_sms_code').hide();

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
                            $('#sms_code').show().css('display', 'flex');
                            $('#check_sms_code').show();
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
                        window.location = data.url;
                        return false;
                    }
                });
                return false;
            });
        });
    </script>

</div>

<div class="row" style="justify-content: center;">
    <p id="error" class="error" style="display: none;"></p>
</div>
