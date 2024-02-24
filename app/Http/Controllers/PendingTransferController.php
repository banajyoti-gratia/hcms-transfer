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

class PendingTransferController extends Controller 
{
    public function index( Request $request ) 
    {
        $district = District::all();
        $block = Block::join( 'districts', 'districts.district_code', '=', 'blocks.district_id' )
            ->select( 'blocks.block_name' )
            ->get();
        $gramPanchayat = GramPanchayat::join( 'blocks', 'blocks.block_id', '=', 'gram_panchyats.block_id' )
                    ->select( 'gram_panchyats.gram_panchyat_name' )
                    ->get();
        $level = Level::all();
        $designation  = Designation::all();
        $service_status = ServiceStatus::all();

        // For checking Output //
        $pendingEmployee =  NewEmployeeTransfer::join('employees', 'employees.employee_id', '=', 'new_emplyoee_transfers.employee_id')
        ->join('designations', 'designations.designation_id', '=', 'new_emplyoee_transfers.designation_id')
        ->join('districts as Old_district', 'Old_district.district_code', '=', 'new_emplyoee_transfers.old_district_id')
        ->leftjoin('blocks as old_block', 'old_block.block_id', '=', 'new_emplyoee_transfers.old_block_id')
        ->leftjoin('gram_panchyats as old_gp', 'old_gp.gram_panchyat_id', '=', 'new_emplyoee_transfers.old_gram_panchayat_id')
        ->join('districts as new_district', 'new_district.district_code', '=', 'new_emplyoee_transfers.new_district_id')
        ->leftjoin('blocks as new_block', 'new_block.block_id', '=', 'new_emplyoee_transfers.new_block_id')
        ->leftjoin('gram_panchyats as new_gp', 'new_gp.gram_panchyat_id', '=', 'new_emplyoee_transfers.new_gram_panchayat_id')
        ->select(
            'employees.name',
            'new_emplyoee_transfers.employee_id',
            'new_emplyoee_transfers.employee_code',
            'new_emplyoee_transfers.old_district_id',
            'new_emplyoee_transfers.old_block_id',
            'new_emplyoee_transfers.old_gram_panchayat_id',
            'new_emplyoee_transfers.new_district_id',
            'new_emplyoee_transfers.new_block_id',
            'new_emplyoee_transfers.new_gram_panchayat_id',
            'new_emplyoee_transfers.designation_id',
            'designations.designation_name',
            'Old_district.district_name',
            'old_block.block_name',
            'old_gp.gram_panchyat_name',
            'new_district.district_name as new_dis',
            'new_block.block_name as new_block',
            'new_gp.gram_panchyat_name as new_gp',
            'employees.status'                                    
        )
        ->get();
        return view( 'pages.pending-transfer-dashboard' , [
            'districts'      => $district, 
            'blocks'         => $block,
            'gramPanchayats' => $gramPanchayat,
            'levels'         => $level,
            'designations'   => $designation,
            'ServiceStatus'  => $service_status
        ]);
    }

    public function getPendingBlock(Request $request)
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

    public function getPendingGramPanchayat(Request $request)
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

    public function getPendingDesignation(Request $request)
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

