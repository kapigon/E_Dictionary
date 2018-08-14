<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Customs{
	
	public $CI;
	
    public function __construct()
    {
        $this->CI = & get_instance();
    }
	
	public function test(){
		return 'Hello';
	}
	
	public function getSesstion($name){
		$sesstion = $this->CI->session->userdata(name);
		if(!isset($session) || empty($session)) return NULL;
		
		$session = json_decode($session, TRUE);
		return $session;
	}
	
    public function fullurl(){
        $ssl = (isset($_SERVER['HTTPS']) && !empty($_SERVER('HTTPS')) && $_SERVER("HTTPS") == 'on') ? true:false;
        $sp = strtolower($_SERVER['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
        $port = $_SERVER['SERVER_PORT'];
        $port = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
        $host = (isset($use_forwarded_host) && isset($_SERVER['HTTP_X_FORWARDED_HOST'])) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : '';
        $host = isset($host) ? $host : $_SERVER['SERVER_NAME'] . $port;
        return $protocol . '://' . $host . $_SERVER['REQUEST_URI'];
    }
    
    public function pagination($url = '', $total_rows = 0, $per_page = 10){
        $this->CI->load->library('pagination');
        
        $config['full_tag_open']  = '<nav aria-label="Page navigation"><ul class="pagination pagination-sm">';
        $config['full_tag_close'] = '</ul></nav>';
    
        $config['first_link'] = '&laquo; Đầu';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['first_url'] = '';
        $config['last_link'] = 'Cuối &raquo;';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['last_url'] = '';
            
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        $config['num_links'] = 5;
        //$config['uri_segment'] = 1;
        
        $config['use_page_numbers'] = TRUE;
        $config['base_url'] = $url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        
        return $config;
    }
}
?>