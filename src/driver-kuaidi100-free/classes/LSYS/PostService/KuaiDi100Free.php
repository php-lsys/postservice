<?php
/**
 * 依赖管理器
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\PostService;
use LSYS\PostService\Result\FailResult;
use LSYS\PostService;
use LSYS\PostService\Result\PostResult;
use LSYS\PostService\Result\SuccQueryResult;
use LSYS\PostService\Result\PostNode;
class KuaiDi100Free implements PostService{
    protected $_query_url='https://www.kuaidi100.com/query?type={com}&postid={postid}&temp={time}';
    /**
     * @var Poster[]
     */
    protected $_poster=[];
    protected function _makeRequest($url,$post=array()){
        $curl = curl_init($url);
        if ($post) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
        }
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $body = curl_exec($curl);
        if ($body===false&&curl_errno($curl)){
            $msg= curl_error($curl);
        }
        curl_close($curl);
        if (isset($msg)) return array(false,$msg);
        $res=@json_decode($body,true);
        if (!is_array($res)) return array(false,$body);
        return array(true,$res);
    }
    protected function _resultToPostresut($data,$def_poster){
        $com=null;
        foreach ($this->_poster as $v){
            if($v->handlerName()==$data['com']){
                $com=$v->localName();break;
            }
        }
        if(!$def_poster&&!$com&&isset($data['com'])){
            $com=new Poster('', $data['com']);
        }
        $poster=$com==null?$def_poster:new Poster($com, $data['com']);
        switch ($data['state']){
            case '0':$status=PostResult::STATUS_ING;break;
            case '1':$status=PostResult::STATUS_GET;break;
            case '2':$status=PostResult::STATUS_BAD;break;
            case '3':$status=PostResult::STATUS_OK;break;
            case '4':$status=PostResult::STATUS_REFUND;break;
            case '5':$status=PostResult::STATUS_DISPATCH;break;
            case '6':$status=PostResult::STATUS_REFUNDING;break;
            case '10':$status=PostResult::STATUS_CUSTOMS;break;
            case '11':$status=PostResult::STATUS_CUSTOMSING;break;
            case '12':$status=PostResult::STATUS_CUSTOMSOK;break;
            case '13':$status=PostResult::STATUS_CUSTOMSFAIL;break;
            case '14':$status=PostResult::STATUS_REJECTION;break;
            default:$status=$data['state'];break;
        }
        $record=array();
        foreach ($data['data'] as $v){
            $record[]=new PostNode($v['time'], $v['context'],
                isset($v['areaName'])?$v['areaName']:null,isset($v['areaCode'])?$v['areaCode']:null);
        }
        $sn=$data['nu'];
        return new PostResult($poster, $sn, $status, $record);
    }
    public function query(?string $local_poser_name,string $postno){
        $handler_name=null;
        foreach ($this->_poster as $v){
            if($v->localName()==$local_poser_name){
                $handler_name=$v->handlerName();break;
            }
        }
        if (!$handler_name)$handler_name=$local_poser_name;
        $query=str_replace("{com}",$handler_name, $this->_query_url);
        $query=str_replace("{postid}",$postno, $query);
        $query=str_replace("{time}",time(), $query);
        list($status,$data)=$this->_makeRequest($query);
        if (!$status) return new FailResult($data, $data, FailResult::CODE_QUERY_FAIL);
        $def_poster=new Poster($local_poser_name, $handler_name);
        $postresult=$this->_resultToPostresut($data, $def_poster);
        return new SuccQueryResult($data,$postresult->getPoser(),$postresult->getSn(),$postresult);
    }
    public function addPoster(Poster $poster){
        $this->_poster[]=$poster;
        return $this;
    }
    public function getPoster(){
        return $this->_poster;
    }
}