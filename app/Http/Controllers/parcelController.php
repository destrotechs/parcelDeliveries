<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Parcel;
use App\Models\SMS;
use PDF;
use Illuminate\Pagination\CursorPaginator;
class parcelController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }
    public function allparcels(){
        $sent_parcels = DB::table('parcels')->join('users','users.id','=','parcels.source_station_id')->where('parcels.source_station_id','=',Auth::user()->id);
        // $parcels = DB::table('parcels')->join('users','users.id','=','parcels.destination_station_id')->where('parcels.destination_station_id','=',Auth::user()->id)->union($sent_parcels)->get();
        $stations = array();
        $parcels = DB::table('parcels')->join('users','users.id','=','parcels.destination_station_id')->where('parcels.destination_station_id','=',Auth::user()->id)->orWhere('parcels.source_station_id','=',Auth::user()->id)->distinct()->select('parcels.*','users.station_name')->orderBy('parcels.id','DESC')->cursorPaginate(10);

        foreach($parcels as $p){
            $tostationname = DB::table('users')->where('id','=',$p->destination_station_id)->pluck('station_name');
            if($p->source_station_id==Auth::user()->id){
                array_push($stations,'To '.$tostationname[0]);
            }else{
                $fromstationname = DB::table('users')->where('id','=',$p->source_station_id)->pluck('station_name');
                array_push($stations,'From '.$fromstationname[0]);
            }
        }

        return view('parcels.allparcels',compact('parcels','stations'));
    }
    public function newparcel(){
        $stations = DB::table('users')->get();
        return view('parcels.newparcel',compact('stations'));
    }
    public function postnewparcel(Request $request){
        // $validated = $request->validate([
        //     'type' => 'required',
        //     'destination_station_id' => 'required',
        //     'quantity'=>'required',
        //     'payment_mode'=>'required',
        //     'cost'=>'required',
        //     'sender_phone'=>'required',
        //     'sender_name'=>'required',
        //     'recipient_phone'=>'required',
        // ]);
        $parcel_no =  substr($request->get('type'),0,1).mt_rand();
        $parcel = new Parcel;
        $parcel->type = $request->get('type');
        $parcel->percel_no =$parcel_no;
        $parcel->sender_name = $request->get('sender_name');
        $parcel->sender_phone = $request->get('sender_phone');
        $parcel->sender_idnumber = $request->get('sender_idnumber');
        $parcel->receiver_name = $request->get('recipient_name');
        $parcel->receiver_phone = $request->get('sender_phone');
        $parcel->receiver_idnumber = $request->get('recipient_idnumber');

        $parcel->quantity = $request->get('quantity');
        $parcel->cost=$request->get('cost');
        $parcel->payment_mode = $request->get('payment_mode');
        $parcel->destination_station_id = $request->get('destination_station_id');
        $parcel->source_station_id = Auth::user()->id;
        $parcel->send_date=date("Y/m/d");

        $status = $parcel->save();


        if($status){
            // $sms = new SMS();
            // $status = $sms->sendSMS(254704211227,"Fulcrum parcel services test message : Percel Number :");
            if($status){
                echo "success, sms sent";
            }else{
                echo "Failed to send sms";
            }
            
        }else{
            echo "error";
        }


    }
    public function actiononparcel(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');
        $parcel = Parcel::find($id);
        $parcel->status = $status;
        $parcel->save();

        // send sms now
        $success = "Action completed";
        //redirect

        return redirect()->back()->with("success",$success);

    }
    public function parceldetails($percel_no){
        $parcel = DB::table('parcels')->where('percel_no','=',$percel_no)->get();
        return response()->json(['result'=>$parcel]);
    }
    public function searchparcel(Request $request){
        $searchkey = $request->get('searchkey');
        $parcel = DB::table('parcels')->where('percel_no','like','%'.$searchkey.'%')->join('users','users.id','=','parcels.destination_station_id')->where('parcels.destination_station_id','=',Auth::user()->id)->orWhere('parcels.source_station_id','=',Auth::user()->id)->distinct()->select('parcels.*','users.station_name')->orderBy('parcels.id','DESC')->cursorPaginate(10);
        
        $table = "";
        if(count($parcels)>0){
            
            return response()->json(['result'=>$parcel]);
        }else{
            echo "not found";
        }

        
    }
    public function createPDF(){
        $sent_parcels = DB::table('parcels')->join('users','users.id','=','parcels.source_station_id')->where('parcels.source_station_id','=',Auth::user()->id);
        // $parcels = DB::table('parcels')->join('users','users.id','=','parcels.destination_station_id')->where('parcels.destination_station_id','=',Auth::user()->id)->union($sent_parcels)->get();
        $stations = array();
        $parcels = DB::table('parcels')->join('users','users.id','=','parcels.destination_station_id')->where('parcels.destination_station_id','=',Auth::user()->id)->orWhere('parcels.source_station_id','=',Auth::user()->id)->distinct()->select('parcels.*','users.station_name')->orderBy('parcels.id','DESC')->cursorPaginate(20);
        $total = 0;
        foreach($parcels as $p){
            $total+=$p->cost;
            $tostationname = DB::table('users')->where('id','=',$p->destination_station_id)->pluck('station_name');
            if($p->source_station_id==Auth::user()->id){
                array_push($stations,'To '.$tostationname[0]);
            }else{
                $fromstationname = DB::table('users')->where('id','=',$p->source_station_id)->pluck('station_name');
                array_push($stations,'From '.$fromstationname[0]);
            }
        }

        view()->share('parcels',$parcels);

        $pdf = PDF::loadView('pdf.parcelspdf',compact('parcels','stations','total'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('parcels.pdf');

    }
}
