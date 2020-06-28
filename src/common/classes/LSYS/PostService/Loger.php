<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\PostService;
interface Loger{
    const FILTER_SUCC=1<<0;//过滤掉成功结果
    const FILTER_REMOTE_FAIL=1<<1;//过滤过程错误
    const FILTER_EMPTY_FAIL=1<<2;//过滤本地错误[为空请求]
    const FILTER_LOCAL_FAIL=1<<3;//过滤本地错误[签名不通过,其他本地错误]
    /**
     * 过滤种结果,默认存储全部
     * @param int $filter
     * @return $this
     */
    public function setFilter($filter);
    /**
     * 添加结果到日志
     * @param Result $data
     * @return bool
     */
    public function add(Result $data);
}