<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
  protected $table = "job";
  protected $primaryKey = "job_id";
  public $timestamps = false;

  public function bid(){
    return $this->hasMany('App\Bid', 'job_id');
  }
}