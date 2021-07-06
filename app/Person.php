<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CPNVEnvironment\Environment;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Support\Facades\Auth;

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
     * Returns the internships in which the person is the intern
     */
    public function internshipsAsStudent()
    {
        return $this->hasMany('App\Internship', "intern_id");
    }

    /**
     * Returns all internships in which the person is the teacher
     */
    public function internshipsAsTeacher()
    {
        return Internship::whereHas('student.flock', function ($query) {
            $query->where('classMaster_id', $this->id);
        })->orderBy('beginDate', 'DESC')->get();
    }

    /**
     * Returns the internships that are in the futer and in which the person is the teacher
     */
    public function currentInternshipsAsTeacher()
    {
        return Internship::whereHas('student.flock', function ($query) {
            $query->where('classMaster_id', $this->id);
        })->where('endDate','>','2021-01-01')->orderBy('beginDate', 'DESC')->get();
    }

    /**
     * Returns the internships in which the person is the manager
     */
    public function internshipsAsResponsible()
    {
        return $this->hasMany('App\Internship', "responsible_id");
    }

    /**
     * Relation to the internship of the admin
     */
    public function internshipsAsAdmin()
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
        return $this->hasMany('App\Contactinfos', "persons_id");
    }

    public function humanContactInfo()
    {
        $emailInfo = $this->contactinfo->where('contacttypes_id', '1')->first();
        $phoneInfo = $this->contactinfo->where('contacttypes_id', '2')->first();
        $mobileInfo = $this->contactinfo->where('contacttypes_id', '3')->first();

        return [
            'email' => $emailInfo ? $emailInfo->value : '',
            'phone' => $phoneInfo ? $phoneInfo->value : '',
            'mobilePhone' => $mobileInfo ? $mobileInfo->value : ''
        ];
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
        return $query->where('firstname', 'like', "%{$name}%")->orWhere('lastname', 'like', "%{$name}%");
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
        return $this->contactinfo->where("contacttypes_id", Contacttypes::EMAIL)->pluck("value");
    }

    /**
     * Get the initials or the full name
     * @param $value
     * @return mixed
     */
    public function getInitialsAttribute($value)
    {
        return empty($value) ? $this->fullName : $value;
    }
}
