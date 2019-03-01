<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $all_reviews=$this->reviews();
        return [
            'name'=>$this->name,
            'stock'=>$this->stock > 0 ? $this->stock : 'Out of Stock',
            'rating'=>($all_reviews->count()>0)?round($all_reviews->sum('rating')/$all_reviews->count()):'No rating yet',
            'total_price'=>round($this->price*(1-0.01*$this->discount),2),
            'details_link'=>[
                route('products.show',['product'=>$this->id])
            ],
        ];
    }
}
