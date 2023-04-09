<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        //menampilkan data product
        $data['products'] = Product::with('category')->get();
        return view('product/index', $data);
    }

    public function create(Request $request)
    {
        // ambil data category
        $data['categories'] = Category::all();

        //create data (add)
        return view(
            'product/add',
            $data
        );
    }


    public function store(Request $request)
    {
        // validasi form
        $validated = $request->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'product_category' => 'required',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|numeric',
            'image' => 'required|mimes:jpg,jpeg,png|max:5120'
        ]);

        // menyimpan foto ke dalam public/avatar
        $saveImage['image'] = Storage::putFile('public/image', $request->file('image'));

        //menambahkan data ke database
        Product::create([
            'name' => $validated['product_name'],
            'description' => $validated['product_description'],
            'category_id' => $validated['product_category'],
            'price' => $validated['product_price'],
            'stock' => $validated['product_stock'],
            'image' => $saveImage['image']
        ]);

        return redirect('/product');
    }

    public function edit($id)
    {
        $data['categories'] = Category::all();
        $data['products'] = Product::find($id);

        //create data (add)
        return view(
            'product/edit',
            $data
        );
    }

    public function update(Request $request, $id)
    {
        // mendapatkan data product
        $dataProduct = Product::findOrFail($id);

        $validated = $request->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'product_category' => 'required',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|numeric',
            'image' => 'required|mimes:jpg,jpeg,png|max:5120'
        ]);

        // cek data avatar
        if ($request->file('image')) {
            // hapus foto yang lama
            Storage::delete($dataProduct->image);

            // simpan foto yang baru
            $newImage['image'] = Storage::putFile('public/image', $request->file('image'));
        }

        // update data pada database berdasarkan id
        Product::where('id', $id)->update([
            'name' => $validated['product_name'],
            'description' => $validated['product_description'],
            'category_id' => $validated['product_category'],
            'price' => $validated['product_price'],
            'stock' => $validated['product_stock'],
            'image' => $newImage['image']
        ]);


        return redirect('/product');
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return redirect('/product');
    }
}
