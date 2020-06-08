@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                            class="form-edit-add"
                            action="{{ $edit ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) : route('voyager.'.$dataType->slug.'.store') }}"
                            method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if($edit)
                            {{ method_field("PUT") }}
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                            @endphp

                            @if($edit)
                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label">From Date</label>
                                    <input type="date" class="form-control" name="from_date" placeholder="From Date" value="{{ old('from_date', $salary->from_date) }}" id="from_date">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label">To Date</label>
                                    <input type="date" class="form-control" name="to_date" placeholder="To Date" value="{{ old('to_date', $salary->to_date) }}" id="to_date">
                                </div>
                                
                                <div class="form-group col-md-12">
                                <label for="name" class="control-label">Employee</label>
                                    <select id="" required="required" name="employee_id" class="form-control select2" style="width:100%">
                                    <option value="">None</option>
                                        @foreach($employees as $e)
                                            @if (old('employee_id', $salary->employee_id) == $e->employee_id)
                                                <option value={{ $e->employee_id }} selected>{{ $e->first_name  }}</option>
                                            @else
                                                <option value={{ $e->employee_id  }}>{{ $e->first_name  }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label">Total Absence</label>
                                    <input type="number" class="form-control" name="total_absence" placeholder="Total Absence" value="{{ old('total_absence', $salary->absence) }}" id="totalAbsence">
                                    <small class="form-text text-muted">If absence more than 3 days, deduction will be count on 4th day each day.</small>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label">Total Late</label>
                                    <input type="number" class="form-control" name="total_late" placeholder="Total Late" value="{{ old('total_late', $salary->total_late) }}" id="totalLate">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label">Total Deduction</label>
                                    <input type="number" class="form-control" name="total_deduction" placeholder="Total Deduction" value="{{ old('total_deduction', $salary->total_deduction) }}" id="totalDeduction">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label">Bonus</label>
                                    <input type="number" class="form-control" name="bonus" placeholder="Bonus" value="{{ old('bonus', $salary->bonus) }}" id="totalBonus">
                                    <small class="form-text text-muted">Will get bonus if no absence.</small>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label">Salary</label>
                                    <input type="number" class="form-control" name="salary" placeholder="Salary" value="{{ old('salary', $salary->salary) }}" id="totalSalary">
                                </div>
                            @else
                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label">From Date</label>
                                    <input type="date" class="form-control" name="from_date" placeholder="From Date" id="from_date">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label">To Date</label>
                                    <input type="date" class="form-control" name="to_date" placeholder="To Date" id="to_date">
                                </div>

                                <div class="form-group col-md-12">
                                <label for="name" class="control-label">Employee</label>
                                    <select id="" required="required" name="employee_id" class="form-control select2" style="width:100%" onChange="employee(this.value)" id="employee">
                                    <option value="">None</option>
                                        @foreach($employees as $e)
                                            <option value="{{ $e->employee_id  }}">{{ $e->first_name  }}</option>
                                        @endforeach   
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label">Total Absence</label>
                                    <input type="number" class="form-control" name="total_absence" placeholder="Total Absence" id="totalAbsence">
                                    <small class="form-text text-muted">If absence more than 3 days, deduction will be count on 4th day each day.</small>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label">Total Late</label>
                                    <input type="number" class="form-control" name="total_late" placeholder="Total Late" id="totalLate">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label">Total Deduction</label>
                                    <input type="number" class="form-control" name="total_deduction" placeholder="Total Deduction" id="totalDeduction">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label">Bonus</label>
                                    <input type="number" class="form-control" name="bonus" placeholder="Bonus" id="totalBonus">
                                    <small class="form-text text-muted">Will get bonus if no absence.</small>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label">Salary</label>
                                    <input type="number" class="form-control" name="salary" placeholder="Salary" id="totalSalary">
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 form-group">
                                            <p id="item"></p>
                                                
                                        </select>
                                    </div>
                                </div>
                            @endif

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            @section('submit-buttons')
                                <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                            @stop
                            @yield('submit-buttons')
                        </div>
                    </form>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                            enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                                 onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
          return function() {
            $file = $(this).siblings(tag);

            params = {
                slug:   '{{ $dataType->slug }}',
                filename:  $file.data('file-name'),
                id:     $file.data('id'),
                field:  $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
          };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                } else if (elt.type != 'date') {
                    elt.type = 'text';
                    $(elt).datetimepicker({
                        format: 'L',
                        extraFormats: [ 'YYYY-MM-DD' ]
                    }).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });

        function employee(val){
            var from_date = document.getElementById("from_date").value;
            var to_date = document.getElementById("to_date").value;

            if(to_date < from_date){
                alert("From Date must be earlier than To Date");
                location.reload();
            }
            else{
                $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "{{ url('/admin/create/salaryOnchange') }}",
                        data:{ id1: from_date, id2: to_date, id3: val },
                        success: function(data){
                            var result = $.parseJSON(data);
                            document.getElementById("totalAbsence").value = result[0];
                            document.getElementById("totalLate").value = result[1];
                            document.getElementById("totalDeduction").value = result[2];
                            document.getElementById("totalBonus").value = result[3];
                            document.getElementById("totalSalary").value = result[4];
                        }
                    });
            }
        }
    </script>
@stop
