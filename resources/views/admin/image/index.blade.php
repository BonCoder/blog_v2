@extends('admin.base')

@section('content')
<style>
    .ng-scope {
        position: relative;
        cursor: pointer;
        border-radius: 6px;
        padding: 10px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        float: left;
        margin: 10px;
        -webkit-transition: All 0.2s ease-in-out;
        -moz-transition: All 0.2s ease-in-out;
        -o-transition: All 0.2s ease-in-out;
        transition: All 0.2s ease-in-out;
    }

    .img-cover {
        width: 155px;
        height: 120px;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .am-cf {
        height: 30px;
        padding: 0 2rem 0 1rem;
        margin-bottom: 10px;
    }

</style>
<div class="v-box-header am-cf">
    <button type="button" class="layui-btn layui-btn-primary" id="uploadImg">
        <i class="layui-icon">&#xe654;</i>上传图片
    </button>
</div>
<ul class="file-list-item">
    @foreach ($files as $file)
    <li class="ng-scope" title="{{ $file}}"
        data-file-path="http://file.bobcoder.cc/{{ $file}}">
        <img class="img-cover" src="http://file.bobcoder.cc/{{ $file}}">
        </img>
    </li>
    @endforeach
</ul>
@endsection

@section('script')
<script>
    $(function () {
        $('.file-list-item').delegate('.ng-scope', 'click', function () {
            var path = $(this).attr('data-file-path');
            $('#layui-upload-box').html('<li><img src="'+path+'" /></li>')
            $('#thumb').val(path)
            layer.closeAll();
        })
    })
        var upload = layui.upload
        //普通图片上传
        upload.render({
            elem: '#uploadImg'
            , url: '{{ route("admin.image.upload") }}'
            , multiple: true
            , data: {"_token": "{{ csrf_token() }}"}
            , done: function (res) {
                //如果上传失败
                if (res.code === 0) {
                    layer.msg(res.msg, {icon: 6});
                }else {
                    layer.msg(res.msg, {icon: 5});
                }
            }
        });
</script>
@endsection