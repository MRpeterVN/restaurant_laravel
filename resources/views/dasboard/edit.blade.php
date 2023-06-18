@include('dasboard.layout')



<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Sửa món ăn</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sửa món ăn</h1>
        </div>
    </div>

    <form action="{{ route('dashboard.update', $monAn->id) }}" method="POST" enctype="multipart/form-data" role="form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Tên món ăn</label>
            <input class="form-control" placeholder="Tên món ăn" name="ten_mon" value="{{ $monAn->ten_mon }}">
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <input class="form-control" placeholder="Mô tả" name="mo_ta" value="{{ $monAn->mo_ta }}">
        </div>
        <div class="form-group">
            <label>Phân loại</label>
            <select name="phan_loai" class="form-control">
                <option value="option_1" {{ $monAn->phan_loai == 'option_1' ? 'selected' : '' }}>Option 1</option>
                <option value="option_2" {{ $monAn->phan_loai == 'option_2' ? 'selected' : '' }}>Option 2</option>
                <option value="option_3" {{ $monAn->phan_loai == 'option_3' ? 'selected' : '' }}>Option 3</option>
                <option value="option_4" {{ $monAn->phan_loai == 'option_4' ? 'selected' : '' }}>Option 4</option>
            </select>
        </div>
        <!-- anh -->
        <div class="form-group">
            <label>Ảnh</label>
            <input type="file" id="inputFile" name="anh">
            <p class="help-block">Chọn một tệp tin ảnh từ máy tính của bạn.</p>
            <img id="previewImage" style="max-width: 200px; display: none;">
            <button id="cancelButton" style="display: none;">Hủy chọn ảnh</button>
            @if ($monAn->anh)
            <img src="{{ asset('images/' . $monAn->anh) }}" alt="{{ $monAn->ten_mon }}" style="max-width: 200px;">
            @endif
        </div>
        <!-- /anh -->
        <div class="form-group">
            <label>Giá tiền</label>
            <input class="form-control" placeholder="Giá Tiền" name="gia_tien" value="{{ $monAn->gia_tien }}">
        </div>
        <button type="submit" class="btn btn-md btn-success">Cập nhật</button>
    </form>
</div>
<!--/.main-->

<script>
    // Get the file input element and preview image element
    var inputFile = document.getElementById('inputFile');
    var previewImage = document.getElementById('previewImage');
    var cancelButton = document.getElementById('cancelButton');

    // Set up an event listener for the file input change event
    inputFile.addEventListener('change', function(event) {
        // Get the selected file and create a URL for it
        var file = event.target.files[0];
        var url = URL.createObjectURL(file);

        // Update the preview image source and display it
        previewImage.src = url;
        previewImage.style.display = 'block';

        // Hide the old image
        var oldImage = document.querySelector('img[src="{{ asset('images/' . $monAn->anh) }}"]');
        if (oldImage) {
            oldImage.style.display = 'none';
        }

        // Display the cancel button
        cancelButton.style.display = 'inline-block';
    });

    // Set up an event listener for the cancel button click event
    cancelButton.addEventListener('click', function(event) {
        // Clear the file input and hide the preview image and cancel button
        inputFile.value = '';
        previewImage.src = '';
        previewImage.style.display = 'none';
        cancelButton.style.display = 'none';

        // Show the old image again
        var oldImage = document.querySelector('img[src="{{ asset('images/' . $monAn->anh) }}"]');
        if (oldImage) {
            oldImage.style.display = 'block';
        }

        // Prevent the default button behavior
        event.preventDefault();
    });
</script>