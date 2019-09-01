<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\PostService;
class Poster{
    protected $_local;
    protected $_handler;
    /**
     * 快递对象
     * @param string $local_name 本地名
     * @param string $handler_name 远程名
     */
    public function __construct($local_name,$handler_name){
        $this->_local=$local_name;
        $this->_handler=$handler_name;
    }
    public function localName(){
        return $this->_local;
    }
    public function handlerName(){
        return $this->_handler;
    }
    public function __toString(){
        return strval(empty($this->_local)?$this->_handler:$this->_local);
    }
}