@extends('layouts.app')

@section('title', 'Transaction - Detail')

@section('content')
    <div class="transactions my-5">
        <div class="text-center my-5">
            <h3>
                Detail Transaction
            </h3>
        </div>
        <div class="container">
            <div class="row">
                @php
                    $total_price = 0;
                @endphp
                <div class="col">
                    <div class="card p-3">
                        <h5 class="mb-2">Transaksi</h5>
                        <p>Tanggal & Waktu : {{ $transaction->created_at }}</p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Barang</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
                                </tr>
                            </thead>
                            @foreach ($transaction->transaction_details as $item)
                                <tbody>
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->product->price }}</td>
                                        <td>{{ $item->qty }} Pcs</td>
                                    </tr>
                                    @php
                                        $total_price += $item->product->price * $item->qty;
                                    @endphp
                            @endforeach
                            </tbody>
                        </table>

                        <p class="fw-bold text-center">Total: Rp. {{ $total_price }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
