@extends('layouts.app') 
@section('content') 
    <form action="{{ url('/news/update') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" id="ID_edit" name="ID_edit" value="{{$new->id}}" />
        <div class="form-group">
            <div class="form-group">
                <label for="title_edit">Tiêu đề
                    <span class="text-danger font-weight-bold">*</span>
                </label>
                <input type="text" class="form-control{{ $errors->has('title_edit') ? ' is-invalid' : '' }}" id="title_edit" name="title_edit"
                    value="{{ $new->title }}" placeholder="" required /> @if($errors->has('title_edit'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('title_edit') }}</strong>
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="category_id_edit">Chủ đề
                    <span class="text-danger font-weight-bold">*</span>
                </label>
                <select class="form-control{{ $errors->has('category_id_edit') ? ' is-invalid' : '' }}" id="category_id_edit" name="category_id_edit"
                    required>
                    <option value="">-- Chọn chủ đề --</option>
                    @foreach($categories as $value)
                    <option value="{{ $value->id }}">{{ $value->name_category }}</option>
                    @endforeach
                </select>
                @if($errors->has('category_id_edit'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('category_id_edit') }}</strong>
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="summary_edit">Tóm tắt
                    <span class="text-danger font-weight-bold">*</span>
                </label>
                <textarea class="form-control{{ $errors->has('summary_edit') ? ' is-invalid' : '' }}" id="summary_edit" name="summary_edit"
                    placeholder="" required>{{$new->summary}}</textarea>
                @if($errors->has('summary_edit'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('summary_edit') }}</strong>
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="content_edit">Nội dung bài viết
                    <span class="text-danger font-weight-bold">*</span>
                </label>
                <textarea class="ckeditor form-control{{ $errors->has('content_edit') ? ' is-invalid' : '' }}" id="content_edit" name="content_edit"
                    placeholder="" required>{{$new->content}}</textarea>
                @if($errors->has('content_edit'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('content_edit') }}</strong>
                </div>
                @endif
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
    </form>

    @if($errors->has('title_edit')) $('#myModal').modal('show');@endif 
    @if($errors->has('content_edit')) $('#myModal').modal('show'); @endif 
    @if($errors->has('summary_edit')) $('#myModal').modal('show'); @endif
@endsection

@section('javascript')
    <script type="text/javascript">
        document.getElementById("category_id_edit").value = "<?php echo $new->category_id;?>";
    </script> 
 @endsection