<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function AllCat(){
        // $categories = DB::table('categories')->latest()->paginate(5);

         // $categories = DB::table('categories')
        //     ->join('users', 'categories.user_id', 'user_id')
        //     ->select('categories.*', 'users.name')
        //     ->latest()->paginate(5);

        $categories = Category::latest()->paginate(5);
        $trashCat   = Category::onlyTrashed()->latest()->paginate(3);


        return view('admin.category.index', compact('categories', 'trashCat'));
    }

    public function AddCat(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:30',
        ],
        ['category_name.required' => 'Please Input Category Name',
        'category_name.max' => 'Category Less Than 5Chars',

        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'user_id'       => Auth::user()->id,
            'created_at'    => Carbon::now()
        ]);

        //Opsional syntax insert
        // $category = new Category;
        // $category->category_name = $request->caetgory_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        // Query Builder
        // $data                   = array();
        // $data['category_name']  = $request->category_name;
        // $data['user_id']        = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return redirect()->back()->with('success', 'Category Inserted Successfull');
    }

    public function Edit($id){
        // $categories = Category::find($id);
        $categories = DB::table('categories')->where('id', $id)->first();
        return view('admin.category.edit', compact('categories'));

    }

    public function Update(Request $request, $id){
        // $update = Category::find($id)->update([
        //     'category_name' => $request->category_name,
        //     'user_id'       => Auth::user()->id
        // ]);

        $data = array();
        $data['category_name']  = $request->category_name;
        $data['user_id']        = Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($data);
        return redirect()->route('all.category')->with('success', 'Category Updated Successfully');
    }

    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Category Soft Delete Successfully');
    }

    public function Restore($id){
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Category Restore Successfully');
    }

    public function Pdelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Category Permanent Deleted');
    }
}
