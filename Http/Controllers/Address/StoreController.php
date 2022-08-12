<?php

namespace Modules\Places\Http\Controllers\Address;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Places\Http\Requests\StoreAddressRequest;
use Modules\Places\Models\Address;
use Modules\Places\Transformers\AddressResource;

class StoreController extends Controller
{
    public function __invoke(StoreAddressRequest $request)
    {
        $address = $request->user()
            ->addresses()
            ->create($request->validated());

        if ($address->shipping_default) {
            Address::query()->whereNot('id', $address->id)->update(['shipping_default' => false]);
        }

        if ($address->billing_default) {
            Address::query()->whereNot('id', $address->id)->update(['billing_default' => false]);
        }

        if ($address->shipping_default && $address->billing_default) {
            Address::query()->whereNot('id', $address->id)->update(['shipping_default' => false, 'billing_default' => false]);
        } else {
            if ($address->shipping_default) {
                Address::query()->whereNot('id', $address->id)->update(['shipping_default' => false]);
            }

            if ($address->billing_default) {
                Address::query()->whereNot('id', $address->id)->update(['billing_default' => false]);
            }
        }

        return new JsonResponse(['address' => new AddressResource($address)]);
    }
}
