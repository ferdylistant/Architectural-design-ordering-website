<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\PembayaranModel;
use App\Models\PerusahaanModel;
use App\Controllers\BaseController;

class LaporanController extends BaseController
{
    public function __construct()
    {
        $this->pay = new PembayaranModel();
        $this->order = new OrderModel();
        $this->tentang = new PerusahaanModel();
    }
    public function index()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        if (isset($_GET['filter']) && ! empty($_GET['filter'])) { // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user
            if ($filter == '1') { // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];
                $tgl_indo = date('y-m-d', strtotime($tgl));
                $ket = 'Data Transaksi Tanggal '.format_hari_tanggal($tgl_indo);
                $url_cetak = 'print?filter=1&tahun='.$tgl;
                $transaksi = $this->order->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di sistem_model
            } elseif ($filter == '2') { // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                $ket = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $url_cetak = 'print?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $transaksi = $this->order->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di sistem_model
            } else { // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                $ket = 'Data Transaksi Tahun '.$tahun;
                $url_cetak = 'print?filter=3&tahun='.$tahun;
                $transaksi = $this->order->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di sistem_model
            }
        } else { // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Transaksi';
            $url_cetak = 'print';
            $transaksi = $this->order->view_all(); // Panggil fungsi view_all yang ada di sistem_model
        }
        $data['ket'] = $ket;
        $data['url_cetak'] = base_url('/sold-report/'.$url_cetak);
        $data['transaksi'] = $transaksi;
        $data['option_tahun'] = $this->order->option_tahun();
        $data['title'] 	= 'Laporan';
        return view('laporan/index', $data);
    }
    public function cetak()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        if (isset($_GET['filter']) && ! empty($_GET['filter'])) { // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user
            if ($filter == '1') { // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];
                $ket = 'Data Transaksi Tanggal '.format_hari_tanggal('d-m-y', strtotime($tgl));
                $transaksi = $this->order->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di sistem_model
            } elseif ($filter == '2') { // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                $ket = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $transaksi = $this->order->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di sistem_model
            } else { // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                $ket = 'Data Transaksi Tahun '.$tahun;
                $transaksi = $this->order->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di sistem_model
            }
        } else { // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Transaksi';
            $transaksi = $this->order->view_all(); // Panggil fungsi view_all yang ada di sistem_model
        }
        $data['ket'] = $ket;
        $data['transaksi'] = $transaksi;
        $data['tentang'] = $this->tentang->getCompany();
        return view('print_laporan/print', $data);
    }
    public function backup_db()
    {

        // Load the DB utility class
        $this->load->dbutil();

        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup();

        // Load the file helper and write the file to your server
        $this->load->helper('file');
        write_file('database/backup/', $backup);

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download('kampungjawa.sql', $backup);
    }
    public function download_pdf_transaksi($id)
    {
        $url = $this->sistem_model->Pembayaran($id);
        foreach ($url->result_array() as $value) {
            $data = $value['pdf_url'];
        }

        // Set header content type.
        header('Content-Type', 'application/pdf');
        header('Content-Transfer-Encoding', 'binary');
        header('Content-Length: '. filesize($data), '');
        $this->load->helper('download');
        force_download('cara-pembayaran.pdf', $data);
    }
}
