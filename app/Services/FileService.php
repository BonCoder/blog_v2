<?php
/**
 * @Author Bob
 * @Date: 2019/1/17
 * @Email  bob@bobcoder.cc
 * @Site https://www.bobcoder.cc/
 */

namespace App\Services;


use Carbon\Carbon;

class FileService
{
    /**
     * 返回指定文件和目录的信息
     *
     * @param $file
     * @return array
     * @author   Bob<bob@bobcoder.cc>
     */
    public static function list_info($file)
    {
        $dir = array();
        $dir['filename']   = basename($file);//返回路径中的文件名部分。
        $dir['pathname']   = realpath($file);//返回绝对路径名。
        $dir['owner']      = fileowner($file);//文件的 user ID （所有者）。
        $dir['perms']      = fileperms($file);//返回文件的 inode 编号。
        $dir['inode']      = fileinode($file);//返回文件的 inode 编号。
        $dir['group']      = filegroup($file);//返回文件的组 ID。
        $dir['path']       = dirname($file);//返回路径中的目录名称部分。
        $dir['atime']      = fileatime($file);//返回文件的上次访问时间。
        $dir['ctime']      = filectime($file);//返回文件的上次改变时间。
        $dir['perms']      = fileperms($file);//返回文件的权限。
        $dir['size']       = self::byte_format(filesize($file),2);//返回文件大小。
        $dir['type']       = filetype($file);//返回文件类型。
        $dir['ext']        = is_file($file) ? pathinfo($file,PATHINFO_EXTENSION) : '';//返回文件后缀名
        $dir['mtime']      = date('Y-m-d H:i:s',filemtime($file));//返回文件的上次修改时间。
        $dir['isDir']      = is_dir($file);//判断指定的文件名是否是一个目录。
        $dir['isFile']     = is_file($file);//判断指定文件是否为常规的文件。
        $dir['isLink']     = is_link($file);//判断指定的文件是否是连接。
        $dir['isReadable'] = is_readable($file);//判断文件是否可读。
        $dir['isWritable'] = is_writable($file);//判断文件是否可写。
        $dir['isUpload']   = is_uploaded_file($file);//判断文件是否是通过 HTTP POST 上传的。

        return $dir;
    }

    /**
     * 字节格式化 把字节数格式为 B K M G T P E Z Y 描述的大小
     * @param int $size 大小
     * @param int $dec 显示类型
     * @return int
     * @author   Bob<bob@bobcoder.cc>
     */
    public static function byte_format($size, $dec=2)
    {
        $a = array("B", "KB", "MB", "GB", "TB", "PB","EB","ZB","YB");
        $pos = 0;
        while ($size >= 1024)
        {
            $size /= 1024;
            $pos++;
        }

        return round($size,$dec)." ".$a[$pos];
    }

    /**
     * 读取文件操作
     * @param string $file
     * @return boolean
     * @author   Bob<bob@bobcoder.cc>
     */
    public static function read_file($file)
    {
        return @file_get_contents($file);
    }

    /**
     * 获取文件后缀名
     * @param $file
     * @return string
     * @author   Bob<bob@bobcoder.cc>
     */
    public static function get_ext($file)
    {
        $file = self::dir_replace($file);
        //return strtolower(substr(strrchr(basename($file), '.'),1));
        //return end(explode(".",$filename ));
        //return strtolower(trim(array_pop(explode('.', $file))));//取得后缀
        //return preg_replace('/.*\.(.*[^\.].*)*/iU','\\1',$file);
        return pathinfo($file,PATHINFO_EXTENSION);
    }

    /**
     * 替换相应的字符
     * @param string $path 路径
     * @return string
     * @author   Bob<bob@bobcoder.cc>
     */
    public static function dir_replace($path)
    {
        return str_replace('//','/',str_replace('\\','/',$path));
    }

    /**
     * @function          写文件
     *
     * @param $filename
     * @param $writetext
     * @param string $openmod
     * @return bool :          成功=true
     * @author   Bob<bob@bobcoder.cc>
     */
    static function write_file($filename, $writetext, $openmod='w')
    {
        if(@$fp = fopen($filename, $openmod))
        {
            flock($fp, 2);
            fwrite($fp, $writetext);
            fclose($fp);
            return true;
        }
        else
        {
            return false;
        }
    }
}