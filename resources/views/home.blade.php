@extends('layouts.app')

@section('content')
    <div class="products my-5">
        <div class="text-center my-5">
            <h3>
                List Product
            </h3>
        </div>
        <div class="container">
            <div class="row">
                <table class="table table-bordered border-primary">
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
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-warning" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td><img src="{{ Storage::url($product->image) }}" style="width: 5rem;"></td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <form action="{{ route('add_toCart', $product->id) }}" method="post">
                                        @csrf
                                        <input type="number" name="qty" value="1">
                                        <button class="btn btn-success" type="submit">Add to Cart</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
