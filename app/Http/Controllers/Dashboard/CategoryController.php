<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\FileUploder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\CategoryStoreRequest;
use App\Http\Requests\Dashboard\Category\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->ajax());
        if ($request->ajax()) {
            $data = Category::with('parent')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        return view('dashboard.categories.action', compact('row'));
                    })
                    ->addColumn('main_category', function ($row) {
                        return $row->parent->name ?? "#######";
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $categories = Category::with('parent')->get();

        $title = 'الاقسام الرئيسية';
       
        
        return view('dashboard.categories.index', compact('categories', 'title'));
    }

    public function indexSubCategories(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::SubCategories()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        return view('dashboard.categories.action', compact('row'));
                    })
                    ->addColumn('main_category', function ($row) {
                        return $row->parent->name ?? "#######";
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $categories = Category::SubCategories()->get();

        
 
        $title = 'الاقسام الفرعية';

        return view('dashboard.categories.index', compact('categories', 'title'));
    }


    public function store(CategoryStoreRequest $request)
    {
        $image =  FileUploder::uploadOneImage($request, 'categories');
       
        Category::create([
            'name' =>$request->name,
            'image' => $image,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id
        ]);

        toastr()->success('بنجاح', 'تم حفظ البيانات');

        return back();
    }

    public function edit(Category $category)
    {
        $parents = Category::whereNull('parent_id')->get();
        return view('dashboard.categories.edit', compact('category', 'parents'));
    }


    public function update(CategoryUpdateRequest $request, Category $category)
    {
        // dd($request->all());
        $image = null;
        if ($request->has('image')) {
            $image = FileUploder::uploadOneImage($request, 'categories');
        }

        $category->update([
            'name' =>$request->name,
             'image' => $image ?? $category->image,
             'slug' => Str::slug($request->name),
             'parent_id' => $request->parent_id
        ]);

        toastr()->success('بنجاح', 'تم تعديل البيانات');
        return to_route('categories.index');
    }
}
