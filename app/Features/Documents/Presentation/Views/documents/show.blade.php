@extends ('layouts.main-layout')
@section('title', 'View Document')
@section('documents-active', 'active')

@section('content')

    @if ($document)
        <div class="container mt-5">
            <div class="row d-flex align-items-center">
                <label for="" class="col-1 fw-bold ">ID ({{ $document->id }})</label>
                <h3 class="col-11 bg-secondary text-light p-2 rounded text-center">{{ $document->name }}</h3>
            </div>

            <div class="row d-flex align-items-center">
                <label for="" class="col-1 fw-bold">Category </label>
                <h3 class="col-11 bg-secondary text-light p-2 rounded text-center">{{ $document->categoryName}}</h3>
            </div>

            <div class="row d-flex align-items-center">
                <label for="" class="col-1 fw-bold">Description</label>
                <h3 class="col-11 bg-secondary text-light p-2 rounded text-center " style="min-height: 50px">
                    {{ $document->description??'------' }}
                </h3 >
            </div>
            <hr>
            <label for="" class="fw-bold">Files ({{ $document->filesCount }})</label>
            {{-- files --}}
            <div class="d-flex flex-wrap gap-3">
                @foreach ($document->files as $file)
                    <a href="{{ asset(urlencode($storage . $file)) }}">
                        <img src="{{ asset(urlencode($storage . $file)) }}" alt=""
                            style="width: 150px; height: 150px; object-fit: cover;">
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
