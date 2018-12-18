@component('mail::message')

@if ($user)
**{{ $user->name }}, 你好，**
@else
**你好，**
@endif

您此次申请的的验证码为 <span style="color: #66a8cc; font-weight: bold"> `{{ $model->code }}` </span>，请在 5 分钟内输入验证码进行下一步操作。<br>
如非你本人操作，请忽略此邮件。
欢迎注册 <a href="https://www.bobcoder.cc/">Bob的博客</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
