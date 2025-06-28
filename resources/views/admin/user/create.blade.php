@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Tambah User</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('user.store') }}" method="POST"> 
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>

            <label> konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
            <label>Role</label>
            <select name="role" class="form-control" required>
                @endforeach ($roles as $role)
                    <option value="{{ $role }}">{{ $role }}</option>
                    @endforeach
            </select>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
</form>
        </div>
        @endsection

           