<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentHead extends Model
{
    use HasFactory;

    
    protected $appends = ['status_name', 'department'];
    public function getDepartmentAttribute()
    {
        $role = '';
        $roleId = $this->department_id;
        if ($roleId) {
            $getRole = Department::find($roleId);

            if ($getRole) {
                $role = $getRole->name;
            }
        }
        return $this->attributes['department'] = $role;

    }
    public function getStatusNameAttribute()
    {
        $statusName = '';
        $getStatus = $this->status;
        if ($getStatus == 0) {
            $statusName = 'No';
        } elseif ($getStatus == 1) {
            $statusName = 'Yes';
        }
        return $this->attributes['status_name'] = $statusName;
    }

}
