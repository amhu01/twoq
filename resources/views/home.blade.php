@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">{{ __('Welcome to Your Dashboard') }}</h4>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="text-center mb-4">
                            <h2 class="display-6">{{ __('Hello, ') }}{{ Auth::user()->name }}!</h2>
                            <p class="lead">{{ __('You are now logged in.') }}</p>
                        </div>

                        <div class="d-grid gap-3">
                            <a href="{{ route('companies.index') }}" class="btn btn-lg btn-outline-primary">
                                <i class="fas fa-building me-2"></i> {{ __('Go to Company Index') }}
                            </a>
                            @if (auth()->user()->is_admin)
                                <a href="{{ route('companies.create') }}" class="btn btn-lg btn-outline-success">
                                    <i class="fas fa-plus-circle me-2"></i> {{ __('Create Company') }}
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- <div class="card-footer bg-light text-muted text-center">
                        <small>{{ __('Last login: ') }}{{ Auth::user()->last_login_at ?? 'N/A' }}</small>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
