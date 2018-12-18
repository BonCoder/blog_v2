<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Models\VerificationCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as ContractsCacheRepository;

class VerifyCodeController extends Controller
{
    protected $cache;

    /**
     * VerifyCodeController constructor.
     * @param ContractsCacheRepository $cache
     */
    public function __construct(ContractsCacheRepository $cache)
    {
        $this->cache = $cache;
    }

    /**
     * 发送验证码通过请求
     *
     * @param Request $request
     * @return mixed
     * @author   Bob<bob@bobcoder.cc>
     */
    protected function sendFromRequest(Request $request)
    {
        if(! $request->input('email')){
            return response()->json(['code' => 0, 'message' => '邮箱不能为空'], 402);
        }
        $map = [
            'mail' => 'email',
            'sms' => 'phone',
        ];
        $user = $request->user()->id ?? null;

        foreach ($map as $channel => $input) {
            if (!($account = $request->input($input))) {
                continue;
            }

            $this->send($account, $channel, [
                'user_id' => $user,
            ]);
            break;
        }

        return response()->json(['code' => 1, 'message' => '获取成功'], 201);
    }

    /**
     * Send phone or email verification code.
     *
     * @param string $account
     * @param string $channel
     * @param array $data
     * @return mixed
     * @author   Bob<bob@bobcoder.cc>
     */
    protected function send(string $account, string $channel = '', array $data = [])
    {
        $this->validateSent($account,$channel);

        $data['account'] = $account;
        $data['channel'] = $channel;

        $model = factory(VerificationCode::class)->create($data);

        $model->notify(
            new \App\Notifications\VerificationCode($model)
        );
    }

    /**
     * Validate sent.
     *
     * @param string $account
     * @param string $channel
     * @return void
     * @author   Bob<bob@bobcoder.cc>
     */
    protected function validateSent(string $account,string $channel)
    {
        $vaildSecond = config('app.env') == 'production' ? 60 : 60;
        $verify = VerificationCode::where('account', $account)
            ->byValid($vaildSecond)
            ->orderBy('id', 'desc')
            ->first();

        if ($verify) {
            abort(402, sprintf('还需要%d秒后才能获取', $verify->makeSurplusSecond($vaildSecond)));
        }

        $result = $this->astrict($channel);

        if (is_string($result)) {
            abort(402, $result);
        }
    }

    /**
     * 验证短信验证码条数
     * @param $type
     * @return bool|string
     */
    protected function astrict($type)
    {
        if ($type != 'sms') {
            return true;
        }

        // 验证一天
        $verify = VerificationCode::query()
            ->whereBetween('created_at', $this->getPrcTimeScope())
            ->count();
        if ($verify >= 10) {
            return '请勿频繁获取';
        }

        // 验证一小时
        $verify = VerificationCode::query()
            ->byValid(3600)
            ->count();
        if ($verify >= 5) {
            return '请勿频繁获取';

        }

        return true;
    }

    /**
     * 获取每日时间区间
     *
     * @return array
     * @author   Bob<bob@bobcoder.cc>
     */
    protected function getPrcTimeScope()
    {
        $date = Carbon::now()->toDateString();
        $start = $date . " 00:00:00";
        $end = $date . ' 23:59:59';

        return [$start, $end];
    }
}