<?php

namespace Modules\Places\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Places\Models\Address;

/**
 * @mixin Address
 */
class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'title' => $this->title,
            'description' => $this->description,
            'country' => $this->whenLoaded('country', fn() => new CountryResource($this->country)),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'company_name' => $this->company_name,
            'line_one' => $this->line_one,
            'line_two' => $this->line_two,
            'city' => $this->whenLoaded('city', fn() => new StateResource($this->city)),
            'state' => $this->state,
            'postcode' => $this->postcode,
            'delivery_instructions' => $this->delivery_instructions,
            'contact_phone' => $this->contact_phone,
            'shipping_default' => $this->shipping_default,
            'billing_default' => $this->billing_default,
            'meta' => $this->meta,
        ];
    }
}
