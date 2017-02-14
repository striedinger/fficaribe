<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //Users
        Gate::define('view-user', function($user, $user1){
            return $user->isAdmin() || $user->id == $user1->id;
        });

        Gate::define('update-user', function($user, $user1){
            return $user->isAdmin() || $user->id == $user1->id;
        });
        //Companies
        Gate::define('create-company', function($user){
            return $user->isEmpresario() && !$user->company;
        });
        Gate::define('update-company', function($user, $company){
            return $user->isAdmin() || $user->id == $company->user_id;
        });
        //Projects
        Gate::define('create-project', function($user){
            return $user->isAdmin();//isEmpresario() &&  $user->company;
        });
        Gate::define('update-project', function($user, $project){
            return $user->isAdmin() || $user->company->id == $project->company_id;
        });
        Gate::define('view-project', function($user, $project){
            return $user->isAdmin() || $user->company->id == $project->company_id;
        });
        //Results
        Gate::define('create-result', function($user, $project){
            return $user->isAdmin() || $user->company->id == $project->company_id;
        });
        Gate::define('update-result', function($user, $result){
            return $user->isAdmin() || $user->company->id == $result->project->company_id;
        });
        Gate::define('destroy-result', function($user, $result){
            return $user->isAdmin() || $user->company->id == $result->project->company_id;
        });
        //Products
        Gate::define('create-product', function($user, $project){
            return $user->isAdmin() || $user->company->id == $project->company_id;
        });
        Gate::define('update-product', function($user, $product){
            return $user->isAdmin() || $user->company->id == $product->result->project->company_id;
        });
        Gate::define('destroy-product', function($user, $product){
            return $user->isAdmin() || $user->company->id == $product->result->project->company_id;
        });
        //Entities
        Gate::define('create-entity', function($user){
            return $user->company;
        });
        Gate::define('update-entity', function($user, $entity){
            return $user->isAdmin() || $user->company->id == $entity->company->id;
        });
        Gate::define('destroy-entity', function($user, $entity){
            return $user->isAdmin() || $user->company->id == $entity->company->id;
        });
        //Costs
        Gate::define('create-cost', function($user, $project){
            return $user->isAdmin() || $user->company->id == $project->company_id;
        });
        Gate::define('update-cost', function($user, $cost){
            return $user->isAdmin() || $user->company->id == $cost->project->company->id;
        });
        Gate::define('destroy-cost', function($user, $cost){
            return $user->isAdmin() || $user->company->id == $cost->project->company->id;
        });
        //Project Comments
        Gate::define('create-project-comment', function($user, $project){
            return $user->isAdmin() || $user->company->id == $project->company_id;
        });
        Gate::define('destroy-project-comment', function($user, $comment){
            return $user->isAdmin() || $user->id == $comment->user_id;
        });
    }
}
