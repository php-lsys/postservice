<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\PostService\Loger;
use LSYS\PostService\Loger;
use LSYS\PostService\Result;
use LSYS\PostService\Result\SuccResult;
use LSYS\PostService\Result\FailResult;
class File implements Loger{
    protected $dir;
    protected $name_format;
    protected $_filter;
    public function __construct($dir,$name_format="Y-m-d"){
        $this->dir=rtrim($dir,"\\/")."/";
        $this->name_format=$name_format;
    }
    /**
     * 过滤种结果,默认存储全部
     * @param int $filter
     */
    public function setFilter($filter){
        $this->_filter=$filter;
        return $this;
    }
    public function add(Result $result){
        if ($this->_filter&Loger::FILTER_SUCC&&$result instanceof SuccResult)return false;
        if($result instanceof FailResult){
            switch ($result->getCode()){
                case FailResult::CODE_EMPTY:
                    if ($this->_filter&Loger::FILTER_EMPTY_FAIL)return false;
                break;
                case FailResult::CODE_SIGN:
                case FailResult::CODE_WRONG:
                    if ($this->_filter&Loger::FILTER_LOCAL_FAIL)return false;
                break;
                default:
                    if ($this->_filter&Loger::FILTER_REMOTE_FAIL)return false;
            }
        }
        if (!is_dir($this->dir)||!is_writable($this->dir))return false;
        $file=$this->dir.date($this->name_format).".log";
        return @file_put_contents($file, $this->_format($result),FILE_APPEND);
    }
    protected function _format(Result $result){
        $data=strval($result);
        if ($result instanceof SuccResult) $token="succ:";
        else $token="fail:";
        return "{$token}\n{$data}\n";
    }
}