<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\ApiResponse;
use App\Helpers\Error;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ApiResponse
     */
    public function index()
    {
        return ApiResponse::success(Category::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ApiResponse
     */
    public function show($id)
    {
        $category = Category::with('songs')->find($id);

        if ($category) {
            return ApiResponse::success($category);
        } else {
            return ApiResponse::error(new Error('cat404'));
        }
    }
}
