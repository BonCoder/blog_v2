{{csrf_field()}}

<div class="layui-form-item">
    <label for="" class="layui-form-label">所属城市</label>
    <div class="layui-input-inline">
        <select name="city_id" lay-verify="required">
            <option value=""></option>
            @foreach($citys as $city)
            <option value="{{ $city->id }}" @if(isset($shop->city_id)&& $shop->city_id == $city->id) selected @endif>{{ $city->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">门店名称</label>
    <div class="layui-input-block">
        <input type="text" name="name" value="{{$shop->name??old('name')}}" lay-verify="required" placeholder="请输入名称" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <div class="layui-inline">
        <label for="" class="layui-form-label">电话</label>
        <div class="layui-input-inline">
            <input type="text" name="tel" value="{{$shop->tel??old('tel')}}" lay-verify="required|number" placeholder="请输入电话" class="layui-input" >
        </div>
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">位置坐标</label>
    <div class="layui-input-inline">
        <input type="text" name="place" value="{{$shop->place??old('place')}}" lay-verify="required" placeholder="请输入坐标" class="layui-input" >
    </div>
    <a class="layui-form-mid layui-word-aux" href="http://api.map.baidu.com/lbsapi/getpoint/" target="_blank" >标注位置</a>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">缩略图</label>
    <div class="layui-input-block">
        <div class="layui-upload">
            <button type="button" class="layui-btn" id="uploadPic"><i class="layui-icon">&#xe67c;</i>图片上传</button>
            <div class="layui-upload-list" >
                <ul id="layui-upload-box" class="layui-clear">
                    @if(isset($shop->thumb))
                    <li><img src="{{ $shop->thumb }}" /><p>上传成功</p></li>
                    @endif
                </ul>
                <input type="hidden" name="thumb" id="thumb" value="{{ $shop->thumb??'' }}">
            </div>
        </div>
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">营业时间</label>
    <div class="layui-input-inline">
        <input type="text" name="open" value="{{$shop->open??old('open')}}" lay-verify="required" placeholder="请输入坐标" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">门店地址</label>
    <div class="layui-input-block">
        <input type="text" name="address" value="{{$shop->address??old('address')}}" lay-verify="required" placeholder="请输入门店地址" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <div class="layui-inline">
        <label class="layui-form-label">是否启用</label>
        <div class="layui-input-block">
            <input type="radio" name="status" value="1" title="是" @if(!isset($shop->status) || $shop->status === 1) checked="" @endif>
            <input type="radio" name="status" value="2" title="否" @if((isset($shop->status))&&$shop->status===2) checked="" @endif>
        </div>
    </div>
</div>

<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.shop')}}" >返 回</a>
    </div>
</div>