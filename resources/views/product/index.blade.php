@extends('layouts.app')

@section('title', 'Product')

@section('content')
    <div class="products my-5">
        <div class="text-center my-5">
            <h3>
                List Product
            </h3>
        </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <a href="{{ '/product/add' }}" class="btn btn-primary my-4" type="butoon">+ Tambah Produk</a>
                </div>
            </div>
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td><img src="{{ Storage::url($product->image) }}" style="width: 5rem;"></td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <a href="/product/{{ $product->id }}/edit" class="card-link text-warning">Ubah</a>
                                    <a href="/product/{{ $product->id }}/delete" class="card-link text-danger">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
