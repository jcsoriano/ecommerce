<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // get fields
        $data = $this->only('id', 'name', 'content', 'price', 'stock_level');

        // create URL for the photo
        $data['photo'] = Storage::url($this->photo);

        // respond
        return $data;
    }
}
