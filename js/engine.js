function setCariOn() {

}

/*    
    Page 2 functions are here
*/

function getJumlahSumbu() {

    var jbbS1 = parseInt($("#jbbS1").val());
    var jbbS2 = parseInt($("#jbbS2").val());
    var jbbS3 = parseInt($("#jbbS3").val());
    var jbbS4 = parseInt($("#jbbS4").val());
    var jbbS5 = parseInt($("#jbbS5").val());

    var jumlah = jbbS1 + jbbS2 + jbbS3 + jbbS4 + jbbS5;
    $("#jbbJumlah").val(jumlah);
}

function getJBI() {
    var jumlahSumbu = parseInt($("#jbbJumlah").val());
    var barang = parseInt($("#barang").val());
    var orang = parseInt($("#orang").val());
    var jbi = jumlahSumbu + barang + (orang * 50);
    $("#jbi").val(jbi);

}

/*
    End Page 2 Functions
*/

/*
    Page 3 functions are here
*/

function getVolumeTanki() {
    var panjang = parseInt($("#panjang1").val());
    var lebar = parseInt($("#lebar1").val());
    var tinggi = parseInt($("#tinggi1").val());
    var volume = panjang * lebar * tinggi;
    $("#volume1").val(volume);
}

function getVolumeBak() {
    var panjang = parseInt($("#panjang2").val());
    var lebar = parseInt($("#lebar2").val());
    var tinggi = parseInt($("#tinggi2").val());
    var volume = panjang * lebar * tinggi;
    $("#volume2").val(volume);
}

/*
    End Page 3 functions
*/

/*
    Kwitansi Page Functions are Here
*/

function getTotalDenda() {
    var formulir = parseInt($("#hargaFormulir").val());
    var biayaUji = parseInt($("#hargaBiayaUji").val());
    var sampingSemprot = parseInt($("#hargaPlatSampingSemprot").val());
    var stikerKecil = parseInt($("#hargaPlatSampingKecil").val());
    var stikerBesar = parseInt($("#hargaPlatSampingBesar").val());
    var administrasi = parseInt($("#administrasi").val());
    var platUji = parseInt($("#hargaPlatUji").val());
    var bukuUji = parseInt($("#hargaBukuUji").val());
    var dendaUji = parseInt($("#dendaUji").val());
    var dendaDaftar = parseInt($("#dendaDaftar").val());
    var numpangUji = parseInt($("#numpangUji").val());
    var mutasi = parseInt($("#mutasi").val());
    var total = formulir+biayaUji+sampingSemprot+stikerKecil+stikerBesar+administrasi+platUji+bukuUji+dendaUji+dendaDaftar+numpangUji+mutasi;
    $("#totalDenda").val(total);
}

