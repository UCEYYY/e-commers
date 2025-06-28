@extends('layouts.app')
@section('content')
<div class="container">
    <h2> Edit User</h2>
    @if ($errors->error())
        <div class="alert alert-danger"> {{$session('error')}}</div>
    @endif
    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            <label>Password (kosongkan jika tidak ingin mengubah)</label>
            <input type="password" name="password" class="form-control">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control">
            <label>Role</label>
            <select name="role" class="form-control" required>
                @foreach ($roles as $role)
                    <option value="{{ $role }}" {{ $user->role == $role ? 'selected' : '' }}>{{ $role }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </div>
        @endsection
            