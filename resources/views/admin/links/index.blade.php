@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group ">
                @can('config.links.destroy')
                    <button class="layui-btn layui-btn-danger" id="listDelete">删 除</button>
                @endcan
                @can('config.links.create')
                    <a class="layui-btn" href="{{ route('admin.links.create') }}">添 加</a>
                @endcan
            </div>

            <div class="layui-form" >
                <div class="layui-input-inline">
                    <select name="field" lay-verify="required" id="field">
                        <option value="name">名称</option>
                        <option value="link">链接</option>
                        <option value="email">邮箱</option>
                        <option value="status">状态</option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="keyword" id="keyword" placeholder="请输入关键字" class="layui-input">
                </div>
                <button class="layui-btn" id="searchBtn">搜 索</button>
            </div>
        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="status">
                @{{# if(d.status == 1){ }}
                <input type="checkbox" name="status" lay-skin="switch" value="@{{ d.id }}" class="status" lay-text="是|否" lay-filter="status" checked>
                <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>是</em><i></i></div>
                @{{# }else{ }}
                <input type="checkbox" name="status" lay-skin="switch" value="@{{ d.id }}" class="status" lay-text="是|否" lay-filter="status">
                <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>否</em><i></i></div>
                @{{# } }}
            </script>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    @can('config.links.edit')
                        <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                    @endcan
                    @can('config.links.destroy')
                        <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
                    @endcan
                </div>
            </script>
        </div>
    </div>
@endsection

@section('script')
    @can('config.links')
        <script>
            layui.use(['layer','table','form'],function () {
                var layer = layui.layer;
                var form = layui.form;
                var table = layui.table;
                //用户表格初始化
                var dataTable = table.render({
                    elem: '#dataTable'
                    ,height: 500
                    ,url: "{{ route('admin.links.data') }}" //数据接口
                    ,page: true //开启分页
                    ,cols: [[ //表头
                        {checkbox: true,fixed: true}
                        ,{field: 'id', title: 'ID', sort: true,width:80}
                        ,{field: 'name', title: '名称'}
                        ,{field: 'link', title: '链接'}
                        ,{field: 'email', title: '邮箱'}
                        ,{field: 'sort', title: '排序'}
                        ,{field: 'status', title: '状态', toolbar: '#status'}
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
                            $.post("{{ route('admin.links.destroy') }}",{_method:'delete',ids:[data.id]},function (result) {
                                if (result.code==0){
                                    obj.del(); //删除对应行（tr）的DOM结构
                                }
                                layer.close(index);
                                layer.msg(result.msg)
                            });
                        });
                    } else if(layEvent === 'edit'){
                        location.href = '/admin/links/'+data.id+'/edit';
                    }
                });

                form.on('switch(status)', function(data){
                    var index = layer.msg('修改中，请稍候',{icon: 16,time:false,shade:0.5});
                    $.ajax({
                        type : "POST",
                        url  : "{{ route('admin.links.status') }}",
                        data : {'id':data.value},
                        success : function(res) {
                            layer.close(index);
                            if(res.code===1){
                                layer.msg(res.msg,{time:1000,icon:1});
                            }else{
                                layer.msg(res.msg,{time:1000,icon:2});
                            }
                        },
                        error:function(){
                            layer.msg('修改失败！',{time:1000,icon:2});
                        }
                    });
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
                            $.post("{{ route('admin.links.destroy') }}",{_method:'delete',ids:ids},function (result) {
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
                    var field = $("#field").val();
                    var keyword = $("#keyword").val();
                    dataTable.reload({
                        where:{field:field,keyword:keyword},
                        page:{curr:1}
                    })
                })
            })
        </script>
    @endcan
@endsection