function getRincianHargaByID(key) {

    var jenisKendaraan = key;

    if ((jenisKendaraan == 10) || (jenisKendaraan == 11)) {
        
        $("#panjang2").attr("readonly", "");
        $("#panjang2").val(0);
        $("#lebar2").attr("readonly", "");
        $("#lebar2").val(0);
        $("#tinggi2").attr("readonly", "");
        $("#tinggi2").val(0);
        $("#volume2").val(0);
        $("#panjang1").removeAttr("readonly", "");
        $("#panjang1").val(0);
        $("#lebar1").removeAttr("readonly", "");
        $("#lebar1").val(0);
        $("#tinggi1").removeAttr("readonly", "");
        $("#tinggi1").val(0);
        $("#jumlahMuatan").removeAttr("readonly", "");
        $("#jumlahMuatan").val(0);
        $("#bjMuatan").removeAttr("readonly", "");
        $("#bjMuatan").val(0);
        
    } else if ((jenisKendaraan == 8) || (jenisKendaraan == 9)) {

        $("#panjang1").attr("readonly", "");
        $("#panjang1").val(0);
        $("#lebar1").attr("readonly", "");
        $("#lebar1").val(0);
        $("#tinggi1").attr("readonly", "");
        $("#tinggi1").val(0);
        $("#volume1").val(0);
        $("#panjang2").removeAttr("readonly", "");
        $("#panjang2").val(0);
        $("#lebar2").removeAttr("readonly", "");
        $("#lebar2").val(0);
        $("#tinggi2").removeAttr("readonly", "");
        $("#tinggi2").val(0);
        $("#jumlahMuatan").attr("readonly", "");
        $("#jumlahMuatan").val(0);
        $("#bjMuatan").attr("readonly", "");
        $("#bjMuatan").val(0);

    } else if (jenisKendaraan == 0) {

        $("#panjang2").removeAttr("readonly", "");
        $("#panjang2").val(0);
        $("#lebar2").removeAttr("readonly", "");
        $("#lebar2").val(0);
        $("#tinggi2").removeAttr("readonly", "");
        $("#tinggi2").val(0);
        $("#panjang1").removeAttr("readonly");
        $("#panjang1").val(0);
        $("#lebar1").removeAttr("readonly");
        $("#lebar1").val(0);
        $("#tinggi1").removeAttr("readonly");                                                            
        $("#tinggi1").val(0);
        $("#jumlahMuatan").removeAttr("readonly");
        $("#jumlahMuatan").val(0);
        $("#bjMuatan").removeAttr("readonly");
        $("#bjMuatan").val(0);

    } else {

        $("#panjang1").attr("readonly", "");
        $("#panjang1").val(0);
        $("#lebar1").attr("readonly", "");
        $("#lebar1").val(0);
        $("#tinggi1").attr("readonly", "");
        $("#tinggi1").val(0);
        $("#volume1").val(0);
        $("#panjang2").attr("readonly", "");
        $("#panjang2").val(0);
        $("#lebar2").attr("readonly", "");
        $("#lebar2").val(0);
        $("#tinggi2").attr("readonly", "");
        $("#tinggi2").val(0);
        $("#volume2").val(0);
        $("#jumlahMuatan").attr("readonly", "");
        $("#jumlahMuatan").val(0);
        $("#bjMuatan").attr("readonly", "");
        $("#bjMuatan").val(0);

    }

    $.ajax({
        url: "http://<?php pola("ref","GetRincianHargaJson");?>/"+key,
        dataType: "json",
        success: function(data){
            var harga = [];
            var rincianHarga = [];
            for (var i=0; i<data.length; i++) {
                harga[i] = data[i]["entity_harga"];
                rincianHarga[i] = data[i]["periode_rinc_harga"];
            }                    
            $("#hargaFormulir").val(parseInt(harga[0]));
            $("#hargaBiayaUji").val(parseInt(harga[1]));
            $("#hargaPlatSampingSemprot").val(parseInt(harga[2]));
            $("#hargaPlatSampingKecil").val(parseInt(harga[3]));
            $("#hargaPlatSampingBesar").val(parseInt(harga[4]));
            $("#administrasi").val(parseInt(harga[5]));
            $("#hargaPlatUji").val(parseInt(harga[6]));
            $("#hargaBukuUji").val(parseInt(harga[7]));
            $("#dendaUji").val((parseInt(harga[1])/2));
            $("#rincianHarga").val(rincianHarga[0]);
        }
    })
    getTotalDenda();
}

function GetRincianHarga(idjenisKendaraan){
    $.ajax({
        url: "http://<?php pola("ref","GetRincianHargaJson");?>/1",
        dataType: 'json', 
        success: function(data) 
        {
            for(i=0; i < data.length; i++)
            {
                $("#jsonresult").append(data[i]["entity"]+"<br> ");
            }
        }
    });
}

// function updateKwitansi() {
//     $.ajax({
        
//         var noUji = $("#cariID").val();
//         var noKwi = $("#noKwi").val();
//         var daerahAsal = $("#daerahAsal").val();
//         var statPengujian = $("#statPengujian").val();
//         var tglUji = $("#tglUji").val();
        
//         var dendaDaftar = $("#dendaDaftar").val();
//         var numpangUji = $("#numpangUji").val();
//         var mutasi = $("#mutasi").val();
//         var totalDenda = $("#totalDenda").val();

