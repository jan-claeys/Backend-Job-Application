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
        return Business::where('id', $id)->with('owners')->first();
    }

    public function index(Request $request)
    {
        $countries = $request->query('countries');
        $search = $request->query('search');

        return Business::select('*')->with('owners')
            ->when($countries, function ($query) use ($countries) {
                $query->whereIn('country', $countries);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('country', 'ilike', "%{$search}%")
                        ->orWhere('name', 'ilike', "%{$search}%")
                        ->orWhere('address', 'ilike', "%{$search}%")
                        ->orWhere('city', 'ilike', "%{$search}%")
                        ->orWhere('description', 'ilike', "%{$search}%")
                        ->orWhereHas('owners', function ($query) use ($search) {
                            $query->where('name', 'ilike', "%{$search}%");
                        });
                });
            })
            ->get();
    }
}
