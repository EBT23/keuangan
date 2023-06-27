<?php

namespace App\Http\Controllers\api;

use App\Models\Role;
use App\Models\Penjab;
use App\Models\Posisi;
use App\Models\Pemasukan;
use App\Models\Distributor;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ApiAdminController extends Controller
{

    public function dashboard()
    {
    }
    public function pengeluaran()
    {   
       
        $pengeluaran = DB::table('pengeluaran')
            ->join('jenis_pengeluaran', 'jenis_pengeluaran.id', '=', 'pengeluaran.jenis_pengeluaran_id')
            ->select('users.id AS user_id','jenis_pengeluaran.id','jenis_pengeluaran.jenis_pengeluaran','pengeluaran.*')
            ->get();
        return response()->json([
            'data' => $pengeluaran
        ]);
    }
    public function tambah_pengeluaran(Request $request)
    {
       
        $validatedData = $request->validate([
            'jenis_pengeluaran_id' => 'required',
            'keterangan' => 'required|max:255',
            'total_pengeluaran' => 'required|numeric',
            'tgl' => 'required',
            'bukti_pengeluaran' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

       
        if ($request->hasFile('bukti_pengeluaran')) {
            $gambar = $request->file('bukti_pengeluaran');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->move(public_path('upload/pengeluaran'), $gambarName);
            $gambar->bukti_pengeluaran = $gambarName;
        } else {
            $gambarName = null;
        }

    
        $pengeluaran = Pengeluaran::create([
            'jenis_pengeluaran_id' => $validatedData['jenis_pengeluaran_id'],
            'keterangan' => $validatedData['keterangan'],
            'total_pengeluaran' => $validatedData['total_pengeluaran'],
            'tgl' => $validatedData['tgl'],
            'bukti_pengeluaran' => $gambarName,
        ]);

    
        return response()->json([
            'message' => 'Data pengeluaran berhasil ditambahkan.',
            'data' => $pengeluaran,
        ], 201);
    }

    public function update_pengeluaran(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'jenis_pengeluaran_id' => 'required',
            'keterangan' => 'required',
            'total_pengeluaran' => 'required',
            'tgl' => 'required',
            'bukti_pengeluaran' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        $pengeluaran->jenis_pengeluaran_id = $request->jenis_pengeluaran_id;
        $pengeluaran->keterangan = $request->keterangan;
        $pengeluaran->total_pengeluaran = $request->total_pengeluaran;
        $pengeluaran->tgl = $request->tgl;
    
    
        if ($request->hasFile('bukti_pengeluaran')) {
          // hapus gambar
            if ($pengeluaran->bukti_pengeluaran != null) {
                Storage::delete($pengeluaran->bukti_pengeluaran);
            }
    
            // upload gambar baru
            $file = $request->file('bukti_pengeluaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->move(public_path('upload/pengeluaran'), $filename);
            $pengeluaran->bukti_pengeluaran = $path;
        }
    
        $pengeluaran->save();
    
        return response()->json([
            'message' => 'Data pengeluaran berhasil diupdate'
        ]);
    }
    public function delete_pengeluaran($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();
        return response()->json([
            'success' => true,
            'message' => 'Pengeluaran berhasil dihapus',
            'data' => $pengeluaran
        ]);
    }
    public function get_pengeluaran_by_id($id)
    {
        $pengeluaran = DB::table('pengeluaran')
            ->where('id', '=', $id)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditampilkan',
            'data' => $pengeluaran
        ]);
    }
    public function pemasukan()
    {
        $pemasukan = DB::table('pemasukan')
            ->join('distributor', 'distributor.id', '=', 'pemasukan.distributor_id')
            ->select('pemasukan.id','distributor.id', 'distributor.nama_distributor', 'pemasukan.*')
            ->get();
        return response()->json([
            'data' => $pemasukan
        ]);
    }
    public function tambah_pemasukan(Request $request)
    {
        $validatedData = $request->validate([
            'distributor_id' => 'required',
            'keterangan' => 'required',
            'tgl' => 'required',
            'total_pemasukan' => 'required',
            'bukti_pemasukan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

       
        if ($request->hasFile('bukti_pemasukan')) {
            $gambar = $request->file('bukti_pemasukan');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->move(public_path('upload/pemasukan'), $gambarName);
            $gambar->bukti_pemasukan = $gambarName;
        } else {
            $gambarName = null;
        }

    
        $pemasukan = Pemasukan::create([
            'distributor_id' => $validatedData['distributor_id'],
            'keterangan' => $validatedData['keterangan'],
            'tgl' => $validatedData['tgl'],
            'total_pemasukan' => $validatedData['total_pemasukan'],
            'bukti_pemasukan' => $gambarName,
        ]);

    
        return response()->json([
            'message' => 'Data pemasukan berhasil ditambahkan.',
            'data' => $pemasukan,
        ], 201);
    }
    public function update_pemasukan(Request $request, $id)
    {
        $pemasukan = Pemasukan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'distributor_id' => 'required',
            'keterangan' => 'required',
            'total_pemasukan' => 'required',
            'tgl' => 'required',
            'bukti_pemasukan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        $pemasukan->distributor_id = $request->distributor_id;
        $pemasukan->keterangan = $request->keterangan;
        $pemasukan->total_pemasukan = $request->total_pemasukan;
        $pemasukan->tgl = $request->tgl;
    
        if ($request->hasFile('bukti_pemasukan')) {
          // hapus gambar
            if ($pemasukan->bukti_pemasukan != null) {
                Storage::delete($pemasukan->bukti_pemasukan);
            }
    
            // upload gambar baru
            $file = $request->file('bukti_pemasukan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->move(public_path('upload/pemasukan'), $filename);
            $pemasukan->bukti_pemasukan = $path;
        }
    
        $pemasukan->save();
    
        return response()->json([
            'message' => 'Data pemasukan berhasil diupdate'
        ]);
    }

    public function delete_pemasukan($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->delete();
        return response()->json([
            'success' => true,
            'message' => 'Pemasukan berhasil dihapus',
            'data' => $pemasukan
        ]);
    }
    
    public function get_pemasukan_by_id($id)
    {
        $pemasukan = DB::table('pemasukan')
            ->where('id', '=', $id)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditampilkan',
            'data' => $pemasukan
        ]);
    }
    public function distributor()
    {

        $distributor = DB::table('distributor')->get();
        return response()->json([
            'data' => $distributor
        ]);
    }
    public function tambah_distributor(Request $request)
    {
        $validate = $request->validate([
            'nama_distributor' => 'required',
            'tlp' => 'required',
            'area_cover' => 'required',
            'alamat' => 'required',
            'penjab' => 'required',
        ]);

        $distributor = DB::table('distributor')->insert([

            'nama_distributor' => $request->nama_distributor,
            'tlp' => $request->tlp,
            'area_cover' => $request->area_cover,
            'alamat' => $request->alamat,
            'penjab' => $request->penjab,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Distributor berhasil disimpan',
            'data' => $distributor
        ], Response::HTTP_OK);
    }
    public function update_distributor(Request $request, $id)
    {
        $distributor = Distributor::findOrFail($id);
        $distributor->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'distributor berhasil dirubah',
            'data' => $distributor
        ]);
    }
    public function delete_distributor($id)
    {
        $distributor = Distributor::findOrFail($id);
        $distributor->delete();
        return response()->json([
            'success' => true,
            'message' => 'distributor berhasil dihapus',
            'data' => $distributor
        ]);
    }
    public function get_distributor_by_id($id)
    {
        $distributor = DB::table('distributor')
            ->where('id', '=', $id)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditampilkan',
            'data' => $distributor
        ]);
    }

    //========== PENJAB ===========

    public function penjab()
    {
        $penjab = DB::table('penjab')->get();
        return response()->json([
            'data' => $penjab
        ]);
    }

    public function tambah_penjab(Request $request)
    {
        $validate = $request->validate([
            'nama_penjab' => 'required',
        ]);

        $penjab = DB::table('penjab')->insert([

            'nama_penjab' => $request->nama_penjab,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Penjab berhasil ditambah',
            'data' => $penjab
        ], Response::HTTP_OK);
    }

    public function update_penjab(Request $request, $id)
    {
        $penjab = Penjab::findOrFail($id);
        $penjab->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'penjab berhasil diubah',
            'data' => $penjab
        ]);
    }

    public function delete_penjab($id)
    {
        $penjab = Penjab::findOrFail($id);
        $penjab->delete();
        return response()->json([
            'success' => true,
            'message' => 'Penjab berhasil dihapus',
            'data' => $penjab
        ]);
    }

    public function get_penjabId($id)
    {
        $penjab = DB::table('penjab')
            ->where('id', '=', $id)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditampilkan',
            'data' => $penjab
        ]);
    }

    //========== POSISI ===========

    public function posisi()
    {
        $posisi = DB::table('posisi')->get();
        return response()->json([
            'data' => $posisi
        ]);
    }

    public function tambah_posisi(Request $request)
    {
        $validate = $request->validate([
            'nama_posisi' => 'required',
        ]);

        $posisi = DB::table('posisi')->insert([

            'nama_posisi' => $request->nama_posisi,
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Posisi berhasil ditambah',
            'data' => $posisi
        ], Response::HTTP_OK);
    }

    public function update_posisi(Request $request, $id)
    {
        $posisi = Posisi::findOrFail($id);
        $posisi->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'posisi berhasil diubah',
            'data' => $posisi
        ]);
    }

    public function delete_posisi($id)
    {
        $posisi = Posisi::findOrFail($id);
        $posisi->delete();
        return response()->json([
            'success' => true,
            'message' => 'posisi berhasil dihapus',
            'data' => $posisi
        ]);
    }

    public function get_posisiId($id)
    {
        $posisi = DB::table('posisi')
            ->where('id', '=', $id)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditampilkan',
            'data' => $posisi
        ]);
    }

    //========== PENGGAJIAN ===========

    public function penggajian($id)
    {
        $penggajian = DB::table('penggajian')
            ->join('users', 'users.id', '=', 'penggajian.id_users')
            ->where('penggajian.id_users', '=', $id)
            ->select(
                'penggajian.id',
                'penggajian.bulan',
                'penggajian.gapok',
                'penggajian.makan_transport',
                'penggajian.lembur',
                'penggajian.tunjangan',
                'penggajian.insentiv',
                'penggajian.pinjaman',
                'penggajian.jamkes',
                'users.name',
                'penggajian.total'
            )
            ->get();
        return response()->json([
            'data' => $penggajian
        ]);
    }

    //========== ROLE ===========

    public function role()
    {
        $role = DB::table('role')->get();
        return response()->json([
            'data' => $role
        ]);
    }

    public function tambah_role(Request $request)
    {
        $validate = $request->validate([
            'role' => 'required',
        ]);

        $role = DB::table('role')->insert([

            'role' => $request->role,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Role berhasil disimpan',
            'data' => $role
        ], Response::HTTP_OK);
    }

    public function update_role(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Role berhasil diubah',
            'data' => $role
        ]);
    }

    public function delete_role($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json([
            'success' => true,
            'message' => 'Role berhasil dihapus',
            'data' => $role
        ]);
    }

    public function get_roleId($id)
    {
        $role = DB::table('role')
            ->where('id', '=', $id)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditampilkan',
            'data' => $role
        ]);
    }

    public function karyawan()
    {
        $data = DB::table('users')
                ->join('role', 'role.id', '=', 'users.role_id')
                ->join('posisi', 'posisi.id', '=', 'users.posisi_id')
                ->select('users.id','users.name','users.email','users.tempat_lahir','users.tgl_lahir','users.no_identitas',
                        'users.status','users.no_tlp','users.domisili','role.role','posisi.nama_posisi')
                ->where('users.role_id','=','2')
                ->get();

            return response()->json([
                'data' => $data
            ]);
    }

    public function tambah_karyawan(Request $request)
    {
        $validate = $request->validate([
            'name'=> 'required',
            'email'=> 'required|string|email|max:255|unique:users',
            'no_identitas'=> 'required',
            'tempat_lahir'=> 'required',
            'tgl_lahir'=> 'required',
            'no_rek'=> 'required',
            'posisi_id'=> 'required',
            'no_tlp'=> 'required',
            ], [
                'email.unique' => 'email sudah digunakan',
        ]);

        $karyawan = DB::table('users')->insert([

            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt('12345678'),
            'no_identitas'=> $request->no_identitas,
            'tempat_lahir'=> $request->tempat_lahir,
            'tgl_lahir'=> $request->tgl_lahir,
            'no_rek'=> $request->no_rek,
            'role_id'=> 2,
            'posisi_id'=> $request->posisi_id,
            'status'=> $request->status,
            'domisili'=> $request->domisili,
            'no_tlp'=> $request->no_tlp,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Karyawan berhasil ditambah',
            'data' => $karyawan
        ], Response::HTTP_OK);
    }

    public function update_karyawan(Request $request, $id)
    {
        $karyawan = User::findOrFail($id);
        $karyawan->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diubah',
            'data' => $karyawan
        ]);
    }

    public function delete_karyawan($id)
    {
        $karyawan = User::findOrFail($id);
        $karyawan->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus',
            'data' => $karyawan
        ]);
    }

    public function get_karyawan_id($id)
    {
        $karyawan = DB::table('users')
        ->where('id', '=', $id)
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditampilkan',
            'data' => $karyawan
        ]);
    }

    public function jenis_pengeluaran()
    {
        $jenis_pengeluaran = DB::table('jenis_pengeluaran')->get();
        return response()->json([
            'data' => $jenis_pengeluaran
        ]);
    }

    public function jenis_pengeluaran_by_id($id)
    {
        $jenis_pengeluaran = DB::table('jenis_pengeluaran')
            ->where('id', '=', $id)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditampilkan',
            'data' => $jenis_pengeluaran
        ]);
    }
    
}
