@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加友链</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.links.store')}}" method="post">
                @include('admin.links._form')
            </form>
        </div>
    </div>
@endsection