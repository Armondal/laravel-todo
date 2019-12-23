<?php

namespace App\Http\Controllers;
use Session;
use App\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    //
    public function index(){
        $todos = Todo::all();
        return view('todos.index',['todos'=>$todos]);
    }
    //
    public function store(Request $request){
        
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        // if validation success
        $name = "";
       if($file   =   $request->file('image')) {
 
        $name      =   time().time().'.'.$file->getClientOriginalExtension();
         
        $target_path    =   public_path('/uploads/');
         
            $file->move($target_path, $name);
        }

        $todo = new Todo;
        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->image = $name;
        $todo->save();
        Session::flash('success','Your Todo has been Created');
        return redirect()->back();
    }
    
    public function delete($id){
        
        $todo = Todo::find($id);
        $todo->delete();    
        
        Session::flash('success','Your Todo has been Deleted');    
        return redirect()->back();
    }
    public function update($id){
        
        $todo = Todo::find($id);
         
        return view('todos.update')->with('todo',$todo);
    }
    
    public function save(Request $request,$id){
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $name = "";
        if($file   =   $request->file('image')) {
  
         $name      =   time().time().'.'.$file->getClientOriginalExtension();
          
         $target_path    =   public_path('/uploads/');
          
             $file->move($target_path, $name);
         }
        $todo = Todo::find($id);
        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->image = $name;
        $todo->save();
        
        Session::flash('success','Your Todo has been Updated');
        return redirect()->route('todos');
    }
    public function completed($id){
        $todo = Todo::find($id);
        if($todo->completed == 0){
            $todo->completed = 1;
        }else{
            $todo->completed = 0;
        }
        $todo->save();
        
        Session::flash('success','Your Todo Complete status has been Changed');
        return redirect()->route('todos');
    }
}
