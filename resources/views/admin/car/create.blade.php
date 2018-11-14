@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加车辆</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.car.store')}}" method="post">
                @include('admin.car._form')
            </form>
        </div>
    </div>
@endsection

@section('script')
    @include('admin.car._js')
@endsection
