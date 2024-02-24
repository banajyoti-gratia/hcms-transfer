<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<body>
    @include('layouts.header')
    @include('layouts.sidebar')
    <main id="main" class="main">
        <section class="section">
            <div class="row align-items-top">
                <div class="col-lg-12">
                    <div class="card shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <h1 class="card-title text-decoration-underline">Search Employee Lists</h1>
                            <form>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class=""><strong>District</strong></label>
                                        <select class="form-select" id="district" aria-label="Default select example">
                                            <option value="" selected disabled>Select</option>
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->district_code }}">
                                                    {{ $district->district_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class=""><strong>Block</strong></label>
                                        <select class="form-select" id="block" aria-label="Default select example">
                                            <option value="" selected disabled>Select</option>
                                            @foreach ($blocks as $block)
                                                <option value="{{ $block->block_id }}">{{ $block->block_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class=""><strong>Gram Panchayat</strong></label>
                                        <select class="form-select" id="gramPanchayat"
                                            aria-label="Default select example">
                                            <option value="" selected disabled>Select</option>
                                            @foreach ($gramPanchayats as $gramPanchayat)
                                                <option value="{{ $gramPanchayat->gram_panchyat_id }}">
                                                    {{ $gramPanchayat->gram_panchyat_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class=""><strong>Program</strong></label>
                                        <select class="form-select" id="program" name="program"
                                            aria-label="Default select example">
                                            <option value="" selected disabled>Select</option>
                                            @foreach ($programs as $program)
                                                <option value="{{ $program->program_id }}">{{ $program->program_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
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
                                    <div class="col-sm-3">
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
                                    <div class="col-sm-3">
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
            </div>
        </section>
        <section class="section">
            <div class="card shadow p-3 mb-5 bg-body rounded">
                <div class="card-body">
                    <div class="pagetitle">
                        <h1 class="card-title text-decoration-underline">Employee Details Table</h1>
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
                                        <th>District</th>
                                        <th>Block</th>
                                        <th>GP</th>
                                        <th>Service Status</th>
                                        <th>Contact No</th>
                                        <th>View Details</th>
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
        <!-- Modal for view Employee Details -->
        <div class="modal fade top" id="transfer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            data-backdrop="true" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-top modal-notify modal-primary" role="document">
                <!--Content-->
                <div class="modal-content">
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
                </div>
            </div>
        </div>
        <!-- Modal for Transfer Employee -->
        <div class="modal fade top" id="transferEmployee" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel" data-backdrop="true" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-top modal-notify modal-primary" role="document">
                <!--Content-->
                <div class="modal-content">
                    <!--Header-->
                    <div class="card">
                        <div class="card-body" style="text-align:center">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <!--Body-->
                            <h3 class="card-title text-decoration-underline" style="font-size: 30px;">Employee
                                Transefer
                            </h3>
                            <div class="modal-body">
                                <div class="container"
                                    style="font-size:2opx;box-shadow: 0 4px 8px 0 rgba(2, 2, 2, 0.945), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                    <form id="transfer_form" enctype="multipart/form-data" style="padding: 20px">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="employee_id" id="employee_id">
                                        <input type="hidden" name="employee_code" id="employee_code">
                                        <input type="hidden" name="district_code" id="district_code">
                                        <input type="hidden" name="block_id" id="old_block_id">
                                        <input type="hidden" name="gram_panchayat_id" id="old_gram_panchayat_id">
                                        <input type="hidden" name="designation_id" id="designation_id">
                                        <div class="row mb-3">
                                            <div class="col-sm-4">
                                                <label class="col-sm-12 col-form-label"><strong>New
                                                        District</strong>&nbsp;<span style="color:red">*</span></label>
                                                <select class="form-select" name="new_district_id"
                                                    aria-label="Default select example" id="new_district" required>
                                                    <option selected disabled>Select District</option>
                                                    @foreach ($districts as $district)
                                                        <option value="{{ $district->district_code }}">
                                                            {{ $district->district_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-sm-12 col-form-label"><strong>New
                                                        Block</strong>&nbsp;<span style="color:red">*</span></label>
                                                <select class="form-select" name="new_block_id"
                                                    aria-label="Default select example" id="new_block" required>
                                                    <option selected disabled>Select Block</option>
                                                    @foreach ($blcks as $block)
                                                        <option value="{{ $block->block_id }}">
                                                            {{ $block->block_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-sm-12 col-form-label"><strong>New Gram
                                                        Panchayat</strong>&nbsp;<span
                                                        style="color:red">*</span></label>
                                                <select class="form-select" name="new_gram_panchayat_id"
                                                    aria-label="Default select example" id="new_gramPanchayat"
                                                    required>
                                                    <option selected disabled>Select Gram Panchayat</option>
                                                    @foreach ($gps as $gramPanchayat)
                                                        <option value="{{ $gramPanchayat->gram_panchyat_id }}">
                                                            {{ $gramPanchayat->gram_panchyat_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div><br>
                                        <div class="input-group">
                                            <span class="input-group-text"><strong>Remarks</strong>&nbsp;<span
                                                    style="color:red">*</span></span>
                                            <textarea class="form-control" name="remarks" aria-label="With textarea"></textarea>
                                        </div><br>
                                        <div class="row mb-3">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-outline-success">Submit
                                                    Form</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End #main -->

    @include('layouts.footer')
    @include('layouts.script')

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
        /* AJAX for fetching Blocks*/

        $('#block').empty();
        $('#gramPanchayat').empty();
        $(document).on('change', '#district', function() {
            $('.page-loader-wrapper').fadeIn();
            var dis_id = $('#district').val();
            $.ajax({
                type: "GET",
                url: "{{ route('get-block') }}",
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

        /* AJAX for fetching Gram Panchayat*/

        $(document).on('change', '#block', function() {
            var block_id = $('#block').val();
            $('.page-loader-wrapper').fadeIn();
            $.ajax({
                type: "GET",
                url: "{{ route('get-gp') }}",
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

        /* AJAX for fetching Employee Designation*/

        $('#designation').empty();
        $(document).on('change', '#level', function(e) {
            e.preventDefault();
            $('.page-loader-wrapper').fadeIn();
            var level = $('#level').val()
            $.ajax({
                type: "GET",
                url: "{{ route('get-designation') }}",
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

        /* jQuery for Fetching data for Datatable*/

        $(function() {
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                scrollX: true,
                "ajax": {
                    "url": '/get-employee-deatils',
                    "data": function(item) {
                        item.dis_id = $('#district').val();
                        item.block_id = $('#block').val();
                        item.panchayat_id = $('#gramPanchayat').val();
                        item.program_id = $('#program').val();
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
                        data: "action"
                    },
                    {
                        data: "mobile"
                    },
                    {
                        data: "employee_code",
                        render: function(data, type, row, meta) {
                            if (type === 'display') {
                                data = '<a href="' + row.employee_code +
                                    '" style="color:blue;" id="employee_record" title="View Employee Details"><i class="bi bi-eye" style="font-size: 22px"></i></a>';
                            }
                            return data;
                        }
                    },
                    {
                        data: "employee_code",
                        render: function(data, type, row) {
                            return "<a id='' href='" + row.employee_code +
                                "' data-employee_code='" + row.employee_code +
                                "' data-employee_id='" + row.employee_id +
                                "' data-designation_id='" + row.designation_id +
                                "' data-district_code='" + row.district_code + "' data-block_id='" +
                                row.block_id + "' data-gram_panchayat_id='" + row
                                .gram_panchayat_id +
                                "' class='employeeTransfer' style='padding: 10px' id='employee_record' title='Transfer Employee' data-bs-toggle='modal' data-bs-target='#transferEmployee'><i class='bi bi-send' style='font-size: 25px'></i></a>"
                        }
                    },
                ],
            });
        });

        /*On click Search Reload Datatable*/

        $(document).on('click', '.search', function(e) {
            e.preventDefault();
            $('#example').DataTable().ajax.reload();
        });

        /* jQuery for view Employee List*/

        $(document).on('click', '#employee_record', function(e) {
            e.preventDefault();
            var code = $(this).attr('href');
            var employee_code = $(this).data('employee_code');
            var name = $(this).data('name');
            var designation_name = $(this).data('designation_name');
            var district_name = $(this).data('district_name');
            var block_name = $(this).data('block_name');
            var gram_panchyat_name = $(this).data('gram_panchyat_name');
            $.ajax({
                type: "POST",
                url: "{{ route('get-employee-list') }}",
                dataType: 'json',
                data: {
                    'code': code,
                    'employee_code': employee_code,
                    'name': name,
                    'designation_name': designation_name,
                    'district_name': district_name,
                    'block_name': block_name,
                    'gram_panchyat_name': gram_panchyat_name,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    console.log(data)
                    if (data.msg == 'success') {
                        $('#transfer').modal('show');

                        var employee_record_div =
                            '<div class="row" style="padding:0 10px;margin-bottom:20px;margin-top:30px;">';
                        for (var i = 0; i < data.emp_record.length; i++) {
                            employee_record_div +=
                                '<div class="col-md-4"><label style="color:black;font-weight:bold;font-size:18px;">Employee Name</label><p><br>' +
                                data.emp_record[i].name +
                                '</p></div><div class="col-md-4"><label style="color:black;font-weight:bold;font-size:16px;">Employee Code</label><p><br>' +
                                data.emp_record[i].employee_code +
                                '</p></div><div class="col-md-4"><label style="color:black;font-weight:bold;font-size:16px;">Current Designation</label><p><br>' +
                                data.emp_record[i].designation_name +
                                '</p></div><div class="col-md-4"><label style="color:black;font-weight:bold;font-size:16px;">Current District</label><p><br>' +
                                data.emp_record[i].district_name +
                                '</p></div><div class="col-md-4"><label style="color:black;font-weight:bold;font-size:16px;">Current Block</label><p><br>' +
                                data.emp_record[i].block_name +
                                '</p></div><div class="col-md-4"><label style="color:black;font-weight:bold;font-size:16px;">Current Gram Panchayat</label><p><br>' +
                                data.emp_record[i].gram_panchyat_name;
                        }
                        employee_record_div += '</div>';
                        $('.employee_records').html(employee_record_div)
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

        /*jQuery for Get Data For Employeee */

        $(document).on('click', '.employeeTransfer', function() {

            $('#employee_code').val($(this).data('employee_code'));
            $('#employee_id').val($(this).data('employee_id'));
            $('#designation_id').val($(this).data('designation_id'));
            $('#district_code').val($(this).data('district_code'));
            $('#old_block_id').val($(this).data('block_id'));
            $('#old_gram_panchayat_id').val($(this).data('gram_panchayat_id'));
        });

        /*AJAX for Employee Transfer*/

        $(document).on('submit', '#transfer_form', function(e) {
            // e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('transfer-employee') }}",
                dataType: 'json',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.message == "success") {
                        $("#transfer_form")[0].reset();
                        $('#transfer').modal('hide');

                        Swal.fire(
                            'Success!',
                            'Employee Transfer Request Sent!',
                            'success'
                        )
                    }
                },
            });
        })

        /* AJAX for get block for Modal */

        $('#new_block').empty();
        $('#new_gramPanchayat').empty();
        $('#new_district').on('change', function(e) {
            e.preventDefault()
            var dis_id = $(this).val();
            $('.page-loader-wrapper').fadeIn();
            $.ajax({
                type: "GET",
                url: "{{ route('get-block') }}",
                dataType: 'json',
                data: {
                    'dis_id': dis_id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('.page-loader-wrapper').fadeOut();
                    $('#new_block').empty();
                    $('#new_block').append($("<option value=''>Select</option>"));
                    $.each(data, function(index, value) {
                        console.log(value)
                        $('#new_block').append('<option value="' + value.block_id + '">' + value
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
        })

        /* AJAX for get GP for Modal */

        $(document).on('change', '#new_block', function(e) {
            e.preventDefault()
            var block_id = $(this).val();
            $('.page-loader-wrapper').fadeIn();
            $.ajax({
                type: "GET",
                url: "{{ route('get-gp') }}",
                dataType: 'json',
                data: {
                    'block_id': block_id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('.page-loader-wrapper').fadeOut();
                    if (data.msg == 'success') {
                        console.log(data)
                        $('#new_gramPanchayat').empty();
                        $('#new_gramPanchayat').append($("<option value=''>Select</option>"));
                        $.each(data.gp, function(index, value) {
                            $('#new_gramPanchayat').append('<option value="' + value
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
        })
    </script>
</body>

</html>
