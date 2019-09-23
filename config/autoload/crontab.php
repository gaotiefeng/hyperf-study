<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

use Hyperf\Crontab\Crontab;

return [
    'enable' => true,
    'crontab' => [
        //        (new Crontab())->setName('article')->setRule('* * * * * *')->setCallback([\App\Controller\Web\ArticleController::class, 'test'])->setMemo('this is add article'),
    ],
];
