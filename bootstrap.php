<?php

namespace TharowServices\HideUtils;

use Blessing\Filter;

return function (Filter $filter) {
    $filter->add('side_menu', function ($menu, $type) {
        if ($type !== 'user') {
            return $menu;
        }
        if (auth()->user()->isAdmin()){
            return $menu;
        }
        if ((auth()->user()->permission == User::ADMIN) and $type == 'admin'){
            return array_filter($menu, function ($item){
                switch ($item['title']) {
                    case 'general.developer':
                        return false;
                    case 'general.check-update':
                        return false;
                    default:
                        return true;
                }
            })
        }
        return array_filter($menu, function ($item) {
            switch ($item['title']) {
                case 'general.developer':
                    return false;
                case 'general.player-manage':
                default:
                    return true;
            }
        });
    });
};
