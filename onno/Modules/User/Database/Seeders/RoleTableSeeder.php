<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Superadmin','slug' => 'superadmin', 'permissions' => $this->getAdminRolePermissions()]);

        Role::create(['name' => 'Admin','slug' => 'admin', 'permissions' => $this->getDemoAdminRolePermissions()]);

        Role::create(['name' => 'Editor','slug' => 'editor', 'permissions' => $this->getDemoEditorRolePermissions()]);

        Role::create(['name' => 'User','slug' => 'user']);

        Role::create(['name' => 'Subscriber','slug' => 'subscriber']);
        // Model::unguard();

        // $this->call("OthersTableSeeder");
    }
    private function getAdminRolePermissions()
    {
        return [
            // permissions

            "users_read" => true,
            "users_write" => true,
            "users_delete" => true,

            "settings_read" => true,
            "settings_write" => true,
            "settings_delete" => true,

            "role_read" => true,
            "role_write" => true,
            "role_delete" => true,

            "permission_read" => true,
            "permission_write" => true,
            "permission_delete" => true,

            "language_settings_read" => true,
            "language_settings_write" => true,
            "language_settings_delete" => true,

            "pages_read" => true,
            "pages_write" => true,
            "pages_delete" => true,

            "menu_read" => true,
            "menu_write" => true,
            "menu_delete" => true,

            "menu_item_read" => true,
            "menu_item_write" => true,
            "menu_item_delete" => true,

            "post_read" => true,
            "post_write" => true,
            "post_delete" => true,

            "category_read" => true,
            "category_write" => true,
            "category_delete" => true,

            "sub_category_read" => true,
            "sub_category_write" => true,
            "sub_category_delete" => true,

            "widget_read" => true,
            "widget_write" => true,
            "widget_delete" => true,

            "newsletter_read" => true,
            "newsletter_write" => true,
            "newsletter_delete" => true,

            "notification_read" => true,
            "notification_write" => true,
            "notification_delete" => true,

            "contact_message_read" => true,
            "contact_message_write" => true,
            "contact_message_delete" => true,

            "ads_read" => true,
            "ads_write" => true,
            "ads_delete" => true,

            "theme_section_read" => true,
            "theme_section_write" => true,
            "theme_section_delete" => true,

            "polls_read" => true,
            "polls_write" => true,
            "polls_delete" => true,

            "socials_read" => true,
            "socials_write" => true,
            "socials_delete" => true,

            "comments_read" => true,
            "comments_write" => true,
            "comments_delete" => true,
        ];
    }
    private function getDemoAdminRolePermissions()
    {
        return [
            // permissions

            "users_read" => true,
            "users_write" => true,

            "settings_read" => true,
            "settings_write" => true,

            "role_read" => true,
            "role_write" => true,

            "permission_read" => true,
            "permission_write" => true,

            "language_settings_read" => true,
            "language_settings_write" => true,

            "pages_read" => true,
            "pages_write" => true,

            "menu_read" => true,
            "menu_write" => true,

            "menu_item_read" => true,
            "menu_item_write" => true,

            "post_read" => true,
            "post_write" => true,

            "category_read" => true,
            "category_write" => true,

            "sub_category_read" => true,
            "sub_category_write" => true,

            "widget_read" => true,
            "widget_write" => true,

            "newsletter_read" => true,
            "newsletter_write" => true,

            "notification_read" => true,
            "notification_write" => true,

            "contact_message_read" => true,
            "contact_message_write" => true,

            "ads_read" => true,
            "ads_write" => true,

            "theme_section_read" => true,
            "theme_section_write" => true,

            "polls_read" => true,
            "polls_write" => true,

            "socials_read" => true,
            "socials_write" => true,

            "comments_read" => true,
            "comments_write" => true,
        ];
    }

    private function getDemoEditorRolePermissions()
    {
        return [
            // permissions



            "pages_read" => true,
            "pages_write" => true,

            "menu_read" => true,
            "menu_write" => true,

            "menu_item_read" => true,
            "menu_item_write" => true,

            "post_read" => true,
            "post_write" => true,

            "category_read" => true,
            "category_write" => true,

            "sub_category_read" => true,
            "sub_category_write" => true,

            "widget_read" => true,
            "widget_write" => true,

            "newsletter_read" => true,
            "newsletter_write" => true,

            "notification_read" => true,
            "notification_write" => true,

            "contact_message_read" => true,
            "contact_message_write" => true,

            "ads_read" => true,
            "ads_write" => true,

            "polls_read" => true,
            "polls_write" => true,
        ];
    }
}