//         url: "http://<?php pola("ref","ubahDataKwitansi");?>",
//         type: "POST",
//         data: "noUji="+noUji+"&noKwi="+noKwi+"&daerahAsal="+daerahAsal+"&statPengujian="+statPengujian+"&dendaDaftar="+dendaDaftar+"&numpangUji="+numpangUji+"&mutasi="+mutasi+"&totalDenda="+totalDenda+"&tglUji="+tglUji,
//         dataType: 'json',
//         success: function(data) {
//             if(data == 1) {

//             }
//         }
//     });
// }

function refreshFormulirPage() {
    $.ajax({
        url: "http://<?php pola("ref","insertKwitansi");?>",
        type: "POST",
        data: "noUji="+noUji+"&tglKwi="+tglKwi+"&tglUji="+tglUji+"&tglAkhirUji="+tglAkhirUji+"&noKwi="+noKwi+"&daerahAsal="+daerahAsal+"&statPengujian="+statPengujian+"&statData="+statData+"&numpangUji="+numpangUji+"&mutasi="+mutasi+"&totalDenda="+totalDenda+"&dendaUji="+dendaUji+"&dendaDaftar="+dendaDaftar+"&idJenis="+idJenis+"&idSifat="+idSifat+"&idPengujian="+idPengujian+"&updatedBy="+updatedBy,
        dataType: "html",
        success: function(data) {
            
        }
    });        
}

function tambahDataKwitansi() {

    var noUji = $("#noUji").val();
    var tglKwi = $("#tglKwi").val();
    var tglUji = $("#tglUji").val();
    var tglAkhirUji = $("#tglAkhirUji").val();
    var noKwi = $("#noKwi").val();
    var daerahAsal = $("#daerahAsal").val();
    var statPengujian = $("#statPengujian").val();
    var statData = $("#status").val();
    var numpangUji = $("#numpangUji").val();
    var mutasi = $("#mutasi").val();
    var totalDenda = $("#totalDenda").val();
    var dendaUji = $("#dendaUji").val();
    var dendaDaftar = $("#dendaDaftar").val();
    var idJenis = $("#jenis").val();
    var idSifat = $("#sifat").val();
    var idPengujian = $("#jenisUji").val();
    var updatedBy = "<?php echo $_SESSION['SES_KIR_nama']; ?>";

    $.ajax({
        url: "http://<?php pola("ref","insertKwitansi");?>",
        type: "POST",
        data: "noUji="+noUji+"&tglKwi="+tglKwi+"&tglUji="+tglUji+"&tglAkhirUji="+tglAkhirUji+"&noKwi="+noKwi+"&daerahAsal="+daerahAsal+"&statPengujian="+statPengujian+"&statData="+statData+"&numpangUji="+numpangUji+"&mutasi="+mutasi+"&totalDenda="+totalDenda+"&dendaUji="+dendaUji+"&dendaDaftar="+dendaDaftar+"&idJenis="+idJenis+"&idSifat="+idSifat+"&idPengujian="+idPengujian+"&updatedBy="+updatedBy,
        dataType: "html",
        success: function(data) {
            alert("Data Kwitansi berhasil ditambah!");
            $("#kwiSimpan").attr("disabled", "");
            $("#kwiCetak").attr("disabled", "");
            $("#kwiBatal").attr("disabled", "");
            $("#tglKwi").val("<?php echo date('Y/m/d'); ?>");
            $("#tglUji").val("<?php echo date('Y/m/d'); ?>");
            $("#tglAkhirUji").val("<?php echo date('Y/m/d'); ?>");
            $("#noKwi").val("");
            $("#daerahAsal").val("");
            $("#statPengujian").val("");
            $("#hargaFormulir").val(0);
            $("#hargaBiayaUji").val(0);
            $("#hargaPlatSampingSemprot").val(0);
            $("#hargaPlatSampingKecil").val(0);
            $("#hargaPlatSampingBesar").val(0);
            $("#administrasi").val(0);
            $("#hargaPlatUji").val(0);
            $("#hargaBukuUji").val(0);
            $("#dendaUji").val(0);
            $("#dendaDaftar").val(0);
            $("#numpangUji").val(0);
            $("#mutasi").val(0);
            $("#totalDenda").val(0);
        }
    });
}

