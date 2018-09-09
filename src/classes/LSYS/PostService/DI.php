<?php
namespace LSYS\PostService;
/**
 * @method \LSYS\PostService post_service()
 */
class DI extends \LSYS\DI{
    /**
     * @return static
     */
    public static function get(){
        $di=parent::get();
        !isset($di->post_service)&&$di->post_service(new \LSYS\DI\VirtualCallback(\LSYS\PostService::class));
        return $di;
    }
}