<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Adds a new category to database.
     */
    public function newCategory(Request $request)
    {
        return $request->input('category');
    }
}
