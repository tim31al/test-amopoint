<?php


namespace App;


use App\Utils\Config;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use Slim\App as SlimApp;


final class App
{
    private SlimApp $app;

    /**
     * App constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $container = (new Config)->buildContainer();
        $this->init($container);
    }

    public function run()
    {
        $this->app->run();
    }

    private function init(ContainerInterface $container): void
    {
        $app = AppFactory::createFromContainer($container);

        $app->addRoutingMiddleware();
        $app->addBodyParsingMiddleware();
        $app->addErrorMiddleware($container->get('development'), false, false);

        // routes
        (require dirname(__DIR__) . '/config/routes/web.php')($app);
        (require dirname(__DIR__) . '/config/routes/api.php')($app);

        $this->app = $app;
    }

}

