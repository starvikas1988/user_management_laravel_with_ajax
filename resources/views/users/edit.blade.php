{{-- resources/views/users/edit.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" rows="4">{{ $user->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="role_id">Role</label>
            <select class="form-control" name="role_id" id="role_id" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                        {{ $role->role_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="profile_image">Profile Image</label>
            <input type="file" class="form-control" name="profile_image" id="profile_image">
            @if($user->profile_image)
                <p>Current Image:</p>
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" style="max-width: 150px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection
