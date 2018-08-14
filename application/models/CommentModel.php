<?php

class CommentModel extends CI_Model{
    
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
    
    public function insertComment($comment, $star){
        $this->db->trans_start();
        
        if($comment['Comment'] != '')
        {
            $this->db->set($comment);
            $this->db->insert('comments');
        }
        
        $this->db->set($star);
        $this->db->insert('ratings');
        
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return true;
            // do whatever you want to do on query success
        }
    }
    
    # UPDATE: Word
    public function updateStar($data, $id, $uid){
        $this->db->trans_start();
        $this->db->where('EdictID', $id);
        $this->db->where('UserID', $uid);
        $this->db->update('ratings', $data);
        
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
        
    public function getStarByEdictId($id){
        $str_query  = 'SELECT count(Star) as total,';
        $str_query .= '(select count(Star) FROM ratings where Star = 5) as star5,';
        $str_query .= '(select count(Star) FROM ratings where Star = 4) as star4,';
        $str_query .= '(select count(Star) FROM ratings where Star = 3) as star3,';
        $str_query .= '(select count(Star) FROM ratings where Star = 2) as star2,';
        $str_query .= '(select count(Star) FROM ratings where Star = 1) as star1';
        $str_query .= ' FROM ratings';
        $str_query .= ' WHERE EdictID=' . $id;
        
        $str_query1 = 'SELECT (select count(Star) FROM ratings where Star = 5) as star5 FROM ratings WHERE EdictID=' . $id;
        $query = $this->db->query($str_query);
       // $this->output->enable_profiler(TRUE);
        if ( $query->num_rows() > 0)
        {
            $row = $query->result();
            return $row;
        }
    }
    
    // GET : tất cả comment của 1 EDict ID
    public function getCommentList($id){
        //$strQuery = 'SELECT e.ID, e.Word, e.Detail, e.Active,';
        $strQuery = 'SELECT cm.ID, cm.EdictID, cm.UserID, cm.Comment,';
        $strQuery .= ' u.ID as userId, u.UserName, u.FullName, u.RoleId, u.Email ';
        $strQuery .= ' FROM comments as cm';
        $strQuery .= ' JOIN user as u ON cm.UserID = u.ID';
        $strQuery .= ' WHERE cm.EdictID=' . $id;
        
        //$query = $this->db->query('SELECT *FROM comments WHERE EdictID=' . $id);
        $query = $this->db->query($strQuery);
        //$this->output->enable_profiler(TRUE);
        if ( $query->num_rows() > 0)
        {
            $row = $query->result();
            return $row;
        }
    }
    
    public function isCommented($uid, $id){
        $query = $this->db->query('SELECT ID, Comment, count(*) as cm FROM comments WHERE EdictID=' . $id .' AND UserID = ' . $uid );
        
        if ( $query->num_rows() > 0)
        {
            $row = $query->result();
            return $row;
        }
    }
    
    public function isRated($uid, $id){
        $query = $this->db->query('SELECT ID, count(ID) as rt FROM ratings WHERE EdictID=' . $id .' AND UserID = ' . $uid);
        
        if ( $query->num_rows() > 0)
        {
            $row = $query->result();
            return $row;
        }
    }
}
?>