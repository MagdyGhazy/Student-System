<?php

namespace App\Services\Command;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Pluralizer;

abstract class FileFactoryCommandService extends Command
{
    protected $file;

    abstract function setStubName():string;
    abstract function setFilePath():string;
    abstract function setSuffix():string;

     public function __construct(Filesystem $filesystem)
     {
         parent::__construct();
         $this->file = $filesystem;
     }

    public function makeClassNameSingle($name)
    {
        return ucwords(Pluralizer::singular($name));
    }

    public function makeDirectory($path)
    {
        $this->file->makeDirectory($path,0777,true,true);
//        return $path;
    }

    public function stubPath()
    {
        $name = $this->setStubName();
        return __DIR__."/../../../stubs/{$name}.stub";
    }

    public function stubVariables()
    {
        $name = $this->makeClassNameSingle($this->argument('name'));
        $nameParts = explode('/', $name);
        if (count($nameParts) > 1){
            $namespace = $nameParts[0];
            $classname = $nameParts[1];

            return [
                'NAME' => $this->makeClassNameSingle($classname),
                'DIR' =>  "\\".$namespace,
            ];
        }

        return [
            'NAME' => $this->makeClassNameSingle($name),
            'DIR' => "",
        ];

    }

    public function stubContent($stubPath,$stubVariables)
    {
        $content = file_get_contents($stubPath);

        foreach ($stubVariables as $key => $replace)
        {
            $content = str_replace('$'.$key ,$replace,$content);
        }
        return $content;
    }

    protected function makePath()
    {
        $path = $this->setFilePath();
        $suffix = $this->setSuffix();
        return base_path($path).$this->makeClassNameSingle($this->argument('name'))."{$suffix}.php";
    }

    public function handle()
    {
        $path = $this->makePath();
        $this->makeDirectory(dirname($path));
        if ($this->file->exists($path))
        {
            return $this->error("{$this->setStubName()} is already exist");
        }
        $stubPath =$this->stubPath();
        $stubVariables =$this->stubVariables();
        $content = $this->stubContent($stubPath,$stubVariables);
        $this->file->put($path,$content);
       return $this->info("{$this->setStubName()} is created successfully");

    }

}
