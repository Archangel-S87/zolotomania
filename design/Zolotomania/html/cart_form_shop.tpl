<div class="form cart_form">

    {strip}
        <label for="comment"></label>
        <textarea id="comment"
                  name="comment"
                  rows="1"
                  placeholder="Комментарий к заказу">
            {if !empty($comment)}{$comment|escape}{/if}
        </textarea>
    {/strip}

    {include file='antibot.tpl'}

    <input id="purchase_method"
           name="purchase_method"
           value="i_pickup"
           type="hidden">
    <input name="shop_id"
           value="{$user->id}"
           type="hidden">
    <input name="name"
           value="{$user->name}"
           type="hidden">
    <input type="submit"
           name="check_order"
           class="button hideablebutton"
           value="Заказать"/>

    <style>
        .check_block {
            display: none;
        }
    </style>
    <script>
        $('.check_block input[name=bttrue]').prop('checked', true);
    </script>
</div>