function buatFormBaru() {

    $("#kwiSimpan").removeAttr("disabled", "");
    $("#kwiCetak").removeAttr("disabled", "");
    $("#kwiBatal").removeAttr("disabled", "");

    var totalDenda = $("#totalDenda").val();
    var mutasi = $("#mutasi").val();
    var numpangUji = $("#numpangUji").val();

    if((totalDenda != 0) && (mutasi != 0) && (numpangUji != 0)) {
        $("#tglKwi").val("<?php echo date('Y/m/d'); ?>");
        $("#tglUji").val("<?php echo date('Y/m/d'); ?>");
        $("#tglAkhirUji").val("<?php echo date('Y/m/d'); ?>");
        $("#noKwi").val("");
        $("#daerahAsal").val("");
        $("#statPengujian").val("");
        $("#hargaFormulir").val(0);
        $("#hargaBiayaUji").val(0);
        $("#hargaPlatSampingSemprot").val(0);
        $("#hargaPlatSampingKecil").val(0);
        $("#hargaPlatSampingBesar").val(0);
        $("#administrasi").val(0);
        $("#hargaPlatUji").val(0);
        $("#hargaBukuUji").val(0);
        $("#dendaUji").val(0);
        $("#dendaDaftar").val(0);
        $("#numpangUji").val(0);
        $("#mutasi").val(0);
        $("#totalDenda").val(0);
        getRincianHargaByID("<?php echo $tempJenisKendaraan; ?>");
    } else {
        getRincianHargaByID("<?php echo $tempJenisKendaraan; ?>");
    }
}

function clearFormKwitansi() {
    $("#statPengujian").val("Batal");
}

$(document).ready(function(){
    if($("#noUji").val() == "") {
        $("#penjelasan").attr("style", "visibility: hidden");
    } else {
        $("#penjelasan").attr("style", "visibility: visible");
    }

    var jenisKendaraan = $("#jenis").val();

    if ((jenisKendaraan == 10) || (jenisKendaraan == 11)) {
        
        $("#panjang2").attr("readonly", "");
        $("#panjang2").val(0);
        $("#lebar2").attr("readonly", "");
        $("#lebar2").val(0);
        $("#tinggi2").attr("readonly", "");
        $("#tinggi2").val(0);
        $("#volume2").val(0);
        
    } else if ((jenisKendaraan == 8) || (jenisKendaraan == 9)) {

        $("#panjang1").attr("readonly", "");
        $("#panjang1").val(0);
        $("#lebar1").attr("readonly", "");
        $("#lebar1").val(0);
        $("#tinggi1").attr("readonly", "");
        $("#tinggi1").val(0);
        $("#volume1").val(0);
        $("#jumlahMuatan").attr("readonly", "");
        $("#jumlahMuatan").val(0);
        $("#bjMuatan").attr("readonly", "");
        $("#bjMuatan").val(0);

    } else if (jenisKendaraan == 0) {

        $("#panjang2").removeAttr("readonly", "");
        $("#panjang2").val(0);
        $("#lebar2").removeAttr("readonly", "");
        $("#lebar2").val(0);
        $("#tinggi2").removeAttr("readonly", "");
        $("#tinggi2").val(0);
        $("#panjang1").removeAttr("readonly");
        $("#panjang1").val(0);
        $("#lebar1").removeAttr("readonly");
        $("#lebar1").val(0);
        $("#tinggi1").removeAttr("readonly");                                                            
        $("#tinggi1").val(0);
        $("#jumlahMuatan").removeAttr("readonly");
        $("#jumlahMuatan").val(0);
        $("#bjMuatan").removeAttr("readonly");
        $("#bjMuatan").val(0);

    } else {

        $("#panjang1").attr("readonly", "");
        $("#panjang1").val(0);
        $("#lebar1").attr("readonly", "");
        $("#lebar1").val(0);
        $("#tinggi1").attr("readonly", "");
        $("#tinggi1").val(0);
        $("#volume1").val(0);
        $("#panjang2").attr("readonly", "");
        $("#panjang2").val(0);
        $("#lebar2").attr("readonly", "");
        $("#lebar2").val(0);
        $("#tinggi2").attr("readonly", "");
        $("#tinggi2").val(0);
        $("#volume2").val(0);
        $("#jumlahMuatan").attr("readonly", "");
        $("#jumlahMuatan").val(0);
        $("#bjMuatan").attr("readonly", "");
        $("#bjMuatan").val(0);

    }

});

