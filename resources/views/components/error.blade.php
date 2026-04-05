@props(['name' => 'required'])
@error($name)
    <div>
        <p class="text-xs text-error">{{$message}}</p>
    </div>
@enderror
