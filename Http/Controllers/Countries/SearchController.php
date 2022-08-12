<?php

namespace Modules\Places\Http\Controllers\Countries;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Places\Models\Country;
use Modules\Places\Transformers\CountryResource;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'query' => ['nullable', 'string'],
        ]);

        $countries = Country::search($validated['query'] ?? '')->get();

        return new JsonResponse(CountryResource::collection($countries));
    }
}
