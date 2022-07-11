<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function countries()
    {
        return Business::select('country')
            ->distinct('country')
            ->get()
            ->map(function ($bussines) {
                return $bussines->country;
            });
    }

    public function show($id)
    {
        return Business::where('id', $id)->with('owners')->get();
    }
}
