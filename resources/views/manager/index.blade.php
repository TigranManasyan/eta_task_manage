@extends("layouts.manager")
@section("title") Մենեջեր
@endsection
@section("content")
    <div class="container-fluid d-flex">
        <div style="width:300px; text-align: center; margin-right: 10px" class="card">
            <div class="card-body">
                <h5 class="card-title">Աշխատակիցների քանակը ({{ $user_count }})</h5>
                <a href="{{ route('manager.user.index') }}" class="btn btn-primary btn-sm">Բացել ցանկը</a>
            </div>
        </div>

        <div style="width:300px; text-align: center" class="card">
            <div class="card-body">
                <h5 class="card-title">Առաջադրանքների քանակը ({{ $task_count }})</h5>
                <a href="{{ route('manager.task.index') }}" class="btn btn-primary btn-sm">Բացել ցանկը</a>
            </div>
        </div>
    </div>
@endsection
