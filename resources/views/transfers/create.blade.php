@extends('layouts.app', ['page' => 'Register Transfer', 'pageSlug' => 'transfers', 'section' => 'transactions'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Daftar Pemindahan</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('transfer.index') }}" class="btn btn-sm btn-primary">
                                Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('transfer.store') }}" autocomplete="off">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">Informasi Pemindahan</h6>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-title">Judul</label>
                                <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="Title" value="{{ old('title') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'title'])
                            </div>
                            <div class="form-group{{ $errors->has('sender_method_id') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-method">Metode Pengirim</label>
                                <select name="sender_method_id" id="input-method" class="form-select form-control-alternative{{ $errors->has('sender_method_id') ? ' is-invalid' : '' }}" required>
                                    @foreach ($methods as $payment_method)
                                        @if($payment_method['id'] == old('sender_method_id'))
                                            <option value="{{$payment_method['id']}}" selected>{{$payment_method['name']}}</option>
                                        @else
                                            <option value="{{$payment_method['id']}}">{{$payment_method['name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @include('alerts.feedback', ['field' => 'sender_method_id'])
                            </div>
                            <div class="form-group{{ $errors->has('receiver_method_id') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-method">Metode Penerima</label>
                                <select name="receiver_method_id" id="input-method" class="form-select2 form-control-alternative{{ $errors->has('receiver_method_id') ? ' is-invalid' : '' }}" required>
                                    @foreach ($methods as $payment_method)
                                        @if($payment_method['id'] == old('receiver_method_id'))
                                            <option value="{{$payment_method['id']}}" selected>{{$payment_method['name']}}</option>
                                        @else
                                            <option value="{{$payment_method['id']}}">{{$payment_method['name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @include('alerts.feedback', ['field' => 'receiver_method_id'])
                            </div>
                            <div class="form-group{{ $errors->has('sended_amount') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-sended_amount">Jumlah Pengirim</label>
                                <input type="number" step=".01" name="sended_amount" id="input-sended_amount" class="form-control form-control-alternative" placeholder="Amount Sent" value="{{ old('sended_amount') }}" min="0" required>
                                @include('alerts.feedback', ['field' => 'amount'])
                            </div>
                            <div class="form-group{{ $errors->has('received_amount') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-received_amount">Jumlah Penerima</label>
                                <input type="number" step=".01" name="received_amount" id="input-received_amount" class="form-control form-control-alternative" placeholder="Amount Received" value="{{ old('received_amount') }}" min="0" required>
                                @include('alerts.feedback', ['field' => 'received_amount'])
                            </div>
                            <div class="form-group{{ $errors->has('reference') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-reference">Referensi</label>
                                <input type="text" name="reference" id="input-reference" class="form-control form-control-alternative{{ $errors->has('reference') ? ' is-invalid' : '' }}" placeholder="Reference" value="{{ old('reference') }}">
                                @include('alerts.feedback', ['field' => 'reference'])
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        new SlimSelect({
            select: '.form-select'
        })
        new SlimSelect({
            select: '.form-select2'
        })
    </script>
@endpush('js')