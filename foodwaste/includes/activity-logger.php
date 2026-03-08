<?php
/**
 * Simple activity logger
 *
 * Usage:
 *   require_once __DIR__ . '/activity-logger.php';
 *   log_activity('user_login', 'User 5 logged in');
 */

if (!function_exists('log_activity')) {

    /**
     * Write an activity entry to the log file.
     *
     * @param string $event    Short event name / type (e.g. "login", "order_created")
     * @param string $message  Description of the activity
     * @param array  $context  Optional extra data (will be JSON-encoded)
     */
    function log_activity(string $event, string $message, array $context = []): void
    {
        // Where to store logs (you can change this path)
        $logDir  = __DIR__ . '/../logs';
        $logFile = $logDir . '/activity.log';

        // Make sure the directory exists
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }

        // Build log line
        $timestamp = date('Y-m-d H:i:s');
        $ip        = $_SERVER['REMOTE_ADDR'] ?? 'CLI';
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

        $contextStr = '';
        if (!empty($context)) {
            $contextStr = ' | context=' . json_encode($context, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }

        $line = sprintf(
            "[%s] event=%s | ip=%s | ua=%s | message=%s%s%s",
            $timestamp,
            $event,
            $ip,
            $userAgent,
            $message,
            $contextStr,
            PHP_EOL
        );

        // Append to the log file
        file_put_contents($logFile, $line, FILE_APPEND | LOCK_EX);
    }
}
