<?php

namespace Modules\Places\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class StateResource extends JsonResource
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
            'country' => $this->whenLoaded('country', fn () => new CountryResource($this->country)),
            'name' => $this->name,
            'code' => $this->code,
        ];
    }
}
