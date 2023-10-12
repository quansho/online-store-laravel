<?php

namespace App\Mediators;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;


abstract class Mediator
{
    public function __construct(protected array $handlers = [])
    {
        $this->registerSelfCommands();
    }

    abstract function registerSelfCommands();
    public function registerHandler($commandOrQueryClass, $handlerClass): void
    {
        $this->handlers[$commandOrQueryClass] = $handlerClass;
    }

    public function dispatch($commandOrQuery)
    {
        $handlerClass = $this->handlers[get_class($commandOrQuery)] ?? null;

        if (!$handlerClass) {
            throw new \RuntimeException("Handler not found for " . get_class($commandOrQuery));
        }

        $handler = App::make($handlerClass);

        try {
            return $handler->handle($commandOrQuery);
        } catch (\Exception $e) {
            Log::error("Error handling " . get_class($commandOrQuery) . ": " . $e->getMessage());
        }
    }
}
