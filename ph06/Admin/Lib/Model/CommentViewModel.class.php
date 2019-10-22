<?php
class CommentViewModel extends ViewModel{
    protected $viewFields=array(
        'comment'=>array(
          'co_id','co_message','co_status','co_addtime',
          '_type'=>'LEFT'
        ),
        'news'=>array(
            'n_title'=>'n_title',
            '_on'=>'news.n_id=comment.co_news_id'
        ),
        'customer'=>array(
            'c_name'=>'c_name',
            '_on'=>'comment.co_customer_id=customer.c_id'
        ),
    );
}