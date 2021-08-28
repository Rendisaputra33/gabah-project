<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;

class IndexController extends Controller
{
    private $user, $barang, $customer, $auth;

    public function __construct()
    {
        $this->user = new UserController();
        $this->barang = new BarangController();
        $this->customer = new CustomerController();
        $this->auth = new AuthController();
    }

    /**
     * controller route index admin
     */
    public function index()
    {
        (!isAdmin()) ? abort('401', 'cant access this page') : '';
        $data = $this->user->getUser();
        return view('admin.index', ['user_data' => $data]);
    }

    /**
     * controller route barang admin
     */
    public function barang()
    {
        (!isAdmin()) ? abort('401', 'cant access this page') : '';
        $data = $this->barang->getBarang();
        return view('admin.barang', ['barang' => $data]);
    }

    /**
     * controller route customer admin
     */
    public function customer()
    {
        (!isAdmin()) ? abort('401', 'cant access this page') : '';
        $data = $this->customer->getCustomer();
        return view('admin.customer', ['customer' => $data]);
    }

    // ========================================================== //

    // ====================== actions user ====================== //

    public function delUser($id)
    {
        (!isAdmin()) ? abort('401', 'cant access this page') : '';
        return $this->user->deleteUser($id);
    }

    public function upUser(Request $req, $id)
    {
        (!isAdmin()) ? abort('401', 'cant access this page') : '';
        return $this->user->updateUser([
            'name' => $req->name,
            'email' => $req->eemail
        ], $id);
    }

    public function getIdu($id)
    {
        return $this->user->getUpdate($id);
    }

    public function addUser(Request $req)
    {
        $req->validate([
            'email' => 'required|unique:users,email'
        ]);
        return $this->auth->Register([
            'name' => $req->username,
            'email' => $req->email,
            'password' => bcrypt($req->password),
            'level' => 1
        ]);
    }

    // ===================== end actions user ==================== //

    // ====================== actions barang ===================== //

    public function upBarang(Request $req, $id)
    {
        (!isAdmin()) ? abort('401', 'cant access this page') : '';
        return $this->barang->updateBarang([
            'nama' => $req->unama,
            'satuan' => $req->usatuan,
            'kemasan' => $req->ukemasan,
            'jenis' => $req->ujenis,
            'hrg_jual' => $req->uharga
        ], $id);
    }

    public function getIdb($id)
    {
        (!isAdmin()) ? abort('401', 'cant access this page') : '';
        return $this->barang->getUpdate($id);
    }

    public function addBarang(Request $req)
    {
        (!isAdmin()) ? abort('401', 'cant access this page') : '';

        if (!$req->validate(['akemasan' => 'required|numeric'])) {
            return redirect('/admin/barang');
        }

        return $this->barang->addBarang([
            'nama' => $req->anama,
            'satuan' => $req->asatuan,
            'kemasan' => $req->akemasan,
            'jenis' => $req->ajenis,
            'hrg_jual' => $req->aharga
        ]);
    }

    public function delBarang($id)
    {
        (!isAdmin()) ? abort('401', 'cant access this page') : '';
        return $this->barang->deleteBarang($id);
    }

    // ==================== end actions barang =================== //

    // ===================== actions customer ==================== //

    /* function add data customer */
    public function addCustomer(Request $req)
    {
        (!isAdmin()) ? abort('401', 'cant access this page') : '';
        return $this->customer->addCustomer([
            'nama' => $req->anama,
            'alamat' => $req->aalamat,
            'no_telp' => $req->ano
        ]);
    }

    /** function get data update **/
    public function getIdc($id)
    {
        (!isAdmin()) ? abort('401', 'cant access this page') : '';
        return $this->customer->getUpdate($id);
    }

    /* function update data customer */
    public function upCustomer(Request $req, $id)
    {
        (!isAdmin()) ? abort('401', 'cant access this page') : '';
        return $this->customer->updateCustomer([
            'nama' => $req->unama,
            'alamat' => $req->ualamat,
            'no_telp' => $req->uno
        ], $id);
    }

    /* function delete data customer */
    public function delCustomer($id)
    {
        (!isAdmin()) ? abort('401', 'cant access this page') : '';
        return $this->customer->deleteCustomer($id);
    }

    // =================== end actions customer ================== //

}
