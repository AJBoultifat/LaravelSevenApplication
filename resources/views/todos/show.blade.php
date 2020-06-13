<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--tailwindcss cdn-->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <title>{{$todo->title}}</title>
    @livewireStyles
</head>
<body>
    <div class="text-center pt-10">
    <h1 class="text-2xl">{{$todo->title}}</h1>
    
    <div>
        
        <div>
            <p>
                {{$todo->description}}
            </p>
        </div>
        @if($todo->steps->count()>0)
        <div>
            @foreach($todo->steps as $step)
                <div>{{$step->name}}</div>
            @endforeach
        </div>
        @endif
    </div>
         <a href="/todos" class="mx-5 py-2 px-1 bg-blue-400 cursor-pointer rounded text-white">Back</a>
    </div>
    @livewireScripts
</body>
</html>