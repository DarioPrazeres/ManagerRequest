@extends('layout')

@section('content')
    <h1>Dashboard do Aprovadores</h1>
    <p>Bem-vindo, {{ auth()->user()->nome }}!</p>
@endsection