<?php

namespace App\Models;

use App\Http\Resources\CartResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    /**
     * @param User|null $user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public static function getPersonalCart(User $user = null){
        if (empty($user)){
            $user=Auth::user();
        }
        return CartResource::collection(Cart::query()->where('user_id', $user->id)
            ->get()->all());
    }

    public static function destroyPersonalCart(User $user = null){
        if (empty($user)){
            $user=Auth::user();
        }
        Cart::query()->where('user_id', $user->id)
            ->delete();
        return CartResource::collection(Cart::query()->where('user_id', $user->id)
            ->get()->all());
    }

    public function Carts(){
        return $this->belongsToMany(Cart::class, 'carts', 'user_id', 'product_id');
    }

    public function applyCartById($cartId=''){

        Cart::updateOrCreate([
            'user_id' => $this->id,
            'product_id' => Cart::firstOrCreate(['id' => $cartId])->id,
        ]);
    }

}
