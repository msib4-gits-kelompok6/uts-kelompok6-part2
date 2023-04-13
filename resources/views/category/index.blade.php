@extends('layouts.app')

@section('title', 'Category')

@section('content')
    <div class="categories my-5">
        <div class="text-center my-5">
            <h3>List Category</h3>
        </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <a href="{{ '/category/add' }}" class="btn btn-primary my-4" type="button">+ Tambah Category</a>
                </div>
            </div>
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    @foreach ($categories as $item)
                        <tbody>
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a href="/category/{{ $item->id }}/edit" class="btn btn-md btn-warning">Ubah</a>
                                    <a href="/category/{{ $item->id }}/delete" class="btn btn-md btn-danger">Hapus</a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
