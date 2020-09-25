<?php

namespace App\Providers;

use App\Participant;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('is-admin', function ($user,$conf_id=null,$access_role=null) {
            $isAdmin = false;
            if(!is_null($conf_id)){
                $userData = Participant::where("id",$conf_id)
                    ->where("account",Auth::id())
                    ->first();
                if(!is_null($userData)){
                    if(strtolower($userData->role) == "chair"){
                        $isAdmin = true;
                    }
                    if(!is_null($access_role)){
                        if($userData->role == $access_role){
                            $isAdmin = true;
                        }
                    }
                }
            }
            if($user->name == "admin")$isAdmin = true;
            return $isAdmin;
        });
    }
}
