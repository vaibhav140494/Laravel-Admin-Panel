<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menus')->delete();
        
        \DB::table('menus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'type' => 'backend',
                'name' => 'Backend Sidebar Menu',
                'items' => '[{"view_permission_id":"view-module","icon":"fa-wrench","open_in_new_tab":0,"url_type":"route","url":"admin.modules.index","name":"Module","id":1,"content":"Module"},{"view_permission_id":"view-menu","icon":"fa-bars","open_in_new_tab":0,"url_type":"route","url":"admin.menus.index","name":"Menus","id":3,"content":"Menus"},{"view_permission_id":777,"icon":"fa-list","open_in_new_tab":0,"url_type":"route","url":"admin.categories.index","name":"Category","id":20,"content":"Category"},{"id":21,"name":"Product","url":"admin.products.index","url_type":"route","open_in_new_tab":0,"icon":"fa-product-hunt","view_permission_id":777,"content":"Product"},{"id":22,"name":"Offer","url":"admin.offers.index","url_type":"route","open_in_new_tab":0,"icon":"fa-gift","view_permission_id":"view-offer-permission","content":"Offer"},{"id":23,"name":"Order","url":"admin.orders.index","url_type":"route","open_in_new_tab":0,"icon":"fa-first-order","view_permission_id":"view-order-permission","content":"Order"},{"id":24,"name":"SupportTicket","url":"admin.supporttickets.index","url_type":"route","open_in_new_tab":0,"icon":"fa-support","view_permission_id":"view-supportticket-permission","content":"SupportTicket"},{"view_permission_id":"view-user-management","icon":"fa-users","open_in_new_tab":0,"url_type":"route","url":"admin.access.user.index","name":"User Management","id":25,"content":"User Management"}]',
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2020-01-22 11:40:22',
                'updated_at' => '2020-01-23 09:06:03',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}