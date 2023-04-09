<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // menampilkan data category
        $data['categories'] = Category::all();
        return view('category/index', $data);
    }

    public function create(Request $request)
    {
        // ambil data category
        $data['categories'] = Category::all();

        // create data (add)
        return view('category/add', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required',
        ]);

        //menambahkan data ke database
        Category::create([
            'name' => $validated['category_name'],
        ]);

        return redirect('/category');
    }

    public function edit($id)
    {
        $data['categories'] = Category::all();
        $data['categories'] = Category::find($id);

        //create data (add)
        return view(
            'category/edit',
            $data
        );
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_name' => 'required',
        ]);

        Category::where('id', $id)->update([
            'name' => $validated['category_name'],
        ]);

        return redirect('/category');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return redirect('/category');
    }
}
