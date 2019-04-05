<?php

namespace App\Http\Repositories;

interface DatabaseRepositoryInterface
{
    /*
     *  Get the Json Database file, extract the content and return a Collection
     *  Return Type: Eloquent Collection
     */
    public function collectJsonData ();

    public function getDatas ();
     
}
