<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\PostService\Result;
use LSYS\PostService\Poster;

class SuccQueryResult extends SuccResult{
    protected $_record;
    protected $_poster;
    protected $_sn;
    /**
     * 查询
     * @param mixed $raw
     * @param Poster $poster
     * @param string $sn
     * @param PostResult $record
     */
    public function __construct($raw,Poster $poster,$sn,PostResult $record){
        parent::__construct($raw);
        $this->_poster=$poster;
        $this->_sn=$sn;
        $this->_record=$record;
    }
    public function getPoser(){
        return $this->_poster;
    }
    public function getSn(){
        return $this->_sn;
    }
    public function getRecord(){
        return $this->_record;
    }
}