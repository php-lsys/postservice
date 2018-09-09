<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS;
use LSYS\PostService\Poster;
use LSYS\PostService\Result\FailResult;
use LSYS\PostService\Result\SuccQueryResult;
interface PostService{
    /**
     * 快递查询接口
     * @param string $local_poser_name
     * @param string $postno
     * @return FailResult|SuccQueryResult
     */
    public function query($local_poser_name,$postno);
    /**
     * 添加快递公司
     * @param Poster $poster
     */
    public function add_poster(Poster $poster);
    /**
     * 添加快递公司
     * @return Poster[]
     */
    public function get_poster();
}