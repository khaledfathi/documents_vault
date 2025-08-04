@extends ('layouts.main-layout')
@section('title', 'Create Category')
@section('categories-active', 'active')

@section('content')

    <div class="container mt-5">
        <h1>New Category</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{old('name' , "")}}" required>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>

    </div>
@endsection
