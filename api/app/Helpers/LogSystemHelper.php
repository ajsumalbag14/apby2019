<?php
namespace App\Helpers;

use App\Interfaces\LogSystemInterface;
use Illuminate\Support\Facades\Log;

class LogSystemHelper implements LogSystemInterface
{
    public $module = "";
    public $service = "";
    public $class = "";

    /**
     * System is unusable.
     *
     * @param string $action
     * @param string $message
     * @param array $context
     * @return null
     */
    public function emergency($action, $message, $content=array())
    {
        $message = "{$this->module} -> {$this->service} -> {$this->class} -> {$action} -> {$message}";
        Log::emergency($message, $content);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $action
     * @param string $message
     * @param array $context
     * @return null
     */
    public function alert($action, $message, $content=array())
    {
        $message = "{$this->module} -> {$this->service} -> {$this->class} -> {$action} -> {$message}";
        Log::alert($message, $content);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $action
     * @param string $message
     * @param array $context
     * @return null
     */
    public function critical($action, $message, $content=array())
    {
        $message = "{$this->module} -> {$this->service} -> {$this->class} -> {$action} -> {$message}";
        Log::critical($message, $content);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $action
     * @param string $message
     * @param array $context
     * @return null
     */
    public function error($action, $message, $content=array())
    {
        $message = "{$this->module} -> {$this->service} -> {$this->class} -> {$action} -> {$message}";
        Log::error($message, $content);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $action
     * @param string $message
     * @param array $context
     * @return null
     */
    public function warning($action, $message, $content=array())
    {
        $message = "{$this->module} -> {$this->service} -> {$this->class} -> {$action} -> {$message}";
        Log::warning($message, $content);
    }

    /**
     * Normal but significant events.
     *
     * @param string $action
     * @param string $message
     * @param array $context
     * @return null
     */
    public function notice($action, $message, $content=array())
    {
        $message = "{$this->module} -> {$this->service} -> {$this->class} -> {$action} -> {$message}";
        Log::notice($message, $content);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $action
     * @param string $message
     * @param array $context
     * @return null
     */
    public function info($action, $message, $content=array())
    {
        $message = "{$this->module} -> {$this->service} -> {$this->class} -> {$action} -> {$message}";
        Log::info($message, $content);
    }

    /**
     * Detailed debug information.
     *
     * @param string $action
     * @param string $message
     * @param array $context
     * @return null
     */
    public function debug($action, $message, $content=array())
    {
        $message = "{$this->module} -> {$this->service} -> {$this->class} -> {$action} -> {$message}";
        Log::debug($message, $content);
    }
}