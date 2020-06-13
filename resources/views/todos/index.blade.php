<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--tailwindcss cdn-->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <title>Todo</title>
    @livewireStyles
</head>
<body>
    <div class="text-center pt-10">
    <div class="flex justify-center">
        <h1 class="text-2xl">All your Todos</h1>
        <a href="/todos/create" 
        class="mx-5 py-2 px-1 bg-blue-400 cursor-pointer rounded text-white">
        Create new</a>
    </div>
    
    <ul class="my-5">
         @if(session()->has('confirm'))
        <p>{{session()->get('confirm')}}</p>
        @endif

        @if (session()->has('message'))
       	 {{session()->get('message')}}
        @endif

        @forelse($todos as $todo)
        <li class="flex justify-between py-2 ">
            @if($todo->completed)
            <div class="line-through">{{$todo->title}}</div>
            @else
        <a class="cursor-pointer" 
        href="{{route('todo.show',['todo' => $todo->id])}}">{{$todo->title}}</a>
            @endif

            <div>
                <a href="{{'/todos/'.$todo->id.'/edit'}}" class="mx-5 py-2 px-1 bg-orange-400 cursor-pointer rounded text-white">Edit</a>


                @if($todo->completed)
                <a onclick="event.preventDefault(); document.getElementById('form-incomplete-{{$todo->id}}').submit();" 
                class="mx-5 py-2 px-1 bg-green-400 cursor-pointer rounded text-white">Complete</a>
                <form style="display:none" method="post" id="{{'form-incomplete-'.$todo->id}}" action="{{route('todo.incomplete',$todo->id)}}">
                    @csrf
                    @method('delete')   
                </form>
                @else
                <a onclick="event.preventDefault(); document.getElementById('form-complete-{{$todo->id}}').submit();"
                class="mx-5 py-2 px-1 bg-red-400 cursor-pointer rounded text-white">Complete</a>
                <form style="display:none" method="post" id="{{'form-complete-'.$todo->id}}" action="{{route('todo.complete',$todo->id)}}">
                    @csrf
                    @method('put')   
                </form>
                @endif


                <a onclick="event.preventDefault();
                if(confirm('Are you sure about deleting this element ?')){
                    document.getElementById('form-delete-{{$todo->id}}').submit();
                }"
                    class="mx-2 py-2 px-1 bg-red-400 cursor-pointer rounded text-white">delete</a>
                <form style="display:none" method="post" id="{{'form-delete-'.$todo->id}}" action="{{route('todo.delete',$todo->id)}}">
                    @csrf
                    @method('delete')   
                </form>
            </div>    
        </li>
        @empty

        <p> No task available, create one.</p>

        @endforelse
    </ul>

    </div>
    @livewireScripts
</body>
</html>