function cetakKwitansi() {
    window.open("<?php echo $globalPath; ?>print.php?noUji="+$("#noUji").val()+"&tglUji="+$("#tglUji").val()+"&idJenis="+$("#jenis").val()+"&form=kwitansi", "_blank");
}

function cetakPenjelasan() {
    window.open("<?php echo $globalPath; ?>print.php?noUji="+$("#noUji").val()+"&tglUji="+$("#tglUji").val()+"&idJenis="+$("#jenis").val()+"&form=penjelasan", "_blank");
}

function lihatDataKwitansi(noUjiLink, tglUjiLink) {

    $("#kwiSimpan").removeAttr("disabled", "");
    $("#kwiCetak").removeAttr("disabled", "");
    $("#kwiBatal").removeAttr("disabled", "");        

    getRincianHargaByID("<?php echo $tempJenisKendaraan; ?>");
    
    if($("#hargaFormulir").val() != 0) {

        $("#tglKwi").val("<?php echo date('Y/m/d'); ?>");
        $("#tglUji").val("<?php echo date('Y/m/d'); ?>");
        $("#tglAkhirUji").val("<?php echo date('Y/m/d'); ?>");
        $("#noKwi").val("");
        $("#daerahAsal").val("");
        $("#statPengujian").val("");
        $("#hargaFormulir").val(0);
        $("#hargaBiayaUji").val(0);
        $("#hargaPlatSampingSemprot").val(0);
        $("#hargaPlatSampingKecil").val(0);
        $("#hargaPlatSampingBesar").val(0);
        $("#administrasi").val(0);
        $("#hargaPlatUji").val(0);
        $("#hargaBukuUji").val(0);
        $("#dendaUji").val(0);
        $("#dendaDaftar").val(0);
        $("#numpangUji").val(0);
        $("#mutasi").val(0);
        $("#totalDenda").val(0);

        $.ajax({
            url: "http://<?php pola("ref","getDataKwitansiByIdAndTgl");?>",
            type: "POST",
            data: "noUji="+noUjiLink+"&tglUji="+tglUjiLink,
            dataType: 'json',
            success: function(data) {
                $("#tglKwi").val(data[0]);
                $("#tglUji").val(data[1]);
                $("#tglAkhirUji").val(data[2]);
                $("#noKwi").val(data[3]);
                $("#daerahAsal").val(data[5]);
                $("#statPengujian").val(data[6]);
                $("#dendaUji").val(data[7]);
                $("#dendaDaftar").val(data[8]);
                $("#numpangUji").val(data[9]);
                $("#mutasi").val(data[10]);
                $("#totalDenda").val(data[11]);
                $("#tglKwitansi").html(data[0]);
            }
        });


    } else {

        $.ajax({            
            url: "http://<?php pola("ref","getDataKwitansiByIdAndTgl");?>",
            type: "POST",
            data: "noUji="+noUjiLink+"&tglUji="+tglUjiLink,
            dataType: 'json',
            success: function(data) {                    
                $("#tglKwi").val(data[0]);
                $("#tglUji").val(data[1]);
                $("#tglAkhirUji").val(data[2]);
                $("#noKwi").val(data[3]);
                $("#daerahAsal").val(data[5]);
                $("#statPengujian").val(data[6]);
                $("#dendaUji").val(data[7]);
                $("#dendaDaftar").val(data[8]);
                $("#numpangUji").val(data[9]);
                $("#mutasi").val(data[10]);
                $("#totalDenda").val(data[11]);
            }
        });
    }
}

/*
    End Kwitansi Page functions
*/

$(function(){
    $("#jenis").change(function(){
        
    })
})