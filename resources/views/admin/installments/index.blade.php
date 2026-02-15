@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <h1 class="h3 mb-0 text-gray-800">Installment Plans</h1>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Plans</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Property</th>
                                <th>Total Amount</th>
                                <th>Balance Due</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th>Start Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plans as $plan)
                                <tr>
                                    <td>{{ $plan->user->name }}</td>
                                    <td>{{ $plan->property->title }}</td>
                                    <td>${{ number_format($plan->total_amount, 2) }}</td>
                                    <td>${{ number_format($plan->balance_due, 2) }}</td>
                                    <td>{{ $plan->duration_months }} Months</td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $plan->status == 'completed' ? 'success' : ($plan->status == 'defaulted' ? 'danger' : 'info') }}">
                                            {{ ucfirst($plan->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $plan->start_date->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.installments.show', $plan->id) }}"
                                            class="btn btn-sm btn-primary">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $plans->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
