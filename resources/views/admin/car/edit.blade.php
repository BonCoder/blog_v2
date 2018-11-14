@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>更新车辆</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.car.update',['id'=>$car->id])}}" method="post">
                {{ method_field('put') }}
                @include('admin.car._form')
            </form>
        </div>
    </div>
@endsection

@section('script')
    @include('admin.article._js')
@endsection
