@extends('layouts.manager')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Առաջադրանքներ</h2>
                        <a href="{{ route("manager.task.create") }}" class="btn btn-primary btn-sm">Ստեղծել նոր առաջադրանք</a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Վերնագիր</th>
                                <th>Կատարող</th>
                                <th>Գործողություններ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->user->name }}</td>
                                    <td>
                                        <a href="{{ route('manager.task.show', $task->id) }}" class="btn btn-success btn-sm">Մանրամասն</a>


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
