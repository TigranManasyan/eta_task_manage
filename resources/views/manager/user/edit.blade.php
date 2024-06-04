@extends('layouts.manager')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Խմբագրել աշխատակցի տվյալները</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('manager.user.update' ) }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password (leave blank to keep current password)</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            </div>

                            <button   class="btn btn-success">Update User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
