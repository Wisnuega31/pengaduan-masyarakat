<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;

use App\Models\Petugas;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function index() {
		$data = new Pengaduan();
		
		return view('Admin.dashboard', ['data' => $data->all()]);
	}
	public function validasiStatus($id){
		$data = new Pengaduan();
		$data->find($id)->update(['status'=>'proses']);
		return back();
	}
	public function tanggapan() {
		$data = new Pengaduan();

		return view('Admin.tanggapan',['data'=>$data->where('status','proses')->get()]);
	}
	public function registrasi() {
		return view('Admin.registrasi');
	}
	public function simpan(Request $request){
		$data = new Petugas();

		$data->create($request->all());
		return redirect('petugas/login');
	}
	public function login() {
		return view('Admin.login');
	}
	public function ceklogin(Request $request){
		$data = new Petugas();
		$data =  $data->where('username',$request->input('username'))->where('password',$request->input('password'));
		if ($data->exists()) {
			$data = $data->first();
			session(['dataPetugas'=>$data]);
			return redirect('petugas');
		}
	}
	public function logout(){
		session()->flush();
		return back();
	}
	public function laporan() {
		return view('Admin.laporan');
	}
}