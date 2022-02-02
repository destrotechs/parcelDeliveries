<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;

    protected $fillable = ['sender_name','percel_no','cost','payment_mode','quantity','sender_phone','sender_idnumber','receiver_idnumber','receiver_name','recipient_phone','source_station_id','destination_station_id','type','weight','send_date'];
}
