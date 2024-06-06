@extends("layouts.admin")
@section('title') Ադմին
@endsection
@section("content")
    <div class="container-fluid">
        <div style="width:300px; text-align: center" class="card">
            <div class="card-body">
                <h5 class="card-title">Մենեջերների քանակը ({{ $manager_count }})</h5>
                <a href="{{ route('admin.user.index') }}" class="btn btn-primary btn-sm">Բացել ցանկը</a>
            </div>
        </div>
    </div>
@endsection
