<?php

namespace App\Enums;

enum PermissionsEnum: string
{
    //role permissions
    case VIEW_ROLES = 'view_roles';
    case VIEW_ROLE = 'view_role';
    case DELETE_ROLE = 'delete_role';
    case UPDATE_ROLE = 'update_role';
    case CREATE_ROLE = 'create_role';

    //user permissions
    case VIEW_USERS = 'view_users';
    case VIEW_USER = 'view_user';
    case CHANGE_USER_ROLES = 'change_user_roles';

    //page permissions
    case STUDENT = 'student';
    case TEACHER = 'teacher';
    case ADMIN = 'admin';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
