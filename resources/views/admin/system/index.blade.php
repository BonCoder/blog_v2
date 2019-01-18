@extends('admin.base')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <div class="ibox-content  no-padding">
                <div class="table-responsive">
                    <table class="layui-table">
                        <thead>
                        <tr>
                            <th class="text-left">列表</th>
                            <th class="text-left">文件大小</th>
                            <th class="text-left">更新时间</th>
                            <th class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody class="">
                        <tr>
                            <td class="text-left" colspan="3">
                                <span> <i class="layui-icon layui-icon-template-1">  </i>
                                    <a href="{{route('admin.file.index')}}?dir={{$dir}}&superior=1">返回上级</a></span>
                            </td>
                            <td class="text-center"></td>
                        </tr>
                        @foreach ($fileAll['dir'] as $vo)
                        <tr>
                            <td class="text-left">
                                <span><i class="layui-icon layui-icon-template-1">  </i>
                                    <a href="{{route('admin.file.index')}}?dir={{$dir}}&filedir={{$vo['filename']}}">{{ $vo['filename'] }}</a></span>
                            </td>
                            <td class="text-left">
                                <span> {{ $vo['size'] }}</span>
                            </td>
                            <td class="text-left">
                                <span>  {{ $vo['mtime'] }}</span>
                            </td>

                            <td class="text-center">
                                <a class="layui-btn layui-btn-xs layui-btn-normal" href="{{route('admin.file.index')}}?dir={{$dir}}&filedir={{$vo['filename']}}">
                                    <i class="layui-icon layui-icon-set-fill"></i>
                                    打开
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @foreach ($fileAll['file'] as $vo)
                        <tr>
                            <td class="text-left">
                            <span onclick="openfile('{{$vo['filename']}}','{{route('admin.file.open')}}','{{$vo['pathname']}}')">
                                <i class="layui-icon layui-icon-file-b">  </i>{{ $vo['filename'] }}</span>
                            </td>
                            <td class="text-left">
                                <span> {{ $vo['size'] }}</span>
                            </td>
                            <td class="text-left">
                                <span>  {{ $vo['mtime'] }} </span>
                            </td>

                            <td class="text-center">
                                <button class="layui-btn layui-btn-xs layui-btn-primary" type="button"
                                        onclick="openfile('{{$vo['filename']}}','{{route('admin.file.open')}}','{{$dir}}/{{$vo['filename']}}')">
                                    <i class="layui-icon layui-icon-edit"></i>
                                    编辑
                                </button>
                                <!--                                <button class="btn btn-info btn-xs" type="button"  onclick="$eb.createModalFrame('{$vo.filename}','{:Url('openfile')}?file={$vo.filename}&dir={$dir}',{w:1260,h:600})"><i class="fa fa-paste"></i> 重命名</button>-->
                                <!--                                <button class="btn btn-info btn-xs" type="button"  onclick="$eb.createModalFrame('{$vo.filename}','{:Url('openfile')}?file={$vo.filename}&dir={$dir}',{w:1260,h:600})"><i class="fa fa-paste"></i> 删除</button>-->
                                <!--                                <button class="btn btn-info btn-xs" type="button"  onclick="$eb.createModalFrame('{$vo.filename}','{:Url('openfile')}?file={$vo.filename}&dir={$dir}',{w:1260,h:600})"><i class="fa fa-paste"></i> 下载</button>-->

                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

function openfile(title, src, file) {
    return layui.layer.open({
        type: 2,
        title: title,
        area: ['1260px', '600px'],
        fixed: false, //不固定
        maxmin: true,
        shade: 0,
        content: src + '?file=' + file
    });
}
</script>
@endsection
