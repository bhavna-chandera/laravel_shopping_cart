<!-- resources/views/users/create.blade.php -->
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 30px;
    }

    .title {
        text-align: center;
    }

    .addadmin {
        width: 400px;
        margin: 0 auto;
        border: 1px solid black;
        padding: 20px;
    }

    .labels {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    select {
        width: 100%;
        padding: 5px;
        margin-bottom: 10px;
        border: 1px solid black;
    }

    input[type="radio"],
    input[type="checkbox"] {
        margin-right: 5px;
    }

    .btns {
        text-decoration: none;
        color: black;
        border: 1px solid black;
        background: #f0f0f0;
        padding: 5px 10px;
        margin-top: 10px;
        display: inline-block;
    }

    .btns:hover {
        background: #ddd;
    }
</style>

@extends('admin.sidebar')

<form action="{{ route('admin.users.users.adminupdate',  $users->id) }}" method="POST" enctype="multipart/form-data" class="addadmin">
    @csrf
    @method('PUT')
    <h2 class="title">Edit Admin</h2>
    <label for="" class="labels">Admin name*</label>
    <input type="text" name="name" value="{{ old('name', $users->name) }}" required>
    <br>
    <br>
    <label for="" class="labels">User Email*</label>
    <input type="email" id="email" name="email" required value="{{ old('email', $users->email) }}">
    <br>
    <br>
    <label for="" class="labels">Role*</label>
    <select name="role" id="role" required>
        <option value="">Role</option>
        <option value="user" @selected(old('role', $users->role) == 'user')>User</option>
        <option value="admin" @selected(old('role', $users->role) == 'admin')>Admin </option>
    </select>
    <br>
    <br>
    <button type="submit" name="submit" class="btns">update User/admin</button>
    <button><a href="{{ route('admin.users.users') }}">Back</a></button>
</form>