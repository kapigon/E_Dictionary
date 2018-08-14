<?php

class UserModel extends CI_Model{
    
    // Check Login
    public function login($user, $pass){
        
        $query = $this->db->query('SELECT ID, FullName, UserName FROM user Where UserName ="' . $user . '" and Password="' . $pass . '" and Active = 1' );
                
        if($query->num_rows() == 1){
            return true;
        }else{
            return false;
        }
    }
    
    // Get Thông tin User đăng nhập
    public function getUser($user, $pass){
         
        //return $this->db->get('user')->result();
         
        $query = $this->db->query('SELECT ID, FullName, UserName, RoleId FROM user Where UserName ="' . $user . '" and Password="' . $pass . '" and Active = 1' );
        
        if ( $query->num_rows() > 0 )
        {
            $row = $query->result();
            return $row;
        }
    }
    
    public function getUserNotActive_Total(){
        return $this->db->from('user')->where('Active', 0)->count_all_results();
    }
    
    public function getUserList($start, $limit){
        //$query = $this->db->query('SELECT ID, Email, FullName, UserName FROM user Where Active = 0');
        $this->db->select('*');
        $this->db->from('user');
        $this->db->limit($limit, $start);
        $this->db->where('Active', 0);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            $row = $query->result();
            return $row;
        }
    }
        
    // Check User có tồn tại không
    public function isExistUser($userName){
        
        $this->db->select('UserName', 'Password');
        $this->db->from('user');
        $this->db->where('UserName', $userName);
        
        $query = $this->db->get();
        
        if($query->num_rows() == 1){
            return true;
        }else{
            return false;
        }
    }
    
    // Check Email có tồn tại không
    public function isExistEmail($id, $email){
        
        $this->db->select('email');
        $this->db->from('user');
        $this->db->where('email', $email);
        if($id != 0){
            $this->db->where('ID !=', $id);
        }
        
        $query = $this->db->get();
        
        if($query->num_rows() == 1){
            return true;
        }else{
            return false;
        }
    }
    
    // Create user mới
    public function createUser($data){
        $this->db->set($data);
        $this->db->insert('user');
        
        $flag = $this->db->affected_rows();
        return $flag; // > 0 : thành công 
    }
    
    # Update User
    public function updateUser($data, $id){
        $this->db->where('id', $id);
        $this->db->update('user', $data);
        
        $flag = $this->db->affected_rows();
        return $flag; // > 0 : thành công 
    }
    
    # Get Thông tin User thông qua ID
    public function getInfoUserById($id){
         
        $query = $this->db->query('SELECT * FROM user Where ID =' . $id);
        
        if ($query->num_rows() > 0 )
        {
            $row = $query->result();
            return $row;
        }
    }
}
?>