<h2>User List</h2>
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->role->role_name }}</td>
            <td>{{ $user->description }}</td>
            <td>
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->profile_image }} " width="50" height="50">
            </td>
            <td>
                {{-- <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm m-2">Edit</a> --}}

                <button class="btn btn-warning btn-sm editBtn m-2 " data-id="{{ $user->id }}">Edit</button>
                <button class="btn btn-danger btn-sm deleteBtn" data-id="{{ $user->id }}">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<script>
    jQuery.noConflict();
    jQuery(document).ready(function($) {
            // Delete user function
        $('.deleteBtn').on('click', function() {
            var id = $(this).data('id');
            
            if (confirm("Are you sure you want to delete this user?")) {
                $.ajax({
                    url: '/users/delete/' + id,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            loadUsers();  // Reload users after deletion
                        } else {
                            alert('Something went wrong!');
                        }
                    }
                });
            }
        });

        function loadUsers() {
            $.ajax({
                url: "{{ route('users.index') }}",
                success: function(data) {
                    $('#userTable').html(data);
                }
            });
        }

        $(document).on('click', '.editBtn', function() {
            var userId = $(this).data('id');
            window.location.href = '/users/' + userId + '/edit'; // Assuming this is your edit route
        });
    });
   
</script>
