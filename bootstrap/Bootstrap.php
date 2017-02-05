<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 05.02.17
 * Time: 21:54
 */

namespace app\bootstrap;


use app\repositories\QuestionRepository;
use app\repositories\QuestionRepositoryInterface;
use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $container = Yii::$container;
        $container->setSingleton(QuestionRepositoryInterface::class, QuestionRepository::class);
    }
}