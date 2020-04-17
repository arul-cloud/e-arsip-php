<?php

class ConvertHtmlToPdf {
    
    protected $pages = "";
    protected $options = "";
    protected $wkhtmltopdfpath = "";
    protected $tempPdf ="";
    
    public function __construct($form) {
        
        $this->wkhtmltopdfpath = $_SERVER['StaticPath']."3rdparty/wkhtmltopdf/bin/wkhtmltopdf.exe";

        switch($form) {
            case "spjk":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/kwitansi_spjk.pdf";
                break;
			case "kwitansi":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/kwitansi.pdf";
                break;
            case "penjelasan":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/penjelasan.pdf";
                break;
            case "bl14":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/laporan_bl14.pdf";
                break;
            case "bl02":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/laporan_bl02.pdf";
                break;
            case "bl05":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/laporan_bl05.pdf";
                break;
            case "harian":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/laporan_harian.pdf";
                break;
            case "harian2":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/laporan_harian2.pdf";
                break;
            case "harian3":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/harian_pengujian.pdf";
                break;              
            case "harian4":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/harian_stiker.pdf";
                break;              
            case "harian5":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/rekap_harian.pdf";
                break;
            case "harian6":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/laporan_harian6.pdf";
                break;                          
            case "stiker":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/stiker.pdf";
                break;
            case "halaman1":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/buku_uji/halaman1.pdf";
                break;
            case "halaman23":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/buku_uji/halaman23.pdf";
                break;
            case "halaman45":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/buku_uji/halaman45.pdf";
                break;
            case "halaman6":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/buku_uji/halaman6.pdf";
                break;
            case "halaman7":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/buku_uji/halaman7.pdf";
                break;
            case "halaman10":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/buku_uji/halaman10.pdf";
                break;
            case "halamanbarcode":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/buku_uji/halamanbarcode.pdf";
                break;
            case "keterangan_uji":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/surat/keterangan_uji.pdf";
                break;
            case "keterangan_kendaraan":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/surat/keterangan_kendaraan.pdf";
                break;
            case "izin":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/surat/izin.pdf";
                break;
            case "pengantar":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/surat/pengantar.pdf";
                break;
            case "LaporanRekap":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/laporanRekap.pdf";
                break;
            case "LaporanKeuangan":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/laporanKeuangan.pdf";
                break;
            case "datakendali_hal1":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/datakendali_hal2.pdf";
                break;
            case "datakendali_hal2":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/datakendali_hal1.pdf";
                break;
            case "BukuUji":
                $this->tempPdf = $_SERVER['StaticPath']."hasil_cetak/bukuUji.pdf";
                break;
        }
    }
    
    public function exec($form) {
        switch($form) {
            case "kwitansi":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/kwitansi.pdf");
                break;
			case "spjk":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/kwitansi_spjk.pdf");
                break;
            case "penjelasan":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/penjelasan.pdf");
                break;
            case "bl14":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/laporan_bl14.pdf");
                break;
            case "bl02":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/laporan_bl02.pdf");
                break;
            case "bl05":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/laporan_bl05.pdf");
                break;
            case "harian":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/laporan_harian.pdf");
                break;
            case "harian2":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/laporan_harian2.pdf");
                break;
            case "harian3":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/harian_pengujian.pdf");
                break;              
            case "harian4":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/harian_stiker.pdf");
                break;              
            case "harian5":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/rekap_harian.pdf");
                break;              
            case "harian6":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/laporan_harian6.pdf");
                break;				
            case "stiker":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/stiker.pdf");
                break;
            case "halaman1":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/buku_uji/halaman1.pdf");
                break;
            case "halaman23":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/buku_uji/halaman23.pdf");
                break;
            case "halaman45":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/buku_uji/halaman45.pdf");
                break;
            case "halaman6":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/buku_uji/halaman6.pdf");
                break;
            case "halaman7":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/buku_uji/halaman7.pdf");
                break;
            case "halaman10":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/buku_uji/halaman10.pdf");
                break;
            case "halamanbarcode":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/buku_uji/halamanbarcode.pdf");
                break;
            case "keterangan_uji":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/surat/keterangan_uji.pdf");
                break;
            case "keterangan_kendaraan":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/surat/keterangan_kendaraan.pdf");
                break;
            case "izin":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/surat/izin.pdf");
                break;
            case "pengantar":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/surat/pengantar.pdf");
                break;
            case "LaporanRekap":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/laporanRekap.pdf");
                break;
            case "LaporanKeuangan":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/laporanKeuangan.pdf");
                break;
            case "datakendali_hal1":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/datakendali_hal2.pdf");
                break;
            case "datakendali_hal2":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/datakendali_hal1.pdf");
                break;
            case "BukuUji":
                exec('"'.$this->wkhtmltopdfpath.'" '.$this->options.'  '.$this->pages.'  '.$this->tempPdf.'');
                header("location:".$_SERVER['GlobalPath']."hasil_cetak/bukuUji.pdf");
                break;
        }
    }
    
    public function AddPage($page){
        $this->pages = $this->pages.'"'.$page.'" ';
    }
    
    public function AddOption($option){
        $this->options = $this->options.''.$option.'';
    }
}

?>