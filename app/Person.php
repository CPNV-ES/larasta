<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CPNVEnvironment\Environment;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

/**
 * TODO
 * Add the SoftDeletes to the model.
 */
class Person extends Model implements Authenticatable
{
    use AuthenticableTrait;

    public $timestamps = false;

    protected $table = 'persons'; //TODO: Bravo, vraiment, très utile. "People" en anglais au cas ou.

    protected $fillable = [
        'firstname',
        'lastname',
        'role'
    ];

    /**
     * @description A Location belong to person
     * @return the location of person
     */
    public function location()
    {
        return $this->belongsTo('App\Location');
    }
    
    public function company()
    {
        return $this->belongsTo('App\company', 'company_id');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    /**
     * Relation to the internship of the student
     */
    public function internships()
    {
        return $this->hasMany('App\Internship', 'responsible_id');
    }

    /**
     * Relation to the internship of the student
     */
    public function student()
    {
        return $this->hasMany('App\Internship', "intern_id");
    }

    /**
     * Relation to the internship of the responsible
     */
    public function responsible()
    {
        return $this->hasMany('App\Internship', "responsible_id");
    }

    /**
     * Relation to the internship of the admin
     */
    public function admin()
    {
        return $this->hasMany('App\Internship', "admin_id");
    }

    public function wishes()
    {
        return $this->hasMany('App\Wish', 'persons_id');
    }

    /**
     * Relation to the flock of the student
     */
    public function flock()
    {
        return $this->belongsTo('App\Flock', 'flock_id');
    }

    /**
     * Relation to the flock of the teacher
     */
    public function mcof()
    {
        return $this->hasMany('App\Flock', 'classMaster_id');
    }

    /**
     * Relation to the contactinfos of the teacher/students
     */
    public function contactinfo()
    {
        return $this->hasMany('App\Contactinfos',"persons_id");
    }

    /**
     * Computed property to get role name
     * Created by Davide Carboni
     *
     * @return string Eleve|Professeur|Company
     */
    public function getRolesAttribute()
    {
        switch ($this->role) {
            case (0):
                return "Elève";
                break;
            case (1):
                return "Professeur";
                break;
            case (2):
                return "Company";
                break;
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
     * Test if the person is a student
     *
     * @return bool
     */
    public function getIsStudentAttribute()
    {
        return ($this->role <= 0);
    }

    /**
     * Test if the person is a teacher
     *
     * @return bool
     */
    public function getIsTeacherAttribute()
    {
        return ($this->role >= 1);
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

    /**
     * @return JSON with mail(s) of user
     */
    public function emails()
    {
        return $this->contactinfo->where("contacttypes_id",Contacttypes::EMAIL)->pluck("value");
    }

    static function fromId($personId)
    {
        return self::where("id", $personId)->first();
    }
}