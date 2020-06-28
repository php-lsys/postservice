<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\PostService\Result;
use LSYS\PostService\Poster;

class SuccSubscribeResult extends SuccResult{
    const STATUS_FINISH=0;//进行中
    const STATUS_ING=1;//揽件
    const STATUS_FAIL=2;//失败
    protected $_status;
    protected $_record;
    protected $_new_poster;
    protected $_attr_record;
    protected $_is_retry;
    protected $_msg;
    protected $_poster;
    protected $_sn;
    /**
     * 订阅成功结果
     * @param mixed $raw
     * @param string $status
     * @param Poster $poster
     * @param string $sn
     */
    public function __construct($raw,$status,Poster $poster,$sn){
        parent::__construct($raw);
        $this->_status=$status;
        $this->_poster=$poster;
        $this->_sn=$sn;
    }
    /**
     * 设置物流数据
     * @param PostResult $record
     * @param PostResult $attr_record
     * @return \LSYS\PostService\Result\SuccSubscribeResult
     */
    public function setRecord(PostResult $record,PostResult $attr_record=null){
        $this->_record=$record;
        $this->_attr_record=$attr_record;
        return $this;
    }
    /**
     * 设置是否重新订阅
     * @param string $msg 重新订阅原因
     * @return \LSYS\PostService\Result\SuccSubscribeResult
     */
    public function setRetry($msg){
        $this->_is_retry=true;
        $this->_msg=$msg;
        return $this;
    }
    /**
     * 是否快递公司错误,重新设置
     * @param Poster $new_poster
     * @return \LSYS\PostService\Result\SuccSubscribeResult
     */
    public function setNewPoster(Poster $new_poster=null){
        $this->_new_poster=$new_poster;
        return $this;
    }
    /**
     * 是否需要重新订阅
     * @return boolean
     */
    public function isRetry(){
        return $this->_is_retry;
    }
    /**
     * 需要重新订阅原因
     * @return string
     */
    public function getRetryMsg(){
        return $this->_msg;
    }
    /**
     * 当前订阅状态
     * @return string
     */
    public function getStatus(){
        return $this->_status;
    }
    /**
     * 当前快递
     * @return \LSYS\PostService\Poster
     */
    public function getPoser(){
        return $this->_poster;
    }
    /**
     * 物流编码
     * @return string
     */
    public function getSn(){
        return $this->_sn;
    }
    /**
     * 是否发现新快递公司
     * @return \LSYS\PostService\Poster
     */
    public function getNewPoser(){
        return $this->_new_poster;
    }
    /**
     * 快递结果
     * @return \LSYS\PostService\Result\PostResult
     */
    public function getRecord(){
        return $this->_record;
    }
    /**
     * 附带快递单,跨国物流会生成第二个快递单
     * @return \LSYS\PostService\Result\PostResult
     */
    public function getAttrRecord(){
        return $this->_attr_record;
    }
}