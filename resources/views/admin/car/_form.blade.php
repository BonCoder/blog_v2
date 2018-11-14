{{csrf_field()}}
<div class="layui-form-item">
    <div class="layui-inline">
        <label for="" class="layui-form-label">所属分类</label>
        <div class="layui-input-inline">
            <select name="level" lay-verify="required">
                <option value="1" @if(isset($car->level)&& $car->level == 1) selected @endif>经济型</option>
                <option value="2" @if(isset($car->level)&& $car->level == 2) selected @endif>商务型</option>
                <option value="3" @if(isset($car->level)&& $car->level == 3) selected @endif>豪华型</option>
                <option value="4" @if(isset($car->level)&& $car->level == 4) selected @endif>suv</option>
            </select>
        </div>
    </div>
    <div class="layui-inline">
        <label for="" class="layui-form-label">品牌</label>
        <div class="layui-input-inline">
            <select name="brand" lay-verify="required">
                <option value="大众" @if(isset($car->brand)&& $car->brand == '大众') selected @endif>大众</option>
                <option value="奔驰" @if(isset($car->brand)&& $car->brand == '奔驰') selected @endif>奔驰</option>
                <option value="宝马" @if(isset($car->brand)&& $car->brand == '宝马') selected @endif>宝马</option>
                <option value="奥迪" @if(isset($car->brand)&& $car->brand == '奥迪') selected @endif>奥迪</option>
            </select>
        </div>
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">所属门店</label>
    <div class="layui-input-inline">
        <select name="shop_id" lay-verify="required">
            <option value=""></option>
            @foreach($shops as $shop)
            @if($shop->status === 1)
            <option value="{{ $shop->id }}" @if(isset($car->shop_id)&& $car->shop_id == $shop->id) selected @endif>{{ $shop->name }}</option>
            @endif
            @endforeach
        </select>
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">车辆名称</label>
    <div class="layui-input-block">
        <input type="text" name="name" value="{{$car->name??old('name')}}" lay-verify="required" placeholder="请输入名称" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <div class="layui-inline">
        <label for="" class="layui-form-label">租金</label>
        <div class="layui-input-inline">
            <input type="text" name="rent" value="{{$car->rent??old('rent')}}" lay-verify="required" placeholder="请输入关键词" class="layui-input" >
        </div>
        <div class="layui-form-mid layui-word-aux">元/天</div>
    </div>
    <div class="layui-inline">
        <label for="" class="layui-form-label">押金</label>
        <div class="layui-input-inline">
            <input type="text" name="deposit" value="{{$car->deposit??old('deposit')}}" lay-verify="required" placeholder="请输入关键词" class="layui-input" >
        </div>
        <div class="layui-form-mid layui-word-aux">元</div>
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">缩略图</label>
    <div class="layui-input-block">
        <div class="layui-upload">
            <button type="button" class="layui-btn" id="uploadPic"><i class="layui-icon">&#xe67c;</i>图片上传</button>
            <div class="layui-upload-list" >
                <ul id="layui-upload-box" class="layui-clear">
                    @if(isset($car->thumb))
                    <li><img src="{{ $car->thumb }}" /><p>上传成功</p></li>
                    @endif
                </ul>
                <input type="hidden" name="thumb" id="thumb" value="{{ $car->thumb??'' }}">
            </div>
        </div>
    </div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">档位</label>
    <div class="layui-input-block">
        @if(!isset($car->gear) || $car->gear === 1)
        <input type="radio" name="gear" value="1" title="手动挡"  checked="" >
        <input type="radio" name="gear" value="2" title="自动挡">
        @else
        <input type="radio" name="gear" value="1" title="手动挡" >
        <input type="radio" name="gear" value="2" title="自动挡" checked="" >
        @endif
    </div>
</div>

