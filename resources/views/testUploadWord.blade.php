<?php $codeLanguageVdict = ['en-vi'=>1, 'vi-en'=>2];
?>

<!DOCTYPE html>
<html>
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(isset($info))
    <div class="alert alert-danger">
        <ul>
            <li>
            @if($info==true)
            Upload thành công!
            @else
            Upload Thất bại!
            @endif</li>
        </ul>
    </div>
@endif

<form action="{{ route('uploadWords') }}" method="post" enctype="multipart/form-data">
    Danh sách từ muốn thêm:
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="file" name="fileWordsUpload">
    <select name="codeLanguageVdict">
        <option value="{{ $codeLanguageVdict['en-vi'] }}">Anh-Việt</option>
        <option value="{{ $codeLanguageVdict['vi-en'] }}">Việt-Anh</option>
    </select>
    <input type="submit" value="submit" name="submit">
</form>

</body>
</html>
