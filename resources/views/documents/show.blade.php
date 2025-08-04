@extends ('layouts.main-layout')
@section('title', 'View Document')
@section('documents-active', 'active')

@section('content')

    @if ($document)
        <div class="container mt-5">
            <label for="" class="fw-bold">ID ({{$document->id}})</label>
            <h3 class="bg-secondary text-light p-2 rounded text-center">{{ $document->name }}</h1>
            <label for="" class="fw-bold">Category </label>
            <h6 class="bg-secondary text-light p-2 rounded text-center">{{$document->category_name}}</h6>
            <label for="" class="fw-bold">Description</label>
            <div class="bg-light p-2 rounded">
                {{ $document->description }}
            </div>
            <hr>
            <label for="" class="fw-bold">Files ({{ $document->files_count }})</label>
            {{-- files --}}
            <div class="d-flex flex-wrap gap-3">
                @foreach ($document->files as $file)
                    <a href="{{ asset($storage . $file->file )}}">
                        <img src="{{ asset($storage . $file->file )}}" alt="" style="width: 150px; height: 150px; object-fit: cover;">
                    </a>
                @endforeach
            </div>
            {{-- /files --}}
        </div>
    @else
        <div class="container mt-5">
            <h3 class="bg-secondary text-light p-2 rounded text-center">Document not found</h3>
        </div>
    @endif
@endsection
