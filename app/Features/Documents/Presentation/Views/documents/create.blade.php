@extends ('layouts.main-layout')
@section('title', 'Create Document')
@section('document-active', 'active')

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

        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', '') }}"
                    required>
            </div>
            {{-- / name --}}

            {{-- category --}}
            <div>
                <label for="category" class="form-label">Category</label>
                <select id="category" class="form-control" aria-label="Default select example" name="category_id">
                    
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            {{-- / category --}}

            {{-- description  --}}
            <div class="my-4">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
            </div>
            {{-- / description  --}}

            {{-- files --}}
            <div class="mb-5">
                <label for="file" class="form-label" >Files</label>
                <input class="form-control form-control-lg" id="file" type="file"  name="file[]" multiple >
            </div>
            {{-- / files --}}

            <button type="submit" class="btn btn-primary">Save</button>

        </form>

    </div>
@endsection
