<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\BroadcastServiceProvider::class, // CRITICAL: Enable broadcasting!
    Modules\Rag\app\Providers\RagServiceProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
    Nwidart\Modules\LaravelModulesServiceProvider::class,
];
