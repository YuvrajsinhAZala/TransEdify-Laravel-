@extends('layouts.student')

@section('title', 'My Fees')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">My Fees</h2>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if($fees->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fees as $fee)
                                    <tr>
                                        <td>{{ $fee->created_at->format('M d, Y') }}</td>
                                        <td>{{ $fee->description ?? 'Fee Payment' }}</td>
                                        <td><strong>${{ number_format($fee->amount, 2) }}</strong></td>
                                        <td>
                                            @if($fee->status === 'paid')
                                                <span class="badge bg-success">Paid</span>
                                            @else
                                                <span class="badge bg-warning">Unpaid</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        @php
                            $totalFees = $fees->sum('amount');
                            $paidFees = $fees->where('status', 'paid')->sum('amount');
                            $unpaidFees = $fees->where('status', 'unpaid')->sum('amount');
                        @endphp
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6>Total Fees</h6>
                                        <h4>${{ number_format($totalFees, 2) }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-success text-white">
                                    <div class="card-body">
                                        <h6>Paid</h6>
                                        <h4>${{ number_format($paidFees, 2) }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-warning">
                                    <div class="card-body">
                                        <h6>Unpaid</h6>
                                        <h4>${{ number_format($unpaidFees, 2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info">
                        <p class="mb-0">No fee records found.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

