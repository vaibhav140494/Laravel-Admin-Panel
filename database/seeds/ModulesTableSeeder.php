<?php

use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('modules')->delete();
        
        \DB::table('modules')->insert(array (
            0 => 
            array (
                'id' => 1,
                'view_permission_id' => 'view-access-management',
                'name' => 'Access Management',
                'url' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2020-01-22 11:40:22',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'view_permission_id' => 'view-user-management',
                'name' => 'User Management',
                'url' => 'admin.access.user.index',
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2020-01-22 11:40:22',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'view_permission_id' => 'view-role-management',
                'name' => 'Role Management',
                'url' => 'admin.access.role.index',
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2020-01-22 11:40:22',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'view_permission_id' => 'view-permission-management',
                'name' => 'Permission Management',
                'url' => 'admin.access.permission.index',
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2020-01-22 11:40:22',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'view_permission_id' => 'view-menu',
                'name' => 'Menus',
                'url' => 'admin.menus.index',
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2020-01-22 11:40:22',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'view_permission_id' => 'view-module',
                'name' => 'Module',
                'url' => 'admin.modules.index',
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2020-01-22 11:40:22',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'view_permission_id' => 'view-page',
                'name' => 'Pages',
                'url' => 'admin.pages.index',
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2020-01-22 11:40:22',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'view_permission_id' => 'edit-settings',
                'name' => 'Settings',
                'url' => 'admin.settings.edit',
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2020-01-22 11:40:22',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'view_permission_id' => 'view-blog',
                'name' => 'Blog Management',
                'url' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2020-01-22 11:40:22',
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'view_permission_id' => 'view-blog-category',
                'name' => 'Blog Category Management',
                'url' => 'admin.blogcategories.index',
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2020-01-22 11:40:22',
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'view_permission_id' => 'view-blog-tag',
                'name' => 'Blog Tag Management',
                'url' => 'admin.blogtags.index',
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2020-01-22 11:40:22',
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'view_permission_id' => 'view-blog',
                'name' => 'Blog Management',
                'url' => 'admin.blogs.index',
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2020-01-22 11:40:22',
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'view_permission_id' => 'view-faq',
                'name' => 'Faq Management',
                'url' => 'admin.faqs.index',
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2020-01-22 11:40:22',
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'view_permission_id' => 'view-offer-permission',
                'name' => 'Offer',
                'url' => 'admin.offers.index',
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2020-01-22 11:55:03',
                'updated_at' => '2020-01-22 11:55:03',
            ),
            14 => 
            array (
                'id' => 15,
                'view_permission_id' => 'view-order-permission',
                'name' => 'Order',
                'url' => 'admin.orders.index',
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2020-01-22 12:49:12',
                'updated_at' => '2020-01-22 12:49:12',
            ),
            15 => 
            array (
                'id' => 16,
                'view_permission_id' => 'view-supportticket-permission',
                'name' => 'SupportTicket',
                'url' => 'admin.supporttickets.index',
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2020-01-23 05:21:36',
                'updated_at' => '2020-01-23 05:21:36',
            ),
        ));
        
        
    }
}