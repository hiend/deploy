<?php
/*
 * This file is part of the Deploy.
 *
 * (c) Dmitry Averbakh <adm@ruhub.com>
 */

namespace Deploy\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection as DI;

/**
 * ContainerCommand
 *
 * Author: Dmitry Averbakh <adm@ruhub.com>
 */
abstract class ContainerCommand extends Command implements DI\ContainerAwareInterface
{
    use DI\ContainerAwareTrait;

    /**
     * Get dependency injection container
     *
     * @return DI\ContainerInterface
     */
    protected function getContainer()
    {
        if (null === $this->container) {
            /** @var \Deploy\Application $application */
            $application = $this->getApplication();
            $this->setContainer($application->getContainer());
        }

        return $this->container;
    }
}
