<?php
/**
 * @Author Bob
 * @Date: 2019/1/17
 * @Email  bob@bobcoder.cc
 * @Site https://www.bobcoder.cc/
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FileService;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index(Request $request)
    {
        $fileAll = array('dir'=>[],'file'=>[]);
        if($request->input('superior') && $request->input('dir')){
            $path = '../'.$request->input('dir');
            $path = dirname($path);
        }else{
            $path = $request->input('dir') ? '../'.$request->input('dir') : '..';
            $path = $path.'/'.$request->input('filedir');
        }
        $list = scandir($path);
        foreach($list as $key=>$v) {
            if($v !='.' && $v !='..'){
                if (is_dir($path.'/'.$v)) {
                    $fileAll['dir'][] = FileService::list_info($path.'/'.$v);
                }
                if(is_file($path.'/'.$v)){
                    $fileAll['file'][] = FileService::list_info($path.'/'.$v);
                }
            }
        }

        //兼容windows
        $uname=php_uname('s');
        if(strstr($uname,'Windows')!==false) $path = ltrim($path,'\\');
        $dir = ltrim($path,'./');

        return view('admin.system.index',compact('fileAll','dir'));
    }

    //读取文件
    public function openfile(Request $request)
    {
        $file = $request->input('file');
//        if(empty($file)) return Json::fail('出现错误');
        $filepath  = realpath('..').'.'.DIRECTORY_SEPARATOR.$file;

        $content = htmlspecialchars(FileService::read_file($filepath));//防止页面内嵌textarea标签
        $ext = FileService::get_ext($filepath);
        $extarray = [
            'js'=>'text/javascript'
            ,'php'=>'text/x-php'
            ,'html'=>'text/html'
            ,'sql'=>'text/x-mysql'
            ,'css'=>'text/x-scss'
            ,'xml'=>'text/xml'
            ,'markdown'=>'text/html'
        ];

        $mode = empty($extarray[$ext])?'':$extarray[$ext];

        return view('admin.system.openfile',compact('content','mode','filepath'));
    }

    //保存文件
    public function savefile(Request $request){
        $comment = $request->input('comment');
        $filepath = $request->input('filepath');
        if(!empty($comment) && !empty($filepath)){
            //兼容windows
            $uname=php_uname('s');
            if(strstr($uname,'Windows')!==false)
                $filepath = ltrim(str_replace('/', DS, $filepath),'.');
            $res = FileService::write_file($filepath,$comment);
            if($res){
                return request()->json()->successful('保存成功!');
            }else{
                return request()->json()->fail('保存失败');
            }
        }else{
            return request()->json()->fail('出现错误');
        }

    }
}