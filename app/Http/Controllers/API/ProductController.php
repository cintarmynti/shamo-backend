<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function all(Request $request){
        $id = $request->input('id');
        $limit = 6;
        $name = $request->input('name');
        $description = $request->input('description');
        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');
        $tags = $request->input('tags');
        $categories = $request->input('categories_id');

        if($id){
            // dd($id);
            $product = Product::with(['category', 'gallery'])->find($id);
            if($product){
                return ResponseFormatter::success($product, 'Data produk berhasil diambil');
            }else{
                return ResponseFormatter::error(
                    null, 'Data produk, tidak ada',
                    404
                );
            }
        }

        $product =  Product::with(['category', 'gallery']);
        if($name){
            $product->where('name', 'Like', '%' . $name . '%');
        }

        if($description){
            $product->where('descrption', 'Like', '%' . $description . '%');
        }

        if($tags){
            $product->where('tags', 'Like', '%' . $tags . '%');
        }

        if($price_from){
            $product->where('price', '>=', $price_from);
        }

        if($price_to){
            $product->where('price', '<=', $price_to);
        }

        if($categories){
            $product->where('categories_id', $categories);
        }

        return ResponseFormatter::success(
            $product->paginate($limit),
            'Data produk berhasil diambil'
        );

   }
}


