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
                        @foreach ($fileAll as $vo)
                        <tr>
                            <td class="text-left">
                            <span onclick="openfile('{{$vo['filename']}}','{{route('admin.file.open')}}','storage/logs/sql/{{$vo['filename']}}')">
                                <i class="layui-icon layui-icon-file-b">  </i>{{ $vo['filename'] }}</span>
                            </td>
                            <td class="text-left">
                                <span> {{ $vo['size'] }}</span>
                            </td>
                            <td class="text-left">
                                <span>  {{ $vo['mtime'] }} </span>
                            </td>

                            <td class="text-center">
                                <button class="layui-btn layui-btn-sm layui-btn-primary" type="button"
                                        onclick="openfile('{{$vo['filename']}}','{{route('admin.file.open')}}','storage/logs/sql/{{$vo['filename']}}')">
                                    查看
                                </button>
                                <button onclick="delete_log('{{$vo['filename']}}')" class="layui-btn layui-btn-danger layui-btn-sm">删除</button>
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
            area: ['1260px', '800px'],
            fixed: false, //不固定
            maxmin: true,
            shade: 0,
            content: src + '?file=' + file
        });
    }

    function delete_log(filename) {
        layer.confirm('确认删除吗？', function(index){
            $.post("{{ route('admin.log.destroy') }}",{_method:'delete',filename:filename},function (result) {
                if(result.code === 1){
                    location.reload();
                }
                layer.close(index);
                layer.msg(result.msg,)
            });
        })
    }
</script>
@endsection
