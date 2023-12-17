<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Administrator extends Model
{
    use HasFactory;

    protected $appends = ['creator',  'status_name', 'role'];
    protected $hidden = [
        'password',
    ];


    
    public function getCreatorAttribute()
    {

        $creator = "";

        $createdBy = Administrator::find($this->added_by);
        if ($createdBy) {
            $creator = $createdBy->first_name . ' ' . $createdBy->last_name;

        }
        return $this->attributes['creator'] = $creator;
    }


    public function getStatusNameAttribute()
    {
        $statusName = '';
        $getStatus = $this->status;
        if ($getStatus == 0) {
            $statusName = 'Inactive';
        } elseif ($getStatus == 1) {
            $statusName = 'Active';
        }
        return $this->attributes['status_name'] = $statusName;
    }

    
    public function getRoleAttribute()
    {
        $role = '';
        $roleId = $this->role_id;
        if ($roleId) {
            $getRole = Role::find($roleId);

            if ($getRole) {
                $role = $getRole->name;
            }
        }
        return $this->attributes['role'] = $role;
    }
}
