<?php

namespace App\Listeners;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Http\Request;

class QueryListener
{
    protected $request;

    /**
     * Create the event listener.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  QueryExecuted $event
     * @return void
     */
    public function handle(QueryExecuted $event)
    {
        if (config('app.debug')) {
            // 把sql  的日志独立分开
            $fileName = storage_path('logs/sql/' . date('Y-m-d') . '.log');
            $sql = str_replace("?", "'%s'", $event->sql);
            $log = vsprintf($sql, $event->bindings);
            file_put_contents($fileName,
            "---------------------------------------------------------------------------------------------------------------------------------" ."\r\n"
            ."[" . date("Y-m-d H:i:s") . "] " .$this->request->getClientIp()." ".$this->request->method()." ". $this->request->url() ." \r\n"
            . "[ SQL ] ".$log ."\r\n"
            . "[ time ] " . $event->time ." 毫秒"
            . "\r\n", FILE_APPEND);
        }
    }
}
