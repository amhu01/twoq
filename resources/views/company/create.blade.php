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
        <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data" id="create-company-form">
            @csrf
            @foreach ($form_list as $name => $options)
                <div class="mb-3">
                    <label for="{{ $name }}" class="form-label">{{ $options['label'] }}</label>
                    <input type="{{ $options['type'] == 'image' ? 'file' : $options['type'] }}"
                        class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
                        name="{{ $name }}"> {{-- Add required attribute --}}

                    <div class="invalid-feedback" id="{{ $name }}-error"></div> {{-- Now it has an ID --}}
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Add this before the closing </head> tag -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#create-company-form').on('submit', function(e) {
                e.preventDefault(); // Prevent normal submission

                // Clear previous errors
                $('.invalid-feedback').text('');
                $('.form-control').removeClass('is-invalid');

                let formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        window.location.href = "{{ route('companies.index') }}";
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        console.log(errors);

                        for (let field in errors) {
                            $(`#${field}`).addClass('is-invalid');
                            $(`#${field}-error`).text(errors[field][
                                0
                            ]); // Correctly displays error
                        }
                    }
                });
            });
        });
    </script>
@endsection
