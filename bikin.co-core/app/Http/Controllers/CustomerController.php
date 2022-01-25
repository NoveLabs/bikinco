<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;
use App\Http\Models\Cities;
use App\Http\Models\Customer;
use App\Http\Models\CustomerWork;
use App\Http\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    private $modelProvince;
    private $modelCities;
    private $modelWork;
    private $modelCustomer;

    private $customerIdentity;
    private $customerPrefixID;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->modelProvince = new Province();
        $this->modelCities = new Cities();
        $this->modelWork = new CustomerWork();
        $this->modelCustomer = new Customer();

        $this->customerIdentity = Config('general.customer_identity');
        $this->customerPrefixID = Config('general.customer_prefix_id');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::with('hasCities.hasProvince')
                                ->with('hasWork')
                                ->whereNull('deleted_at');

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editcolumn('is_verified', function ($row) {
                        return $row->is_verified == 1 ? '<span class="uk-label uk-label-success">Aktif</span>' : '<span class="uk-label uk-label-danger">Tidak Aktif</span>';
                    })
                    ->editcolumn('created_at', function ($row) {
                        return date('d/m/Y', strtotime($row->created_at));
                    })
                    ->addColumn('alias_id', function ($row) {
                        return $this->customerPrefixID . $row->id;
                    })
                    ->addColumn('alias_work', function ($row) {
                        return !empty($row->hasWork->name) ? '<span class="uk-label uk-label-primary">' . $row->hasWork->name . '</span>' : '-' ;
                    })
                    ->addColumn('repeat_order', function ($row) {
                        $repeatStatus = '<span class="uk-label uk-label-danger">Belum Order</span>';
                        
                        if ($row->latest_ordering == 1) {
                            $repeatStatus = '<span class="uk-label uk-label-warning">Tidak</span>';
                        } else if ($row->latest_ordering > 1) {
                            $repeatStatus = '<span class="uk-label uk-label-success">Ya</span>';
                        }

                        return $repeatStatus;
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-mini">Lihat</a>
                                    <a href="' . route('order.add-form', $row->id) . '" class="sc-button sc-button-mini uk-button-primary">Order</a>';
                    })
                    ->rawColumns(['status', 'action', 'alias_work', 'is_verified', 'repeat_order'])
                    ->make(true);
        }

        $works = $this->modelWork->getAllData();
        $provinces = $this->modelProvince->getAllData();
        $identities = $this->customerIdentity;

        return view('sales-officer.customer.customer-list',
                    compact(
                        'works',
                        'provinces',
                        'identities'
                    ));
    }

    public function show($id)
    {
        $data = $this->modelCustomer->getSingleData($id);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data konsumen tidak ditemukan.'
            ], 403);
        }

        $data->identity = '';
        $data->fverified_date = !empty($data->verified_date) ? date('d M Y', strtotime($data->verified_date)) : '-' ;

        foreach ($this->customerIdentity as $item) {
            if ($item['id'] == $data->identity_id) {
                $data->identity = $item['name'];
                break;
            }
        }

        return response()->json([
            'status' => true, 
            'data' => $data,
            'messsage' => 'Data konsumen ditemukan',
        ], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
                "fullname" => "required",
                "email" => "required",
                "company_name" => "required",
                "mobile_phone" => "required",
                "work_id" => "required|numeric",
                "cities_id" => "required|numeric",
                "photo" => "image|mimes:jpeg,png,jpg|max:500",
            ]
        ); 
        
        $input = Arr::only($request->all(), [
            'fullname','email','company_name','mobile_phone','work_id',
            'cities_id','address','identity_id','photo'
        ]);

        $valid = [
            [
                'condition' => [
                    ['name' => 'fullname', 'opr' => '=', 'value' => $input['fullname'], 'opr_func' => 'where'],
                ],
                'message' => "Nama Lengkap '{$input['fullname']}' sudah digunakan",
            ],
            [
                'condition' => [
                    ['name' => 'email', 'opr' => '=', 'value' => $input['email'], 'opr_func' => 'where'],
                ],
                'message' => "Email '{$input['email']}' sudah digunakan",
            ],
            [
                'condition' => [
                    ['name' => 'mobile_phone', 'opr' => '=', 'value' => $input['mobile_phone'], 'opr_func' => 'where'],
                ],
                'message' => "Nomor HP '{$input['mobile_phone']}' sudah digunakan",
            ],
        ];

        $check = FormValidation::uniqueColumnValidation('customers', $valid);
        if (!$check['status']) {
            return $check;
        }

        $fileName = FormValidation::uploadOne($request, 'photo', 'upload_image/customer', Str::slug($request->input('fullname')) . '_'. uniqid());
        if (!empty($fileName)) {
            $input['photo'] = $fileName;
        }

        $create = $this->modelCustomer->create($input);

        $token = base64_encode($input['email']);
        $data = [
            'fullname' => $input['fullname'],
            'verification_link' => route('customers.verification', [$token]),
        ];

        // Mail::send('sales-officer.customer.verification-mail', $data, function($message) use ($input) {
        //     $message->to($input['email'], $input['fullname'])->subject('Pemberitahuan verifikasi akun');
        //     $message->from('no-reply@bikin.co', 'Bikin.co');
        // });
        $create->is_verified = 1;
        $create->verified_date = now();
        $create->token = $token;
        $create->save();
        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data konsumen'
        ], 200);
    }

    public function verification($token)
    {
        if (is_null($token)) {
            return '';
        }

        $customer = $this->modelCustomer->getSingleDataToken($token);
        if (empty($customer)) {
            return response()->json([
                'status' => true,
                'data' => [],
                'message' => 'Gagal melakukan aktivasi, token salah.'
            ], 200);
        }

        $customer->is_verified = true;
        $customer->verified_date = date('Y-m-d H:i:s');
        $customer->save();
        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil melakukan aktivasi konsumen.'
        ], 200);
    }

    public function downloadImage($id)
    {
        $data = $this->modelCustomer->getSingleData($id);
        if (empty($data)) {
            return redirect()->route('customers');
        }  

        $name = str_replace("upload_image/customer/", "", $data->photo);
        $file = public_path($data->photo);

        return response()->download($file, $name); 
    }

    public function updateForm($id)
    {
        $data = $this->modelCustomer->getSingleData($id);
        if (empty($data)) {
            return redirect()->route('customers');
        }

        $works = $this->modelWork->getAllData();
        $provinces = $this->modelProvince->getAllData();
        $cities = $this->modelCities->getAllData();
        $identities = $this->customerIdentity;

        return view('sales-officer.customer.customer-edit',
                    compact(
                        'data',
                        'works',
                        'provinces',
                        'cities',
                        'identities'
                    ));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                "fullname" => "required",
                "email" => "required",
                "company_name" => "required",
                "mobile_phone" => "required",
                "work_id" => "required|numeric",
                "cities_id" => "required|numeric",
                "photo" => "image|mimes:jpeg,png,jpg|max:500",
            ]
        ); 
        
        $input = Arr::only($request->all(), [
            'fullname','email','company_name','mobile_phone','work_id',
            'cities_id','address','identity_id','photo'
        ]);
        
        $detail = $this->modelCustomer->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data konsumen tidak ditemukan.'
            ], 403);
        }

        $valid = [
            [
                'condition' => [
                    ['name' => 'fullname', 'opr' => '=', 'value' => $input['fullname'], 'opr_func' => 'where'],
                ],
                'message' => "Nama Lengkap '{$input['fullname']}' sudah digunakan",
            ],
            [
                'condition' => [
                    ['name' => 'email', 'opr' => '=', 'value' => $input['email'], 'opr_func' => 'where'],
                ],
                'message' => "Email '{$input['email']}' sudah digunakan",
            ],
            [
                'condition' => [
                    ['name' => 'mobile_phone', 'opr' => '=', 'value' => $input['mobile_phone'], 'opr_func' => 'where'],
                ],
                'message' => "Nomor HP '{$input['mobile_phone']}' sudah digunakan",
            ],
        ];

        $check = FormValidation::uniqueColumnValidation('customers', $valid, $detail->id);
        if (!$check['status']) {
            return $check;
        }
        
        $fileName = FormValidation::uploadOne($request, 'photo', 'upload_image/customer', Str::slug($request->input('fullname')) . '_'. uniqid());
        if (!empty($fileName)) {
            if (!empty($detail->photo)) {
                @unlink($detail->photo);
            }

            $input['photo'] = $fileName;
        }

        $detail->update($input);
        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data konsumen'
        ], 200);
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
                "id" => "required|numeric",
            ]
        ); 

        $input = $request->all();

        $detail = $this->modelCustomer->getSingleData($input['id']);

        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data konsumen'
        ], 200);
    }
}
