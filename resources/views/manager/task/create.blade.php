@extends('layouts.manager')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Ստեղծել նոր առաջադրանք</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('manager.task.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Վերնագիր</label>
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Նկարագրություն</label>
                                <div class="col-md-6">
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required autocomplete="description" autofocus cols="30" rows="10">{{ old('description') }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="images" class="col-md-4 col-form-label text-md-right">Նկարներ</label>
                                <div class="col-md-6">
                                    <input id="images" type="file" class="form-control @error('images') is-invalid @enderror" name="images[]" multiple>
                                    @error('images')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="deadline" class="col-md-4 col-form-label text-md-right">Վերջնաժամկետ</label>
                                <div class="col-md-6">
                                    <input id="deadline" type="datetime-local" class="form-control @error('deadline') is-invalid @enderror" name="deadline" value="{{ old('deadline') }}" required autocomplete="deadline" autofocus>
                                    @error('deadline')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="importance" class="col-md-4 col-form-label text-md-right">Կարևորություն</label>
                                @php
                                    $importance = array(
                                        array("name" => "low", "slug" => "Ցածր"),
                                        array("name" => "medium", "slug" => "Միջին"),
                                        array("name" => "high", "slug" => "Բարձր"),
                                    )
                                @endphp
                                <div class="col-md-6">
                                    <select class="form-control @error('importance') is-invalid @enderror" name="importance" id="importance">
                                        @foreach($importance as $item)
                                            <option value="{{ $item['name'] }}">{{ $item['slug'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('importance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_id" class="col-md-4 col-form-label text-md-right">Աշխատակից</label>
                                <div class="col-md-6">
                                    <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Պահպանել</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
