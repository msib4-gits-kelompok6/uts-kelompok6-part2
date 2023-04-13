@extends('layouts.app')

@section('title', 'Transaction - List ')

@section('content')
    <div class="transactions my-5">
        <div class="text-center my-5">
            <h3>
                Transaction List
            </h3>
        </div>
        <div class="container">
            <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 g-4">
                @foreach ($transactions as $transaction)
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Transaksi</h5>
                                <h6 class="card-subtitle mb-2 text-muted">ID : {{ $transaction->id }}</h6>
                                <p class="card-text">Tanggal & Waktu : {{ $transaction->created_at }}</p>
                                <a href="{{ route('show_detail', $transaction) }}" class="card-link">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
