<?php

namespace Modules\Places\Http\Controllers\Address;

use App\Http\Controllers\Controller;
use Modules\Places\Http\Requests\UpdateAddressRequest;
use Modules\Places\Models\Address;
use Modules\Places\Transformers\AddressResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class UpdateController extends Controller
{
    public function __invoke(Address $address, UpdateAddressRequest $request): JsonResponse
    {
        $address->update($request->validated());

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
