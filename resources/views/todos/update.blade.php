@extends('layouts')

@section('content')
    <h1> update Todos page</h1>
    <div class="new-todo">
    <form class="form-inline" action="{{ route('todo.save',['id'=>$todo->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control mb-2 mr-sm-2" id="name" name="name" value="{{$todo->name}}" placeholder="Name">                      
                    @error('name')
                    <p class="text-danger font-weight-light">{{ $errors->first('name')}}</p>
                    @enderror
                </div>
                <div class="col-md-3">    
                   <textarea type="text" class="form-control mb-2 mr-sm-2" id="description"  name="description">
                        {{$todo->description}}
                    </textarea>
                   @error('description')
                   <p class="text-danger font-weight-light">{{ $errors->first('description')}}</p>
                   @enderror
                </div>
                <div class="col-md-3">
                    @if ($todo->image != "none")
                        <img src="/uploads/{{$todo->image}}" class="todo-image-up">       
                        <input type="file" class="form-control mb-2 mr-sm-2 w-100" id="image" name="image" value="{{$todo->image}}">
                    @else
                        <input type="file" class="form-control mb-2 mr-sm-2 w-100" id="image" name="image">
                    @endif
                    @error('image')
                    <p class="text-danger font-weight-light">{{ $errors->first('image')}}</p>
                    @enderror
                </div>
                <div class="col-md-3">     
                    <button type="submit" class="btn btn-primary mb-2">New Todos</button>
                </div>
            </div>
          </form>
    </div>
@endsection