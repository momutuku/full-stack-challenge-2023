<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ESolution\DBEncryption\Traits\EncryptedAttribute;

class Comment extends Model
{
    protected $primaryKey = 'uri'; // Specify the primary key
    protected $fillable = ['comment', 'reference_no','user']; // Specify the fillable fields

    // public function referral()
    // {
    //     return $this->belongsTo(Referral::class, 'reference_no', 'reference_no');
    // }
    protected $encryptable = [
        'reference_no'];
}
