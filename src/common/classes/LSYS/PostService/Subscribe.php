<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\PostService;
use LSYS\PostService\Result\FailResult;
use LSYS\PostService\Result\SuccSubscribeResult;
use LSYS\PostService\Result\SuccResult;
interface Subscribe{
    /**
     * 进行订阅
     * @param string $local_poser_name
     * @param string $postno
     * @return SuccResult|FailResult
     */
    public function pullSubscribe($local_poser_name,$postno,$callback_url);
    /**
     * 监听订阅
     * @return FailResult|SuccSubscribeResult
     */
    public function listenResult();
}