@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Installment Plan Details</h1>
            <a href="{{ route('admin.installments.index') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                Back to Plans
            </a>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">User</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $plan->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $plan->user->email }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Property</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $plan->property->title }}</div>
                                <div class="text-sm text-gray-500">Total Price: ${{ number_format($plan->total_amount, 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Balance Due</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    ${{ number_format($plan->balance_due, 2) }}</div>
                                <div class="text-xs font-weight-bold text-gray-500 text-uppercase mb-1">Status:
                                    {{ ucfirst($plan->status) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Installments List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Due Date</th>
                                <th>Amount Due</th>
                                <th>Amount Paid</th>
                                <th>Status</th>
                                <th>Paid At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plan->installments as $key => $installment)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $installment->due_date->format('M d, Y') }}</td>
                                    <td>${{ number_format($installment->amount_due, 2) }}</td>
                                    <td>${{ number_format($installment->amount_paid, 2) }}</td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $installment->status == 'paid' ? 'success' : ($installment->status == 'overdue' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($installment->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $installment->paid_at ? $installment->paid_at->format('M d, Y H:i') : '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
