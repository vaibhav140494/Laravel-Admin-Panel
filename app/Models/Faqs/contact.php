<?php

namespace App\Models\Faqs;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    protected $table='contacts';


    protected $fillable = ['name','email','subject','message'];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $guarded = [
        'id'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
