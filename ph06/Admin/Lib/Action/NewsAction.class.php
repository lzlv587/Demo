<?php
class NewsAction extends CommonAction{
    public function newsList(){
        if(!isset($_SESSION['u_id'])){
            $this->redirect('Login/login');
        }
        $news=D('NewsView');
        $count=$news->count('n_id');
        import('ORG.Util.Page');
        $page=new page($count,17);
        $limit=$page->firstRow.','.$page->listRows;
        $this->list=$news->order('n_addtime DESC')->limit($limit)->select();
        $this->page=$page->show();
        $this->display();
        }
        Public function publishNews(){
            if(!isset($_SESSION['u_id'])){
                $this->redirect('Login/login');
                
            }
            $type=M('type');
            $this->list=$type->where('t_status=1')->select();
            
            $this->display();
        }
        Public function publish(){
            if(!isset($_POST['n_title'])){
                $this->error('非法操作');
                
            }
            if(empty($_POST['n_title'])){
                $this->error('新闻名称不能为空');
            }
            $news=M('news');
            $data['n_title']  =  $_POST['n_title'];
            $data['n_message']  =  $_POST['n_message'];
            $data['n_type']  =  $_POST['n_type'];
            $data['n_status']  =  $_POST['n_status'];
            $data['n_author']  =  $_SESSION['u_id'];
            $data['n_addtime']  = time();
            if($news->data($data)->add()){
                $this->success('发布成功',U('newsList'));
                
            }
         else{
             $this->error('发布失败');
         }
        }
           Public function updateNews(){
               if(!isset($_SESSION['u_id'])){
                   $this->redirect('Login/login');
               }
               $news=M('news');
               $type=M('type');
               $where['n_id']=$_GET['n_id'];
               $this->list=$news->where($where)->find();
               $this->t_list=$type->select();
               $this->display();
           }
           public function update(){
               if(!isset($_POST['n_id'])){
                   $this->error('非法操作');
               }
               $news=M('news');
               $news->create();
               $where['n_id']=$_POST['n_id'];
               if($news->where($where)->save()){
                   $this->success('修改成功',U('newsList'));
               }
               else {
                   $this->error('修改失败');
               }
   
         }
         Public function delete(){
             if(!isset($_SESSION['u_id'])){
                 $this->redirect('Login/login');
             }
           
             if(!isset($_GET['n_id'])){
                 $this->error('非法操作');
             }
             $news=M('news');
             $where['n_id']=$_GET['n_id'];
             if($news->where($where)->delet()){
                 $this->success('删除成功',U('newsList'));
             }
             else {
                 $this->error('删除失败');
             }
         
         
        }
}