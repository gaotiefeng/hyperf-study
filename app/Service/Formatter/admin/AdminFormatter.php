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

namespace App\Service\Formatter\admin;

use App\Model\Admin;
use App\Service\Formatter\Formatter;

class AdminFormatter extends Formatter
{
    public function base(Admin $model)
    {
        return [
            'id' => $model->id,
            'mobile' => $model->mobile,
            'username' => $model->user_name,
        ];
    }
}
