<?php

namespace Modules\Places\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'name' => $this->name,
            'iso3' => $this->iso3,
            'iso2' => $this->iso2,
            'phonecode' => $this->phonecode,
            'capital' => $this->capital,
            'currency' => $this->currency,
            'native' => $this->native,
            'emoji' => $this->emoji,
            'emoji_u' => $this->emoji_u,
        ];
    }
}
