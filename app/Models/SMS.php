<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    use HasFactory;
    protected $APIKEY= '';
    protected $PARTNERID = '';
    protected $SHORTCODE = '';
    protected $ENDPOINT = '';
    protected $TIMETOSEND = '';


    public static function sendSMS($phone,$message){
                $smsgatewaUrl='https://sms.movesms.co.ke/api/compose?';
                $curl=curl_init();
                curl_setopt($curl, CURLOPT_URL, $smsgatewaUrl);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                $data_string = array(
                    'username'=>'HewaNet',
                    'api_key'=>'c04EhaD3ipcTGztn5albuExDHTdLCRPzP0BYUNYYF32UxShhDc',
                    'sender'=>'SMARTLINK',
                    'to'=>$phone,
                    'message'=>$message,
                    'msgtype'=>'5',
                    'dlr'=>'1',
                );
                $data=json_encode($data_string);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                curl_setopt($curl, CURLOPT_HEADER, false);
                $curl_response=curl_exec($curl);                
                if($curl_response=='Message Sent:1701'){
                    return true;
                }else{
                    return false;
                }
    }
}
