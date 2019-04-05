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
                $practicesCollection->push(['value' => Str::slug($practiceValue), 'text' => $practiceValue]);
            }
        }

        return $practicesCollection->unique()->sortBy('text');
    }    


    /********************** WIP ******/
    public function getListByCities (Collection $practicesCollection){

        $cities = $this->databaseRepo->getDatas()->pluck('city')->unique()->all();
        foreach($cities as $city)
        {
            $practicesForCity = $this->databaseRepo->getDatas()->filter( function ($item, $key) use ($city) {            
                                    return $city == $item->city;
                                } )->pluck('practices')->unique()->toArray();

            $practicesCollection->push($city);
            $practicesCollection[$city] = new Collection();
        
            foreach ($practicesForCity as $practices) {
                foreach ( $practices as $practiceValue) {
                    $practicesCollection[$city]->push(['value' => Str::slug($practiceValue), 'text' => $practiceValue]);
                }
            }
            $practicesCollection[$city] = $practicesCollection[$city]->unique()->sort();

        }

        return $practicesCollection;
    }

    
}
