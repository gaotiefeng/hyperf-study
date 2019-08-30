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

use Hyperf\ExceptionHandler\Formatter\FormatterInterface;
use Hyperf\Utils\ApplicationContext;

if (! function_exists('di')) {
    /**
     * Finds an entry of the container by its identifier and returns it.
     * @param null|mixed $id
     * @return mixed|\Psr\Container\ContainerInterface
     */
    function di($id = null)
    {
        $container = ApplicationContext::getContainer();
        if ($id) {
            return $container->get($id);
        }

        return $container;
    }
}

if (! function_exists('validator_mobile')) {
    /**
     * @param $mobile
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
    if (! function_exists('format_throwable')) {
        /**
         * Format a throwable to string.
         * @param Throwable $throwable
         * @return string
         */
        function format_throwable(Throwable $throwable): string
        {
            return di()->get(FormatterInterface::class)->format($throwable);
        }
    }
}
