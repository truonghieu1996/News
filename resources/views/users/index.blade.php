@extends('layouts.app') @section('content')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">Danh sách người dùng</div>
                <div class="card-body">
                    <table id="DataList" class="table table-bordered table-hover table-sm table-responsive">
                        <thead>
                            <tr>
                                <th width="8%">#</th>
                                <th width="36%">Họ và tên</th>
                                <th width="30%">Email</th>
                                <th width="10%">Quyền</th>
                                <th width="8%">Sửa</th>
                                <th width="8%">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $count = 1; @endphp @foreach($users as $value)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>
                                    @if($value->role==1) Quản trị viên @else Người dùng @endif
                                </td>
                                @if($value->id != Auth::user()->id)
                                    <td class="text-center">
                                        <a data-toggle="modal" data-target="#myModalEdit" onclick="getUpdate({{ $value->id }}, '{{ $value->role }}'); return false;"
                                            class="btn btn-warning btn-sm" style="width:40px;">Sửa</a>
                                    </td>
                                    <td class="text-center">
                                        <a data-toggle="modal" data-target="#myModalDelete" onclick="getDelete({{ $value->id }}); return false;"
                                            class="btn btn-danger btn-sm" style="width:40px;">Xóa</a>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ url('/users/delete') }}" method="get">
        {{ csrf_field() }}
        <input type="hidden" id="ID_delete" name="ID_delete" value="" />
        <div class="modal fade" id="myModalDelete" tabindex="-1" name="dialog" aria-labelledby="myModalLabelDelete" aria-hidden="true">
            <div class="modal-dialog" name="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabelDelete">Xóa người dùng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="font-weight-bold text-danger">Xác nhận xóa? Hành động này không thể phục hồi.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                        <button type="submit" class="btn btn-danger">Thực hiện</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ url('/users/update') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" id="ID_edit" name="ID_edit" value="" />
        <div class="modal fade" id="myModalEdit" tabindex="-1" name="dialog" aria-labelledby="myModalLabelEdit" aria-hidden="true">
            <div class="modal-dialog" name="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabelEdit">Cập nhật người dùng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="role_edit">Quyền</label>
                            <select class="custom-select form-control" id="role_edit" name="role_edit">
                                <option value="1">Quản trị viên</option>
                                <option value="0">Người dùng</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Thực hiện</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection 
@section('javascript')
    <script type="text/javascript">
        function getUpdate(id, role) {
            $('#ID_edit').val(id);
            $('#role_edit').val(role);
        }

        function getDelete(id) {
            $('#ID_delete').val(id);
        }
    </script>
@endsection