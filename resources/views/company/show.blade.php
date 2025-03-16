@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <!-- Logo Section -->
                <div class="card-header bg-primary text-white text-center py-4">
                    @if ($company->comp_logo)
                        <img src="{{ asset('storage/' . $company->comp_logo) }}" alt="Company Logo" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 150px; height: 150px; margin: 0 auto;">
                            <p class="text-muted mb-0">No Logo</p>
                        </div>
                    @endif
                    <h3 class="mt-3 mb-0">{{ $company->comp_name }}</h3>
                </div>

                <!-- Details Section -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Email:</div>
                        <div class="col-md-8">{{ $company->comp_email }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Website:</div>
                        <div class="col-md-8">
                            <a href="{{ $company->comp_website }}" target="_blank">{{ $company->comp_website }}</a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Created By:</div>
                        <div class="col-md-8">
                            {{ $company->createdBy->name ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Created At:</div>
                        <div class="col-md-8">{{ $company->created_at->format('M d, Y H:i A') }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Updated At:</div>
                        <div class="col-md-8">{{ $company->updated_at->format('M d, Y H:i A') }}</div>
                    </div>
                </div>

                <!-- Footer Section -->
                <div class="card-footer bg-light">
                    <a href="{{ route('companies.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
