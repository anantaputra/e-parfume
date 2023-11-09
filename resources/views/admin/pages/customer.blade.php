@extends('admin.layouts.app')

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="d-flex justify-content-between align-items-center px-4 py-3">
            <div>Data Customers</div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 2%;">No.</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Total Purchases</th>
                                    <th class="text-center">Last Purchase Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($customers as $customer)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td>{{ ucwords($customer->name) }}</td>
                                    <td>{{ $customer->email }}</td>
                                    @php
                                        $transactions = App\Models\Transaction::where('user_id', $customer->id)->where('status', 'settlement')->get();
                                        $last_purchase = App\Models\Transaction::where('user_id', $customer->id)->where('status', 'settlement')->OrderBy('updated_at', 'DESC')->first()->updated_at;
                                        $total = $transactions->sum('gross_amount');
                                    @endphp
                                    <td class="text-right">Rp {{ number_format($total, 0, 0, '.') }}</td>
                                    <td class="text-center">{{ Carbon\Carbon::parse($last_purchase)->format('d M Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
