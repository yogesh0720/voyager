@extends('voyager::master')

@section('content')

<div class="page-content browse container-fluid">
    <h1 class="page-title">
        <i class="voyager-activity"></i> Inquiry
    </h1>
    <a href="{{ route('create') }}" class="btn btn-success btn-add-new" data-toggle="modal">
        <i class="voyager-plus"></i> <span>Add New</span>
    </a>
    <a class="btn btn-danger" id="bulk_delete_btn"><i class="voyager-trash" data-toggle="modal"></i>
        <span>Bulk Delete</span></a>
    <div class="alerts">
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover dataTable no-footer">
                            <thead>
                            <tr>
                                <th style="width: 22px;"><input type="checkbox" id="selectAll"></th>
                                <th style="width: 51px;">FirsName</th>
                                <th style="width: 51px;">LastName</th>
                                <th style="width: 51px;">Phone</th>
                                <th style="width: 51px;">Email</th>
                                <th style="width: 51px;">Occupation</th>
                                <th style="width: 51px;">Inquiry</th>
                                <th class="actions text-right sorting_disabled" style="width: 207px;">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($inquiry as $inquiryData)
                            <tr>
                                <td><input type="checkbox" id="checkbox_{{ $inquiryData->id }}" name="row_id"
                                           value="{{ $inquiryData->id }}"></td>
                                <td>{{ $inquiryData->firstName }}</td>
                                <td>{{ $inquiryData->lastName }}</td>
                                <td>{{ $inquiryData->contactNo }}</td>
                                <td>{{ $inquiryData->emailID }}</td>
                                <td>{{ $inquiryData->occupation }}</td>
                                <td>{{ $inquiryData->inquiryFor }}</td>
                                <td class="no-sort no-click" id="bread-actions">
                                    <!--<form action="{{ route('delete', $inquiryData->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>-->
                                    <a href="javascript:;" class="btn btn-danger btn-sm pull-right delete"
                                       style="padding: 5px 10px; font-size: 12px;"><i class="voyager-trash"></i>
                                        Delete</a>
                                    <a href="{{ route('edit', $inquiryData->id) }}"
                                       class="btn btn-sm btn-primary pull-right edit"
                                       style="padding: 5px 10px; font-size: 12px;">
                                        <i class="voyager-edit"></i> Edit
                                    </a>
                                    <a href="{{ route('show', $inquiryData->id) }}"
                                       class="btn btn-sm btn-warning pull-right view"
                                       style="padding: 5px 10px; font-size: 12px; margin: 5px 5px;"><i
                                            class="voyager-eye"></i> View</a>

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Single delete modal --}}
<div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} ?</h4>
            </div>
            <div class="modal-footer">
                <form action="#" id="delete_form" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger pull-right delete-confirm" value="{{ __('voyager::generic.delete_confirm') }}">
                </form>
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@stop

@section('javascript')

<script>
    $(document).ready(function () {
        $('#example').DataTable({
            'columnDefs': [{
                'targets': [5], /* column index */
                'orderable': false, /* true or false */
            }]
        });
    });

    $(document).ready(function () {
        // Activate tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Select/Deselect checkboxes
        var checkbox = $('table tbody input[type="checkbox"]');
        $("#selectAll").click(function () {
            if (this.checked) {
                checkbox.each(function () {
                    this.checked = true;
                });
            } else {
                checkbox.each(function () {
                    this.checked = false;
                });
            }
        });
        checkbox.click(function () {
            if (!this.checked) {
                $("#selectAll").prop("checked", false);
            }
        });
    });

    var deleteFormAction;
    $('td').on('click', '.delete', function (e) {//{{ route('delete', $inquiryData->id) }}
        $('#delete_form')[0].action = '{{ route('delete', ['id' => '__id']) }}'.replace('__id', $(this).data('id'));
        $('#delete_modal').modal('show');
    });
</script>
@stop
