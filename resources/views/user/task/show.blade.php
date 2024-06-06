@extends('layouts.user')

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
                                <p class="form-control-plaintext">{{$task->description}}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="images" class="col-md-4 col-form-label text-md-right">Նկարներ</label>
                            <div class="col-md-6">
                                @if(!empty($task->images))
                                    @foreach(explode(",",$task->images) as $image)
                                        <img src="{{ asset('uploads/' . str_replace(array('\'', '"', '[', ']', "\\"), '',$image)) }}" alt="image" class="img-thumbnail mb-2" style="max-width: 400px; max-height: 400px;">
                                    @endforeach
                                @else
                                    <p>Նկար չկա</p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deadline" class="col-md-4 col-form-label text-md-right">Վերջնաժամկետ</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{$task->deadline}}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="importance" class="col-md-4 col-form-label text-md-right">Կարևորություն</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">Low</p>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <select name="" id="importance" class="form-control">
                                    <option @if($task->status == 'Ընթացիկ') selected @endif>Ընթացիկ</option>
                                    <option @if($task->status == 'Ավարտված') selected @endif>Ավարտված</option>
                                </select>
                                <a href="{{ route('user.task.index') }}" class="btn btn-primary mt-2">Վերադառնալ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    jQuery(document).ready(function($) {
        $("#importance").on("change", function () {
            let status = $(this).val();
            let task_id = {{ $task->id }};
            let _token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url:"http://127.0.0.1:8000/user/tasks/change_status",
                method:"post",
                data:{
                    status,
                    task_id,
                    _token
                },
                dataType:'json',
                success:function(response) {
                    alert(response.message);
                    location.reload()
                }
            })
        })
    })
</script>
