<?php

namespace Modules\Places\Http\Controllers\States;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\Places\Models\Country;
use Modules\Places\Models\State;
use Modules\Places\Transformers\StateResource;
use Modules\Places\Utils\Table;

class SearchController extends Controller
{
    public function __invoke(Request $request, Country $country)
    {
        $validated = $request->validate([
            'query' => ['nullable', 'string'],
            'country' => ['sometimes', Rule::exists(Table::countries(), 'id')]
        ]);

        $country = $validated['country'] ?? null;

        $countries = State::search($validated['query'] ?? '')->query(function ($query) use ($country) {
            if ($country) {
                $query->where('country_id', $country);
            }
        })->get();


        return new JsonResponse(StateResource::collection($countries));
    }
}
