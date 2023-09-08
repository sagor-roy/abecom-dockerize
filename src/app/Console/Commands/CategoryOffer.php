<?php

namespace App\Console\Commands;

use App\Models\Coupon;
use App\Models\GuestVerification;
use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CategoryOffer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'offer:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Category offer removed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        //remove offer from category and products start
        $offers = Offer::where('status', true)->get();
        foreach( $offers as $offer ){
            $offer_date = Carbon::parse($offer->end_date)->toDateString();
            $yesterday =  Carbon::now()->yesterday()->toDateString();
            if( $offer_date == $yesterday ){
                $offer->status = false;
                $offer->save();
                //remove existing offers start
                foreach( $offer->category as $exists_offer_category ){
                    $exists_offer_category->offer_status = false;
                    $exists_offer_category->save();
                    foreach( $exists_offer_category->product as $exists_offer_category_product ){
                        $exists_offer_category_product->offer_status = false;
                        $exists_offer_category_product->offer_price = null;
                        $exists_offer_category_product->offer_id = null;
                        $exists_offer_category_product->save();
                    }
                }
                foreach( $offer->product as $exists_offer_product ){
                    $exists_offer_product->offer_status = false;
                    $exists_offer_product->offer_status = false;
                    $exists_offer_product->offer_id = null;
                    $exists_offer_product->save();
                }
                //remove existing offers end
            }
        }
        //remove offer from category and products end

        //remove coupon start
        $coupons = Coupon::where('is_active', true)->get();
        foreach( $coupons as $coupon ){
            $coupon_date = Carbon::parse($coupon->end_date)->toDateString();
            $yesterday =  Carbon::now()->yesterday()->toDateString();
            if( $coupon_date == $yesterday ){
                $coupon->is_active = false;
                $coupon->save();
            }
        }
        //remove coupon end

        //remove verification code start
        GuestVerification::truncate();
        //remove verification code end

    }
}
