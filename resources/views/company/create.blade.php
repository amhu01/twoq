@extends('layouts.app')

@php
    $form_list = [
        'comp_name' => ['label' => 'Company Name', 'type' => 'text', 'required' => true],
        'comp_email' => ['label' => 'Company Email', 'type' => 'text', 'required' => true],
        'comp_logo' => ['label' => 'Company Logo', 'type' => 'image', 'required' => true],
        'comp_website' => ['label' => 'Company Website', 'type' => 'text', 'required' => true],
    ];
@endphp
@section('content')
    <div class="container">
        <h2>Create Company</h2>
        <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @foreach ($form_list as $name => $options)
                <div class="mb-3">
                    <label for="{{ $name }}" class="form-label">{{ $options['label'] }}</label>
                    <input type="{{ $options['type'] == 'image' ? 'file' : $options['type'] }}"
                        class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
                        name="{{ $name }}">
                    @error($name)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
