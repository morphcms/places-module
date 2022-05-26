<?php

namespace Modules\Places\Http\Controllers\Address;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Places\Models\Address;

class DeleteController extends Controller
{
    public function __invoke(Address $address): JsonResponse
    {
        // TODO: Authorize address deletion

       $address->delete();

       return new JsonResponse();
    }
}
