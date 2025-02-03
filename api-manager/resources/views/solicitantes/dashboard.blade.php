@extends('layout')

@section('content')
    <h1>Dashboard do Solicitante</h1>
    <p>Bem-vindo, {{ auth()->user()->nome }}!</p>
@endsection