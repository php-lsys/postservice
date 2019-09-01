<?php
namespace LSYS\PostService;
/**
 * @method \LSYS\PostService postService()
 */
class DI extends \LSYS\DI{
    /**
     * @return static
     */
    public static function get(){
        $di=parent::get();
        !isset($di->postService)&&$di->postService(new \LSYS\DI\VirtualCallback(\LSYS\PostService::class));
        return $di;
    }
}