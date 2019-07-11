<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\Translatable;

class Inquiry extends Model{

    use Translatable;

    protected $translatable = ['slug', 'name'];

    protected $table = 'inquiry';

    protected $fillable = ['firstName', 'lastName', 'address', 'contactNo', 'emailID', 'occupation', 'inquiryFor', 'status'];

    public function inquiries()
    {
        return $this->hasMany(Voyager::modelClass('Inquiries'))
            ->published()
            ->orderBy('created_at', 'DESC');
    }

    public function parentId()
    {
        return $this->belongsTo(self::class);
    }

}
