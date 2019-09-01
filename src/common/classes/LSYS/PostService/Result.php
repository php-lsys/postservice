<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\PostService;
abstract class Result{
    protected $_raw;
    /**
     * @param mixed $raw 原始数据
     */
    public function __construct($raw){
        $this->_raw=$raw;
    }
    /**
     * 字符串化结
     * @return string
     */
    public function __toString(){
        $raw=$this->_raw;
        if (is_array($raw))$raw=json_encode($raw,JSON_UNESCAPED_UNICODE);
        if(is_scalar($raw))return strval($raw);
        return print_r($raw,true);
    }
}