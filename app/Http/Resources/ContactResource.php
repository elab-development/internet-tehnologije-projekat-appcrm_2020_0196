<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    public static $wrap = 'contact';

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->full_name,
            'email' => $this->email,
            'company' => new CompanyResource($this->whenLoaded('company')),
        ];
    }
}
