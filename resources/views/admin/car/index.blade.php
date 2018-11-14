@extends('admin.base')

@section('content')
<div class="layui-card">
    <div class="layui-card-header layuiadmin-card-header-auto">
        <div class="layui-btn-group ">
            @can('system.car.destroy')
            <button class="layui-btn layui-btn-sm layui-btn-danger" id="listDelete">删 除</button>
            @endcan
            @can('system.car.create')
            <a class="layui-btn layui-btn-sm" href="{{ route('admin.car.create') }}">添 加</a>
            @endcan
            <button class="layui-btn layui-btn-sm" id="returnParent" pid="0">返回上级</button>
        </div>
    </div>
    <div class="layui-card-body">
        <table id="dataTable" lay-filter="dataTable"></table>
        <script type="text/html" id="options">
            <div class="layui-btn-group">
                @can('system.car.edit')
                <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                @endcan
                @can('system.car.destroy')
                <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
                @endcan
            </div>
        </script>
        <script type="text/html" id="level">
            @{{# if(d.level === 1){ }}
                经济型
            @{{# }else if(d.level === 2){ }}
                商务型
            @{{# }else if(d.level === 3){ }}
                豪华型
            @{{# }else if(d.level === 4){ }}
                SUV
            @{{# } }}
        </script>
        <script type="text/html" id="shop">
            @{{ d.shop.name }}
        </script>
        <script type="text/html" id="status">
            @{{# if(d.status==1){ }}
            <i class="layui-icon layui-icon-ok" style="font-size: 30px; color: #01FF00;"></i>
            @{{# }else{  }}
            <i class="layui-icon layui-icon-close" style="font-size: 30px; color: red;"></i>
            @{{# } }}
        </script>
        <script type="text/html" id="home">
            @{{# if(d.home==1){ }}
            <i class="layui-icon layui-icon-ok" style="font-size: 30px; color: #01FF00;"></i>
            @{{# }else{  }}
            <i class="layui-icon layui-icon-close" style="font-size: 30px; color: red;"></i>
            @{{# } }}
        </script>
    </div>
</div>
@endsection

@section('script')
@can('system.car')
<script>
    layui.use(['layer','table','form'],function () {
        var layer = layui.layer;
        var form = layui.form;
        var table = layui.table;
        //用户表格初始化
        var dataTable = table.render({
            elem: '#dataTable'
            ,height: 500
            ,url: "{{ route('admin.car.data') }}" //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {checkbox: true,fixed: true}
                ,{field: 'id', title: 'ID', sort: true,width:50}
                ,{field: 'name', title: '名称'}
                ,{field: 'rent', title: '租金',width:80}
                ,{field: 'deposit', title: '押金',width:80}
                ,{field: 'level', title: '分类',toolbar: '#level'}
                ,{field: 'counts', title: '预定次数',width:100}
                ,{field: 'shop_id', title: '门店', toolbar:'#shop'}
                ,{field: 'status', title: '状态', toolbar:'#status',width:80}
                ,{field: 'home', title: '首页推荐', toolbar:'#home',width:100}
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
                    $.post("{{ route('admin.car.destroy') }}",{_method:'delete',ids:[data.id]},function (result) {
                        if (result.code==0){
                            obj.del(); //删除对应行（tr）的DOM结构
                        }
                        layer.close(index);
                        layer.msg(result.msg)
                    });
                });
            } else if(layEvent === 'edit'){
                location.href = '/admin/car/'+data.id+'/edit';
            }
        });

    @can('system.car.edit')
        //监听是否显示
        form.on('switch(isShow)', function(obj){
            var index = layer.load();
            var url = $(obj.elem).attr('url')
            var data = {
                "is_show" : obj.elem.checked==true?1:0,
                "_method" : "put"
            }
            $.post(url,data,function (res) {
                layer.close(index)
                layer.msg(res.msg)
            },'json');
        });
    @endcan

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
                    $.post("{{ route('admin.car.destroy') }}",{_method:'delete',ids:ids},function (result) {
                        if (result.code==0){
                            dataTable.reload()
                        }
                        layer.close(index);
                        layer.msg(result.msg)
                    });
                })
            }else {
                layer.msg('请选择删除项')
            }
        })

        //搜索
        $("#searchBtn").click(function () {
            var catId = $("#category_id").val()
            var title = $("#title").val();
            dataTable.reload({
                where:{category_id:catId,title:title},
                page:{curr:1}
            })
        })


        //返回上一级
        $("#returnParent").click(function () {
            var pid = $(this).attr("pid");
            if (pid!='0'){
                ids = pid.split('_');
                parent_id = ids.pop();
                $(this).attr("pid",ids.join('_'));
            }else {
                parent_id=pid;
            }
            dataTable.reload({
                where:{model:"permission",parent_id:parent_id},
                page:{curr:1}
            })
        })
    })
</script>
@endcan
@endsection