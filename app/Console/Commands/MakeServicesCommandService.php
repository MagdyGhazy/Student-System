<?php

namespace App\Console\Commands;

use App\Services\Command\FileFactoryCommandService;
use Illuminate\Console\Command;

class MakeServicesCommandService extends FileFactoryCommandService
{

    protected $signature = "make:service {name}";

    protected $description = 'this command for making service';

    public function setStubName():string
    {
        return "service";
    }
    public function setFilePath():string
    {
        return "App\\Services\\";
    }
    public function setSuffix():string
    {
        return "Service";
    }
}
