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
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
                </div>
            </script>
        </div>
    </div>
@endsection

@section('script')
<script>
    layui.use(['layer','table','form'],function () {
        var layer = layui.layer;
        var form = layui.form;
        var table = layui.table;
        //用户表格初始化
        var dataTable = table.render({
            elem: '#dataTable'
            ,height: 500
            ,url: "{{ route('admin.visit.shield') }}" //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {checkbox: true,fixed: true}
                ,{field: 'id', title: 'ID', sort: true,width:80}
                ,{field: 'ip', title: 'IP', width:150}
                ,{field: 'remark', title: '备注'}
                ,{field: 'created_at', title: '创建时间'}
                ,{field: 'updated_at', title: '更新时间'}
                ,{fixed: 'right', width: 220, align:'center', toolbar: '#options'}
            ]]
        });

        //监听工具条
        table.on('tool(dataTable)', function(obj){ //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
            var data = obj.data //获得当前行数据
                ,layEvent = obj.event; //获得 lay-event 对应的值
            if(layEvent === 'del'){
                layer.confirm('确认删除吗？', function(index){
                    $.post("{{ route('admin.visit.del') }}",{_method:'delete',ids:[data.id]},function (result) {
                        if (result.code==0){
                            obj.del(); //删除对应行（tr）的DOM结构
                        }
                        layer.close(index);
                        layer.msg(result.msg)
                    });
                });
            } else if(layEvent === 'edit'){
                location.href = '/admin/visit/'+data.id+'/edit';
            }
        });

        //按钮批量删除
        $("#listDelete").click(function () {
            var ids = []
            var hasCheck = table.checkStatus('dataTable')
            var hasCheckData = hasCheck.data
            if (hasCheckData.length>0){
                $.each(hasCheckData,function (index,element) {
                    ids.push(element.id)
                })
            }
            if (ids.length>0){
                layer.confirm('确认删除吗？', function(index){
                    $.post("{{ route('admin.visit.destroy') }}",{_method:'delete',ids:ids},function (result) {
                        if (result.code==0){
                            dataTable.reload()
                        }
                        layer.close(index);
                        layer.msg(result.msg,)
                    });
                })
            }else {
                layer.msg('请选择删除项')
            }
        });

        //搜索
        $("#searchBtn").click(function () {
            var field = 'ip';
            var keyword = $("#ip").val();
            dataTable.reload({
                where:{field:field,keyword:keyword},
                page:{curr:1}
            })
        })
    })
</script>
@endsection