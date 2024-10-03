@extends('layouts.app')

@section('content')
<div class="container">
    <h2>User Management</h2>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
    <form id="userForm">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control">
        </div>
        <div class="form-group">
            <label for="role_id">Role</label>
            <select name="role_id" id="role_id" class="form-control">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description" class="for">Description</label>
            <textarea class="form-control" name="description" id="description" rows="4"></textarea>
        </div>
        <div class="form-group">
            <label for="profile_image">Profile Image</label>
            <input type="file" name="profile_image" id="profile_image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <div  class="container m-2" id="userTable">
        <!-- Users table will be loaded here via AJAX -->
    </div>
</div>

<script>

jQuery.noConflict();
jQuery(document).ready(function($) {
    loadUsers();

    // Submit form using AJAX
    $('#userForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        console.log(formData);

        $.ajax({
            url: "{{ route('users.store') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.errors) {
                    alert('Validation failed.');
                } else {
                    alert('User created successfully!');
                    $('#userForm')[0].reset(); // Clear the form
                    loadUsers(); // Reload table
                }
            }
        });
    });

    // Load users function
    function loadUsers() {
        $.ajax({
            url: "{{ route('users.index') }}",
            success: function(data) {
                $('#userTable').html(data);
            }
        });
    }
});

</script>
@endsection
