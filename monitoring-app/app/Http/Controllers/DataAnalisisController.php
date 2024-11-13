<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\DataUser;
use App\Models\SensorBmp;
use App\Exports\BmpExport;
use App\Models\DataDevice;
use App\Models\SensorBn220;
use App\Models\SensorThm30;
use App\Models\SensorIna219;
use Illuminate\Http\Request;
use App\Exports\Ina219Export;
use App\Exports\Thm30dExport;
use App\Models\SensorThigrow;
use App\Exports\ThigrowExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class DataAnalisisController extends Controller
{
    public function index(Request $request){

        $dataDevice = DataDevice::all();
        
        // $model = new SensorThigrow();
        // $tableColumns = $model->getTableColumns();
        // $data = SensorThigrow::with('device')->get();
        // dd($dataDevice);
        return view('data/home', compact(['dataDevice']));
    }

    public function viewPDF(Request $request){


        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);

        $selectedValue = $request->input('device');

        dd($selectedValue);
        // $pdf = Pdf::loadView('data.exportPDF', compact('data'))->setPaper('a4','landscape');
        // return $pdf->stream();

    }

    public function viewPDFS(){
        $data = SensorThigrow::all();

        return view('/data/exportPDF', compact(['data']));
    }

    public function getDataSensor($token, Request $request){
        $dvc = DataDevice::where('token', $token)->select('id', 'token', 'kode_device','nama_device');

        $thigrow = SensorThigrow::where('device_token', $token)->select('id','device_token','temperature','kelembaban_tanah_th','kelembaban_tanah_sm','battery','i_cahaya','kelembaban_udara','kadar_garam','created_at')->latest()->limit(10)->get();
        
        $bmp180 = SensorBmp::where('device_token', $token)->select('id','device_token','tekanan_udara','tinggi_permukaan','battery','created_at')->latest()->limit(10)->get();//temperature diganti ke tinggi_permukaan
        
        $thm30d = SensorThm30::where('device_token', $token)->select('id','device_token','temperature','kelembaban_udara','battery','created_at')->latest()->limit(10)->get();
        
        $bn220 = SensorBn220::where('device_token', $token)->select('id','device_token','latitude','longitude','battery','created_at')->latest()->get();
        
        $ina219 = SensorIna219::where('device_token', $token)->select('id','device_token','tegangan','arus','daya','created_at')->latest()->limit(10)->get();
        
        if(empty($thigrow)&&empty($bn220)&&empty($ina219)&&empty($thm30d)&&empty($bmp180)){
            return response()->json(['dvc'=>$dvc, 'thigrow'=>[], 'bn220'=>[], 'ina219'=>[],'thm30d'=>[],'bmp180'=>[]]);
        }
        
        // return response()->json(['dvc'=>$dvc]);
        return response()->json(['dvc'=>$dvc, 'thigrow'=>$thigrow,'bn220'=>$bn220,'ina219'=> $ina219,'thm30d'=> $thm30d,'bmp180'=>$bmp180]);
    }

    // public function filter(Request $request){
    //     $request->validate([
    //         'selectedDevice' => 'required',
    //         'selectedSensor' => 'required',
    //         'startDate' => 'required',
    //         'endDate' => 'required',
    //     ]);
    //     $selectedDevice = $request->input('selectedDevice');
    //     $selectedSensor = $request->input('selectedSensor');
    //     $startDate = $request->input('dateStart');
    //     $endDate = $request->input('dateEnd');

    //     return response()->json([
    //         'selectedDevice' => $selectedDevice,
    //         'selectedSensor' => $selectedSensor,
    //         'startDate' => $startDate,
    //         'endDate' => $endDate,
    //         'message' => 'Data received and processed successfully'
    //     ]);

    // public function filter(){

    // }
    //     // dd($selectedDevice);

    //     // if($selectedSensor==='thigrow'){
    //     //    $data = SensorThigrow::where('device_token', $selectedDevice)
    //     //     ->whereDate('created_at','>=', $startDate)
    //     //     ->whereDate('created_at', '<=', $endDate)
    //     //     ->get();
    //     //     return response()->json([
    //     //         'data'=>$data
    //     //     ]);
    //     //     // dd($data);
    //     // } else {
    //     //     // Handle kasus tanpa sensor yang ditetapkan, contohnya:
    //     //     return response()->json(['error' => 'Invalid sensor type']);
    //     // }
    // }   

    public function filterGet($selectedDevice, $selectedSensor, $startDate, $endDate){

        if($selectedSensor=='thigrow'){
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();
            $dvc= DataDevice::where('token', $selectedDevice)->select('id','nama_device')->get();
            $thigrow = SensorThigrow::where('device_token', $selectedDevice)
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->get();
            // ->where('created_at', $selectedSensor)
            // ->select('id','device_token','temperature','kelembaban_tanah_th','kelembaban_tanah_sm','battery','i_cahaya','kelembaban_udara','kadar_garam','created_at')
            if ($dvc->isEmpty() || $thigrow->isEmpty()) {
                return response()->json(['message' => 'Tidak ada data yang ditemukan']);
            }

            // $mergedData = $thigrow->toArray();
            // $mergedData = array_merge($mergedData, $dvc->toArray());
            $mergedData = [];

            foreach ($dvc as $device) {
                // Find all corresponding thigrow data for the device
                $thigrowData = $thigrow->where('device_token', $selectedDevice)->all();
        
                // Merge data into a single array for the device
                foreach ($thigrowData as $thigrowItem) {
                    $mergedData[] = [
                        'id' => $device->id,
                        'nama_device' => $device->nama_device,
                        'temperature' => $thigrowItem->temperature ?? null,
                        'kelembaban_tanah_th' => $thigrowItem->kelembaban_tanah_th ?? null,
                        'kelembaban_tanah_sm' => $thigrowItem->kelembaban_tanah_sm ?? null,
                        'battery' => $thigrowItem->battery ?? null,
                        'i_cahaya' => $thigrowItem->i_cahaya ?? null,
                        'kelembaban_udara' => $thigrowItem->kelembaban_udara ?? null,
                        'kadar_garam' => $thigrowItem->kadar_garam ?? null,
                        'created_at' => $thigrowItem->created_at ?? null,
                    ];
                }
                if (empty($thigrowData)) {
                    $mergedData[] = [
                        'id' => $device->id,
                        'nama_device' => $device->nama_device,
                        'temperature' => null,
                        'kelembaban_tanah_th' => null,
                        'kelembaban_tanah_sm' => null,
                        'battery' => null,
                        'i_cahaya' => null,
                        'kelembaban_udara' => null,
                        'kadar_garam' => null,
                        'created_at' => null,
                    ];
                }
            }
            return response()->json(['datas'=>$mergedData,
            // 'dvc'=>$dvc,
            'message'=>'berhasil memanggil data' ]);
        } else if($selectedSensor=='ina219'){
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();
            $dvc = DataDevice::where('token', $selectedDevice)
                ->select('id', 'nama_device')
                ->get();

            $ina219 = SensorIna219::where('device_token', $selectedDevice)
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            // ->select('id', 'device_token', 'tegangan', 'arus', 'daya', 'created_at')
            // ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

            // $mergedData = $ina219->toArray();
            // $mergedData = array_merge($mergedData, $dvc->toArray());
            $mergedData = [];

            foreach ($dvc as $device) {
                // Find all corresponding thigrow data for the device
                $inaData = $ina219->where('device_token', $selectedDevice)->all();
        
                // Merge data into a single array for the device
                foreach ($inaData as $inaItem) {
                    $mergedData[] = [
                        'id' => $device->id,
                        'nama_device' => $device->nama_device,
                        'tegangan' => $inaItem->tegangan ?? null,
                        'arus' => $inaItem->arus ?? null,
                        'daya' => $inaItem->daya ?? null,
                        'created_at' => $inaItem->created_at ?? null,
                    ];
                }
                if (empty($inaData)) {
                    $mergedData[] = [
                        'id' => $device->id,
                        'nama_device' => $device->nama_device,
                        'tegangan' => null,
                        'arus' => null,
                        'daya' => null,
                        'created_at' => null,
                    ];
                }
            }

            return response()->json(['datas' => $mergedData, 'message' => 'berhasil memanggil data']);
        } else if($selectedSensor=='bmp'){
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();
            $dvc = DataDevice::where('token', $selectedDevice)
                ->select('id', 'nama_device')
                ->get();

            $bmp = SensorBmp::where('device_token', $selectedDevice)
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            // ->select('id', 'device_token', 'tegangan', 'arus', 'daya', 'created_at')
            // ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

            // $mergedData = $ina219->toArray();
            // $mergedData = array_merge($mergedData, $dvc->toArray());
            $mergedData = [];

            foreach ($dvc as $device) {
                // Find all corresponding thigrow data for the device
                $bmpData = $bmp->where('device_token', $selectedDevice)->all();
        
                // Merge data into a single array for the device
                foreach ($bmpData as $bmpItem) {
                    $mergedData[] = [
                        'id' => $device->id,
                        'nama_device' => $device->nama_device,
                        'tekanan_udara' => $bmpItem->tekanan_udara ?? null,
                        'tinggi_permukaan' => $bmpItem->tinggi_permukaan ?? null,
                        'battery' => $bmpItem->battery ?? null,
                        'created_at' => $bmpItem->created_at ?? null,
                    ];
                }
                if (empty($bmpData)) {
                    $mergedData[] = [
                        'id' => $device->id,
                        'nama_device' => $device->nama_device,
                        'tekanan_udara' => null,
                        'tinggi_permukaan' => null,
                        'battery' => null,
                        'created_at' => null,
                    ];
                }
            }

            return response()->json(['datas' => $mergedData, 'message' => 'berhasil memanggil data']);
        } else if($selectedSensor=='thm30d'){
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();
            $dvc = DataDevice::where('token', $selectedDevice)
                ->select('id', 'nama_device')
                ->get();

            $thm30d = SensorThm30::where('device_token', $selectedDevice)
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            // ->select('id', 'device_token', 'tegangan', 'arus', 'daya', 'created_at')
            // ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

            // $mergedData = $ina219->toArray();
            // $mergedData = array_merge($mergedData, $dvc->toArray());
            $mergedData = [];

            foreach ($dvc as $device) {
            // Find all corresponding thigrow data for the device
            $thmData = $thm30d->where('device_token', $selectedDevice)->all();
    
            // Merge data into a single array for the device
            foreach ($thmData as $thmItem) {
                $mergedData[] = [
                    'id' => $device->id,
                    'nama_device' => $device->nama_device,
                    'temperature' => $thmItem->temperature ?? null,
                    'kelembaban_udara' => $thmItem->kelembaban_udara ?? null,
                    'battery' => $thmItem->battery ?? null,
                    'created_at' => $thmItem->created_at ?? null,
                ];
                }
                if (empty($thmData)) {
                    $mergedData[] = [
                        'id' => $device->id,
                        'nama_device' => $device->nama_device,
                        'temperature' => null,
                        'kelembaban_udara' => null,
                        'battery' => null,
                        'created_at' => null,
                    ];
                }
            }
            return response()->json(['datas' => $mergedData, 'message' => 'berhasil memanggil data']);
            
        }

// Your filtering logic goes her    
    return response()->json(['message' => 'Route parameters received successfully']);
    }

    public function print(Request $request){
        $selectedDevice = $request->device;
        $selectedSensor = $request->sensor;
        $startDate = $request->dateStart;
        $endDate = $request->dateEnd;

        

        if($selectedSensor=='thigrow'){
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();
            $dvc= DataDevice::where('token', $selectedDevice)->select('id','nama_device')->get();
            $data = SensorThigrow::where('device_token', $selectedDevice)
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->get();

            $mergedData = [];

            foreach ($dvc as $device) {
                // Find all corresponding thigrow data for the device
                $thigrowData = $data->where('device_token', $selectedDevice)->all();
        
                // Merge data into a single array for the device
                foreach ($thigrowData as $thigrowItem) {
                    $mergedData[] = [
                        'id' => $device->id,
                        'nama_device' => $device->nama_device,
                        'temperature' => $thigrowItem->temperature ?? null,
                        'kelembaban_tanah_th' => $thigrowItem->kelembaban_tanah_th ?? null,
                        'kelembaban_tanah_sm' => $thigrowItem->kelembaban_tanah_sm ?? null,
                        'battery' => $thigrowItem->battery ?? null,
                        'i_cahaya' => $thigrowItem->i_cahaya ?? null,
                        'kelembaban_udara' => $thigrowItem->kelembaban_udara ?? null,
                        'kadar_garam' => $thigrowItem->kadar_garam ?? null,
                        'created_at' => $thigrowItem->created_at ?? null,
                    ];
                }
                if (empty($thigrowData)) {
                    $mergedData[] = [
                        'id' => $device->id,
                        'nama_device' => $device->nama_device,
                        'temperature' => null,
                        'kelembaban_tanah_th' => null,
                        'kelembaban_tanah_sm' => null,
                        'battery' => null,
                        'i_cahaya' => null,
                        'kelembaban_udara' => null,
                        'kadar_garam' => null,
                        'created_at' => null,
                    ];
                }
            }
            return Excel::download(new ThigrowExport($mergedData), 'data_thigrow'.Carbon::now()->timestamp.'.xlsx');
        } else if ($selectedSensor=='bmp'){
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();
            $dvc= DataDevice::where('token', $selectedDevice)->select('id','nama_device')->get();
            $data = SensorBmp::where('device_token', $selectedDevice)
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->get();

            $mergedData = [];

            foreach ($dvc as $device) {
                // Find all corresponding thigrow data for the device
                $bmpData = $data->where('device_token', $selectedDevice)->all();
        
                // Merge data into a single array for the device
                foreach ($bmpData as $bmpItem) {
                    $mergedData[] = [
                        'id' => $device->id,
                        'nama_device' => $device->nama_device,
                        'tekanan_udara' => $bmpItem->tekanan_udara ?? null,
                        'tinggi_permukaan' => $bmpItem->tinggi_permukaan ?? null,
                        'battery' => $bmpItem->battery ?? null,
                        'created_at' => $bmpItem->created_at ?? null,
                    ];
                }
                if (empty($bmpData)) {
                    $mergedData[] = [
                        'id' => $device->id,
                        'nama_device' => $device->nama_device,
                        'tekanan_udara' => null,
                        'tinggi_permukaan' => null,
                        'battery' => null,
                        'created_at' => null,
                    ];
                }
            }

            return Excel::download(new BmpExport($mergedData), 'data_bmp'.Carbon::now()->timestamp.'.xlsx');

        } else if ($selectedSensor=='thm30d'){
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();
            $dvc= DataDevice::where('token', $selectedDevice)->select('id','nama_device')->get();
            $data = SensorThm30::where('device_token', $selectedDevice)
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->get();

            $mergedData = [];

            foreach ($dvc as $device) {
            // Find all corresponding thigrow data for the device
            $thmData = $data->where('device_token', $selectedDevice)->all();
    
            // Merge data into a single array for the device
            foreach ($thmData as $thmItem) {
                $mergedData[] = [
                    'id' => $device->id,
                    'nama_device' => $device->nama_device,
                    'temperature' => $thmItem->temperature ?? null,
                    'kelembaban_udara' => $thmItem->kelembaban_udara ?? null,
                    'battery' => $thmItem->battery ?? null,
                    'created_at' => $thmItem->created_at ?? null,
                ];
                }
                if (empty($thmData)) {
                    $mergedData[] = [
                        'id' => $device->id,
                        'nama_device' => $device->nama_device,
                        'temperature' => null,
                        'kelembaban_udara' => null,
                        'battery' => null,
                        'created_at' => null,
                    ];
                }
            }
            return Excel::download(new Thm30dExport($mergedData), 'data_thm30d'.Carbon::now()->timestamp.'.xlsx');

        } else if ($selectedSensor=='ina219'){
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();
            $dvc= DataDevice::where('token', $selectedDevice)->select('id','nama_device')->get();
            $data = SensorIna219::where('device_token', $selectedDevice)
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->get();

            $mergedData = [];

            foreach ($dvc as $device) {
                // Find all corresponding thigrow data for the device
                $inaData = $data->where('device_token', $selectedDevice)->all();
        
                // Merge data into a single array for the device
                foreach ($inaData as $inaItem) {
                    $mergedData[] = [
                        'id' => $device->id,
                        'nama_device' => $device->nama_device,
                        'tegangan' => $inaItem->tegangan ?? null,
                        'arus' => $inaItem->arus ?? null,
                        'daya' => $inaItem->daya ?? null,
                        'created_at' => $inaItem->created_at ?? null,
                    ];
                }
                if (empty($inaData)) {
                    $mergedData[] = [
                        'id' => $device->id,
                        'nama_device' => $device->nama_device,
                        'tegangan' => null,
                        'arus' => null,
                        'daya' => null,
                        'created_at' => null,
                    ];
                }
            }
            return Excel::download(new Ina219Export($mergedData), 'data_ina'.Carbon::now()->timestamp.'.xlsx');

        }


        // return [
        //     "json"=> response()->json([
        //         'message'=>'Aww Crout'
        //     ]),
        // ];
    }

    // public function print($selectedDevice, $selectedSensor, $startDate, $endDate){

    //     if ($selectedSensor=='thigrow'){
    //         $startDate = Carbon::parse($startDate)->startOfDay();
    //         $endDate = Carbon::parse($endDate)->endOfDay();
    //         $dvc= DataDevice::where('token', $selectedDevice)->select('id','nama_device')->get();
    //         $thigrow = SensorThigrow::where('device_token', $selectedDevice)
    //         ->where('created_at', '>=', $startDate)
    //         ->where('created_at', '<=', $endDate)
    //         ->get();

    //         return [
    //             'json'=> response()->json(['dvc'=>$dvc, 'thigrow'=>$thigrow]),
    //             'excel'=>(new ThigrowExport)->download('thigrow.xlsx'),
    //         ];
    //     } else if($selectedSensor=='bmp'){

    //     } else if($selectedSensor=='thm30d'){

    //     } else if($selectedSensor=='ina219'){

    //     }
    // }
}