<?php
/*
 * This file is part of the Deploy.
 *
 * (c) Dmitry Averbakh <adm@ruhub.com>
 */

namespace Deploy\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * DownCommand
 *
 * Author: Dmitry Averbakh <adm@ruhub.com>
 */
class DownCommand extends ContainerCommand
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName('down')
            ->setDescription('Deploy previous version');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Deploying previous version...');
    }
}
