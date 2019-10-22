<?php
// Common (公共控制器)

class CommonAction extends Action{


	/**
     * 
     * 文件上传类
     * @param int 	  最大文件大小 单位Byte
     * @param array   允许的文件后缀，数组表示
     * @param url 	  存储路径
     * @param varchar 图片文件压缩后图片名前缀
     * @param int 	  图片最大宽度
     * @param int     图片最大高度
     */
    public function upload($size, $ext, $path, $name, $maxwidth, $maxheight, $rule = true) {
        //导入上传类
        import("ORG.Net.UploadFile");
        //实例化上传类
        $upload = new UploadFile();
        $upload->maxSize = $size; // 设置附件上传大小
        $upload->allowExts = $ext; // 设置附件上传类型
        $upload->savePath = $path; // 设置附件上传目录
        if ($rule) { //文件保存规则
            $upload->saveRule = 'time';
        }
        $upload->uploadReplace = false; //存在同名文件是否覆盖
        $upload->thumb = true;   //是否进行缩略图处理
        $upload->thumbPrefix = $name; //保存时文件名前缀
        $upload->thumbMaxWidth = $maxwidth; //最大宽度	
        $upload->thumbMaxHeight = $maxheight; //最大高度	
        $upload->thumbRemoveOrigin = true; //是否删除原图

        if (!$upload->upload()) {
            $info[0] = 0;
            $info[1] = $upload->getErrorMsg();
            return $info; //上传失败时返回错误信息
        } else {
            $info = $upload->getUploadFileInfo();
            return $info; //上传成功时返回文件信息
        }
    }
    
    

}
?>