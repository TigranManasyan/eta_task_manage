@extends("layouts.user")
@section("title") Աշխատակից
@endsection
@section("content")
    <div class="container-fluid">
        <div style="width:300px; text-align: center" class="card">
            <div class="card-body">
                <h5 class="card-title">Առաջադրանքների քանակը ({{ $task_count }})</h5>
                <a href="{{ route('user.task.index') }}" class="btn btn-primary btn-sm">Բացել ցանկը</a>
            </div>
        </div>
    </div>
@endsection
