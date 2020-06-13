<div>
    <div class="flex justify-center">
            <h2 class="text-lg">Edit steps.</h2>
            <a 
            wire:click="increment"
             class="mx-5 py-2 px-1 bg-blue-400 cursor-pointer rounded text-white">+</a>
        </div>
        @foreach($steps as $step)
    <div wire:key="{{$loop->index}}">
    <input type="text" name="step[]" class="p-2 border rounded" value="{{$step['name']}}" placeholder="Describe step {{$loop->index+1}}">
         <a 
            wire:click="remove({{$loop->index}})"
             class="mx-5 py-2 px-1 bg-red-400 cursor-pointer rounded text-white">x</a>
         </div>
        @endforeach
</div>
