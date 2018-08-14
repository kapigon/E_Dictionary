<?php

class TranslateModel extends CI_Model{
    
    public function translate($textSearch, $lan){
        
        $this->db->select('Detail');
        $this->db->from('edict');
        $this->db->where('word', $textSearch);
        //$this->db->like('word',$textSearch);
        $this->db->where('language', $lan);
        $this->db->where('Active', 1);
        
        $query = $this->db->get();
        
        //var_dump($query->result_array());
        if ( $query->num_rows() > 0 )
        {
            $row = $query->row_array();
            //$row = $query->result();
            return $row;
        }
    }
    
    public function searchAutoComplete($textSearch, $lan, $sW){
        //return $textSearch . ' - ' .$lan;
        $strQuery   = 'SELECT * FROM edict';
        $strQuery  .= ' WHERE Active = 1';
        $strQuery  .= ' AND Language = "' . $lan .'"';
        if($sW == 'A'){
            $strQuery .= ' AND Word LIKE "'. $textSearch .'%"';
        }else{
            $strQuery .= ' AND Word LIKE "%'. $textSearch .'%"';
        }
        $strQuery .= ' ORDER BY Word asc limit 5';
        //var_dump($strQuery); die();
        $query = $this->db->query($strQuery);
//        $this->db->select('Word');
//        $this->db->from('edict');
//        //$this->db->where('word', $textSearch);
//        $this->db->like('Word',$textSearch);
//        $this->db->where('Language', $lan);
//        $this->db->where('Active', 1);        
//        $query = $this->db->get();
        //$this->output->enable_profiler(TRUE);
        //var_dump($query->result_array());
        
        if ( $query->num_rows() > 0 )
        {
            $row = $query->result_array();
            //$row = $query->result();
            return $row;
        }
    }
    
    public function getAll ($lan){
        
        $this->db->select('word');
        $this->db->from('edict');
        $this->db->where('language', $lan);
        $this->db->where('Active', 1);
        
        $query = $this->db->get();
        
        //var_dump($query->result_array());
        if ( $query->num_rows() > 0 )
        {
            $row = $query->result_array();
            //$row = $query->result();
            return $row;
        }
    }
    
    public function insertWord($array){
        $this->db->trans_start();
        $this->db->set($array);
        $this->db->insert('edict');
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return true;
            // do whatever you want to do on query success
        }
    }
    
    # UPDATE: Word
    public function updateWord($data, $id){
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('edict', $data);
        
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return true;
            // do whatever you want to do on query success
        }
    }
    
    public function getWordPendingListTotal(){
        return $this->db->from('edict')->where('Active', 0)->count_all_results();
    }
    
    // Get danh sách tờ chờ duyệt
    public function getWordPendingList($start, $limit){
        //$query = $this->db->query('SELECT * FROM edict Where StatusId = 2')->limit($start, $limit); // StatusId = 2 : trạng thái chờ duyệt
        $this->db->select('*');
        $this->db->from('edict');
        $this->db->limit($limit, $start);
        $this->db->where('Active', 0);
        $query = $this->db->get();
        
        // Hiển thị cấu trúc query 
        //$this->output->enable_profiler(TRUE);
        
        if ( $query->num_rows() > 0)
        {
            $row = $query->result();
            return $row;
        }
    }
    
    // GET: danh sách từ do user tạo
    public function getMyWordList($uid){
        $query = $this->db->query('SELECT * FROM edict Where UserId = ' . $uid); // StatusId = 2 : trạng thái chờ duyệt
                
        if ( $query->num_rows() > 0)
        {
            $row = $query->result();
            return $row;
        }
    }
    
    public function getWordById($uid, $id){
        //$query = $this->db->query('SELECT * FROM edict Where id = ' . $id . ' and UserId = ' . $uid . ' and StatusId = 2'); // StatusId = 2 : trạng thái chờ duyệt
        $query = $this->db->query('SELECT * FROM edict Where id = ' . $id);
        
        if ( $query->num_rows() > 0)
        {
            $row = $query->result();
            return $row;
        }
    }
}
?>