<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
// use App\Http\Resources\GenreResource;

class BooksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public static $wrap = 'books';
    public function toArray($request)
    {
        return [
            'id'=>$this->resource->id,
            'title'=>$this->resource->name,
            'genre'=> new GenreResource($this->resource->genre),
            'user'=> new UserResource($this->resource->user)
        ];
    }
}