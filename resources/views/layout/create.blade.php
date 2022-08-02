<x-app-layout>
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/vue@2.7.8/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    @endpush
    @push('style')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    @endpush
    <div class="container">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="row">
                @include('includes.error')
            </div>
            <div class="row">
                <div class="col">
                    <input placeholder="Name :" type="text" name="name" id="name" class="form-control form-control-sm mb-4">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input placeholder="E-mail :" type="email" name="email" id="email" class="form-control fomr-control-sm mb-4">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input placeholder="Password :" type="text" name="password" id="password" class="form-control fomr-control-sm mb-4">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout> 