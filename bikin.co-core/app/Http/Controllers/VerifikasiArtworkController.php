<?php

namespace App\Http\Controllers;

use App\Http\Models\VerifikasiArtwork;

use App\Http\Models\ArtworkDesignLog;

use App\Http\Models\Order;

use App\Http\Models\OrderLog;

use Illuminate\Http\Request;

class VerifikasiArtworkController extends Controller
{
    private $modelOrder;
    private $modelArtworkDesignLog;
    private $modelVerifikasiArtworkDesign;
    private $modelOrderLog;

    public function __construct()
    {
        $this->middleware('auth');
        $this->modelOrder = new Order();
        $this->modelArtworkDesignLog = new ArtworkDesignLog();
        $this->modelVerifikasiArtworkDesign = new VerifikasiArtwork();
        $this->modelOrderLog = new OrderLog();

    }

    public function index(Request $request)
    {   
        $data = Order::GetDataArtworkDesign()->get();

        $dataLog = OrderLog::GetDataLogAll()->get();

        $count = count($data);
        
        return view('verifikasi-artwork.index', compact('data', 'count', 'dataLog'));
    }


    public function terima(Request $request)
    {
        \DB::beginTransaction();

        $update = [
            'order_id' => $request->order_id,
            'status' => '0', 
        ];

         $updateStatus = [
            'flow_step' => 4,
            'flow_step_date' => now(),
        ];
        $updateSt = $this->modelOrder->getDataOrderById($request->order_id);

        $updateSt->update($updateStatus);

        $inputLogOrder = [
            'order_id' => $request->order_id,
            'flow_step' => 4,
            'flow_step_date' => now()
        ];

        $createLogOrder = $this->modelOrderLog->create($inputLogOrder);

        $detail = $this->modelVerifikasiArtworkDesign->getSingleData($request->order_id);

        $detail->update($update);

        \DB::commit();

        return redirect('/verifikasi_artwork');
    }

    public function tolak(Request $request)
    {
        \DB::beginTransaction();

        $input = [
            'role_id' => '2',
            'order_id' => $request->order_id,
            'reason' => $request->reason,
        ];

        $update = [
            'status' => '1',
            'order_id' => $request->order_id,
        ];

        $detail = $this->modelVerifikasiArtworkDesign->getSingleData($request->order_id);

        $detail->update($update);

        $create = $this->modelArtworkDesignLog->create($input);

        \DB::commit();
        
        return redirect('/verifikasi_artwork');

    }


    public function show($id)
    {
        $dataArtwork = $this->modelOrder->getDataArtworkById($id);
        $countArtwork = count($dataArtwork);

        $dataDesign = $this->modelOrder->getDataDesignById($id);
        $countDesign = count($dataDesign);

        $dataOrder = $this->modelOrder->getDataOrder($id);
        $countOrder = count($dataOrder);

        $dataLog = $this->modelOrder->getDataLog($id);

        return view('verifikasi-artwork.detail-artwork-design', compact('dataArtwork', 'dataDesign', 'dataOrder', 'dataLog', 'countArtwork', 'countDesign', 'countOrder'));
    }

    public function getDataVerifikasiArtwork()
    {
        $data = Order::GetDataArtworkDesign()->get();

        $counted = count($data);
        
        return $counted;
    }
}
