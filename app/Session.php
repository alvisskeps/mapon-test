<?php

namespace App;

use Exception;

class Session
{
    protected static $instance;
    protected $sessionId;

    /**
     * Session constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->start();
    }

    public static function getInstance(): Session
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @throws Exception
     */
    public function start(): void
    {
        if ($this->sessionId) {
            return;
        }

        $success = session_start();
        if (!$success) {
            throw new Exception('Session could not be initialized');
        }
        $this->sessionId = session_id();
    }

    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }
}