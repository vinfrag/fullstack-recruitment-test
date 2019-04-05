<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Repositories\DatabaseRepositoryInterface;


class TherapistController extends Controller
{
    protected $databaseRepo;

    public function __construct(DatabaseRepositoryInterface $databaseRepositoryInterface)
    {
        $this->databaseRepo = $databaseRepositoryInterface;
    }

    /*
    *  API : Get the list of therapists
    *  Return type : JSON
    */

    public function index()
    {
        return$this->databaseRepo->getDatas();
    }

     /*
     *  API : Get the list of therapists for a city and a practice
     *  Return type : JSON
     */
    public function getList ($city, $practice) {
        // Update the data to make the test with the city and practises
        $datas = $this->databaseRepo->getDatas()
            ->filter(function ( $data, $key) use ($city) {
                return $city == strtolower( $data->city);
            })
            ->map( function ($data, $key) {
                // Create new entry to add the practices slug
                $data->practicesSlug = collect($data->practices)->map(function ($item, $key) {
                    return Str::slug($item);
                })->toArray();
                return $data;
            });

        // Get the datas for the city and the good practice slug
        $datas = $datas->filter( function ($item, $key) use ($practice) { 
            return in_array($practice, $item->practicesSlug);
        });
           
        return $datas;
    }
    
}
