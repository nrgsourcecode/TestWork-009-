<?php

namespace App\Models;

class Task extends BaseModel
{
    protected $fillable = ['key', 'summary', 'description', 'assigned_to', 'status_id'];

}