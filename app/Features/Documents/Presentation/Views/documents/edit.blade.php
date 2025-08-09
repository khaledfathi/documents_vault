@extends ('layouts.main-layout')
@section('title', 'Edit Document')
@section('document-active', 'active')
@section('scripts')
    <script src="{{ asset('js/documents/edit.js') }}"></script>
@endsection


@section('content')
    <div class="container mt-5">
        <h1>New Document</h1>

        {{-- flash messages  --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- / flash messages  --}}

        <form action="{{ route('documents.update' , $document->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $document->name) }}" required>
            </div>
            {{-- / name --}}

            {{-- category --}}
            <div>
                <label for="category" class="form-label">Category</label>
                <select id="category" class="form-control" aria-label="Default select example" name="category_id">

                    @foreach ($categories as $category)
                        @if ($document->categoryId == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            {{-- / category --}}

            {{-- description  --}}
            <div class="my-4">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description">{{ old('description', $document->description) }}</textarea>
            </div>
            {{-- / description  --}}

            {{-- files --}}
            <div class="mb-5">
                <label for="file" class="form-label">Files</label>
                <input class="form-control form-control-lg" id="file" type="file" name="file[]" multiple>
            </div>
            <hr>
            {{-- / files --}}

            {{-- Current files  --}}
            <div class="d-flex flex-wrap gap-3 my-3">
                @foreach ($files as $file)
                    <div class="d-flex flex-column align-items-center">
                        <a href="{{ asset($storage . $file->file) }}">
                            <img src="{{ asset($storage . $file->file) }}" alt=""
                                style="width: 150px; height: 150px; object-fit: cover;">
                        </a>

                        <a href=""></a>
                        {{-- delete image btn --}}
                        <div class = "delete-image-btn" style="cursor:pointer ">
                            <input type="hidden" value="{{ $file->id }}">
                            <svg style="margin:20px;color:red" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                <path
                                    d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708" />
                            </svg>
                        </div>
                        {{-- / delete image btn --}}

                    </div>
                @endforeach
            </div>
            {{-- / Current files  --}}

            <input type="hidden" id="delete-files-list" name="delete_files_list" value="[]" >
            <button type="submit" class="btn btn-primary">Update</button>

        </form>

    </div>
@endsection
