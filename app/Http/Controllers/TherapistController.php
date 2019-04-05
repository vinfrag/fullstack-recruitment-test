<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Filesystem\Filesystem;

class TherapistController extends Controller
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

    /*
     *  API : Get the list of cities
     *  Return type : JSON
     */
    public function getCities () {
        return $this->datas->pluck('city')->unique();
    }

    /*
     *  API : Get the list of 
     *  Return type : JSON
     */
    public function getPractices()
    {
        return $this->datas->pluck('practices');
    }

    public function getTherapists ($city) {
        dd( $this->datas->where('city', $city));
        return $this->datas->where('city', $city);
    }
    
}
