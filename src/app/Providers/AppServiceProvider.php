<?php

namespace App\Providers;

use App\Models\CustomPage;
use App\Models\FooterWidget;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $footer_widgets = FooterWidget::where("is_active", true)->orderBy('position','asc')->select("id","widget")->with("customer_pages")->get();

        View::share([
            'footer_widgets' => $footer_widgets
        ]);

        Schema::defaultStringLength(191);

    }
}
