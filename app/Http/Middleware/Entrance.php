<?php

namespace App\Http\Middleware;

use App\Models\ShieldIp;
use App\Models\VisitLog;
use Closure;
use Illuminate\Contracts\Cache\Repository as CacheRepository;

class Entrance
{
    protected $cache;

    /**
     * Entrance constructor.
     * @param CacheRepository $cache
     */
    public function __construct(CacheRepository $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        $ip = $request->ip();
        $url = $request->url();
        if(!$this->cache->has($ip)){
            self::getLatIngByIp($ip,$url);
            $this->cache->add($ip, $ip, 60);
        }

        return $next($request);
    }

    /**
     * @param $ip
     * @param $url
     * @return \Illuminate\Http\JsonResponse
     * @author   Bob<bob@bobcoder.cc>
     */
    protected function getLatIngByIp($ip, $url)
    {
        // 调用百度web api
        $content = file_get_contents("https://api.map.baidu.com/location/ip?ak=b1bKCarPwdp9v2jo85UjnjKCSWnK2oB9&ip={$ip}&coor=bd09ll");
        $content = json_decode($content, true);
        // 存入数据库
        $visit = new VisitLog();
        $visit->ip = $ip;
        $visit->longitude = $content['content']['point']['x']; // 经度
        $visit->latitude = $content['content']['point']['y']; // 纬度
        $visit->address = $content['content']['address']; // 城市地址
        $visit->url = $url;     //访问地址
        //判断该IP是否被拉入黑名单
        if(ShieldIp::query()->where('ip',$ip)->exists()){
            return response()->json(['message'=>'对不起，该IP['.$ip.']已被拉黑,禁止访问本网站！'],500);
        }

        $visit->save();
    }
}
