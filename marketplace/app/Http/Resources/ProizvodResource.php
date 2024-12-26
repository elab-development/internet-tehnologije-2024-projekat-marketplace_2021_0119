<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProizvodResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
     
    
     
     public static $wrap = "proizvod";
    public function toArray(Request $request): array
    {
        return [
            //"id"=> $this->resource->id,
            "naziv"=> $this->resource->naziv,
            "cena"=> $this->resource->cena,
        ];
    }
}
