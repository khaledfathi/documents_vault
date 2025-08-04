@extends ('layouts.main-layout')
@section('title', 'categories')
@section('categories-active', 'active')

@section('content')


    <div class="container p-5">

        {{-- flash messages  --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- / flash messages  --}}

        <a class="btn btn-primary mb-5" href="{{ route('categories.create') }}">New Category</a>

        {{-- categories table --}}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th class="w-75">Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td class="d-flex gap-2 ">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                            @if ($category->id != 1)
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- / categories table --}}
    </div>

@endsection
