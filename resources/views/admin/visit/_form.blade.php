{{csrf_field()}}
<div class="layui-form-item">
    <label for="" class="layui-form-label">IP</label>
    <div class="layui-input-inline">
        <input type="text" name="ip" value="{{ $visit->ip ?? old('name') }}" lay-verify="required" placeholder="请输入IP" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">备注</label>
    <div class="layui-input-inline">
        <textarea name="remark" placeholder="请输入描述" class="layui-textarea">{{ $visit->remark ?? 0 }}</textarea>
    </div>
</div>


<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.visit')}}" >返 回</a>
    </div>
</div>