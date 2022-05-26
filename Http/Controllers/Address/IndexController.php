<?php

namespace Modules\Places\Http\Controllers\Address;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Places\Transformers\AddressResource;
use function view;

class IndexController extends Controller
{
   public function __invoke(Request $request)
   {
       $addresses = $request->user()->addresses()->with([
           'country',
           'city'
       ])->get();

       return new JsonResponse(['addresses' => AddressResource::collection($addresses)]);
   }
}
