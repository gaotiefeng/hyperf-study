<?php

//每隔2000ms触发一次
swoole_timer_tick(2000, function ($timer_id) {
    echo "{$timer_id} \n";
    echo "tick-2000ms\n";
});

//3000ms后执行此函数
swoole_timer_after(3000, function () {
    echo "after 3000ms.\n";
});

$timer_id = 1;
swoole_timer_clear($timer_id);
