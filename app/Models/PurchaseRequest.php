<?php

namespace App\Models;

use App\Models\AcquisitionFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseRequest extends Model
{
    use HasFactory;

    protected $appends = ['files'];
   
    public function getFilesAttribute()
    {
      
        $files = AcquisitionFile::where('acquisition_id', $this->id)->get();
        return $this->attributes['files'] = $files;
    }
}
