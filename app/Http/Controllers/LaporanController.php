<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanController extends Controller
{
    public function pemasukan()
    {
        $data['title'] = 'Laporan Pemasukan';
        $data['StartDate'] = "";
        $data['EndDate'] = "";
        $pemasukan =
        DB::select("select p.*, d.nama_distributor from pemasukan p left join distributor d on d.id=p.distributor_id ");

        return view('laporanPemasukan', ['pemasukan' => $pemasukan], $data);
    }
    public function pengeluaran()
    {
        $data['title'] = 'Laporan Pengeluaran';
        $data['StartDate'] = "";
        $data['EndDate'] = "";
        $pengeluaran =
        DB::select("select p.*, jp.jenis_pengeluaran from pengeluaran p left join jenis_pengeluaran jp on jp.id=p.jenis_pengeluaran_id  ");

        return view('laporanPengeluaran', ['pengeluaran' => $pengeluaran], $data);
    }
    public function gaji()
    {
        $data['title'] = 'Laporan Gaji';
        $data['user_id'] = "";
        $data['tahun'] = "";
        $gaji =
            DB::select("select p.*, u.name from penggajian p left join users u on u.id=p.id_users");
        $users = DB::table('users')->where('role_id', 2)->get();

        return view('laporanGaji', ['gaji' => $gaji, 'users' => $users], $data);
    }
    public function pemasukanSearch(Request $request)
    {
        $d['title'] = 'Laporan Pemasukan';

        $StartDate = $request->StartDate ? "$request->StartDate" : "";
        $EndDate = $request->EndDate ? "$request->EndDate" : "";
        $query = $StartDate && $EndDate != "" ? "and tgl BETWEEN '$StartDate' AND '$EndDate'" : "";
        // dd($query);
        $d['StartDate'] = $StartDate;
        $d['EndDate'] = $EndDate;
        $d['pemasukan'] = DB::select("select p.*, d.nama_distributor from pemasukan p left join distributor d on d.id=p.distributor_id where 1=1 $query");
        // dd($d['pemasukan']);
        // $request->session()->put('date_start', $request->all());
        return view('laporanPemasukan', $d);
    }
    public function pengeluaranSearch(Request $request)
    {
        $d['title'] = 'Laporan Pengeluaran';

        $StartDate = $request->StartDate ? "$request->StartDate" : "";
        $EndDate = $request->EndDate ? "$request->EndDate" : "";
        $query = $StartDate && $EndDate != "" ? "and tgl BETWEEN '$StartDate' AND '$EndDate'" : "";
        // dd($query);
        $d['StartDate'] = $StartDate;
        $d['EndDate'] = $EndDate;
        $d['pengeluaran'] = DB::select("select p.*, jp.jenis_pengeluaran from pengeluaran p left join jenis_pengeluaran jp on jp.id=p.jenis_pengeluaran_id  where 1=1 $query");
        // dd($d['pemasukan']);
        // $request->session()->put('date_start', $request->all());
        return view('laporanPengeluaran', $d);
    }

    public function exportPemasukan(Request $request)
    {
        // dd($request->StartDate);
        $StartDate = $request->StartDate ? "$request->StartDate" : "";
        $EndDate = $request->EndDate ? "$request->EndDate" : "";
        $query = $StartDate && $EndDate != "" ? "and tgl BETWEEN '$StartDate' AND '$EndDate'" : "";
        $offer_customer_data = DB::select("select p.*, d.nama_distributor from pemasukan p left join distributor d on d.id=p.distributor_id where 1=1 $query");
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Distributor');
        $sheet->setCellValue('B1', 'Keterangan');
        $sheet->setCellValue('C1', 'Tanggal');
        $sheet->setCellValue('D1', 'Nilai');
        $rows = 2;
        // dd($offer_customer_data);
        foreach ($offer_customer_data as $empDetails) {
            $sheet->setCellValue('A' . $rows, $empDetails->nama_distributor);
            $sheet->setCellValue('B' . $rows, $empDetails->keterangan);
            $sheet->setCellValue('C' . $rows, $empDetails->tgl);
            $sheet->setCellValue('D' . $rows, $empDetails->total_pemasukan);
            $rows++;
        }

        $fileName = "Laporan Pemasukan Tgl $request->StartDate - $request->EndDate";

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
    public function exportPengeluaran(Request $request)
    {
        // dd($request->StartDate);
        $StartDate = $request->StartDate ? "$request->StartDate" : "";
        $EndDate = $request->EndDate ? "$request->EndDate" : "";
        $query = $StartDate && $EndDate != "" ? "and tgl BETWEEN '$StartDate' AND '$EndDate'" : "";
        $offer_customer_data = DB::select("select p.*, jp.jenis_pengeluaran from pengeluaran p left join jenis_pengeluaran jp on jp.id=p.jenis_pengeluaran_id where 1=1 $query");
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Jenis Pengeluaran');
        $sheet->setCellValue('B1', 'Keterangan');
        $sheet->setCellValue('C1', 'Tanggal');
        $sheet->setCellValue('D1', 'Nilai');
        $rows = 2;
        // dd($offer_customer_data);
        foreach ($offer_customer_data as $empDetails) {
            $sheet->setCellValue('A' . $rows, $empDetails->jenis_pengeluaran);
            $sheet->setCellValue('B' . $rows, $empDetails->keterangan);
            $sheet->setCellValue('C' . $rows, $empDetails->tgl);
            $sheet->setCellValue('D' . $rows, $empDetails->total_pengeluaran);
            $rows++;
        }

        $fileName = "Laporan Pengeluaran Tgl $request->StartDate - $request->EndDate";

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
    public function exportPemasukanById($id)
    {
        $offer_customer_data = DB::select("select p.*, d.nama_distributor from pemasukan p left join distributor d on d.id=p.distributor_id where id = '$id'");
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Distributor');
        $sheet->setCellValue('B1', 'Keterangan');
        $sheet->setCellValue('C1', 'Tanggal');
        $sheet->setCellValue('D1', 'Nilai');
        $rows = 2;
        // dd($offer_customer_data);
        foreach ($offer_customer_data as $empDetails) {
            $sheet->setCellValue('A' . $rows, $empDetails->nama_distributor);
            $sheet->setCellValue('B' . $rows, $empDetails->keterangan);
            $sheet->setCellValue('C' . $rows, $empDetails->tgl);
            $sheet->setCellValue('D' . $rows, $empDetails->total_pemasukan);
            $rows++;
        }

        $fileName = "Laporan By ID $id";

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '.xlsx"');
        $writer->save("php://output");
    }
    public function exportpengeluaranById($id)
    {
        $offer_customer_data = DB::select("select p.*, jp.jenis_pengeluaran from pengeluaran p left join jenis_pengeluaran jp on jp.id=p.jenis_pengeluaran_id where p.id = '$id'");
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Jenis Pengeluaran');
        $sheet->setCellValue('B1', 'Keterangan');
        $sheet->setCellValue('C1', 'Tanggal');
        $sheet->setCellValue('D1', 'Nilai');
        $rows = 2;
        // dd($offer_customer_data);
        foreach ($offer_customer_data as $empDetails) {
            $sheet->setCellValue('A' . $rows, $empDetails->jenis_pengeluaran);
            $sheet->setCellValue('B' . $rows, $empDetails->keterangan);
            $sheet->setCellValue('C' . $rows, $empDetails->tgl);
            $sheet->setCellValue('D' . $rows, $empDetails->total_pengeluaran);
            $rows++;
        }

        $fileName = "Laporan By ID $id";

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '.xlsx"');
        $writer->save("php://output");
    }

    public function gajiSearch(Request $request)
    {
        $d['title'] = 'Laporan Gaji';

        $user_id = $request->user_id ? "$request->user_id" : "";
        $tahun = $request->tahun ? "$request->tahun" : "";
        $query = $user_id && $tahun != "" ? "and p.id_users like '%$user_id%' AND  substr(p.bulan like '%$tahun%',1,4)" : "";
        // dd($tahun);
        $d['user_id'] = $user_id;
        $d['tahun'] = $tahun;
        $d['users'] = DB::table('users')->where('role_id', 2)->get();
        $d['gaji'] = DB::select("select p.*, u.name from penggajian p left join users u on u.id=p.id_users where 1=1 $query");
        // dd($d['gaji']);
        // $request->session()->put('date_start', $request->all());
        return view('laporanGaji', $d);
    }
    public function exportgaji(Request $request)
    {
        // dd($request->all());
        $offer_customer_data = DB::select("select p.*, u.name from penggajian p left join users u on u.id=p.id_users order by p.id_users asc");
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Bulan');
        $sheet->setCellValue('C1', 'Gapok');
        $sheet->setCellValue('D1', 'Makan & Transport');
        $sheet->setCellValue('E1', 'lembur');
        $sheet->setCellValue('F1', 'Tunjangan');
        $sheet->setCellValue('G1', 'Insentiv');
        $sheet->setCellValue('H1', 'Pinjaman');
        $sheet->setCellValue('I1', 'Jamkes');
        $sheet->setCellValue('J1', 'Total');
        $rows = 2;
        // dd($offer_customer_data);
        foreach ($offer_customer_data as $empDetails) {
            $sheet->setCellValue('A' . $rows, $empDetails->name);
            $sheet->setCellValue('B' . $rows, $empDetails->bulan);
            $sheet->setCellValue('C' . $rows, $empDetails->gapok);
            $sheet->setCellValue('D' . $rows, $empDetails->makan_transport);
            $sheet->setCellValue('E' . $rows, $empDetails->lembur);
            $sheet->setCellValue('F' . $rows, $empDetails->tunjangan);
            $sheet->setCellValue('G' . $rows, $empDetails->insentiv);
            $sheet->setCellValue('H' . $rows, $empDetails->pinjaman);
            $sheet->setCellValue('I' . $rows, $empDetails->jamkes);
            $sheet->setCellValue('J' . $rows, $empDetails->total);
            $rows++;
        }
        $name = DB::table('users')->where('id', "$request->user_id")->first();
        // dd($name);
        $fileName = "Laporan Penggajian Nama " . $name->name . " Tahun $request->tahun";

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter(
            $spreadsheet,
            'Xlsx'
        );
        $writer->save('php://output');
        exit;
    }
    public function exportgajiById($id)
    {
        // dd($request->all());
        $offer_customer_data = DB::select("select p.*, u.name from penggajian p left join users u on u.id=p.id_users where p.id = '$id' order by p.id_users asc");
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Bulan');
        $sheet->setCellValue('C1', 'Gapok');
        $sheet->setCellValue('D1', 'Makan & Transport');
        $sheet->setCellValue('E1', 'lembur');
        $sheet->setCellValue('F1', 'Tunjangan');
        $sheet->setCellValue('G1', 'Insentiv');
        $sheet->setCellValue('H1', 'Pinjaman');
        $sheet->setCellValue('I1', 'Jamkes');
        $sheet->setCellValue('J1', 'Total');
        $rows = 2;
        // dd($offer_customer_data);
        foreach ($offer_customer_data as $empDetails) {
            $sheet->setCellValue('A' . $rows, $empDetails->name);
            $sheet->setCellValue('B' . $rows, $empDetails->bulan);
            $sheet->setCellValue('C' . $rows, $empDetails->gapok);
            $sheet->setCellValue('D' . $rows, $empDetails->makan_transport);
            $sheet->setCellValue('E' . $rows, $empDetails->lembur);
            $sheet->setCellValue('F' . $rows, $empDetails->tunjangan);
            $sheet->setCellValue('G' . $rows, $empDetails->insentiv);
            $sheet->setCellValue('H' . $rows, $empDetails->pinjaman);
            $sheet->setCellValue('I' . $rows, $empDetails->jamkes);
            $sheet->setCellValue('J' . $rows, $empDetails->total);
            $rows++;
        }
        // dd($name);
        $fileName = "Laporan Penggajian ID " . $id . "";

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter(
            $spreadsheet,
            'Xlsx'
        );
        $writer->save('php://output');
        exit;
    }
}
