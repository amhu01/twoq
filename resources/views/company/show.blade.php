@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ $company->comp_name }}</h4>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Company Name:</div>
                        <div class="col-md-8">{{ $company->comp_name }}</div>
                    </div>

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
                        <div class="col-md-4 fw-bold">Logo:</div>
                        <div class="col-md-8">
                            @if ($company->comp_logo)
                                <img src="{{ asset('storage/' . $company->comp_logo) }}" alt="Company Logo" class="img-thumbnail" width="150">
                            @else
                                <p class="text-muted">No logo available.</p>
                            @endif
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
