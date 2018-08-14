<?php

class CommentController extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('CommentModel');
    }
    
    public function index(){
        
    }
    
    public function rating(){
        $id             = $this->input->post('id');
        $star           = $this->input->post('star');
        $comment        = $this->input->post('comment');
        
        $star = $star < 0 ? 1 : $star;
        $star = $star > 5 ? 5 : $star;
        
        if(!isset($_SESSION)) 
        { 
            session_start();
        }
        if(isset($_SESSION["cUser"])){
            $uid = $_SESSION["cUser"]->ID;
            
            $isCommented = $this->CommentModel->isCommented($uid, $id);
            //$data['isRated'] = $this->CommentModel->isRated($uid, $id);
            
            // UPDATE : STAR
            if(count($isCommented) > 0 && $isCommented[0]->cm > 0){
                $dataStar = array(
                    'Star' => $star
                );

                if($this->CommentModel->updateStar($dataStar, $id, $uid)){
                    redirect('tu-cho-duyet');
                }
                else{
                    $this->load->view('add');
                }
            }
            // INSERT : COMMNENT - STAR
            else{
                $dataComment = array(
                    'EdictID' => $id,
                    'Comment' => $comment,
                    'UserID' => $uid,
                    'DateCreate' => date("Y-m-d H:i:s")
                );

                $dataStar = array(
                    'EdictID' => $id,
                    'Star' => $star,
                    'UserID' => $uid,
                    'DateCreate' => date("Y-m-d H:i:s")
                );
                if($this->CommentModel->insertComment($dataComment, $dataStar)){
                    redirect('tu-cho-duyet');
                }
                else{
                    $this->load->view('add');
                }
            }
            
            
        }
    }
}
?>