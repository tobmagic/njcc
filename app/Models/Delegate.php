<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delegate extends Model
{
   protected $fillable = [
   'full_name', 'email', 'phone', 'residential_address', 
    'company_name', 'job_title', 'organization_address', 
    'business_products', 'program_name', 'payment_proof', 
    'status', 'admin_notes'
];
}
