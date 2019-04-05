<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use App\Http\Repositories\DatabaseRepositoryInterface;

class PracticeController extends Controller
{
    protected $databaseRepo;

    public function __construct(DatabaseRepositoryInterface $databaseRepositoryInterface)
    {
        $this->databaseRepo = $databaseRepositoryInterface;
    }

    /*
     *  API : Get the list of practices
     *  Return type : JSON
     */
    public function index( Collection $practicesCollection )
    {
        // We get all practices array and foreach them to push the value in a new collection
        foreach ($this->databaseRepo->getDatas()->pluck('practices')->toArray() as $practises) {
            foreach ($practises as $practiceValue) {
                $practicesCollection->push([Str::slug($practiceValue) => $practiceValue]);
            }
        }

        return $practicesCollection;
    }    

    public function getList ( $city, Collection $practicesCollection){
        // Update the data to make the test with the city
        $datas = $this->dataWithPracticeSlug($this->databaseRepo->getDatas(), $practicesCollection)
            ->map(function ($data, $key) {
                $data->city = strtolower($data->city);
            }
        );
            
        return $datas;
    }
}
