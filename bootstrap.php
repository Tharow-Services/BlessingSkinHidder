<?php

namespace TharowServices\HideUtils;

use Blessing\Filter;

return function (Filter $filter) {
    //Manage Side Menu
    $filter->add('side_menu', function ($menu, $type) {
        switch ($type) {
            // Manage User Panel
            case 'user':
                switch (auth()->user()->permission) {
                    // Normal User
                    case 0: return array_filter($menu, function ($item) {
                            switch ($item['title']) {
                                case 'general.player-manage': break;
                                case 'general.developer': break;
                                default: return true;
                            } return false;
                        });
                    // Normal Admin
                    case 1: return array_filter($menu, function ($item) {
                            switch ($item['title']) {
                                case 'general.player-manage': break;
                                case 'general.developer': break;
                                default: return true;
                            } return false;
                        });
                    // Super Admin
                    case 2:
                        return $menu;
                    default:
                        return $menu;
                }
                break;
            case 'admin':
                switch (auth()->user()->permission) {
                    case 0: return null;
                    // Normal Admin
                    case 1: return array_filter($menu, function ($item){
                        switch ($item['title']) {
                            case 'general.check-update': break;
                            case 'general.res-options': break;
                            case 'general.score-options': break;
                            case 'general.plugin-manage': break;
                            case 'general.plugin-configs': break;
                            case 'general.plugin-market': break;
                            case 'general.options': break;
                            case 'general.customize': break;
                            case 'general.il8n': break;
                            case 'general.player-manage': break;
                            case 'general.code': break;
                            default: return true;
                        } return false;
                    });
                    case 2: return $menu;
                    default: return $menu;
                }
            default: return $menu;
        }
    
    
    
    
    
        if (auth()->user()->isAdmin()){
	  if($type == 'user'){return $menu;}            
        }
        if ($type == 'admin') {
        if (auth()->user()->permission <= 1) {
            return array_filter($menu, function ($item) {
              switch ($item['title']) {
                case 'general.check-update':
                  return false;
                case 'general.res-options':
                  return false;
		case 'general.score-options':
		  return false;
                case 'general.plugin-manage':
                  return false;
		case 'general.plugin-market':
                  return false;
		case 'general.plugin-configs':
                  return false;
		case 'general.options':
                  return false;
		case 'general.customize':
		  return false;
		case 'general.i18n':
		  return false;
		case 'general.player-manage':
		  return false;
		case 'front-end.invitation-codes.placeholder':
                  return false;
                default:
                  return true;
              }
            });
          }
        }
        if ($type == 'user'){
        return array_filter($menu, function ($item) {
            switch ($item['title']) {
                case 'general.developer':
                    return false;
                case 'general.player-manage':
		    return false;
                default:
                    return true;
            }
        });}
        return $menu;
    });
};
