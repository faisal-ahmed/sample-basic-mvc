<?php
/**
 * Description of userView
 * 
 * For this demo project our header and footer are fixed.
 * 
 * @author Faisal ahmed
 */
class userViewClass {
    
    protected $header = 'view/header.php';
    protected $footer = 'view/footer.php';
    protected $content = 'view/login.php';
    public $data = array();
    
    public function __construct() {
    }
    
    public function setContent($content){
        $this->content = 'view/'.$content;
    }
    
    public function setData($data){
        $this->data = $data;
    }
    
    public function getContent(){
        return $this->content;
    }
    
    public function render() {
        require_once "{$this->header}";
        require_once "{$this->content}";
        require_once "{$this->footer}";
    }
}

?>
