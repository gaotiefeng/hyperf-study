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

if (! function_exists('validator_mobile')) {
    /**
     * @param $mobile
     * @return null
     */
    function validator_mobile($mobile)
    {
        if (preg_match('/^1\d{10}$/', $mobile)) {
            return $mobile;
        }
        return null;
    }

    if (! function_exists('str_mobile')) {
        /**
         * @param mixed $mobile
         * @param mixed $replacement
         * @param mixed $start
         * @param mixed $length
         * @return string
         */
        function str_mobile($mobile, $replacement, $start, $length): string
        {
            return substr_replace($mobile, $replacement, $start, $length);
        }
    }
}
