<?php

namespace App\Http\Controllers;

use Auth;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'name'        => $request->input('name'),
            'description' => $request->input('description'),
            'user_id'     => Auth::user()->id,
            ]);

        if (! is_null($category)) {
            return redirect('/dashboard/category/add')->with(
                'status', 
                'Sucessfully created!'
                );
        } 

        return redirect('/dashboard/category/add')->with(
            'status', 
            'Oops! Something went wrong!'
            );
    }

    public function updateCategory(CategoryRequest $request, $id)
    {
        $category = Category::getCategoryById($id)
        ->update([
            'name'        => $request->input('name'),
            'description' => $request->input('description'),
            ]);

        if (! is_null($category)) {
            return redirect('/dashboard/category/view');
        } 

        return redirect('/dashboard/category/edit'.$id)->with(
            'status', 
            'Oops! Something went wrong!'
        );
    }

    public function getCategory($id)
    {
        $category = Category::getCategoryById($id)
        ->get()
        ->first();

        if (is_null($category)) {
            return redirect('/dashboard/category/add')->with(
                'status', 
                'Oops! Category does not exist!'
                );
        }

        return view('dashboard.pages.view_video_category', compact('category'));
    }

    public function viewAllCategories()
    {
        $user_id = Auth::user()->id;

        $categories = Category::getCategoriesByUserId($user_id)
        ->orderBy('id', 'asc')
        ->paginate(10);

        $pendingCategories = Category::allTrashedCategories($user_id)
        ->paginate(10);

        return view('dashboard.pages.list_video_categories', compact(
            'categories', 
            'pendingCategories'
        ));

    }

    public function changeCategoryStatus(Request $request, $id) {
        $category = null;

        if ($request->input('status') == 0) {
            $category = Category::setCategoryStatus($id)
            ->delete();
            
        } else {
            $category = Category::setCategoryStatus($id)
            ->restore();
        }
        
        if (! is_null($category)) {
            return [
            'statuscode' => 200, 
            'message' => 'Operation Successfully'
            ];
        }

        return [
        'statuscode' => 404, 
        'message' => 'Invalid Category ID!'
        ];
    }

}
