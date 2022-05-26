<?php

namespace Modules\Places\Http\Controllers\Address;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Places\Models\Address;
use Modules\Places\Transformers\AddressResource;

class ShowController extends Controller
{
    public function __invoke(Address $address)
    {
        // TODO: Authorize address viewing

        return new JsonResponse([
            'address' => new AddressResource($address),
        ]);
    }
}
