<?php
/*
 * This file is part of the Deploy.
 *
 * (c) Dmitry Averbakh <adm@ruhub.com>
 */

namespace Deploy\Service;

/**
 * SSH
 *
 * Author: Dmitry Averbakh <adm@ruhub.com>
 */
class SSH
{
    /**
     * @var resource
     */
    private $connection;

    /**
     * @var string
     */
    private $host;

    /**
     * @var int|null
     */
    private $port;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $pub_key;

    /**
     * @var string
     */
    private $priv_key;

    /**
     * @param string $host
     * @param int|null $port
     * @param string $user
     * @param string $pub_key
     * @param string $priv_key
     */
    public function __construct($host, $port, $user, $pub_key, $priv_key)
    {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->pub_key = $pub_key;
        $this->priv_key = $priv_key;
    }

    /**
     * Connect to host
     */
    public function connect()
    {
        if (!($this->connection = ssh2_connect($this->host, $this->port))) {
            throw new \RuntimeException('Cannot connect to server');
        }
        if (!ssh2_auth_pubkey_file($this->connection, $this->user, $this->pub_key, $this->priv_key)) {
            throw new \RuntimeException('Autentication rejected by server');
        }
    }

    /**
     * Disconnect
     */
    public function disconnect()
    {
        $this->exec('exit;');
        $this->connection = null;
    }

    /**
     * @param string $cmd
     *
     * @return string
     */
    public function exec($cmd)
    {
        if (!($stream = ssh2_exec($this->connection, $cmd))) {
            throw new \RuntimeException('Command execution failed');
        }
        if(!stream_set_blocking($stream, true)) {
            throw new \RuntimeException('Set blocking mode failed');
        }
        if(!($data = stream_get_contents($stream))) {
            throw new \RuntimeException('Read from stream failed');
        }
        if(!fclose($stream)) {
            throw new \RuntimeException('Close stream failed');
        }
        return $data;
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        if (is_resource($this->connection)) {
            $this->disconnect();
        }
    }
}
