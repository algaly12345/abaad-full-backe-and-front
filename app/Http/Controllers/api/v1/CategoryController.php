<?php

namespace App\Http\Controllers\api\v1;


use App\Helpers\EstateLogic;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function get_categories()
    {
        try {
            $categories = Category:: get();
            return response()->json(EstateLogic::category_data_formatting($categories, true), 200);
//            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }
}
