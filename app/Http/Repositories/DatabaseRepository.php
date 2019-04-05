<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Filesystem\Filesystem;

class DatabaseRepository implements DatabaseRepositoryInterface
{
    protected $files;
    protected $datas;

    public function __construct(Filesystem $files)
    {
        $this->files = $files;
        $this->datas = $this->collectJsonData();
    }

    /*
     *  Get the Json Database file, extract the content and return a Collection
     *  Return Type: Eloquent Collection
     */
    public function collectJsonData () {
        // Open the json data file
        $path = config('jsondatabase.file.path');
        if (!$this->files->exists($path)) throw new NotFoundHttpException();
        $fileContent = $this->files->get($path);

        // Convert array extract from json file to eloquent collection 
        $datas = collect(json_decode($fileContent));

        return $datas;
    }    

    public function getDatas () {
        return $this->datas;
    }
     
}
