<?php
/*
 * This file is part of the Deploy.
 *
 * (c) Dmitry Averbakh <adm@ruhub.com>
 */

namespace Deploy\Service;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Filesystem\Filesystem;
use Deploy\Exception\UploadException;
use RuntimeException;

/**
 * Release
 *
 * Author: Dmitry Averbakh <adm@ruhub.com>
 */
class Release
{
    /**
     * @var Finder
     */
    private $finder;

    /**
     * @var Filesystem
     */
    private $fs;

    /**
     * @var SSH
     */
    private $ssh;

    /**
     * @var string
     */
    private $path;

    /**
     * Constructor
     *
     * @param Finder $finder
     * @param Filesystem $fs
     * @param SSH $ssh
     * @param string $path
     */
    public function __construct(Finder $finder, Filesystem $fs, SSH $ssh, string $path)
    {
        $this->finder = $finder;
        $this->finder->files()->followLinks();
        $this->fs = $fs;
        $this->ssh = $ssh;
        $this->path = $path;
    }

    /**
     * Check all files is readable
     */
    public function check()
    {
        /** @var SplFileInfo $file */
        foreach ($this->finder->in($this->path) as $file) {
            if (!$file->isReadable()) {
                throw new RuntimeException("File is not readable: " . $file->getRelativePathname());
            }
        }
    }

    /**
     * Upload files to server
     */
    public function upload()
    {
        $this->ssh->connect();
        /** @var SplFileInfo $file */
        foreach ($this->finder->in($this->path) as $file) {
//            $this->ssh->;
//            throw new UploadException("Error upload file: " . $file->getRelativePathname());
        }
        $this->ssh->disconnect();
    }
}
