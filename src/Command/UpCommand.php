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
 * UpCommand
 *
 * Author: Dmitry Averbakh <adm@ruhub.com>
 */
class UpCommand extends ContainerCommand
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName('up')
            ->setDescription('Deploy new version');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Deploying new version...');
    }
}
