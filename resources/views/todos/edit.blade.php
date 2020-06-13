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
        <h3>Update todo's name</h3>
        <form method="post" action="{{route('todo.update', ['todo' => $todo->id])}}" class="py-5">
            @csrf
            @method('patch')
            <div>
                <input type="text" name="title" value="{{$todo->title}}" class="p-2 border rounded">
            </div>
            <div>
                <textarea name="description" class="m-2 p-2 border rounded">{{$todo->description}}</textarea>
            </div>

            <div>
                @livewire('edit-step',['steps' => $todo->steps])

            </div>


            <div>
                <input type="submit" value="Update" class="p-2 border rounded">
            </div>
        </form>

        @if(session()->has('confirm'))
            <p>{{session()->get('confirm')}}</p>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
         @endif

        <a href="/todos" class="mx-6 m-6 py-2 px-1 bg-blue-400 cursor-pointer rounded text-white">Back</a>
    </div>
    @livewireScripts
</body>
</html>