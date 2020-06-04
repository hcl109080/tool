<?php

namespace Hcl109080;

class Tool
{
    // 随机生成随机Key
    public function getKeyMap()
    {
        return IntConvert::randomKey();
    }

    // 将数字转换成字符串
    public function intToString($num)
    {
        return IntConvert::toString($num);
    }

    public function stringToInt($str = '')
    {
        return IntConvert::toInt($str);
    }

	/**
	 * [getSonTree 获取子孙树]
	 * @param  array   $list     [数据]
	 * @param  integer $mid      [主键id]
	 * @param  string  $mid_name [主键的名称]
	 * @param  string  $pid_name [子建的名称]
	 * @return [type]            [description]
	 */
	public function getSonTree(array $list, $mid = 0, $mid_name = 'id', $pid_name='parent_id'):array
    {
        $tree = [];
        foreach ($list as $key => $v){
            if ($v[$pid_name] == $mid){
                $v['children'] = $this->getSonTree($list, $v[$mid_name], $mid_name, $pid_name);
                if ($v['children'] == NULL){
                    unset($v['children']);
                }
                $tree[ $key ] = $v;
            }
        }
        return $tree;
    }

    /**
     * [mkDirs 递归创建目录]
     * @param  [type] $dir [description]
     * @return [type]      [description]
     */
    public function mkDirs($dir){
        if(!is_dir($dir)){
            if(!$this->mkDirs(dirname($dir))){
                return false;
            }
            if(!mkdir($dir,0777)){
                return false;
            }
        }
        return true;
    }

    /**
     * [delDir 递归删除目录]
     * @param  [type] $directory [description]
     * @return [type]            [description]
     */
    public function delDir($directory)
    {
        if(file_exists($directory)){//判断目录是否存在，如果不存在rmdir()函数会出错
            if($dir_handle=@opendir($directory)){//打开目录返回目录资源，并判断是否成功
                while($filename=readdir($dir_handle)){//遍历目录，读出目录中的文件或文件夹
                    if($filename!='.' && $filename!='..'){//一定要排除两个特殊的目录
                        $subFile=$directory."/".$filename;//将目录下的文件与当前目录相连
                        if(is_dir($subFile)){//如果是目录条件则成了
                            $this->delDir($subFile);//递归调用自己删除子目录
                        }
                        if(is_file($subFile)){//如果是文件条件则成立
                            unlink($subFile);//直接删除这个文件
                        }
                    }
                }
                closedir($dir_handle);//关闭目录资源
                rmdir($directory);//删除空目录
            }
        }
    }

    /**
     * [getAppointLengthRandomNum 获取指定长度的随机数字]
     * @param  integer $length [description]
     * @return [type]          [description]
     */
    public function getAppointLengthRandomNumCode($length = 4)
    {
    	return rand(pow(10,($length-1)), pow(10,$length)-1);
    }

    /**
     * [getRandStrCode 获取指定长度的随机字符串]
     * @param  [type] $length [description]
     * @return [type]      [description]
     */
    public function getAppointLengthRandStrCode($length = 4)
    {
	    $str = "23456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVW";     
	    $code = '';     
	    for ($i=0; $i<$length; $i++){     
	        $code.= $str[mt_rand(0, strlen($str)-1)];     
	    }
	    return $code;
	}

	/**
	 * [twoTwoSwap 将一个字符串两两互换，用于加密]
	 * @param  [type] $str [description]
	 * @return [type]      [description]
	 */
	public function twoTwoSwap($str)
	{
		foreach(str_split($str,2) as $v){
			$data[] = implode(array_reverse(str_split($v,1)));
		}
		return implode($data);
	}

	/**
	 * [beginTodayTime 获取今天开始时间戳]
	 * @return [type] [description]
	 */
	public function beginTodayTime()
	{
		return mktime(0,0,0,date('m'),date('d'),date('Y'));
	}

	/**
	 * [endTodayTime 获取今天结束时间戳]
	 * @return [type] [description]
	 */
	public function endTodayTime()
	{
		return mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
	}

	/**
	 * [beginYesterdayTime 获取昨天开始时间戳]
	 * @return [type] [description]
	 */
	public function beginYesterdayTime()
	{
		return mktime(0,0,0,date('m'),date('d')-1,date('Y'));
	}

	/**
	 * [endYesterdayTime 获取昨天结束时间戳]
	 * @return [type] [description]
	 */
	public function endYesterdayTime()
	{
		return mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
	}

	/**
	 * [beginLastweekTime 获取上周开始时间戳]
	 * @return [type] [description]
	 */
	public function beginLastweekTime()
	{
		return mktime(0,0,0,date('m'),date('d')-date('w')+1-7,date('Y'));
	}

	/**
	 * [endLastweekTime 获取上周结束时间戳]
	 * @return [type] [description]
	 */
	public function endLastweekTime()
	{
		return mktime(23,59,59,date('m'),date('d')-date('w')+7-7,date('Y'));
	}

	/**
	 * [beginThismonthTime 获取本月开始时间戳]
	 * @return [type] [description]
	 */
	public function beginThismonthTime()
	{
		return mktime(0,0,0,date('m'),1,date('Y'));
	}

	/**
	 * [endThismonthTime 获取本月结束时间戳]
	 * @return [type] [description]
	 */
	public function endThismonthTime()
	{
		return mktime(23,59,59,date('m'),date('t'),date('Y'));
	}

	/**
	 * [beginLastmonthTime 获取上月开始时间戳]
	 * @return [type] [description]
	 */
	public function beginLastmonthTime()
	{
		return mktime(0,0,0,date('m')-1,1,date('Y'));
	}

	/**
	 * [endLastmonthTime 获取上月结束时间戳]
	 * @return [type] [description]
	 */
	public function endLastmonthTime()
	{
		return mktime(23,59,59,date('m')-1,date('t',$beginLastmonth),date('Y'));
	}

	/**
	 * [format_date 将时间戳格式化成几天前]
	 * @param  [type] $the_time [时间戳]
	 * @return [type]           [description]
	 */
	public function format_date($the_time)
	{ 
		$now_time = time();

		$t = $now_time - $the_time;  

		$f=[
			'31536000'=>'年',  
			'2592000'=>'个月',  
			'604800'=>'星期',  
			'86400'=>'天',  
			'3600'=>'小时',  
			'60'=>'分钟',  
			'1'=>'秒'  
		];
		foreach ($f as $k=>$v){
			if (0 !=$c=floor($t/(int)$k)) {  
			    return $c.$v.'前';  
			}  
		}
	}
}