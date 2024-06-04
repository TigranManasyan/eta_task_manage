@extends('layouts.manager')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $task->title }}</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Նկարագրություն</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ $task->description }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="images" class="col-md-4 col-form-label text-md-right">Նկարներ</label>
                            <div class="col-md-6">
                                @if(!empty($task->images))
                                    @foreach(json_decode($task->images) as $image)
                                        <img src="{{ asset('uploads/' . $image) }}" alt="image" class="img-thumbnail mb-2" style="max-width: 400px; max-height: 400px;">
                                    @endforeach
                                @else
                                    <p>Նկար չկա</p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deadline" class="col-md-4 col-form-label text-md-right">Վերջնաժամկետ</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ $task->deadline }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="importance" class="col-md-4 col-form-label text-md-right">Կարևորություն</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ $task->importance }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_id" class="col-md-4 col-form-label text-md-right">Աշխատակից</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ $task->user->name }}</p>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('manager.task.edit', $task->id) }}" class="btn btn-primary">Փոփոխել</a>
                                <form action="{{ route('manager.task.delete', $task->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Հեռացնե՞լ առաջադրանքը')">Հեռացնել</button>
                                </form>
                                <a href="{{ route('manager.task.index') }}" class="btn btn-primary">Վերադառնալ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
