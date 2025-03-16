@extends('layouts.app')

@php
    $form_list = [
        'comp_name' => ['label' => 'Company Name', 'type' => 'text', 'required' => true],
        'comp_email' => ['label' => 'Company Email', 'type' => 'text', 'required' => true],
        'comp_logo' => ['label' => 'Company Logo', 'type' => 'image', 'required' => false], // Logo is optional when editing
        'comp_website' => ['label' => 'Company Website', 'type' => 'text', 'required' => true],
    ];
@endphp

@section('content')
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p id="successMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h2>Edit Company</h2>
        <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data" id="edit-company-form">
            @csrf
            @method('PUT') {{-- Use PUT for updates --}}
            <input type="hidden" value="{{ $company->id }}" name="id">
            <input type="hidden" value="{{ $company->created_by }}" name="created_by">
            @foreach ($form_list as $name => $options)
                <div class="mb-3">
                    <label for="{{ $name }}" class="form-label">{{ $options['label'] }}</label>

                    @if ($options['type'] === 'image')
                        <input type="file" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}">
                        @if ($company->$name)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $company->$name) }}" alt="Current Logo" class="img-thumbnail" width="150">
                            </div>
                        @endif
                    @else
                        <input type="{{ $options['type'] }}" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
                            name="{{ $name }}" value="{{ old($name, $company->$name) }}">
                    @endif

                    <div class="invalid-feedback" id="{{ $name }}-error"></div>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#edit-company-form').on('submit', function(e) {
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
                        if (response.success) {
                            // Set the success message in the modal
                            $('#successMessage').text(response.message);

                            // Show the modal
                            $('#successModal').modal('show');

                            // Redirect to the index page after the modal is closed
                            $('#successModal').on('hidden.bs.modal', function() {
                                window.location.href = "{{ route('companies.index') }}";
                            });
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        for (let field in errors) {
                            $(`#${field}`).addClass('is-invalid');
                            $(`#${field}-error`).text(errors[field][0]);
                        }
                    }
                });
            });
        });
    </script>

@endsection

@section('scripts')
@endsection
