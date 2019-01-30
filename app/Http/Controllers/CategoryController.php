<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Adds a new category to database.
     */
    public function newCategory(Request $request)
    {
        $this->validate($request, [
            'category' => 'required'
        ]);

        // return 'validation passed';

        $category = new Category;
        $category->category = $request->input('category');
        $category->save();
        return redirect('/category')->with('response', 'Successfully Created.');
    }
}
