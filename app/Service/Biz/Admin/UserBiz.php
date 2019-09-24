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

namespace App\Service\Biz\Admin;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Model\Admin;
use App\Service\Dao\AdminDao;
use App\Service\Service;
use App\Untils\JwtAuth;
use Hyperf\Di\Annotation\Inject;

class UserBiz extends Service
{
    /**
     * @Inject
     * @var AdminDao
     */
    protected $dao;

    /**
     * @param array $data
     * @return mixed
     */
    public function login(array $data)
    {
        /** @var Admin $model */
        $model = $this->dao->mobile($data['mobile'], true);

        if (empty($model)) {
            throw new BusinessException(ErrorCode::ADMIN_NOT_EXITS);
        }

        if (! password_verify($data['password'], $model->password)) {
            throw new BusinessException(ErrorCode::ADMIN_PASSWORD_ERROR);
        }

        $result = [];
        $result['mobile'] = $data['mobile'];
        $result['token'] = JwtAuth::instance()->init($model->id)->getToken();

        return $result;
    }
}
