<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\PostService\Result;
use LSYS\PostService\Poster;

class PostResult{
    const STATUS_ING=0;//进行中
    const STATUS_GET=1;//揽件
    const STATUS_BAD=2;//问题件
    const STATUS_OK=3;//签收
    const STATUS_REFUND=4;//退签
    const STATUS_DISPATCH=5;//派件
    const STATUS_REFUNDING=6;//派件
    const STATUS_CUSTOMS=10;//待清关
    const STATUS_CUSTOMSING=11;//清关中
    const STATUS_CUSTOMSOK=12;//已清关
    const STATUS_CUSTOMSFAIL=13;//清关异常
    const STATUS_REJECTION=14;//拒收
    protected $_sn;
    protected $_status;
    protected $_record;
    protected $_poster;
    /**
     * 具体物流信息
     * @param Poster $poster
     * @param string $sn
     * @param string $status
     * @param PostNode[] $record
     */
    public function __construct(Poster $poster,$sn,$status,array $record){
        $this->_sn=$sn;
        $this->_status=$status;
        $this->_record=$record;
        $this->_poster=$poster;
    }
    /**
     * 得到快递号
     * @return string
     */
    public function getSn(){
        return $this->_sn;
    }
    /**
     * 得到快递公司
     * @return \LSYS\PostService\Poster
     */
    public function getPoser(){
        return $this->_poster;
    }
    /**
     * 当前快递状态
     * @return string
     */
    public function getStatus(){
        return $this->_status;
    }
    /**
     * 具体物流信息
     * @return PostNode[]
     */
    public function getRecord(){
        return $this->_record;
    }
}