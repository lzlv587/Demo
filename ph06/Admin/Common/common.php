<?php
/*
*打印数组
*/
function p($arr){
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

/*
*无限分类递归函数数组重新排序
*/
function recursive($array,$pid=0,$level=1){
	$arr=array();//定义数组
	foreach ($array as $v) {//$v 第一个分类数组
		if ($v['pid']==$pid) {//一级分类放入数组
			$v['level']=$level;
			$v['html']=str_repeat('--', $level);
			$arr[]=$v;
			$arr = array_merge($arr, recursive($array, $v['id'] , $level+1));//合并数组进行递归无限极分类
		}	
	}
	return $arr;
}

function recursive1($array,$parentid=0,$level=1){
	$arr=array();//定义数组
	foreach ($array as $v) {//$v 第一个分类数组
		if ($v['parentid']==$parentid) {//一级分类放入数组
			$v['level']=$level;
			$v['html']=str_repeat('--', $level);
			$arr[]=$v;
			$arr = array_merge($arr, recursive1($array, $v['addid'] , $level+1));//合并数组进行递归无限极分类
		}	
	}
	return $arr;
}

/**
 * 递归获取所有要删除分类id
 */
function get_all_child($array,$id){

	$arr=array();
	foreach ($array as $v) {
		if ($v['pid']== $id) {
			$arr[]=$v['id'];
			$arr=array_merge($arr,get_all_child($array,$v['id']));
		}
	}
	return $arr;
}
/*
*消除数组重复的项,然后键值从0重新排序
*/
function arr_unset_val($arr){
	$arr=array_values(array_unique($arr));
	return $arr;
}

/**
*服务器信息
*/
function systemMsg(){
	isset($_COOKIE) ? $rs['ifcookie']="SUCCESS" : $rs['ifcookie']="FAIL";
	$rs['sysversion']=PHP_VERSION;	//PHP版本
	$rs['max_upload']= ini_get('upload_max_filesize') ? ini_get('upload_max_filesize') : 'Disabled';	//最大上传限制
	$rs['max_ex_time']=ini_get('max_execution_time').' 秒';	//最大执行时间
	$rs['sys_mail']= ini_get('sendmail_path') ? 'Unix Sendmail ( Path: '.ini_get('sendmail_path').')' :( ini_get('SMTP') ? 'SMTP ( Server: '.ini_get('SMTP').')': 'Disabled' );	//邮件支持模式
	$rs['systemtime']=date("Y-m-j g:i A");	//服务器所在时间
	if( function_exists("imagealphablending") && function_exists("imagecreatefromjpeg") && function_exists("ImageJpeg") ){
		$rs['gdpic']="支持";
	}else{
		$rs['gdpic']="不支持";
	}
	$rs['allow_url_fopen']=ini_get('allow_url_fopen')?"On 支持采集数据":"OFF 不支持采集数据";
	$rs['safe_mode']=ini_get('safe_mode')?"打开":"关闭";
	$rs['DOCUMENT_ROOT']=$_SERVER["DOCUMENT_ROOT"];	//程序所在磁盘物理位置
	$rs['SERVER_ADDR']=$_SERVER["SERVER_ADDR"]?$_SERVER["SERVER_ADDR"]:$_SERVER["LOCAL_ADDR"];		//服务器IP
	$rs['SERVER_PORT']=$_SERVER["SERVER_PORT"];		//服务器端口
	$rs['SERVER_SOFTWARE']=$_SERVER["SERVER_SOFTWARE"];	//服务器软件
	$rs['SCRIPT_FILENAME']=$_SERVER["SCRIPT_FILENAME"]?$_SERVER["SCRIPT_FILENAME"]:$_SERVER["PATH_TRANSLATED"];//当前文件路径

	//获取ZEND的版本
	ob_end_clean();
	ob_start();
	phpinfo();
	$phpinfo=ob_get_contents();
	ob_end_clean();
	ob_start();
	preg_match("/with(&nbsp;| )Zend(&nbsp;| )Optimizer(&nbsp;| )([^,]+),/is",$phpinfo,$zenddb);
	$rs['zendVersion']=$zenddb[4]?$zenddb[4]:"未知/可能没安装";


	$rs['memory_user_limit']=ini_get('memory_limit');    //最大执行时间/空间限制内存
	$rs['file_uploads']=ini_get('file_uploads')?"允许":"不允许"; //是否允许上传文件

	return $rs;
}
//注册码导出到excel表格
function exportexcel($data=array(),$title=array(),$filename='report'){
     header("Content-type:application/octet-stream");
     header("Accept-Ranges:bytes");
     header("Content-type:application/vnd.ms-excel");  
     header("Content-Disposition:attachment;filename=".$filename.".xls");
     header("Pragma: no-cache");
     header("Expires: 0");
     //导出xls 开始
     if (!empty($title)){
         foreach ($title as $k => $v) {
             $title[$k]=iconv("UTF-8", "GB2312",$v);
         }
         $title= implode("\t", $title);
         echo "$title\n";
     }
     if (!empty($data)){
         foreach($data as $key=>$val){
             foreach ($val as $ck => $cv) {
                 $data[$key][$ck]=iconv("UTF-8", "GB2312", $cv);
             }
             $data[$key]=implode("\t", $data[$key]);
             
         }
         echo implode("\n",$data);
     }
}

// 获取模型名称
function get_model_by_id($id){
    return $model = M('Model')->getFieldById($id,'title');
}

// 获取属性类型信息
function get_attribute_type($type=''){
    static $_type = array(
        'text'    =>  array('字符串','varchar(255) NOT NULL'),
        'textarea'  =>  array('文本框','text NOT NULL'),
        'select'    =>  array('下拉菜单','char(50) NOT NULL'),
    	//'checkbox'	=>	array('多选','varchar(100) NOT NULL'),
    	'file'   =>  array('上传图片','varchar(255) NOT NULL'),
    	//'radio'		=>	array('单选','char(10) NOT NULL'),
    	//'editor'    =>  array('编辑器','text NOT NULL'),
        //'num'       =>  array('数字','int(10) UNSIGNED NOT NULL'),
        //'datetime'  =>  array('时间','int(10) NOT NULL'),
        //'bool'      =>  array('布尔','tinyint(2) NOT NULL'),
      	//'attachment'    	=>  array('上传附件','int(10) UNSIGNED NOT NULL'),
    );
    return $type?$_type[$type][0]:$_type;
}
/**
 * select返回的数组进行整数映射转换
 * @param array $map  映射关系二维数组  
 * array(
 *      '字段名1'=>array(映射关系数组),
 *      '字段名2'=>array(映射关系数组),
 *      )
 * @return array
 *  array(
 *      array('id'=>1,'title'=>'标题','status'=>'1','status_text'=>'正常')
 *      ....
 *  )
 */
function int_to_string(&$data,$map=array('status'=>array(1=>'正常',-1=>'删除',0=>'禁用',2=>'未审核',3=>'草稿'))) {
    if($data === false || $data === null ){
        return $data;
    }
    $data = (array)$data;
    foreach ($data as $key => $row){
        foreach ($map as $col=>$pair){
            if(isset($row[$col]) && isset($pair[$row[$col]])){
                $data[$key][$col.'_text'] = $pair[$row[$col]];
            }
        }
    }
    return $data;
}




?>