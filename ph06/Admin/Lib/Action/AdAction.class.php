<?php
//Ad广告
class AdAction extends CommentAction{
    //广告列表页面
    Public function adList(){
        if(!isset($_SESSION['u_id'])){
            $this->redirect('Login/login');
        }
            $ad=M('ad');
            $count=$ad->count('a_id');
            import('ORG.Util.Page');//导入
            $page=new page($count,7);
            $limit=$page->firstRow.','.$page->listRows;
            $this->assign('position',$this->position);
            $this->list=$ad->order('a_position ASC,a_order ASC')->limit($limit)->select();
            $this->page=$page->show();
            $this->display();
        }

        //广告发布页面
      Public function addAd(){
        if(!isset($_SESSION['u_id'])){
            $this->redirect('Login/login');
        }
        $this->assign('position',$this->position);
        $this->display();
    }
    //广告发布过程
    Public function add(){
      if(!isset($_POST['a_name'])){
            $this->error('非法操作');
        }
        $ad=M('ad');
        $ad->create();
     
        if($ad->add()){
            $this->success('添加成功',U('adList'));
        }
        else{
            $this->error('添加失败');
        }
    }
    //修改页面
    Public function updateAd(){
        if(!isset($_SESSION['u_id'])){
            $this->redirect('Login/login');
        }
        if(!isset($_GET['a_id'])){
            $this->error('非法操作');
        }
        $ad=M('ad');
        $where['a_id']=$_GET['a_id'];
        $this->list=$ad->where($where)->find();
        $this->assign('position',$this->position);
        $this->display();
    }
    //修改过程
    Public function update(){
        if(!isset($_POST['a_id'])){
            $this->error('非法操作');
        }
        $ad=M('ad');
        $ad->create();
        $where['a_id']=$_GET['a_id'];
    
   if($ad->where($where)->save()){
        $this->success('修改成功',U('adList'));
    }
    else{
        $this->error('修改失败');
        }
     }
     //删除过程
     Public function delete(){
     if(!isset($_SESSION['u_id'])){
            $this->redirect('Login/login');
        }
      if(!isset($_GET['a_id'])){
            $this->error('非法操作');
        }
        $ad=M('ad');
        $where['a_id']=$_GET['a_id'];
      if($ad->where($where)->delete()){
          $this->success('删除成功',U('adList'));
         }
      else{
        $this->error('删除失败');    
        }
     }
     //异步上传广告图片
     Public function  add_picture(){
         $size=500000000;
         $ext=array('jpg','bmp','png','jpeg');
         $path='./Upload/c_picture/';
         $name='ad_';
         $maxwidth=1000;
         $maxheight=1000;
         $info=$this->upload($size,$ext,$path,$name,$maxwidth,$maxheight,$rule=true);
         
         if ($info[0]==0){
             return $this->ajaxReturn(",$info[1],0");
         }else{
             return $this->ajaxReturn(",$name,$info[0]['savename'],1");
         } 
     }
     var $position=array(
         array('value'=>'1','position'=>'左侧'),  
         array('value'=>'2','position'=>'右侧'),
         array('value'=>'3','position'=>'下侧'),
         array('value'=>'4','position'=>'友情链接')
     );

  }    