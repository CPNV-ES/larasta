<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CPNVEnvironment\Environment;
/**
 * TODO
 * Add the SoftDeletes to the model.
 */

class Person extends Model
{

    public $timestamps = false;

    protected $table = 'persons';
    
    protected $fillable = [
        'firstname',
        'lastname',
        'role'
    ];
    
    /**
     * Relation to the internship of the student
     */
    public function internships()
    {
        return $this->hasMany('App\Internship');
    }

    /**
     * Relation to the flock of the student
     */
    public function flock()
    {
        return $this->belongsTo('App\Flock', 'flock_id');
    }

    /**
     * Computed property to get role name
     * Created by Davide Carboni
     * 
     * @return string Eleve|Professeur|Company
     */
    public function getRolesAttribute()
    {
        switch ($this->role)
        {
            case (0): return "Elève"; break;
            case (1): return "Professeur"; break;
            case (2): return "Company"; break;
        }
    }

    /**
     * Computed property to recompose full name
     * 
     * @return string The full name
     */
    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    /**
     * Scope a query to only include desactivated peoples.
     * Created by Davide Carboni
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeObsolete($query, $type)
    {
        if ($type == null)
            return $query->where('obsolete', '=', 0);
        else
            return $query->where('obsolete', '=', 1);
    }

    /**
     * Scope a query to only include a specific role
     * Created by Davide Carboni
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCategory($query, $filter)
    {
        return $query->whereIn('role', $filter);
    }

    /**
     * Scope a query to include only a specific name
     * Created by Davide Carboni
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeName($query, $name)
    {
        $query->where('firstname', 'like', '%' . $name . '%')->orWhere('lastname', 'like', '%' . $name . '%');
    }
     /** Computed property to recompose full name
     * 
     * @return string The email of the user
     */
    public function getMailAttribute()
    {
        return strtolower("{$this->firstname}.{$this->lastname}@cpnv.ch");
    }
}
