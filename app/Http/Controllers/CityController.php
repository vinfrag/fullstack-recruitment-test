<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\DatabaseRepositoryInterface;


class CityController extends Controller
{
    protected $databaseRepo;

    public function __construct(DatabaseRepositoryInterface $databaseRepositoryInterface)
    {
        $this->databaseRepo = $databaseRepositoryInterface;
    }

    /*
     *  API : Get the list of cities
     *  Return type : JSON
     */
    public function index () {
        return $this->databaseRepo->getDatas()->pluck('city')->unique()->sort();
    }    
}
