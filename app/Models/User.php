<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @return array
     */
    public function getViews(): array {
        $views = [
            ['view' => 'Dashboard', 'route' => 'home'],
        ];
        return $views;
    }

    /**
     * @return array
     */

    public function getViewsFromDatabase(): array {
        try {
        $results = DB::table('master_views')->select('ViewName','ViewRoute')->get();
        $views = $results -> map(function ($view) {return['view'=>$view->ViewName,'route'=>$view->ViewRoute];})->toarray();
        return $views;
        } catch (\Exception $e) {
        return [];
        }
    }

}
