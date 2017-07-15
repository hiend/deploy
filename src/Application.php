<?php
/*
 * This file is part of the Deploy.
 *
 * (c) Dmitry Averbakh <adm@ruhub.com>
 */

namespace Deploy;

use Deploy\Command;
use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\DependencyInjection as DI;

/**
 * Application
 *
 * Author: Dmitry Averbakh <adm@ruhub.com>
 */
class Application extends ConsoleApplication implements DI\ContainerAwareInterface
{
    use DI\ContainerAwareTrait;

    /**
     * Application constructor
     *
     * @param DI\ContainerInterface $container
     * @param string $app_name
     * @param string $vsn
     */
    public function __construct(DI\ContainerInterface $container, string $app_name, string $vsn)
    {
        $container->set('application', $this);

        $this->setContainer($container);

        parent::__construct($app_name, $vsn);
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultCommands()
    {
        $defaultCommands = parent::getDefaultCommands();
        $defaultCommands[] = new Command\UpCommand;
        $defaultCommands[] = new Command\DownCommand;

        return $defaultCommands;
    }

    /**
     * Get dependency injection container
     *
     * @return DI\ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }
}
