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

use Hyperf\HttpServer\Router\Router;

Router::get('/', 'App\Controller\IndexController::index');

Router::post('/user/login', 'App\Controller\Web\UserController::login');
Router::post('/user/register', 'App\Controller\Web\UserController::register');
Router::get('/user/info', 'App\Controller\Web\UserController::userInfo');

/*sudo docker run -d --hostname www.tfuu.cn \
--publish 443:443 --publish 8880:80 --publish 22:22 \
--name gitlab --restart always --volume /srv/gitlab/config:/etc/gitlab \
--volume /srv/gitlab/logs:/var/log/gitlab \
--volume /srv/gitlab/data:/var/opt/gitlab \
gitlab/gitlab-ce:latest*/
