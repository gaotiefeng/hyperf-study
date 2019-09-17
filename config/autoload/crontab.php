<?php

use \Hyperf\Crontab\Crontab;

return [
  'enable' => true,
    'crontab'=> [
//        (new Crontab())->setName('article')->setRule('* * * * * *')->setCallback([\App\Controller\Web\ArticleController::class, 'test'])->setMemo('this is add article'),
    ]
];