<div class="layui-form-item">
    <div class="layui-inline">
        <label class="layui-form-label">车牌号</label>
        <div class="layui-input-inline">
            <input type="text" name="palte" class="layui-input" value="{{$car->palte??old('palte')}}">
        </div>
    </div>
    <div class="layui-inline">
        <label class="layui-form-label">燃料类型</label>
        <div class="layui-input-inline">
            <input type="text" name="fuel" class="layui-input" value="{{$car->fuel??old('fuel')}}">
        </div>
    </div>
    <div class="layui-inline">
        <label class="layui-form-label">变速箱类型</label>
        <div class="layui-input-inline">
            <input type="text" name="gearbox" class="layui-input" value="{{$car->gearbox??old('gearbox')}}">
        </div>
    </div>
    <div class="layui-inline">
        <label class="layui-form-label">排量</label>
        <div class="layui-input-inline">
            <input type="text" name="exhaust" class="layui-input" value="{{$car->exhaust??old('exhaust')}}">
        </div>
    </div>
    <div class="layui-inline">
        <label class="layui-form-label">燃料类型</label>
        <div class="layui-input-inline">
            <input type="text" name="label" class="layui-input" value="{{$car->label??old('label')}}">
        </div>
    </div>
</div>

<div class="layui-form-item">
    <div class="layui-inline">
        <label class="layui-form-label">驱动方式</label>
        <div class="layui-input-inline">
            <input type="text" name="drive" class="layui-input" value="{{$car->drive??old('drive')}}">
        </div>
    </div>
    <div class="layui-inline">
        <label class="layui-form-label">邮油箱容量</label>
        <div class="layui-input-inline">
            <input type="text" name="tank" class="layui-input" value="{{$car->tank??old('tank')}}">
        </div>
    </div>
    <div class="layui-inline">
        <label class="layui-form-label">乘坐人数</label>
        <div class="layui-input-inline">
            <input type="text" name="passenger" class="layui-input" value="{{$car->passenger??old('passenger')}}">
        </div>
    </div>
    <div class="layui-inline">
        <label class="layui-form-label">年贷款</label>
        <div class="layui-input-inline">
            <input type="text" name="year" class="layui-input" value="{{$car->year??old('year')}}">
        </div>
    </div>
</div>

<div class="layui-form-item">
    <div class="layui-inline">
        <label class="layui-form-label">发布</label>
        <div class="layui-input-block">
            <input type="radio" name="status" value="1" title="是" @if(!isset($car->status) || $car->status === 1) checked="" @endif>
            <input type="radio" name="status" value="2" title="否" @if((isset($car->status))&&$car->status===2) checked="" @endif>
        </div>
    </div>
    <div class="layui-inline">
        <label class="layui-form-label">首页推荐</label>
        <div class="layui-input-block">
            <input type="radio" name="home" value="1" title="是" @if(!isset($car->home) || $car->home === 1) checked="" @endif>
            <input type="radio" name="home" value="2" title="否" @if((isset($car->home))&&$car->home===2) checked="" @endif>
        </div>
    </div>
    <div class="layui-inline">
        <label class="layui-form-label">是否可长租</label>
        <div class="layui-input-block">
            <input type="radio" name="long" value="1" title="是" @if(!isset($car->long) || $car->long === 1) checked="" @endif>
            <input type="radio" name="long" value="2" title="否" @if((isset($car->long))&&$car->long===2) checked="" @endif>
        </div>
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">车辆概况</label>
    <div class="layui-input-block">
        <textarea name="about" placeholder="请输入描述" class="layui-textarea">{{$car->about??old('about')}}</textarea>
    </div>
</div>



@include('UEditor::head');
<div class="layui-form-item">
    <label for="" class="layui-form-label">车辆介绍</label>
    <div class="layui-input-block">
        <script id="container" name="introduction" type="text/plain">
            {!! $car->introduction??old('introduction') !!}暂无
        </script>
    </div>
</div>


<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.car')}}" >返 回</a>
    </div>
</div>