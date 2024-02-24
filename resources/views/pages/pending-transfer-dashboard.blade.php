@extends('layouts.master')
@section('main-content')
    <section class="section">
        <div class="row align-items-top">
            <div class="col-lg-12">
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <div class="card-body">
                        <h5 class="card-title text-decoration-underline">Search Pending Employee</h5>
                        <form>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label class=""><strong>District</strong></label>
                                    <select class="form-select" id="district" aria-label="Default select example">
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->district_code }}">{{ $district->district_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label class=""><strong>Block</strong></label>
                                    <select class="form-select" id="block" aria-label="Default select example">
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($blocks as $block)
                                            <option value="{{ $block->block_id }}">{{ $block->block_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label class=""><strong>Gram Panchayat</strong></label>
                                    <select class="form-select" id="gramPanchayat" aria-label="Default select example">
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($gramPanchayats as $gramPanchayat)
                                            <option value="{{ $gramPanchayat->gram_panchyat_id }}">
                                                {{ $gramPanchayat->gram_panchyat_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label class=""><strong>Level</strong></label>
                                    <select class="form-select" id="level" name="level"
                                        aria-label="Default select example">
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($levels as $level)
                                            <option value="{{ $level->level_id }}">{{ $level->level_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label class=""><strong>Designation</strong></label>
                                    <select class="form-select" id="designation" name="designation"
                                        aria-label="Default select example">
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($designations as $designation)
                                            <option value="{{ $designation->designation_id }}">
                                                {{ $designation->designation_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label class=""><strong>Service Status</strong></label>
                                    <select class="form-select" id="service" name="service"
                                        aria-label="Default select example">
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($ServiceStatus as $service)
                                            <option value="{{ $service->status_id }}">{{ $service->status_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary search">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="card-body">
                <div class="pagetitle">
                    <h1 class="card-title text-decoration-underline">Pending Employee Details</h1>
                </div>
                <div class="row">
                    <div class="col-md-12 pl0 pr0">
                        <!-- Table with stripped rows -->
                        <table id="example" class="table table-striped employeeList" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Employee Code</th>
                                    <th>Employee Name</th>
                                    <th>Designation</th>
                                    <th>Current District</th>
                                    <th>Current Block</th>
                                    <th>Current GP</th>
                                    <th>New District</th>
                                    <th>New Block</th>
                                    <th>New GP</th>
                                    <th>Service Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal for view Current Employee Details -->
    <section class="section">
        <div class="modal fade top" id="pendingList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            data-backdrop="true" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-top modal-notify modal-primary" role="document">
                <!--Content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!--Header-->
                    <div class="card">
                        <div class="card-body" style="text-align:center">
                            <h3 class="card-title text-decoration-underline" style="font-size: 30px;">Employee Details
                            </h3>
                            <!--Body-->
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row"
                                        style="font-size:2opx;box-shadow: 0 4px 8px 0 rgba(2, 2, 2, 0.945), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                        <div class="employee_records" style="font-size: 17px;color: #22937f"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>


@section('custom-script')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script type="text/javascript">
        /* AJAX for fetching Pending Blocks*/

        $('#block').empty();
        $('#block').append($("<option value=''>Select</option>"));
        $('#gramPanchayat').empty();
        $('#gramPanchayat').append($("<option value=''>Select</option>"));
        $(document).on('change', '#district', function() {
            $('.page-loader-wrapper').fadeIn();
            var dis_id = $('#district').val();
            $.ajax({
                type: "GET",
                url: "{{ route('pending-transfer-get-block') }}",
                dataType: 'json',
                data: {
                    'dis_id': dis_id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('.page-loader-wrapper').fadeOut();
                    $('#block').empty();
                    $('#block').append($("<option value=''>Select</option>"));
                    $.each(data, function(index, value) {
                        console.log(value)
                        $('#block').append('<option value="' + value.block_id + '">' + value
                            .block_name + '</option>');
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('.page-loader-wrapper').fadeOut();
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                }
            })
        });

        /* AJAX for fetching Pending Gram Panchayat*/

        $(document).on('change', '#block', function() {
            var block_id = $('#block').val();
            $('.page-loader-wrapper').fadeIn();
            $.ajax({
                type: "GET",
                url: "{{ route('pending-transfer-get-gp') }}",
                dataType: 'json',
                data: {
                    'block_id': block_id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('.page-loader-wrapper').fadeOut();
                    if (data.msg == 'success') {
                        console.log(data)
                        $('#gramPanchayat').empty();
                        $('#gramPanchayat').append($("<option value=''>Select</option>"));
                        $.each(data.gp, function(index, value) {
                            $('#gramPanchayat').append('<option value="' + value
                                .gram_panchyat_id + '">' + value
                                .gram_panchyat_name + '</option>');
                        });
                    }
                    if (data.msg == 'failed') {
                        $('.page-loader-wrapper').fadeOut();
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        })
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('.page-loader-wrapper').fadeOut();
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                }
            })
        });

        /* AJAX for fetching Pending Employee Designation*/

        $('#designation').empty();
        $('#designation').append($("<option value=''>Select</option>"));
        $(document).on('change', '#level', function(e) {
            e.preventDefault();
            $('.page-loader-wrapper').fadeIn();
            var level = $('#level').val()
            $.ajax({
                type: "GET",
                url: "{{ route('pending-transfer-get-designation') }}",
                dataType: 'json',
                data: {
                    'level': level,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('.page-loader-wrapper').fadeOut();
                    if (data.msg == 'success') {
                        $('#designation').empty();
                        $('#designation').append($("<option value=''>Select</option>"));
                        $.each(data.designation, function(index, value) {
                            console.log(data)
                            $('#designation').append('<option value="' + value.designation_id +
                                '">' + value
                                .designation_name + '</option>');
                        });
                    }
                    if (data.msg == 'failed') {
                        $('.page-loader-wrapper').fadeOut();
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        })
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('.page-loader-wrapper').fadeOut();

                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                }
            })
        })

        /* jQuery for Fetching data for Pending Employee Deatails in Datatable*/

        $(function() {
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                scrollX: true,
                "ajax": {
                    "url": '/get-pending-employee-deatils',
                    "data": function(item) {
                        item.dis_id = $('#district').val();
                        item.block_id = $('#block').val();
                        item.panchayat_id = $('#gramPanchayat').val();
                        item.level_id = $('#level').val();
                        item.des_id = $('#designation').val();
                        item.ser_status = $('#service').val();
                    }
                },
                columns: [{
                        data: "employee_code"
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "designation_name"
                    },
                    {
                        data: "district_name"
                    },
                    {
                        data: "block_name"
                    },
                    {
                        data: "gram_panchyat_name"
                    },
                    {
                        data: "new_dis"
                    },
                    {
                        data: "new_block"
                    },
                    {
                        data: "new_gp"
                    },
                    {
                        data: "action"
                    },
                    {
                        data: "employee_code",
                        render: function(data, type, row, meta) {
                            if (type === 'display') {
                                data = '<a href="' + row.employee_code +
                                    '" style="color:#71239b ;" id="view_current_details" title="View Employee Details"><i class="bi bi-eye" style="font-size: 22px"></i></a>';
                            }
                            return data;
                        }
                    },
                ],
            });
        });

        /*On click Search Pending Employee Datatable Reload*/

        $(document).on('click', '.search', function(e) {
            e.preventDefault();
            $('#example').DataTable().ajax.reload();
        });

        /* jQuery for view Pending Employee List*/

        $(document).on('click', '#view_current_details', function(e) {
            e.preventDefault();
            var code = $(this).attr('href');
            var employee_code = $(this).data('employee_code');
            var name = $(this).data('name');
            var designation_name = $(this).data('designation_name');
            var district_name = $(this).data('district_name');
            var block_name = $(this).data('block_name');
            var gram_panchyat_name = $(this).data('gram_panchyat_name');
            var cuurent_district_name = $(this).data('new_dis');
            var current_block_name = $(this).data('new_block');
            var current_gram_panchyat_name = $(this).data('new_gp');
            $.ajax({
                type: "POST",
                url: "{{ route('get-pending-employee-list') }}",
                dataType: 'json',
                data: {
                    'code': code,
                    'employee_code': employee_code,
                    'name': name,
                    'designation_name': designation_name,
                    'district_name': district_name,
                    'block_name': block_name,
                    'gram_panchyat_name': gram_panchyat_name,
                    'new_dis': cuurent_district_name,
                    'new_block': current_block_name,
                    'new_gp': current_gram_panchyat_name,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    console.log(data)
                    if (data.msg == 'success') {
                        $('#pendingList').modal('show');

                        var pending_employee_record_div =
                            '<div class="row" style="padding:0 10px;margin-bottom:20px;margin-top:30px;">';
                        for (var i = 0; i < data.emp_record.length; i++) {
                            pending_employee_record_div +=
                                '<div class="col-md-4"><label style="color:black;font-weight:bold;font-size:20px;"><u>Employee Name</u></label><p><br>' +
                                data.emp_record[i].name +
                                '</p></div><div class="col-md-4"><label style="color:black;font-weight:bold;font-size:20px;"><u>Employee Code</u></label><p><br>' +
                                data.emp_record[i].employee_code +
                                '</p></div><div class="col-md-4"><label style="color:black;font-weight:bold;font-size:20px;"><u>Designation</u></label><p><br>' +
                                data.emp_record[i].designation_name +
                                '</p></div><div class="col-md-4"><label style="color:black;font-weight:bold;font-size:20px;"><u>Old District</u></label><p><br>' +
                                data.emp_record[i].district_name +
                                '</p></div><div class="col-md-4"><label style="color:black;font-weight:bold;font-size:20px;"><u>Old Block</u></label><p><br>' +
                                data.emp_record[i].block_name +
                                '</p></div><div class="col-md-4"><label style="color:black;font-weight:bold;font-size:20px;"><u>Old Gram Panchayat</u></label><p><br>' +
                                data.emp_record[i].gram_panchyat_name +
                                '</p></div><div class="col-md-4"><label style="color:black;font-weight:bold;font-size:20px;"><u>Current District</u></label><p><br>' +
                                data.emp_record[i].new_dis +
                                '</p></div><div class="col-md-4"><label style="color:black;font-weight:bold;font-size:20px;"><u>Current Block</u></label><p><br>' +
                                data.emp_record[i].new_block +
                                '</p></div><div class="col-md-4"><label style="color:black;font-weight:bold;font-size:20px;"><u>Current Gram Panchayat</u></label><p><br>' +
                                data.emp_record[i].new_gp;

                        }
                        pending_employee_record_div += '</div>';
                        $('.employee_records').html(pending_employee_record_div)
                    }
                    if (data.msg == 'failed') {

                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        })
                    }
                },

                error: function(jqXHR, textStatus, errorThrown) {

                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',

                    })
                }
            })
        });
    </script>
@endsection
@endsection
