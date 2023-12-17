<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $appends = ['head'];
   
    public function getHeadAttribute()
    {
        $role = 'None';
        $roleId = $this->id;
        if ($roleId) {
            $getRole = @DepartmentHead::where('department_id',$roleId)->where('status', 1)->first();
            if ($getRole) {
                $role = $getRole->first_name . ' '.  $getRole->first_name ;
            }
        }
        return $this->attributes['head'] = $role;

    }
}
