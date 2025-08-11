@extends ('layouts.main-layout')
@section('title', 'Home')
@section('home-active', 'active')

@section('content')
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card col-6">
            <h2 class="bg-primary text-light text-center py-2" > Information</h2>
            <div class="card-body">
                <div class="d-flex align-items-center flex-row mt-4">
                    <div class="p-2 display-5 text-primary">
                        <i class="ti ti-cloud-snow"></i>
                        <span>{{$documentsCount}}</span>
                    </div>
                    <div class="p-2">
                        <h3 class="mb-0">Document Records</h3>
                    </div>
                </div>
                <div class="d-flex align-items-center flex-row mt-4">
                    <div class="p-2 display-5 text-primary">
                        <i class="ti ti-cloud-snow"></i>
                        <span>{{$categoriesCount}}</span>
                    </div>
                    <div class="p-2">
                        <h3 class="mb-0">Categories</h3>
                    </div>
                </div>
                <div class="d-flex align-items-center flex-row mt-4">
                    <div class="p-2 display-5 text-primary">
                        <i class="ti ti-cloud-snow"></i>
                        <span>{{$filesCount}}</span>
                    </div>
                    <div class="p-2">
                        <h3 class="mb-0">Files</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
