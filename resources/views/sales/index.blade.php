@extends('layouts.app', ['page' => 'Sales', 'pageSlug' => 'sales', 'section' => 'transactions'])

@section('content')
    @include('alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Penjualan</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('sales.create') }}" class="btn btn-sm btn-primary">Daftar Penjualan</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table">
                            <thead>
                                <th>Tanggal</th>
                                <th>Klien</th>
                                <th>Pengguna</th>
                                <th>Produk</th>
                                <th>Total Persediaan</th>
                                <th>Jumlah Total</th>
                                <th>Keadaan</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td>{{ date('d-m-y', strtotime($sale->created_at)) }}</td>
                                        <td><a href="{{ route('clients.show', $sale->client) }}">{{ $sale->client->name }}<br>{{ $sale->client->document_type }}-{{ $sale->client->document_id }}</a></td>
                                        <td>{{ $sale->user->name }}</td>
                                        <td>{{ $sale->products->count() }}</td>
                                        <td>{{ $sale->products->sum('qty') }}</td>
                                        <td>{{ format_money($sale->transactions->sum('amount')) }}</td>
                                        <td>
                                            @if (!$sale->finalized_at)
                                                <span class="text-danger">Untuk Diselesaikan</span>
                                            @else
                                                <span class="text-success">Diselesaikan</span>
                                            @endif
                                        </td>
                                        <td class="td-actions text-right">
                                            @if (!$sale->finalized_at)
                                                <a href="{{ route('sales.show', ['sale' => $sale]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Sale">
                                                    <i class="tim-icons icon-pencil"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('sales.show', ['sale' => $sale]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="View Sale">
                                                    <i class="tim-icons icon-zoom-split"></i>
                                                </a>
                                            @endif
                                            <form action="{{ route('sales.destroy', $sale) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete Sale" onclick="confirm('Are you sure you want to delete this sale? All your records will be permanently deleted.') ? this.parentElement.submit() : ''">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $sales->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
