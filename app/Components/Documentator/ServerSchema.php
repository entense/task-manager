<?php

namespace App\Components\Documentator;

use OpenApi\Processors\ProcessorInterface;
use OpenApi\{Analysis, Annotations as OAT};

class ServerSchema implements ProcessorInterface
{
    public function __invoke(Analysis $analysis)
    {
        $config = config('l5-swagger.documentations.default.api');

        $analysis->openapi->info = new OAT\Info([
            'title' => $config['title'],
            'version' => $config['version'],
        ]);

        $analysis->openapi->servers = [];

        if (app()->app->isLocal() && $config['local_host']) {
            $analysis->openapi->servers[] = new OAT\Server([
                'url' => $config['local_host'],
                'description' => __('Local Test Host'),
            ]);
        }

        $analysis->openapi->servers[] = new OAT\Server([
            'url' => $config['production_host'],
            'description' => __('Production Host'),
        ]);
    }
}
