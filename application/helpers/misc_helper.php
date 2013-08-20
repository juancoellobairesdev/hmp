<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Misc_helper{
    static function pagination($page, $model){
        $ci = &get_instance();
        $count = $ci->$model->count();
        $pages = (int) ($count/PAGE_SIZE_DEFAULT) -1;

        $page = ($page < 1)? 1: $page;
        $page = ($page > $pages)? $pages: $page;

        $pagination = new stdClass();
        $pagination->first = 1;
        $pagination->prev = ($page > 1)? $page -1: $pagination->first;
        $pagination->current = $page;
        $pagination->next = ($page < $pages)? $page +1: $pages;
        $pagination->last = $pages;

        return $pagination;
    }
}