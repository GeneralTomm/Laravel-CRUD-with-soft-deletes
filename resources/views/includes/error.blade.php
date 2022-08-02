@if ($errors->any())
    <x-alert class="alert-danger">
        <h5>Ada beberapa error yang wajib di selesaikan :</h5>
        <ul>
            @foreach ($errors->all() as $item)
                <li>
                    {{ $item }}
                </li>
            @endforeach
        </ul>
    </x-alert>
@endif
@if (session()->has('success'))
    <x-alert class="alert-success">
        Success : {{  session('success') }}
    </x-alert>
@endif
@if (session()->has('error'))
    <x-alert class="alert-danger">
        Success : {{  session('danger') }}
    </x-alert>
@endif