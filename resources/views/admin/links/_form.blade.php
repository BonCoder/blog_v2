{{csrf_field()}}
<div class="layui-form-item">
    <label for="" class="layui-form-label">名称</label>
    <div class="layui-input-inline">
        <input type="text" name="name" value="{{ $links->name ?? old('name') }}" lay-verify="required" placeholder="请输入名称" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">链接</label>
    <div class="layui-input-inline">
        <input type="text" name="link" value="{{ $links->link ?? old('link') }}" lay-verify="required|url" placeholder="请输入链接" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">邮箱</label>
    <div class="layui-input-inline">
        <input type="text" name="email" value="{{ $links->email ?? old('email') }}" lay-verify="required" placeholder="请输入邮箱" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">排序</label>
    <div class="layui-input-inline">
        <input type="text" name="sort" value="{{ $links->sort ?? 0 }}" lay-verify="required|number" placeholder="请输入数字" class="layui-input" >
    </div>
</div>


<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.links')}}" >返 回</a>
    </div>
</div>