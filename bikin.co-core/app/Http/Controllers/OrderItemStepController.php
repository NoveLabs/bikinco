<?php

namespace App\Http\Controllers;

use App\Http\Models\OrderItemStep;

use App\Http\Models\OrderItemStepImage;

use App\Http\Models\OrderItemStepNote;

use App\Http\Models\OrderLog;

use App\Http\Models\Order;

use App\Http\Models\User;

use App\Http\Helpers\FormValidation;

use Illuminate\Support\Str;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class OrderItemStepController extends Controller
{
    private $modelOrder;
    private $modelOrderItemStep;
    private $modelOrderItemStepImage;
    private $modelOrderItemStepNote;
    private $modelOrderLog;
    private $modelUser;

    public function __construct()
    {
        $this->middleware('auth');
        $this->modelOrder = new Order();
        $this->modelOrderItemStep = new OrderItemStep();
        $this->modelOrderItemStepImage = new OrderItemStepImage();
        $this->modelOrderItemStepNote = new OrderItemStepNote();
        $this->modelOrderLog = new OrderLog();
        $this->modelUser = new User();
    }

    public function index()
    {
        $data = Order::GetDataStep()->get();

        $dataLog = OrderLog::GetDataLogAll()->get();

        $count = count($data);

        return view('order-item-step.index', compact('data','count','dataLog'));
    }


    public function show(Request $request)
    {

        $dataStep0 = $this->modelOrderItemStep->getDataStep(0, $request->id);
        $dataStep1 = $this->modelOrderItemStep->getDataStep(1, $request->id);
        $dataStep2 = $this->modelOrderItemStep->getDataStep(2, $request->id);
        $dataStep3 = $this->modelOrderItemStep->getDataStep(3, $request->id);

        $data = $this->modelOrderItemStep->getDataById($request->id);
        $arr = [];
        foreach ($data as $value) {
            $status = $value->status;
            if($status == 3) {
                $arr[] = $status;
                } 
        }
        $complete_qty = count($arr);            
        $data_must_complete = count($data);

        if ($complete_qty === $data_must_complete) {
            $params = 1;
        } else {
            $params = 2;
        }
        
        $id_user = Auth::User()->id;

        $dataUser = $this->modelUser->getSingleData($id_user);
        
        $session_id = $dataUser->role_id;

        return view('order-item-step.progress-track-order', compact('dataStep0', 'dataStep1', 'dataStep2', 'dataStep3', 'session_id', 'params'));
    }

    public function updateStep0(Request $request)
    {
        $id = $request->id;
        $input = [
            'status' => 1,
        ];

        $data = $this->modelOrderItemStep->getSingleData($id);

        $data->update($input);

        return back();
    }

    public function updateStep1(Request $request)
    {
        $fileName = FormValidation::uploadOne($request, 'upload', 'images_bukti_transaksi', Str::slug($request->input('upload')) . '_'. uniqid());
    }

    public function storeUpload(Request $request)
    {
        $fileName = FormValidation::uploadOne($request, 'file', 'images/order_item_step', Str::slug($request->input('upload')) . '_'. uniqid());
        
        $imageUpload = new OrderItemStepImage();

        $imageUpload->photo = $fileName;

        $imageUpload->order_item_step_id = $request->id;

        $imageUpload->save();

        return response()->json(['success'=>$fileName]);
    }

    public function updateStep2(Request $request)
    {
        $id = $request->id;
        
        $input =  [
            'status' => 2,
        ];
        
        $data = $this->modelOrderItemStep->getSingleData($id);

        $data->update($input);

        $inputNotes = [
            'order_item_step_id' => $id,
            'notes' => $request->notes,
            'created_by' => Auth::User()->id
        ];

        $create = $this->modelOrderItemStepNote->create($inputNotes);
        
        return back();
    }

    public function updateStep3($id)
    {
        $input = [
            'status' => 3,
        ];
        
        $data = $this->modelOrderItemStep->getSingleData($id);

        $data->update($input);

        return back();

    }

    public function updateStep3Complain(Request $request)
    {
        $id = $request->id;
        $input = 
        [
            'status' => 1,
        ];
        $data = $this->modelOrderItemStep->getSingleData($id);

        $data->update($input);

        $inputNotes =
        [
            'order_item_step_id' => $id,
            'notes' => $request->notes,
            'created_by' => Auth::User()->id
        ];

        $create = $this->modelOrderItemStepNote->create($inputNotes);
        return back();
    }

    public function getLogImage($id)
    {
        $data = $this->modelOrderItemStepImage->getAllDataImage($id);

        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data Image Ditemukan',
        ], 200);

    }

    public function getLogNote($id)
    {
        $data = $this->modelOrderItemStepNote->getAllDataNote($id);

        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => 'Data Note Ditemukan'
            ], 200);
    }

    public function completeStep($id)
    {
        \DB::beginTransaction();

        $date = now();
        $input = 
        [
            'flow_step' => 5,
            'flow_step_date' => $date,
        ];

        $data = $this->modelOrder->getDataOrderProgress($id);
        
        $data->update($input);

        $inputLogOrder = [
            'order_id' => $id,
            'flow_step' => 5,
            'flow_step_date' => now()
        ];

        $createLogOrder = $this->modelOrderLog->create($inputLogOrder);
       
        \DB::commit();


        return response()->json([
            'status' => true,
            'data' => '',
            'message' => 'Berhasil Menyelesaikan Order Step'
            ], 200);
    }

    public function getDataOrderItemStep()
    {
        $data = Order::GetDataStep()->get();

        $counted = count($data);
        
        return $counted;
    }
}
