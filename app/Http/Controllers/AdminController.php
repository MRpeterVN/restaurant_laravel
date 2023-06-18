<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\MonAn;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dasboard.index');
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dasboard.upload');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Lấy tệp tin ảnh được upload từ yêu cầu POST
        $image = $request->file('anh');
    
        // Kiểm tra xem tệp tin ảnh đã được tải lên hay chưa
        if (!$image) {
            return redirect()->back()->with('error', 'Không tìm thấy tệp tin ảnh!');
        }
    
        // Tạo tên mới cho tệp tin ảnh
        $name = time() . '_' . $image->getClientOriginalName();
    
        // Di chuyển tệp tin ảnh đến thư mục public/images
        $image->move(public_path('images'), $name);
    
        // Lưu thông tin của món ăn vào cơ sở dữ liệu
        $monAn = MonAn::create([
            'ten_mon' => $request->input('ten_mon'),
            'mo_ta' => $request->input('mo_ta'),
            'phan_loai' => $request->input('phan_loai'),
            'gia_tien'=> $request->input('gia_tien'),
            'anh'=> $name,
        ]);
    
        $monAn->save();

        // Chuyển hướng đến trang hiển thị thông tin món ăn vừa được tạo
        return redirect()->route('dashboard.list')
        ->with('success', 'Món ăn đã được thêm thành công!');
    }
    /**
     * Display the specified resource.
     */
    public function show()
    {

      
    }

    public function list()
{
    $monAnList = MonAn::all();
    return view('dasboard.list', compact('monAnList'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $monAn = MonAn::find($id);
    return view('dasboard.edit', compact('monAn'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Lấy thông tin món ăn cần cập nhật từ cơ sở dữ liệu
        $monAn = MonAn::findOrFail($id);
    
        // Lấy tên tệp tin ảnh hiện tại của món ăn
        $oldImageName = $monAn->anh;
    
        // Lấy tệp tin ảnh mới được upload từ yêu cầu POST
        $newImage = $request->file('anh');
    
        // Nếu không có tệp tin ảnh mới được upload, giữ nguyên tên tệp tin ảnh cũ
        if (!$newImage) {
            $newImageName = $oldImageName;
        } else {
            // Tạo tên mới cho tệp tin ảnh
            $newImageName = time() . '_' . $newImage->getClientOriginalName();
    
            // Di chuyển tệp tin ảnh đến thư mục public/images
            $newImage->move(public_path('images'), $newImageName);
    
            // Xóa tệp tin ảnh cũ
            if ($oldImageName) {
                $oldImagePath = public_path('images/' . $oldImageName);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }
    
        // Cập nhật thông tin món ăn
        $monAn->ten_mon = $request->input('ten_mon');
        $monAn->mo_ta = $request->input('mo_ta');
        $monAn->phan_loai = $request->input('phan_loai');
        $monAn->gia_tien = $request->input('gia_tien');
        $monAn->anh = $newImageName;
        $monAn->save();
    
        return redirect()->route('dashboard.list', $monAn->id)
        ->with('success', 'Món ăn đã được cập nhật thành công!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Get the existing dish
        $monAn = MonAn::findOrFail($id);
    
        // Delete the image file
        if ($monAn->anh) {
            $imagePath = public_path('images/' . $monAn->anh);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    
        // Delete the dish data
        $monAn->delete();
    
        // Redirect to the dashboard
        return redirect()->route('dashboard.list')
        ->with('success', 'Món ăn đã được xóa thành công!');
    }
}
