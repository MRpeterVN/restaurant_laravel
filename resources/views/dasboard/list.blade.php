@include('dasboard.layout')


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Quản lý món ăn</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý món ăn</h1>
        </div>
    </div>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>Tên món ăn</th>
                    <th>Ảnh</th>
                    <th>Miêu tả</th>
                    <th>Giá tiền</th>
                    <th>
                        <a href="{{ route('dashboard.create') }}">
                            <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip"
                                data-placement="top" title="Thêm món ăn">Thêm</button>
                        </a>
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($monAnList as $monAn)
                <tr>
                    <td>{{ $monAn->ten_mon }}</td>
                    <td>
                        <img style="width:80px ; height:80px ;" src="{{ asset('images/'.$monAn->anh) }}"
                            alt="Ảnh món ăn" onmouseover="zoomIn(this)" onmouseout="zoomOut(this)">
                    </td>
                    <td>{{ $monAn->mo_ta }}</td>
                    <td>{{ $monAn->gia_tien }} đ</td>
                    <td>
                        <div class="edit_size">
                            <button type="button" class="edit-btn" data-toggle="tooltip" data-placement="top"
                                title="Chỉnh sửa"
                                onclick="window.location.href='{{ route('dashboard.edit', $monAn->id) }}'">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Chỉnh sửa
                            </button>

                            <form action="{{ route('dashboard.destroy', $monAn->id) }}" method="POST" id="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="confirmDelete(event)">
                                    <i class="fa fa-trash" aria-hidden="true"></i> Xóa
                                </button>
                            </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>
<!--/.main-->


<style>
.zoom-img {
    position: absolute;
    z-index: 1000;
}

table {
    border-collapse: collapse;
    width: 100%;
    max-width: 800px;
    margin: auto;
    font-size: 16px;
    line-height: 1.5;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

th,
td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
    color: #333;
}

tr:hover {
    background-color: #f5f5f5;
}

img {
    max-width: 100%;
    height: auto;
}

.edit-btn,
.delete-btn {
    font-size: 12px;
    border: none;
    background-color: transparent;
}

.delete-btn {
    margin-top: 5px;
    /* Adjust the font size as needed */
}
</style>

<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
<script>
function zoomIn(img) {
    img.classList.add("zoom-img");
    img.style.transform = "scale(3)";
}

function zoomOut(img) {
    img.classList.remove("zoom-img");
    img.style.transform = "scale(1)";
}
</script>


<script>
    function confirmDelete(event) {
        event.preventDefault(); // Prevent the form from submitting immediately

        if (confirm("Bạn có chắc chắn muốn xóa?")) {
            // If the user confirms, submit the form
            document.getElementById("delete-form").submit();
        }
    }
</script>