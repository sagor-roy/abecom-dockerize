<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement("DELETE FROM sub_menus");
        DB::table('sub_menus')->insert([
            [
                'id' => 1,
                'menu_id' => 1,
                'name' => 'Home Banner',
                'url' => 'home.banner.all',
                'is_active' => true,
            ],
            [
                'id' => 2,
                'menu_id' => 1,
                'name' => 'Two Banner',
                'url' => 'two.banner.show',
                'is_active' => false,
            ],
            [
                'id' => 3,
                'menu_id' => 2,
                'name' => 'Categories',
                'url' => 'category.show',
                'is_active' => true,
            ],
            [
                'id' => 4,
                'menu_id' => 2,
                'name' => 'Sub Categories',
                'url' => 'subcategory.show',
                'is_active' => true,
            ],
            [
                'id' => 5,
                'menu_id' => 2,
                'name' => 'Brands',
                'url' => 'brand.show',
                'is_active' => true,
            ],
            [
                'id' => 6,
                'menu_id' => 2,
                'name' => 'Attribute',
                'url' => 'varient.show',
                'is_active' => true,
            ],
            [
                'id' => 7,
                'menu_id' => 3,
                'name' => 'Product Varient',
                'url' => 'attribute.show',
                'is_active' => true,
            ],
            [
                'id' => 8,
                'menu_id' => 3,
                'name' => 'Product Reviews',
                'url' => 'review.show',
                'is_active' => true,
            ],
            [
                'id' => 9,
                'menu_id' => 3,
                'name' => 'All Product',
                'url' => 'product.show',
                'is_active' => true,
            ],
            [
                'id' => 10,
                'menu_id' => 3,
                'name' => 'Add new product',
                'url' => 'product.add.view',
                'is_active' => true,
            ],
            [
                'id' => 11,
                'menu_id' => 4,
                'name' => 'Coupon code',
                'url' => 'coupon.show',
                'is_active' => true,
            ],
            [
                'id' => 12,
                'menu_id' => 4,
                'name' => 'Create New Offer',
                'url' => 'cat.offer.show',
                'is_active' => true,
            ],
            [
                'id' => 13,
                'menu_id' => 4,
                'name' => 'Purchase point',
                'url' => 'purchase.point.show',
                'is_active' => true,
            ],
            [
                'id' => 14,
                'menu_id' => 5,
                'name' => 'All Customer',
                'url' => 'customer.all',
                'is_active' => true,
            ],
            [
                'id' => 15,
                'menu_id' => 6,
                'name' => 'All Order',
                'url' => 'order.all',
                'is_active' => true,
            ],
            [
                'id' => 16,
                'menu_id' => 7,
                'name' => 'Delivery Charge',
                'url' => 'delivery.charge.all',
                'is_active' => true,
            ],
            [
                'id' => 17,
                'menu_id' => 7,
                'name' => 'Cities',
                'url' => 'city.all',
                'is_active' => true,
            ],
            [
                'id' => 18,
                'menu_id' => 7,
                'name' => 'Courier',
                'url' => 'courier.all',
                'is_active' => true,
            ],
            [
                'id' => 19,
                'menu_id' => 8,
                'name' => 'Create New Block',
                'url' => 'block.all',
                'is_active' => true,
            ],

            [
                'id' => 20,
                'menu_id' => 8,
                'name' => 'Our Clients',
                'url' => 'client.show',
                'is_active' => false,
            ],
            [
                'id' => 21,
                'menu_id' => 8,
                'name' => 'Social Media',
                'url' => 'media.all',
                'is_active' => true,
            ],
            [
                'id' => 22,
                'menu_id' => 8,
                'name' => 'Footer Widgets',
                'url' => 'widget.all',
                'is_active' => true,
            ],
            [
                'id' => 23,
                'menu_id' => 8,
                'name' => 'Home Gallery',
                'url' => 'home.gallery.all',
                'is_active' => true,
            ],
            [
                'id' => 24,
                'menu_id' => 9,
                'name' => 'All User',
                'url' => 'user.all',
                'is_active' => true,
            ],
            [
                'id' => 25,
                'menu_id' => 9,
                'name' => 'Roles',
                'url' => 'role.all',
                'is_active' => true,
            ],
            [
                'id' => 26,
                'menu_id' => 8,
                'name' => 'Counting',
                'url' => 'count.all',
                'is_active' => true,
            ],
            [
                'id' => 27,
                'menu_id' => 5,
                'name' => 'Subscribers',
                'url' => 'subscribers.all',
                'is_active' => true,
            ],
            [
                'id' => 28,
                'menu_id' => 8,
                'name' => 'Contact Details',
                'url' => 'contact.show',
                'is_active' => true,
            ],
            [
                'id' => 29,
                'menu_id' => 3,
                'name' => 'Product Q&A',
                'url' => 'product.qa',
                'is_active' => true,
            ],
            [
                'id' => 30,
                'menu_id' => 1,
                'name' => 'Small Banner',
                'url' => 'small.banner',
                'is_active' => true,
            ],
            [
                'id' => 31,
                'menu_id' => 10,
                'name' => 'About Us',
                'url' => 'about.show',
                'is_active' => true,
            ],
            [
                'id' => 32,
                'menu_id' => 10,
                'name' => 'Our Stores',
                'url' => 'stores.show',
                'is_active' => true,
            ],
            [
                'id' => 33,
                'menu_id' => 5,
                'name' => 'All Message',
                'url' => 'message.show',
                'is_active' => true,
            ],
            [
                'id' => 34,
                'menu_id' => 1,
                'name' => 'All Banner',
                'url' => 'banner.all',
                'is_active' => true,
            ],
            [
                'id' => 35,
                'menu_id' => 10,
                'name' => 'Corporate Sale',
                'url' => 'corporate.sale',
                'is_active' => true,
            ],
            [
                'id' => 36,
                'menu_id' => 10,
                'name' => 'Service Complaint',
                'url' => 'service.complaint',
                'is_active' => true,
            ],
            [
                'id' => 37,
                'menu_id' => 3,
                'name' => 'Price Matching',
                'url' => 'price.matching',
                'is_active' => true,
            ],
            [
                'id' => 38,
                'menu_id' => 7,
                'name' => 'Pick Up Point',
                'url' => 'pickup.point',
                'is_active' => true,
            ],
            [
                'id' => 39,
                'menu_id' => 8,
                'name' => 'Product Warranty',
                'url' => 'product.warranty.index',
                'is_active' => true,
            ],
            [
                'id' => 40,
                'menu_id' => 8,
                'name' => 'Custom Pages',
                'url' => 'custom.page',
                'is_active' => true,
            ],
            [
                'id' => 41,
                'menu_id' => 6,
                'name' => 'Checkout Page NB',
                'url' => 'checkout.page.nb.index',
                'is_active' => true,
            ],
            [
                'id' => 42,
                'menu_id' => 7,
                'name' => 'Thanas',
                'url' => 'thana.all',
                'is_active' => true,
            ],
            [
                'id' => 43,
                'menu_id' => 8,
                'name' => 'Bank Payment',
                'url' => 'bank_payment.all',
                'is_active' => true,
            ],
        ]);
    }
}
