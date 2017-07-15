<?php
/*
 * This file is part of the Deploy.
 *
 * (c) Dmitry Averbakh <adm@ruhub.com>
 */

namespace Deploy\Command;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Deploy\Exception\UploadException;
use RuntimeException;

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
        $container = $this->getContainer();
        $application = $this->getApplication();
        $release = $container->get('release');
        try {
            $output->writeln('<info>Check files...</info>');
            $release->check();
//            $output->writeln('<info>Upload files...</info>');
//            $release->upload();
        } catch (UploadException $e) {
            // Upload failed, rolling release back
            $output->writeln("<error>{$e->getMessage()}</error>");
            $in = new ArrayInput([ 'command' => 'down' ]);
            $application->find('down')->run($in, $output);
        } catch (RuntimeException $e) {
            $output->writeln("<error>{$e->getMessage()}</error>");
        }
    }
}
