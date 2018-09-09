<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\PostService\Result;
class PostNode implements \JsonSerializable{
    protected $_time;
    protected $_content;
    protected $_city_name;
    protected $_city_code;
    /**
     * @param string $time 时间
     * @param string $content 描述
     * @param string $city_name 城市
     * @param string $city_code 城市code
     */
    public function __construct($time,$content,$city_name=null,$city_code=null){
        $this->_time=$time;
        $this->_content=$content;
        $this->_city_name=$city_name;
        $this->_city_code=$city_code;
    }
    public function get_time(){
        return $this->_time;
    }
    public function get_content(){
        return $this->_content;
    }
    public function get_city_name(){
        return $this->_city_name;
    }
    public function get_city_code(){
        return $this->_city_code;
    }
    public function jsonSerialize (){
        return array(
            'time'=>$this->_time,
            'content'=>$this->_content,
            'city_name'=>$this->_city_name,
            'city_code'=>$this->_city_code,
        );
    }
}