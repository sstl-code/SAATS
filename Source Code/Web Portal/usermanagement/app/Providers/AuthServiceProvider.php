<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Functions;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
         Passport::tokensExpireIn(now()->addMinute(10));
         Passport::refreshTokensExpireIn(now()->addDays(1));
         Passport::personalAccessTokensExpireIn(now()->addMonths(6));
      
         $functions=Functions::where('status','t')->select(['function_url','function_name'])->get();
    $functionData=[];
     foreach($functions as $fdata){
       $functionData[$fdata->function_url]=$fdata->function_name ;
     }
  
    Passport::tokensCan(
        $functionData
    );
    }
    
}
