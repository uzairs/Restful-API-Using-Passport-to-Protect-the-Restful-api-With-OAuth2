<?php

namespace App\Providers;
use Carbon\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Buyer;
use App\Policies\BuyerPolicy;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Buyer::class => BuyerPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
         Passport::routes();
         Passport::tokensExpireIn(Carbon::now()->addMinutes(50));
         Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
         Passport::enableImplicitGrant(); 

        //

        Passport::tokensCan([

            'purchase-product'=> 'Create a new Transactions for a  specific product',
            'manage-products'=> 'Create,reade,update,and delete products (CRUD)',
             'manage-account'=>'Read your account data,id,name,email,if verified, and if verified,and if admin(cannot read passord). Modify your account data(email, and password) Connot delete your account',
             'read-general' => 'Read generial information like purchasing categories, perchased products,selling products,selling categories, your transactions (purchased 
             and sales)',





        ]);

    }



}