    public function pendingEmployeeDetails(Request $request)
    {  
        if ($request->ajax()) {
            $dis_code = $request->input('dis_id');
            $block_id = $request->input('block_id');
            $panchayat_id = $request->input('panchayat_id');
            $level_id = $request->input('level_id');
            $des_id = $request->input('des_id');
            $ser_status = $request->input('ser_status');

            $pendingEmployee =  NewEmployeeTransfer::join('employees', 'employees.employee_id', '=', 'new_emplyoee_transfers.employee_id')
            ->join('designations', 'designations.designation_id', '=', 'new_emplyoee_transfers.designation_id')
            ->join('districts as Old_district', 'Old_district.district_code', '=', 'new_emplyoee_transfers.old_district_id')
            ->leftjoin('blocks as old_block', 'old_block.block_id', '=', 'new_emplyoee_transfers.old_block_id')
            ->leftjoin('gram_panchyats as old_gp', 'old_gp.gram_panchyat_id', '=', 'new_emplyoee_transfers.old_gram_panchayat_id')
            ->join('districts as new_district', 'new_district.district_code', '=', 'new_emplyoee_transfers.new_district_id')
            ->leftjoin('blocks as new_block', 'new_block.block_id', '=', 'new_emplyoee_transfers.new_block_id')
            ->leftjoin('gram_panchyats as new_gp', 'new_gp.gram_panchyat_id', '=', 'new_emplyoee_transfers.new_gram_panchayat_id')
            ->select(
                'employees.name',
                'new_emplyoee_transfers.employee_id',
                'new_emplyoee_transfers.employee_code',
                'new_emplyoee_transfers.old_district_id',
                'new_emplyoee_transfers.old_block_id',
                'new_emplyoee_transfers.old_gram_panchayat_id',
                'new_emplyoee_transfers.new_district_id',
                'new_emplyoee_transfers.new_block_id',
                'new_emplyoee_transfers.new_gram_panchayat_id',
                'new_emplyoee_transfers.designation_id',
                'designations.designation_name',
                'Old_district.district_name',
                'old_block.block_name',
                'old_gp.gram_panchyat_name',
                'new_district.district_name as new_dis',
                'new_block.block_name as new_block',
                'new_gp.gram_panchyat_name as new_gp',                 
                'employees.status'                     
            );
            if (!empty($dis_code)) {
                $pendingEmployee->where('new_emplyoee_transfers.old_district_id', '=', $dis_code);
            }
            if (!empty($block_id)) {
                $pendingEmployee->where('new_emplyoee_transfers.old_block_id', '=', $block_id);
            }
            if (!empty($panchayat_id)) {
                $pendingEmployee->where('new_emplyoee_transfers.old_gram_panchayat_id', '=', $panchayat_id);
            }
            if (!empty($des_id)) {
                $pendingEmployee->where('new_emplyoee_transfers.designation_id', '=', $des_id);
            }
            if (!empty($ser_status)) {
                $pendingEmployee->whereIn('employees.status', $ser_status);
            }
            $pendingEmployee = $pendingEmployee->get();
            return Datatables::of($pendingEmployee)->addColumn('action', function ($pendingEmployee) {
                if ($pendingEmployee->status == 1) {
                    return '<span class="badge bg-success">Serving</span>';
                } elseif ($pendingEmployee->status == 2) {
                    return '<span class="badge bg-danger">Terminated</span>';
                } elseif ($pendingEmployee->status == 3) {
                    return '<span class="badge bg-danger">Resigned</span>';
                } elseif ($pendingEmployee->status == 4) {
                    return '<span class="badge bg-danger">Suspended</span>';
                } elseif ($pendingEmployee->status == 5) {
                    return '<span class="badge bg-warning text-dark">On Hold</span>';
                } elseif ($pendingEmployee->status == 6) {
                    return '<span class="badge bg-dark">Death</span>';
                } elseif ($pendingEmployee->status == 7) {
                    return '<span class="badge bg-danger">Unauthorized</span>';
                } elseif ($pendingEmployee->status == 9) {
                    return '<span class="badge bg-primary">Released</span>';
                } elseif ($pendingEmployee->status == 8) {
                    return '<span class="badge bg-success">Promotion</span>';
                }
            })
            ->addColumn('retirment', function ($pendingEmployee) {
                if ($pendingEmployee->status == 2 || $pendingEmployee->status == 3 || $pendingEmployee->status == 4 ||$pendingEmployee->status == 6 || $pendingEmployee->status == 9 ) {
                    return '';
                } else {
                    return $pendingEmployee->month_remain;
                }
            })->addIndexColumn()->make(true);
        }
    }

    public function pendingEmployeeListView(Request $request)
    {
        if ($request->ajax()) {
            $employee_code = $request->input('code');
            if (!empty($employee_code)) {
                $check_if_exist = Employeee::where('employee_code', '=', $employee_code)->count();
                if ($check_if_exist == 1) {
                    $newEmployee =   NewEmployeeTransfer::join('employees', 'employees.employee_id', '=', 'new_emplyoee_transfers.employee_id')
                    ->join('designations', 'designations.designation_id', '=', 'new_emplyoee_transfers.designation_id')
                    ->join('districts as Old_district', 'Old_district.district_code', '=', 'new_emplyoee_transfers.old_district_id')
                    ->leftjoin('blocks as old_block', 'old_block.block_id', '=', 'new_emplyoee_transfers.old_block_id')
                    ->leftjoin('gram_panchyats as old_gp', 'old_gp.gram_panchyat_id', '=', 'new_emplyoee_transfers.old_gram_panchayat_id')
                    ->join('districts as new_district', 'new_district.district_code', '=', 'new_emplyoee_transfers.new_district_id')
                    ->leftjoin('blocks as new_block', 'new_block.block_id', '=', 'new_emplyoee_transfers.new_block_id')
                    ->leftjoin('gram_panchyats as new_gp', 'new_gp.gram_panchyat_id', '=', 'new_emplyoee_transfers.new_gram_panchayat_id')
                    ->where('new_emplyoee_transfers.employee_code', '=', $employee_code)
                    ->select(
                        'employees.name',
                        'new_emplyoee_transfers.employee_id',
                        'new_emplyoee_transfers.employee_code',
                        'designations.designation_name',
                        'Old_district.district_name',
                        'old_block.block_name',
                        'old_gp.gram_panchyat_name',
                        'new_district.district_name as new_dis',
                        'new_block.block_name as new_block',
                        'new_gp.gram_panchyat_name as new_gp'                                    
                    )->get();
                    
                    $returnData['msg'] = 'success';
                    $returnData['emp_record'] = $newEmployee;
                } else {
                    $returnData['msg'] = 'failed';
                }
            } else {
                $returnData['msg'] = 'failed';
            }
        }
        return json_encode($returnData);
    }

}
