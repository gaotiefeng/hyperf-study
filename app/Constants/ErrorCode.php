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

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 */
class ErrorCode extends AbstractConstants
{
    /**
     * @Message("Token Error！")
     */
    const TOKEN_NOT_EXITS = 700;

    /**
     * @Message("Server Error！")
     */
    const SERVER_ERROR = 500;

    /**
     * @Message("token非法")
     */
    const NOT_TOKEN = 1000;

    /**
     * @Message("用户名不存在")
     */
    const USER_NOT_EXIST = 1404;

    /**
     * @Message("用户密码错误")
     */
    const USER_PASSWORD_ERROR = 1003;

    /**
     * @Message("用户已经存在")
     */
    const USER_EXIST = 1001;

    /**
     * @Message("文章不存在")
     */
    const ARTICLE_NO_EXIST = 2404;

    /**
     * @Message("文章已存在")
     */
    const ARTICLE_EXIST = 2301;

    /**
     * @Message("您已经点赞")
     */
    const ARTICLE_USER_EXIST = 2500;
}
