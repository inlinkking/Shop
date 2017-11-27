<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use App\Http\Middleware\Sidebar;
use Cache,Auth;

class Permission extends Model
{
    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function children()
    {
        return $this->hasMany(Permission::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Permission::class, 'parent_id', 'id');
    }

    static function clear()
    {
        Cache::forget('system_permissions');
        Cache::forget('system_children_permissions');
        Cache::forget('menus_user_'.Auth::user()->id);
    }

    static function all_permission()
    {
        $permission = Cache::rememberForever('system_permissions', function () {
            return self::with([
                'children' => function ($query) {
                    $query->orderBy('sort_order')->orderBy('id');
                    $query->with([
                        'children' => function ($query) {
                            $query->orderBy('sort_order')->orderBy('id');
                        }
                    ]);
                },
            ])->where('parent_id', 0)->orderBy('sort_order')->orderBy('id')->get();
        });

        return $permission;
    }

    static function get_children()
    {
        $children_permissions = Cache::rememberForever('system_children_permissions', function () {
            return self::with([
                'children' => function ($query) {
                    $query->orderBy('sort_order');
                }
            ])->where('parent_id', 0)->orderBy('sort_order')->get();
        });

        return $children_permissions;
    }


    /**
     * 检查是否有子栏目
     */
    static function check_children($id)
    {
        $permission = self::with('children')->find($id);
        if ($permission->children->isEmpty()) {
            return true;
        }
        return false;
    }
}
