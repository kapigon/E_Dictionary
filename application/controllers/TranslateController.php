<?php

class TranslateController extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('TranslateModel');
    }
    
    public function index(){
        
        /*if(!isset($_COOKIE['EN']) && $this->TranslateModel->getAll('en')) {
            $result = $this->TranslateModel->getAll('en');
            $arrValueEN = array(); 
            
            foreach($result as $item){
                $arrValueEN[] = $item['word'];
                setcookie('EN', json_encode($arrValueEN), time()+3600);
                //setcookie('EN', serialize($arrValueEN), time()+3600);
            }  
        } 
        else{
            $data = json_decode($_COOKIE['EN'], true);
            //var_dump($data);
        }
        
        if(!isset($_COOKIE['VI']) && $this->TranslateModel->getAll('vi')) {
            $result = $this->TranslateModel->getAll('vi');
            $arrValueVI = array(); 
            
            foreach($result as $item){
                $arrValueVI[] = $item['word'];
                setcookie('VI', json_encode($arrValueVI), time()+3600);
            }
        } 
        else{
            $data = json_decode($_COOKIE['VI'], true);
            //var_dump($data);
        }*/
        
        //$this->load->view('translate');
        $this->translate();
    }
    
    public function translate(){
        $textSearch = $this->input->post('textSearch');
        $lan = $this->input->post('language');
        

        if($this->TranslateModel->translate($textSearch, $lan)) {
            $data['result'] = $this->TranslateModel->translate($textSearch, $lan);
            $this->load->view('translate', $data);
            //return true;
        }    
        else{
            $this->load->view('translate');
//                $this->form_validation->set_message('verifyUser','Incorrect Username or Password. Please try again.');
//                return false;
        }
        #$this->load->view('translate');
    }
    public function searchAutoComplete(){
        $textSearch = $this->input->post('textSearch');
        $lan = $this->input->post('language');
        $sW = $this->input->post('startWidth');
        
       // if($this->TranslateModel->searchAutoComplete($textSearch, $lan)) {
            $result = $this->TranslateModel->searchAutoComplete($textSearch, $lan, $sW);
            $arrSearch = array();
            //echo json_encode(array_values($result));
            if(count($result) > 0){
                foreach($result as $item){
                    $arrSearch[] = $item['Word'];
                }
            }
            echo json_encode($arrSearch);
    }
        
    public function action(){
        $this->form_validation->set_rules('word', 'Tra từ', 'required');
        $this->form_validation->set_rules('detail', 'Nội dung', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>');
        
        $addWord = $this->input->post('addWord');
        $editWord = $this->input->post('editWord');
        if($addWord != ""){
            if($this->form_validation->run() == false){
                $this->load->view('add');
            }else{
                $word           = $this->input->post('word');
                $spelling       = $this->input->post('spelling');
                $language       = $this->input->post('language');
                $detail         = $this->input->post('detail');
                
                if(!isset($_SESSION)) 
                { 
                    session_start();
                }
                if(isset($_SESSION["cUser"])){
                    $userId = $_SESSION["cUser"]->ID;

                    $data = array(
                        'Word' => $word,
                        'Spelling' => $spelling,
                        'Language' => $language,
                        'Detail' => $detail,
                        'UserID' => $userId,
                        'DateCreate' => date("Y-m-d H:i:s"),
                        'DateUpdate' => date("Y-m-d H:i:s")
                    );
                    if($this->input->post('active') != null && $this->input->post('active') == 'on'){
                        $data['Active'] = 1;
                    }else{
                        $data['Active'] = 0;
                    }
                    if($this->input->post('status') != null  && $this->input->post('status') == 'on'){
                        $data['StatusId'] = 1;
                    }
                    else{
                        $data['StatusId'] = 2;
                    }

                    if($this->TranslateModel->insertWord($data)){
                        redirect('tu-cho-duyet');
                    }
                    else{
                        $this->load->view('add');
                    }
                }
            }
        }
        else if($editWord !=""){
            $id             = $this->input->post('id');
            $word           = $this->input->post('word');
            $spelling       = $this->input->post('spelling');
            $language       = $this->input->post('language');
            $detail         = $this->input->post('detail');
            
            $data = array(
                'Word' => $word,
                'Spelling' => $spelling,
                'Language' => $language,
                'Detail' => $detail,
                'DateUpdate' => date("Y-m-d H:i:s"),
            );
            
            if($this->input->post('active') != null && $this->input->post('active') == 'on'){
                $data['Active'] = 1;
            }else{
                $data['Active'] = 0;
            }
            
            if($this->input->post('status') != null && $this->input->post('status') == 'on'){
                $data['StatusId'] = 1;
            }
            else{
                $data['StatusId'] = 2;
            }


            if($this->TranslateModel->updateWord($data, $id)){
                redirect('tu-cho-duyet');
            }
            else{
                $this->load->view('add');
            }
        }
    }
    
    public function wordPendingList($page = 1){
        
        $url = base_url() .'tu-cho-duyet/';
        $total_rows = $this->TranslateModel->getWordPendingListTotal();
        $per_page = 10;
        
        $config = $this->my_customs->pagination($url, $total_rows, $per_page);
        
        $total_page = ceil($config['total_rows'] / $config['per_page']);
        $page = ($page > $total_page) ? $total_page : $page;
        $page = ($page < 0) ? 1 : $page;
        //$config['cur_page'] = $page;
        $page = $page - 1;             
                
        $data['wordPendingList'] = $this->TranslateModel->getWordPendingList($page * $config['per_page'], $config['per_page']);
        $this->pagination->initialize($config);
        //echo $this->pagination->create_links();
        $data['list_pagination'] = $this->pagination->create_links();
        $this->load->view('wordPendingList', $data);
        /*
         * <nav aria-label="Page navigation">
            <ul class="pagination">
              <li>
                <a href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li>
                <a href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
         */
    }
    
    public function myWordList($id = 0){
        
        if(!isset($_SESSION)) 
        { 
            session_start();
        }
        if(isset($_SESSION["cUser"])){
            $uid = $_SESSION['cUser']->ID;
            $data['wordPendingList'] = $this->TranslateModel->getMyWordList($uid);
            $this->load->view('myWord', $data);
        }
    }
    
    public function addNewWord(){
        $this->load->view('add');
    }
    
    public function editWord($id = 0){
        //echo $id;
        
        if(!isset($_SESSION)) 
        { 
            session_start();
        }
        
        if($id > 0 && isset($_SESSION["cUser"])){
            $uid = $_SESSION['cUser']->ID;
            $data['info'] = $this->TranslateModel->getWordById($uid, $id);
            $this->load->view('editWord', $data);
        }
    }
    
    public function getWordById($id = 0){
        
        if(!isset($_SESSION)) 
        { 
            session_start();
        }
        
        if($id > 0 && isset($_SESSION["cUser"])){
            $uid = $_SESSION['cUser']->ID;
            $data['info'] = $this->TranslateModel->getWordById($uid, $id);
            
            $this->load->model('CommentModel');
            $data['commentList'] = $this->CommentModel->getCommentList($id);
            $data['starList'] = $this->CommentModel->getStarByEdictId($id);
            $data['isCommented'] = $this->CommentModel->isCommented($uid, $id);
            //$data['isRated'] = $this->CommentModel->isRated($uid, $id);
            
            $this->load->view('ratingWord', $data);
        }
    }
    
    public function saveWord(){
    
    }
    
    
}
?>