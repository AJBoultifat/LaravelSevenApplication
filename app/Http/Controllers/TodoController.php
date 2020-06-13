<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TodoCreateRequest;


use App\Todo;
use App\Step;

class TodoController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $todos = auth()->user()->todos()->orderBy('completed')->get();
        //$todos = Todo::orderBy('completed')->get();
        return view('todos.index')->with(['todos' => $todos]);
    }

    public function create(){
        return view('todos.create');
    }

    public function edit(Todo $todo){
        return view('todos.edit', compact('todo'));
    }

    public function store(TodoCreateRequest $request){
        $todo = Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id'=> auth()->user()->id,
            'completed'=> false
        ]);

        if($request->step){
            foreach($request->step as $step){
                Step::create([
                    'name'=>$step,
                    'todo_id' => $todo->id
                ]);
            }
        }
        return redirect()->back()->with('todoConfirmCreate', 'Todo has been created.');
    }

    public function update(TodoCreateRequest $request, Todo $todo){
        $todo->update([
            'title'=> $request->title,
            'description' => $request->description
            ]);
        $todo->steps->each->delete();
        if($request->step){
            foreach($request->step as $step){
                Step::create([
                    'name'=>$step,
                    'todo_id' => $todo->id
                ]);
            }
         }
        return redirect(route('todo.index'))->with('confirm','The title of this todo has been updated');
    }

    public function complete(Todo $todo){
        $todo->update(['completed' => true]);
        return redirect()->back()->with('message', 'todo is completed');
    }

    public function incomplete(Todo $todo){
        $todo->update(['completed' => false]);
        return redirect()->back()->with('message', 'todo is incomplete');
    }

    public function delete(Todo $todo){
        $todo->steps->each->delete();
        $todo->delete();
        return redirect()->back()->with('message', 'todo has been deleted');
    }

    public function show(Todo $todo){
        return view('todos.show', compact('todo'));
    }
}
