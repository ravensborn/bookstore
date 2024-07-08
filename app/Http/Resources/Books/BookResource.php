<?php

namespace App\Http\Resources\Books;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cover' => $this->getCoverImage(),
            'name' => $this->name,
            'description' => $this->description,
            'author' => $this->author,
            'translator' => $this->translator,
            'publish_year' => $this->publish_year,
            'cost' => $this->cost,
            'price' => $this->price,
            'stock' => $this->stock,
        ];
    }

    private function getCoverImage(): ?string {

        $image = $this->getFirstMedia('cover');

        return $image ? $image->getUrl() : null;
    }
}
