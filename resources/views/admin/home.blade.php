@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-center align-items-center pt-3 pb-2 3 border-bottom"> 
        <h1 class="h2">Dashboard</h1>
    </div>
    <h1> home </h1>
    <p> selamat datang, <strong> {{$user->name}}</strong>!</p>
    <p> email:: <strong> {{$user->email}}</strong></p>
    <p> role:: $foreach {{$user->getRoleNames() as $role}}
        <span class="badge bg-secondary">{{ $role }}</span>
        @endforeach</p>
        @if (session('error'))
        <div class="alert alert-success">
            {{ session('error') }} </div>
        @endif
        @endsection
       