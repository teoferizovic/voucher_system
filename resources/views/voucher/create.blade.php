@extends('layout')
  
@section('content')
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if(session('error'))  
                            <div id="warning-msg" class="alert alert-danger alert-block">   
                                <strong>{{session('error')}}</strong>
                            </div>
                        @endif
                        <form action="{{ route('voucher.post') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input type="text" id="name" class="form-control" value="{{ auth()->user()->email }}" name="name"  disabled>
                                    <input type="hidden" value="{{auth()->user()->id}}" name="user_id">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Voucher Type</label>
                                <div class="col-md-6">
                                    <select id="voucher-type" name="type_id" class="form-control" required>
                                        <option value="">-- Select Voucher Type --</option>
                                            @foreach ($voucherTypes as $data)
                                                <option value="{{$data->id}}">
                                                    {{$data->name}}
                                                </option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection