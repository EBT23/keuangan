<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;




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
        // dd(request()->user()->name);
        $StartDate = $request->StartDate ? "$request->StartDate" : "";
        $EndDate = $request->EndDate ? "$request->EndDate" : "";
        $query = $StartDate && $EndDate != "" ? "and tgl BETWEEN '$StartDate' AND '$EndDate'" : "";
        $offer_customer_data = DB::select("select p.*, d.nama_distributor from pemasukan p left join distributor d on d.id=p.distributor_id where 1=1 $query");
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->mergeCells('A1:D1');
        $sheet->getStyle('A1')->getAlignment()->applyFromArray(
            array('horizontal' => Alignment::HORIZONTAL_CENTER,)
        );
        $sheet->mergeCells('A2:D2');
        $sheet->getStyle('A2')->getAlignment()->applyFromArray(
            array('horizontal' => Alignment::HORIZONTAL_CENTER,)
        );
        foreach (range('A1', 'D1') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }
        $spreadsheet->getActiveSheet()->getStyle('A3:D3')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('d5d5d5');
        $sheet->setCellValue(
            'A1',
            'PT.PANORAMA VARIA CITRA'
        );
        $sheet->setCellValue(
            'A2',
            ' PEMASUKAN PADA TANGGAL ' . $request->StartDate . ' SAMPAI ' . $request->EndDate . ''
        );

        $sheet->setCellValue('A3', 'Distributor');
        $sheet->setCellValue('B3', 'Keterangan');
        $sheet->setCellValue('C3', 'Tanggal');
        $sheet->setCellValue('D3', 'Total Pemasukan');
        $rows = 4;
        // dd($offer_customer_data);
        foreach ($offer_customer_data as $empDetails) {
            $sheet->setCellValue('A' . $rows, $empDetails->nama_distributor);
            $sheet->setCellValue('B' . $rows, $empDetails->keterangan);
            $sheet->setCellValue('C' . $rows, $empDetails->tgl);
            $sheet->setCellValue('D' . $rows, $empDetails->total_pemasukan);
            $rows++;
        }

        $fileName = "" . request()->user()->name . " Laporan Pemasukan Tgl $request->StartDate - $request->EndDate";

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
        $sheet->mergeCells('A1:D1');
        $sheet->getStyle('A1')->getAlignment()->applyFromArray(
            array('horizontal' => Alignment::HORIZONTAL_CENTER,)
        );
        $sheet->mergeCells('A2:D2');
        $sheet->getStyle('A2')->getAlignment()->applyFromArray(
            array('horizontal' => Alignment::HORIZONTAL_CENTER,)
        );
        foreach (range('A1', 'D1') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }
        $spreadsheet->getActiveSheet()->getStyle('A3:D3')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('d5d5d5');
        $sheet->setCellValue(
            'A1',
            'PT.PANORAMA VARIA CITRA'
        );
        $sheet->setCellValue('A2', 'PENGELUARAN PADA TANGGAL ' . $request->StartDate . ' SAMPAI ' . $request->EndDate . '');
        $sheet->setCellValue('A3', 'Jenis Pengeluaran');
        $sheet->setCellValue('B3', 'Keterangan');
        $sheet->setCellValue('C3', 'Tanggal');
        $sheet->setCellValue('D3', 'Total Pengeluaran');
        $rows = 4;
        // dd($offer_customer_data);
        foreach ($offer_customer_data as $empDetails) {
            $sheet->setCellValue('A' . $rows, $empDetails->jenis_pengeluaran);
            $sheet->setCellValue('B' . $rows, $empDetails->keterangan);
            $sheet->setCellValue('C' . $rows, $empDetails->tgl);
            $sheet->setCellValue('D' . $rows, $empDetails->total_pengeluaran);
            $rows++;
        }

        $fileName = "" . request()->user()->name . " Laporan Pengeluaran Tgl $request->StartDate - $request->EndDate";

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
    public function exportPemasukanById($id)
    {
        $offer_customer_data = DB::select("select p.*, d.nama_distributor from pemasukan p left join distributor d on d.id=p.distributor_id where p.id = '$id'");
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->mergeCells('A1:D1');
        $sheet->getStyle('A1')->getAlignment()->applyFromArray(
            array('horizontal' => Alignment::HORIZONTAL_CENTER,)
        );
        $sheet->mergeCells('A2:D2');
        $sheet->getStyle('A2')->getAlignment()->applyFromArray(
            array('horizontal' => Alignment::HORIZONTAL_CENTER,)
        );
        foreach (range('A1', 'D1') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }
        $spreadsheet->getActiveSheet()->getStyle('A3:D3')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('d5d5d5');
        $sheet->setCellValue(
            'A1',
            'PT.PANORAMA VARIA CITRA'
        );
        $sheet->setCellValue('A2', 'PEMASUKAN BY ID ' . $id . '');

        $sheet->setCellValue('A3', 'Distributor');
        $sheet->setCellValue('B3', 'Keterangan');
        $sheet->setCellValue('C3', 'Tanggal');
        $sheet->setCellValue('D3', 'Total Pemasukan');
        $spreadsheet->getActiveSheet()->getRowDimension(1)->setRowHeight(-1);
        $rows = 4;
        // dd($offer_customer_data);
        foreach ($offer_customer_data as $empDetails) {
            $sheet->setCellValue('A' . $rows, $empDetails->nama_distributor);
            $sheet->setCellValue('B' . $rows, $empDetails->keterangan);
            $sheet->setCellValue('C' . $rows, $empDetails->tgl);
            $sheet->setCellValue('D' . $rows, $empDetails->total_pemasukan);
            $rows++;
        }

        $fileName = "" . request()->user()->name . " Laporan By ID $id";

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

        $sheet->mergeCells('A1:D1');
        $sheet->getStyle('A1')->getAlignment()->applyFromArray(
            array('horizontal' => Alignment::HORIZONTAL_CENTER,)
        );
        $sheet->mergeCells('A2:D2');
        $sheet->getStyle('A2')->getAlignment()->applyFromArray(
            array('horizontal' => Alignment::HORIZONTAL_CENTER,)
        );
        foreach (range('A1', 'D1') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }
        $spreadsheet->getActiveSheet()->getStyle('A3:D3')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('d5d5d5');
        $sheet->setCellValue(
            'A1',
            'PT.PANORAMA VARIA CITRA'
        );
        $sheet->setCellValue('A2', 'PENGELUARAN BY ID ' . $id . '');
        $sheet->setCellValue('A3', 'Jenis Pengeluaran');
        $sheet->setCellValue('B3', 'Keterangan');
        $sheet->setCellValue('C3', 'Tanggal');
        $sheet->setCellValue('D3', 'Total Pengeluaran');
        $rows = 4;
        // dd($offer_customer_data);
        foreach ($offer_customer_data as $empDetails) {
            $sheet->setCellValue('A' . $rows, $empDetails->jenis_pengeluaran);
            $sheet->setCellValue('B' . $rows, $empDetails->keterangan);
            $sheet->setCellValue('C' . $rows, $empDetails->tgl);
            $sheet->setCellValue('D' . $rows, $empDetails->total_pengeluaran);
            $rows++;
        }

        $fileName = "" . request()->user()->name . " Laporan By ID $id";

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '.xlsx"');
        $writer->save("php://output");
    }

    public function gaji()
    {
        $data['title'] = 'Laporan Gaji';
        $data['bln'] = "";
        $gaji =
            DB::select("select p.*, u.name from penggajian p left join users u on u.id=p.id_users");
        $bulan =
            DB::select("select p.*, u.name from penggajian p left join users u on u.id=p.id_users group by bulan");

        return view('laporanGaji', ['gaji' => $gaji, 'bulan' => $bulan], $data);
    }

    public function gajiSearch(Request $request)
    {
        $d['title'] = 'Laporan Gaji';

        $bulan = $request->bulan ? "$request->bulan" : "";
        $query = $bulan != "" ? "and p.bulan like '%$bulan%'" : "";
        // dd($bulan);
        $d['bln'] = $bulan;
        $d['bulan'] =
            DB::select("select p.*, u.name from penggajian p left join users u on u.id=p.id_users group by bulan");
        $d['gaji'] = DB::select("select p.*, u.name from penggajian p left join users u on u.id=p.id_users where 1=1 $query");
        // dd($d['gaji']);
        // $request->session()->put('date_start', $request->all());
        return view('laporanGaji', $d);
    }
    public function exportgaji(Request $request)
    {
        // dd($request->all());
        $offer_customer_data = DB::select("select p.*, u.name from penggajian p left join users u on u.id=p.id_users where p.bulan = '$request->bulan'");
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1')->getAlignment()->applyFromArray(
            array('horizontal' => Alignment::HORIZONTAL_CENTER,)
        );
        $sheet->mergeCells('A2:J2');
        $sheet->getStyle('A2')->getAlignment()->applyFromArray(
            array('horizontal' => Alignment::HORIZONTAL_CENTER,)
        );
        foreach (range('A1', 'J1') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }
        $spreadsheet->getActiveSheet()->getStyle('A3:J3')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('d5d5d5');
        $sheet->setCellValue(
            'A1',
            'PT.PANORAMA VARIA CITRA'
        );
        $sheet->setCellValue('A2', 'GAJI PADA BULAN ' . $request->bulan . '');
        $sheet->setCellValue('A3', 'Nama');
        $sheet->setCellValue('B3', 'Bulan');
        $sheet->setCellValue('C3', 'Gapok');
        $sheet->setCellValue('D3', 'Makan & Transport');
        $sheet->setCellValue('E3', 'lembur');
        $sheet->setCellValue('F3', 'Tunjangan');
        $sheet->setCellValue('G3', 'Insentiv');
        $sheet->setCellValue('H3', 'Pinjaman');
        $sheet->setCellValue('I3', 'Jamkes');
        $sheet->setCellValue('J3', 'Total');
        $rows = 4;
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
        $fileName = "" . request()->user()->name . " Laporan Penggajian Tahun&Bulan $request->bulan";

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
        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1')->getAlignment()->applyFromArray(
            array('horizontal' => Alignment::HORIZONTAL_CENTER,)
        );
        $sheet->mergeCells('A2:J2');
        $sheet->getStyle('A2')->getAlignment()->applyFromArray(
            array('horizontal' => Alignment::HORIZONTAL_CENTER,)
        );
        foreach (range('A1', 'J1') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }
        $spreadsheet->getActiveSheet()->getStyle('A3:J3')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('d5d5d5');
        $sheet->setCellValue(
            'A1',
            'PT.PANORAMA VARIA CITRA'
        );
        $sheet->setCellValue('A2', 'GAJI BY ID ' . $id . '');
        $sheet->setCellValue('A3', 'Id');
        $sheet->setCellValue('B3', 'Bulan');
        $sheet->setCellValue('C3', 'Gapok');
        $sheet->setCellValue('D3', 'Makan & Transport');
        $sheet->setCellValue('E3', 'lembur');
        $sheet->setCellValue('F3', 'Tunjangan');
        $sheet->setCellValue('G3', 'Insentiv');
        $sheet->setCellValue('H3', 'Pinjaman');
        $sheet->setCellValue('I3', 'Jamkes');
        $sheet->setCellValue('J3', 'Total');
        $rows = 4;
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
        $fileName = "" . request()->user()->name . " Laporan Penggajian ID " . $id . "";

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
    public function gajiName()
    {
        $data['title'] = 'Laporan Gaji';
        $gaji =
            DB::select("select p.*, u.name from penggajian p left join users u on u.id=p.id_users where u.name = '" . request()->user()->name . "'");

        return view('laporanGajiByName', ['gaji' => $gaji], $data);
    }
}
