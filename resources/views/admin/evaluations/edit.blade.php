@extends('admin.master')

@php
    $title = "Edit Evaluation"
@endphp

@section('title', $title)

@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="card mt-4">
        <div class="card-body">
            <h1>{{ $title }}</h1>
            <form action="{{ route('admin.evaluations.update', $evaluation) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror " value="{{ old('name', $evaluation->name) }}" />
                    @error('name')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="type">Type</label>
                    <select name="type" class="form-control @error('type') is-invalid @enderror">
                        <option @selected(old('type', $evaluation->type) == 'Student') value="Student">Student</option>
                        <option @selected(old('type', $evaluation->type) == 'Company') value="Company">Company</option>
                    </select>
                    @error('type')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <button class="btn btn-success px-5"><i class="fas fa-save"></i> Add</button>

            </form>
        </div>
    </div>
  </div>
</div>

@stop

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.1/tinymce.min.js" integrity="sha512-eV68QXP3t5Jbsf18jfqT8xclEJSGvSK5uClUuqayUbF5IRK8e2/VSXIFHzEoBnNcvLBkHngnnd3CY7AFpUhF7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    tinymce.init({
        selector: '.myeditor'
    })
</script>
@stop
