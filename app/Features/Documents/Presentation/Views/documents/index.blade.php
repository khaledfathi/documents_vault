@extends ('layouts.main-layout')
@section('title', 'Documents')
@section('documents-active', 'active')


@section('content')

    <div class="container p-5">

        {{-- flash messages  --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        {{-- / flash messages  --}}

        <a class="btn btn-primary mb-5" href="{{ route('documents.create') }}">New Document</a>

        {{-- Document table --}}
        @if($documents)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class="w-50">Name</th>
                        <th>Category</th>
                        <th>count of files</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documents as $document)
                        <tr>
                            <td>{{ $document->id }}</td>
                            <td>{{ $document->name }}</td>
                            <td>{{ $document->categoryName }}</td>
                            <td>{{ $document->filesCount }}</td>
                            <td class="d-flex gap-2 ">
                                <a href="{{ route('documents.show', $document->id) }}" class="btn btn-secondary">view</a>
                                <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('documents.destroy', $document->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else 
            <div class="alert alert-info">There is not Documents yet</div>
        @endif
        {{-- / Document table --}}
    </div>

@endsection
