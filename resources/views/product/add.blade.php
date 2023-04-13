@extends('layouts.app')

@section('title', 'Product - Add')

@section('content')
    <div class="text-center my-5">
        <h3>Tambah Product</h3>
    </div>
    <!-- Create Post Form -->
    <form action="{{ url('/product') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
            <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="exampleInputEmail1"
                aria-describedby="emailHelp" name="product_name">
            <div id="emailHelp" class="form-text">Nama roduk tidak boleh lebih dari 255 karakter</div>
            @error('product_name')
                <div class="invalid-feedback">
                    Nama tidak boleh kosong
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Deskripsi</label>
            <input type="text" class="form-control @error('product_description') is-invalid @enderror"
                id="exampleInputPassword1" name="product_description">
            @error('product_description')
                <div class="invalid-feedback">
                    Deskripsi tidak boleh kosong
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Harga</label>
            <input type="number" class="form-control @error('product_price') is-invalid @enderror"
                id="exampleInputPassword1" name="product_price">
            @error('product_price')
                <div class="invalid-feedback">
                    Harga tidak boleh kosong
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Stock</label>
            <input type="number" class="form-control @error('product_stock') is-invalid @enderror"
                id="exampleInputPassword1" name="product_stock">
            @error('product_stock')
                <div class="invalid-feedback">
                    Stock tidak boleh kosong
                </div>
            @enderror
        </div>
        <select class="form-select @error('product_category') is-invalid @enderror" aria-label="Default select example"
            name="product_category">
            <option selected>Pilih Category</option>
            @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        @error('product_category')
            <div class="invalid-feedback">
                Kategori tidak boleh kosong
            </div>
        @enderror
        <div class="my-3">
            <div class="input-group">
                <input type="file" class="form-control" id="image" name="image">
            </div>
        </div>


        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
@endsection
