@extends ('layouts.main-layout')
@section('title', 'About App')
@section('about-app-active', 'active')


@section('content')
    <div class="container border mt-3">

        {{-- app info --}}
        <div class="row py-4  d-flex justify-content-center"> 
            <h6 class="text-center text-decoration-underline mb-5">App Info</h6>
            <p class="text-center">App :Documents vault </p>
            <p class="text-center">version : 0.2-pre-alpha </p>
            <p class="text-center">License : OpenSource ( <a href="https://www.gnu.org/licenses/gpl-3.0.en.html" target="_blank">GPL3</a>)</p>
            <p class="text-center">Source code : <a href="https://github.com/khaledfathi/documents_vault" target="_blank">Github Repository</a>
            <p class="text-center">Description : Laravel Practice CRUD operations </p>
            <p class="text-center">Functionality : saving personal files in organized way </p>
        </div><hr>
        {{-- / app info --}}

        {{-- db schema --}}
        <div class="row py-4  d-flex justify-content-center"> 
            <h6 class="text-center">Database  Schema</h6>
            <img class="" src="{{asset("images/db_schema.png")}}" alt="" style="width:800px">
        </div>
        {{-- / db schema --}}

        {{-- class Diagram  --}}
        <div> </div>
        {{-- / class Diagram  --}}

    </div>
@endsection