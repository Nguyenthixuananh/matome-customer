<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{


//index() : hiển thị danh sách khách hàng
    public function index()
    {
        $customers = Customer::all();
        return view('customers.list', compact('customers'));
    }

//   create(): show form tạo mới khách hàng
    public function create()
    {
        return view('customers.create');
    }

 //store(): thực hiện thêm mới khách hàng
    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->dob = $request->input('dob');
        $customer->save();

        //dung session de dua ra thong bao
        Session::flash('success', 'Tạo mới khách hàng thành công');
        //tao moi xong quay ve trang danh sach khach hang
        return redirect()->route('customers.index');
    }

    //edit(): hiển thị form và dữ liệu khách hàng cần sửa
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

   //update(): thực hiện tác vụ sửa
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->dob = $request->input('dob');
        $customer->save();

        //dung session de dua ra thong bao
        Session::flash('success', 'Cập nhật khách hàng thành công');
        //cap nhat xong quay ve trang danh sach khach hang
        return redirect()->route('customers.index');
    }

    //destroy(): xóa khách hàng
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        //dung session de dua ra thong bao
        Session::flash('success', 'Xóa khách hàng thành công');

        //xoa xong quay ve trang danh sach khach hang
        return redirect()->route('customers.index');
    }
}
