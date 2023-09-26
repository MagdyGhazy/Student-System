<?php

namespace App\Console\Commands;

use App\MainClasses\Command\FileFactoryCommand;
use Illuminate\Console\Command;

class MakeServicesCommand extends FileFactoryCommand
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
