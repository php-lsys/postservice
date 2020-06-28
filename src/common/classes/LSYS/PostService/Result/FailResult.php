<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\PostService\Result;
use LSYS\PostService\Result;
class FailResult extends Result{
    /**
     * 空请求
     * @var int
     */
    const CODE_EMPTY=-1;
    /**
     * 签名错误
     * @var int
     */
    const CODE_SIGN=-2;
    /**
     * 错误
     * @var int
     */
    const CODE_WRONG=-34;
    /**
     * 订阅失败
     * @var int
     */
    const CODE_SUBSCRIBE_FAIL=-4;
    /**
     * 查询失败
     * @var int
     */
    const CODE_QUERY_FAIL=-5;
    protected $_msg;
    protected $_code;
    /**
     * 失败结果
     * @param mixed $raw
     * @param string $msg
     * @param int $code
     */
    public function __construct($raw,$msg,$code){
        parent::__construct($raw);
        $this->_code=$code;
        $this->_msg=$msg;
    }
    /**
     * 错误编码,参见常量
     * @return int
     */
    public function getCode(){
        return $this->_code;
    }
    /**
     * 错误消息
     * @return string
     */
    public function getMsg(){
        return $this->_msg;
    }
}