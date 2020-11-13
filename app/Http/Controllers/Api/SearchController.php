<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Houses;
use Illuminate\Http\JsonResponse as JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function find(Request $request)
    {
        $q = Houses::where('id', '>', 0);

        $request->whenFilled('name', function ($input) use (&$q) {
            $q->whereRaw("LOWER(`name`) LIKE '%" . strtolower($input) . "%'");
        });

        foreach (['bedrooms', 'bathrooms', 'storeys',  'garages'] as $exactMatchKey) {
            $request->whenFilled($exactMatchKey, function ($input) use (&$q, $exactMatchKey) {
                $q->where($exactMatchKey, $input);
            });
        }

        $request->whenFilled('price', function ($input) use (&$q) {
            $q->whereBetween('price', [$input[0], $input[1]]);
        });

        return response()->json([
            'success' => true,
            'data' => $q->paginate(2)
        ]);
    }
}
