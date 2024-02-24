<?php

namespace App\Http\Controllers;
use App\District;
use App\Designation;
use App\Level;
Use App\ServiceStatus;
Use App\Block;
Use App\Program;
Use App\GramPanchayat;
Use App\Employeee;
Use App\EmployeeTransferOrder;
Use App\EmployeeTransfer;
Use App\NewEmployeeTransfer;
use Yajra\Datatables\Datatables;
use App\DataTables\EmployeeDataTable;
use App\Http\Requests\TransferAppliedRequest;
use DB;
use Session;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index(Request $request)
    {
        $district = District::all();
        $blck = Block::all();
        $gp = GramPanchayat::all();
        $block = Block::join('districts', 'districts.district_code', '=', 'blocks.district_id')
                    ->select('blocks.block_name')
                    ->get();
        $gramPanchayat = GramPanchayat::join('blocks', 'blocks.block_id', '=', 'gram_panchyats.block_id')
                                    ->select('gram_panchyats.gram_panchyat_name')
                                    ->get();
        $designation  = Designation::all();
        $level = Level::all();
        $service_status = ServiceStatus::all();
        $program = Program::all();

        // For checking Output //
        $employee =  Employeee::join('designations', 'designations.designation_id', '=', 'employees.designation_id')
                    ->join('districts', 'districts.district_code', '=', 'employees.district_code')
                    ->leftjoin('blocks', 'blocks.block_id', '=', 'employees.block_id')
                    ->leftjoin('gram_panchyats', 'gram_panchyats.gram_panchyat_id', '=', 'employees.gram_panchayat_id')
                    ->leftjoin('districts as home_dis', 'home_dis.district_code', '=', 'employees.home_district')
                    ->leftjoin('blocks as home_block', 'home_block.block_id', '=', 'employees.home_block')
                    ->select(
                        'employees.employee_code',
                        'employees.name',
                        'designations.designation_name',
                        'districts.district_name',
                        'blocks.block_name',
                        'gram_panchyats.gram_panchyat_name',
                        'home_dis.district_name as home_dist',
                        'home_block.block_name as home_blo',                      
                        'employees.mobile'                     
                    )->get();
                   
        return view('pages.transfer-dashboard', [
            'districts'      => $district, 
            'blocks'         => $block,
            'blcks'          => $blck,
            'gps'            => $gp,
            'gramPanchayats' => $gramPanchayat,
            'designations'   => $designation,
            'levels'         => $level,
            'ServiceStatus'  => $service_status,
            'programs'       => $program           
        ]);
    }

    public function getBlock(Request $request)
    {
        if ($request->ajax()) {
            $dis_id = $request->input('dis_id');
            $returnData['block'] = [];
            if (!empty($dis_id)) {
                $blocks = Block::where('district_id', '=', $dis_id)->get();
                $jdata = [];
                $i = 0;
                foreach ($blocks as $block) {
                    $count = GramPanchayat::where('block_id', '=', $block->block_id)->count();
                    $jdata[$i] = [
                        'count' => $count,
                        'block_id' => $block->block_id,
                        'block_name' => $block->block_name,
                        'msg' => 'success'

                    ];
                    $i++;
                }
                return response()->json($jdata);
            }
        }
    }

    public function getGramPanchayat(Request $request)
    {
        if ($request->ajax()) {
            $block_id = $request->input('block_id');
            $returnData['gp'] = [];
            if (!empty($block_id)) {
                $get_gp = GramPanchayat::where('block_id', '=', $block_id)->get();
                $returnData['gp'] = $get_gp;
                $returnData['msg'] = 'success';
            }
            return json_encode($returnData);
        }
    }

    public function getDesignation(Request $request)
    {
        $level = $request->input('level');
        $returnData['designation'] = [];
        if (!empty($level)) {
            $fetch_designation = Designation::select('designation_name', 'designation_id')->where('level_id', '=', $level)->get();
            $returnData['designation'] = $fetch_designation;
            $returnData['msg'] = 'success';
        }
        return json_encode($returnData);
    }

    public function employeeDetails(Request $request)
    {  
        if ($request->ajax()) {
            $dis_code = $request->input('dis_id');
            $block_id = $request->input('block_id');
            $panchayat_id = $request->input('panchayat_id');
            $program_id = $request->input('program_id');
            $level_id = $request->input('level_id');
            $des_id = $request->input('des_id');
            $ser_status = $request->input('ser_status');
            $employee =  Employeee::join('designations', 'designations.designation_id', '=', 'employees.designation_id')
                ->join('districts', 'districts.district_code', '=', 'employees.district_code')
                ->leftjoin('blocks', 'blocks.block_id', '=', 'employees.block_id')
                ->leftjoin('gram_panchyats', 'gram_panchyats.gram_panchyat_id', '=', 'employees.gram_panchayat_id')
                ->leftjoin('districts as home_dis', 'home_dis.district_code', '=', 'employees.home_district')
                ->leftjoin('blocks as home_block', 'home_block.block_id', '=', 'employees.home_block')
                ->leftjoin('employee_services', 'employee_services.employee_id', '=', 'employees.employee_id')
                ->select(
                    'employees.employee_id',
                    'employees.employee_code',
                    'employees.name',
                    'employees.district_code',
                    'employees.block_id',
                    'employees.gram_panchayat_id',
                    'employees.designation_id',
                    'designations.designation_name',
                    'districts.district_name',
                    'blocks.block_name',
                    'gram_panchyats.gram_panchyat_name',
                    'home_dis.district_name as home_dist',
                    'home_block.block_name as home_blo',                      
                    'employees.mobile',
                    'employees.status'                     
                );
            if (!empty($block_id)) {
                $employee->where('employees.block_id', '=', $block_id);
            }
            if (!empty($panchayat_id)) {
                $employee->where('employees.gram_panchayat_id', '=', $panchayat_id);
            }
            if (!empty($program_id)) {
                $employee->where('employees.program_id', '=', $program_id);
            }
            if (!empty($level_id)) {
                $employee->where('employees.level_id', '=', $level_id);
            }
            if (!empty($des_id)) {
                $employee->where('employees.designation_id', '=', $des_id);
            }
            if (!empty($ser_status)) {
                $employee->whereIn('employees.status', $ser_status);
            }
            $employee = $employee->groupBy('employees.employee_code')->get();
            return Datatables::of($employee)->addColumn('action', function ($employee) {
                if ($employee->status == 1) {
                    return '<span class="badge bg-success">Serving</span>';
                } elseif ($employee->status == 2) {
                    return '<span class="badge bg-danger">Terminated</span>';
                } elseif ($employee->status == 3) {
                    return '<span class="badge bg-danger">Resigned</span>';
                } elseif ($employee->status == 4) {
                    return '<span class="badge bg-danger">Suspended</span>';
                } elseif ($employee->status == 5) {
                    return '<span class="badge bg-warning text-dark">On Hold</span>';
                } elseif ($employee->status == 6) {
                    return '<span class="badge bg-dark">Death</span>';
                } elseif ($employee->status == 7) {
                    return '<span class="badge bg-danger">Unauthorized</span>';
                } elseif ($employee->status == 9) {
                    return '<span class="badge bg-primary">Released</span>';
                } elseif ($employee->status == 8) {
                    return '<span class="badge bg-success">Promotion</span>';
                }
            })
            ->addColumn('retirment', function ($employee) {
                if ($employee->status == 2 || $employee->status == 3 || $employee->status == 4 ||$employee->status == 6 || $employee->status == 9 ) {
                    return '';
                } else {
                    return $employee->month_remain;
                }
            })->addIndexColumn()->make(true);
        }
    }

    public function employeeListView(Request $request)
    {
        if ($request->ajax()) {
            $employee_code = $request->input('code');
            if (!empty($employee_code)) {
                $check_if_exist = Employeee::where('employee_code', '=', $employee_code)->count();
                if ($check_if_exist == 1) {
                    $employee =  Employeee::join('designations', 'designations.designation_id', '=', 'employees.designation_id')
                    ->join('districts', 'districts.district_code', '=', 'employees.district_code')
                    ->leftjoin('blocks', 'blocks.block_id', '=', 'employees.block_id')
                    ->leftjoin('gram_panchyats', 'gram_panchyats.gram_panchyat_id', '=', 'employees.gram_panchayat_id')
                    ->where('employees.employee_code', '=', $employee_code)
                    ->select(
                        'employees.employee_code',
                        'employees.name',
                        'designations.designation_name',
                        'districts.district_name',
                        'blocks.block_name',
                        'gram_panchyats.gram_panchyat_name'                 
                    )->get();
                    $returnData['msg'] = 'success';
                    $returnData['emp_record'] = $employee;
                } else {
                    $returnData['msg'] = 'failed';
                }
            } else {
                $returnData['msg'] = 'failed';
            }
        }
        return json_encode($returnData);
    }

    public function employeeTransfer(TransferAppliedRequest $request)
    {
        $employee_code = $request->input('employee_code');
        $employee_check=Employeee::where('employee_code',$employee_code)->first();
        try{
            DB::beginTransaction();
            if ($employee_check) {
                $employeeTransfer = new NewEmployeeTransfer;
                $employeeTransfer->employee_code         = $employee_code;
                $employeeTransfer->employee_id           = $request->input('employee_id');
                $employeeTransfer->old_district_id       = $request->input('district_code');
                $employeeTransfer->new_district_id       = $request->new_district_id;
                $employeeTransfer->old_block_id          = $request->input('block_id');
                $employeeTransfer->new_block_id          = $request->new_block_id;
                $employeeTransfer->old_gram_panchayat_id = $request->input('gram_panchayat_id');
                $employeeTransfer->new_gram_panchayat_id = $request->new_gram_panchayat_id;
                $employeeTransfer->designation_id        = $request->input('designation_id');
                $employeeTransfer->remarks               = $request->remarks;
                $employeeTransfer->save();
                DB::commit();          
                return response()->json(['message' => 'success']);
            }
        }
        catch (Exception $e) {
            DB::rollBack();
            $returnData['msgType'] = true;
            $returnData['msg'] = $e;
        }
       
        // return json_encode($data); 
        // }
   
        // if ($employeeTransfer) {
        //     $file = $request->file('order_path');
        //     $transferOrder = new EmployeeTransferOrder;
        //     $transferOrder->employee_transfer_id = $employeeTransfer->id;
        //     if($file != null) {
        //         $file_name = time() . '_' . $file->getClientOriginalName();
        //         $path = (storage_path());
        //         $main_path = $path . '/app/uploads/transfer_document';
        //         $uploaded_file_name = $main_path . '/' . $file_name;
        //         $main_path_db = '/uploads/transfer_document/' . $file_name;
        //         $file = $file->move($main_path, $file_name);
        //         $transferOrder->order_path = $main_path_db;
        //     }
        //     $transferOrder->save();
        //     $update_transfer_status=ServiceRecord::where('employee_code',$request->employee_code)->update(['transfer_status'=>1]);
        //     $data['msg']="success";
        //     $data['data']=$request->employee_code;
        //     return json_encode($data);
        // }
        // else {
        //     $data['msg'] = 'failed';
        // }     
    }
}

  