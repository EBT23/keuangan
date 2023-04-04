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
use Symfony\Component\HttpFoundation\Response;

class ApiAdminController extends Controller
{

    public function dashboard()
    {
    }
    public function pengeluaran()
    {
        $pengeluaran = DB::table('pengeluaran')->get();
        return response()->json([
            'data' => $pengeluaran
        ]);
    }
    public function tambah_pengeluaran(Request $request)
    {
        $validate = $request->validate([
            'jenis_pengeluaran' => 'required',
            'keterangan' => 'required',
            'total_pengeluaran' => 'required',
            'tgl' => 'required',
        ]);

        $pengeluaran = DB::table('pengeluaran')->insert([
            'jenis_pengeluaran' => $request->jenis_pengeluaran,
            'keterangan' => $request->keterangan,
            'total_pengeluaran' => $request->total_pengeluaran,
            'tgl' => $request->tgl,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengeluaran berhasil disimpan',
            'data' => $pengeluaran
        ], Response::HTTP_OK);
    }
    public function update_pengeluaran(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Pengeluaran berhasil dirubah',
            'data' => $pengeluaran
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
        $pengeluaran = DB::table('pemasukan')->get();
        return response()->json([
            'data' => $pengeluaran
        ]);
    }
    public function tambah_pemasukan(Request $request)
    {
        $validate = $request->validate([
            'jenis_pemasukan' => 'required',
            'keterangan' => 'required',
            'total_pemasukan' => 'required',
            'tgl' => 'required',
        ]);

        $pemasukan = DB::table('pemasukan')->insert([
            'jenis_pemasukan' => $request->jenis_pemasukan,
            'keterangan' => $request->keterangan,
            'total_pemasukan' => $request->total_pemasukan,
            'tgl' => $request->tgl,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pemasukan berhasil disimpan',
            'data' => $pemasukan
        ], Response::HTTP_OK);
    }
    public function update_pemasukan(Request $request, $id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'pemasukan berhasil dirubah',
            'data' => $pemasukan
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

        $distributor = DB::table('distributor')
            ->join('penjab', 'penjab.id', '=', 'distributor.penjab_id')
            ->select('distributor.id', 'distributor.nama_distributor', 'penjab.nama_penjab', 'distributor.tlp', 'distributor.area_cover', 'distributor.alamat')
            ->get();
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
            'penjab_id' => 'required',
        ]);

        $distributor = DB::table('distributor')->insert([

            'nama_distributor' => $request->nama_distributor,
            'tlp' => $request->tlp,
            'area_cover' => $request->area_cover,
            'alamat' => $request->alamat,
            'penjab_id' => $request->penjab_id,
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

    public function penggajian()
    {
        $penggajian = DB::table('penggajian')
            ->join('users', 'users.id', '=', 'penggajian.user_id')
            ->select(
                'penggajian.id',
                'penggajian.bulan',
                'penggajian.hari_kerja',
                'penggajian.gapok',
                'penggajian.makan_transport',
                'penggajian.lembur',
                'penggajian.tunjangan_jabatan',
                'penggajian.insentif',
                'penggajian.pinjaman_karyawan',
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
}
