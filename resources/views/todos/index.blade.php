@extends('layouts')

@section('content')
    <h1>Todos page</h1>
    <div class="new-todo">
        <form class="form-inline" action="/create/todos" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control mb-2 mr-sm-2" id="name" name="name" placeholder="Name">                      
                    @error('name')
                    <p class="text-danger font-weight-light">{{ $errors->first('name')}}</p>
                    @enderror
                </div>
                <div class="col-md-3">    
                   <textarea type="text" class="form-control mb-2 mr-sm-2" id="description" name="description">
                   </textarea>
                   @error('description')
                   <p class="text-danger font-weight-light">{{ $errors->first('description')}}</p>
                   @enderror
                </div>
                <div class="col-md-3">
                    <input type="file" class="form-control mb-2 mr-sm-2 w-100" id="image" name="image">
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
    <div class="row">
        @foreach($todos as $todo)
        <div class="col-lg-6 mt-2">  
            <?php
                if($todo->completed == false){
                    ?>
                    <span class="text-danger"> {{ $todo->name}}</span>
                    <?php
                }else{
                    ?>
                    <span class="text-success"> {{ $todo->name}}</span>
                    <?php
                }
            ?>   
            @if ($todo->image !="none")
            <img src="/uploads/{{$todo->image}}" class="todo-image">                
            @endif
           
            
        </div> 
        <div class="col-lg-6 mt-2">
            <a href="{{ route('todo.delete',['id'=>$todo->id])}}" class="btn btn-danger">x</a>
            <a href="{{ route('todo.update',['id'=>$todo->id])}}" class="btn btn-warning"> update</a>
            
                <?php
                if($todo->completed == false){
                    ?>
                    <a href="{{ route('todo.completed',['id'=>$todo->id])}}" class="btn btn-success"> Complete  </a>
                    <?php
                }else{
                    ?>
                    <a href="{{ route('todo.completed',['id'=>$todo->id])}}" class="btn btn-info">   Not Complete  </a>
                   
                    <?php
                }
                ?> 
          
            
        </div> 
    
        @endforeach
    </div>
@endsection