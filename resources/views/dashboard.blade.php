@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Voucher List:') }}</div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div id="warning-msg" class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">User</th>
                                <th scope="col">Expired Date</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vouchers as $voucher)
                                <tr class="@if($voucher->voucherStatus->id == 2 ||  \Carbon\Carbon::parse($voucher->expired_date) < \Carbon\Carbon::today()) alert-danger @else alert-success @endif">
                                  <th scope="row">{{$voucher->code}}</th>
                                  <td>{{$voucher->user->email}}</td>
                                  <td>{{$voucher->expired_date}}</td>
                                  <td>{{$voucher->voucherType->name}}</td>
                                  <td>{{$voucher->voucherStatus->name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        @if($vouchers->isNotEmpty())
                            {!! $vouchers->links() !!}               
                        @endif
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('view.scripts')

<script type="text/javascript">
    $(document).ready(function() {
    });
</script>

@endsection
