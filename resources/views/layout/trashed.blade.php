<x-app-layout>
    @push('style')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    @endpush
    <div class="container">
        <div class="row mb-4">
            @include('includes.error')
        </div>
        <div class="row py-4">
            <div class="col-md-2">
                <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary col w-100">Back</a>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td style="width:5%">No.</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody id="body-table">
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('user.forceDelete',$user->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="w-100 col btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Tidak ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>            
    </div>
    @push('script')
        <script src="{{ asset('js/pusher.min.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.7.8/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script>
            var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                encrypted: true,
                cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
            });
            var new_user;
            var body = document.getElementById('body-table');
            var channel = pusher.subscribe('admin-user-notification');
            channel.bind('App\\Events\\UserNotification', function(data) {
                alert(data.msg);
            });
            
        </script>
    @endpush
</x-app-layout>