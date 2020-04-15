<?php

class Library {

	public function konversiTanggal($date) {
		if($date != "0000-00-00" and $date != '0000-00-00 00:00:00' and !is_null($date)) {
			$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 
			$tahun = substr($date, 0, 4);
			$bulan = substr($date, 5, 2);
			$tgl   = substr($date, 8, 2);
		 
			$result = $tgl . "-" . $BulanIndo[(int)$bulan-1] . "-". $tahun;
			return $result;
		} else {
			return "-";
		}
	}

	public function konversiTanggalSingkat($date) {
		if($date != "0000-00-00" and $date != '0000-00-00 00:00:00' and !is_null($date)) {
			$BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agst", "Sep", "Okt", "Nov", "Des");
	 
			$tahun = substr($date, 0, 4);
			$bulan = substr($date, 5, 2);
			$tgl   = substr($date, 8, 2);
		 
			$result = $tgl . "-" . $BulanIndo[(int)$bulan-1] . "-". $tahun;
			return $result;
		} else {
			return "-";
		}
	}

	public function konversiTglKwitansi($date)
	{
		$tahun = substr($date, 0, 4);
		$bulan = substr($date, 5, 2);
		$tgl   = substr($date, 8, 2);
		return $tgl."-".$bulan."-".$tahun;
	}

	public function konversiTanggalLaporanHarian($date) {
		if($date != "0000-00-00" and $date != '0000-00-00 00:00:00' and !is_null($date)) {

			$tahun = substr($date, 0, 4);
			$bulan = substr($date, 5, 2);
			$tgl   = substr($date, 8, 2);
		 
			$result = $tgl . "-" . $bulan . "-". $tahun;
			return $result;
		} else {
			return "-";
		}
	}

	public function konversiTanggal_buku($date) {
		if($date != "0000-00-00") {
			$BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
	 
			$tahun = substr($date, 0, 4);
			$bulan = substr($date, 5, 2);
			$tgl   = substr($date, 8, 2);
		 
			$result = $tgl. "-".$BulanIndo[(int)$bulan-1]."-".$tahun;		
			return $result;
		} else {
			return "Invalid date!";
		}
	}

	public function konversiBilangan($angka) {
		if($angka == 0)
		{
			return "";
		}
		else
		{
			$angka = number_format($angka, 0, ",", ".");
			return $angka;
		}
	}

	public function getBulanDalamIndonesia($bulan) {
		switch($bulan) {
			case "January":
				return "Januari";
				break;
			case "February":
				return "Februari";
				break;
			case "March":
				return "Maret";
				break;
			case "April":
				return "April";
				break;
			case "May":
				return "Mei";
				break;
			case "June":
				return "Juni";
				break;
			case "July":
				return "Juli";
				break;
			case "August":
				return "Agustus";
				break;
			case "September":
				return "September";
				break;
			case "October":
				return "Oktober";
				break;
			case "November":
				return "Nopember";
				break;
			case "December":
				return "Desember";
				break;
		}
	}
        
        public static function Today(){
            return gmdate("Y-m-d", time()+60*60*7);
        }

}

?>