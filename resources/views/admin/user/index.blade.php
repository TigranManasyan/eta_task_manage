@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Մենեջերներ</h2>
                    <a href="{{ route("admin.user.create") }}" class="btn btn-primary btn-sm">Ստեղծել նոր մենեջեր</a>
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
                                <th>#</th>
                                <th>Անուն, ազգանուն</th>
                                <th>Էլ․ հասցե</th>
                                <th>Գործողություններ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-success btn-sm">Խմբագրել</a>
                                        <a href="{{ route('admin.user.delete', $user->id) }}" class="btn btn-danger btn-sm">Հեռացնել</a>

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
