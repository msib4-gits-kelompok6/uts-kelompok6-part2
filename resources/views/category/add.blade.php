@extends('layouts.app')

@section('content')
    <div class="text-center my-5">
        <h3>Tambah Category</h3>
    </div>
    <!-- Create Post Form -->
    <form action="{{ url('/category') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nama Category</label>
            <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="exampleInputEmail1"
                aria-describedby="emailHelp" name="category_name">
            <div id="emailHelp" class="form-text">Tidak boleh kosong</div>
            @error('category_name')
                <div class="invalid-feedback">
                    Nama tidak boleh kosong
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah Kategori</button>
    </form>
@endsection
