@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加IP</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.visit.store')}}" method="post">
                @include('admin.visit._form')
            </form>
        </div>
    </div>
@endsection