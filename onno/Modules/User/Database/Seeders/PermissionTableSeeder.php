<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'users',
            'slug' => 'users_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'users',
            'slug' => 'users_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'users',
            'slug' => 'users_delete',
            'description' => '',
        ]);


        Permission::create([
            'name' => 'role',
            'slug' => 'role_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'role',
            'slug' => 'role_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'role',
            'slug' => 'role_delete',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission',
            'slug' => 'permission_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'permission',
            'slug' => 'permission_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'permission',
            'slug' => 'permission_delete',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'settings',
            'slug' => 'settings_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'settings',
            'slug' => 'settings_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'settings',
            'slug' => 'settings_delete',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'language_settings',
            'slug' => 'language_settings_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'language_settings',
            'slug' => 'language_settings_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'language_settings',
            'slug' => 'language_settings_delete',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'pages',
            'slug' => 'pages_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'pages',
            'slug' => 'pages_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'pages',
            'slug' => 'pages_delete',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'menu',
            'slug' => 'menu_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'menu',
            'slug' => 'menu_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'menu',
            'slug' => 'menu_delete',
            'description' => '',
        ]);

        //menu item
        Permission::create([
            'name' => 'menu_item',
            'slug' => 'menu_item_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'menu_item',
            'slug' => 'menu_item_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'menu_item',
            'slug' => 'menu_item_delete',
            'description' => '',
        ]);

        //post
        Permission::create([
            'name' => 'post',
            'slug' => 'post_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'post',
            'slug' => 'post_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'post',
            'slug' => 'post_delete',
            'description' => '',
        ]);

        //category
        Permission::create([
            'name' => 'category',
            'slug' => 'category_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'category',
            'slug' => 'category_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'category',
            'slug' => 'category_delete',
            'description' => '',
        ]);

        //sub_category
        Permission::create([
            'name' => 'sub_category',
            'slug' => 'sub_category_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'sub_category',
            'slug' => 'sub_category_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'sub_category',
            'slug' => 'sub_category_delete',
            'description' => '',
        ]);

        //widget
        Permission::create([
            'name' => 'widget',
            'slug' => 'widget_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'widget',
            'slug' => 'widget_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'widget',
            'slug' => 'widget_delete',
            'description' => '',
        ]);

        //newsletter
        Permission::create([
            'name' => 'newsletter',
            'slug' => 'newsletter_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'newsletter',
            'slug' => 'newsletter_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'newsletter',
            'slug' => 'newsletter_delete',
            'description' => '',
        ]);

        //notification
        Permission::create([
            'name' => 'notification',
            'slug' => 'notification_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'notification',
            'slug' => 'notification_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'notification',
            'slug' => 'notification_delete',
            'description' => '',
        ]);

        //contact_message
        Permission::create([
            'name' => 'contact_message',
            'slug' => 'contact_message_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'contact_message',
            'slug' => 'contact_message_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'contact_message',
            'slug' => 'contact_message_delete',
            'description' => '',
        ]);

        //ads
        Permission::create([
            'name' => 'ads',
            'slug' => 'ads_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'ads',
            'slug' => 'ads_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'ads',
            'slug' => 'ads_delete',
            'description' => '',
        ]);

        //ads
        Permission::create([
            'name' => 'theme_section',
            'slug' => 'theme_section_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'theme_section',
            'slug' => 'theme_section_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'theme_section',
            'slug' => 'theme_section_delete',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'socials',
            'slug' => 'socials_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'socials',
            'slug' => 'socials_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'socials',
            'slug' => 'socials_delete',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'polls',
            'slug' => 'polls_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'polls',
            'slug' => 'polls_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'polls',
            'slug' => 'polls_delete',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'comments',
            'slug' => 'comments_read',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'comments',
            'slug' => 'comments_write',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'comments',
            'slug' => 'comments_delete',
            'description' => '',
        ]);

        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
