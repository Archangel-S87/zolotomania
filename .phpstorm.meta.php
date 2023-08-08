<?php

// Эта штуковина нужна что бы редактор понимал префиксы таблиц БД
namespace PHPSTORM_META {
    override(
        sql_injection_subst(),
        map([
            '__' => "f_"
        ])
    );
}
