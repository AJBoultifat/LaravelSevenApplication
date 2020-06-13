<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--tailwindcss cdn-->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <title>Creating New Todo</title>
    @livewireStyles
</head>
<body>
    <div class="text-center pt-10">
    <h1 class="text-2xl">What Do You Want to Do ?</h1>
        <form method="post" action="/todos/create" class="py-5">
            @csrf
            <div>
                <input type="text" name="title" class="p-2 border rounded" placeholder="Text">
            </div>
            <div>
                <textarea name="description" class="m-2 p-2 border rounded" placeholder="Description"></textarea>
            </div>
            @livewire('step')
            <div>
                <input type="submit" value="Create" class="p-2 border rounded">
            </div>
        </form>
        @if(session()->has('todoConfirmCreate'))
            <p>{{session()->get('todoConfirmCreate')}}</p>
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

         <a href="/todos" class="mx-5 py-2 px-1 bg-blue-400 cursor-pointer rounded text-white">Back</a>
    </div>
    @livewireScripts
</body>
</html>