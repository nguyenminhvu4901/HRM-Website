@extends('layouts.client')
@section('title')
    {{ $data['title'] }}
@endsection
@section('sidebar')
    <h3>Home Sidebar</h3>
    @parent
@endsection
@section('content')
    <h1>Trang chu</h1>
    <button type="button" class="show">Show</button>
@endsection

@section('css')
    header{
    background-color: blue;
    }
@endsection

@section('js')
    document.querySelector('.show').onclick = function(){
    alert('AO that day');
    }
@endsection
