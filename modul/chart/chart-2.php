 <?php

 ?>
 
  <link rel="stylesheet" type="text/css" href="<?php echo $globalPath; ?>modul/chart/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo $globalPath; ?>modul/chart/bootstrap-theme.min.css" />

	<script type="text/javascript">
	function(){this.exportChart({type:"image/jpeg"})}}
	</script>
  

  <div class="highcharts-container" id="example-2"></div>

  <script src="<?php echo $globalPath; ?>modul/chart/jquery.min.js"></script>
  <script src="<?php echo $globalPath; ?>modul/chart/highcharts.js"></script>
  <script src="<?php echo $globalPath; ?>modul/chart/exporting.js"></script>
  <script src="<?php echo $globalPath; ?>modul/chart/canvas-tools.js"></script>
  <script src="<?php echo $globalPath; ?>modul/chart/export-csv.js"></script>
  <script src="<?php echo $globalPath; ?>modul/chart/jspdf.min.js"></script>

  <script src="<?php echo $globalPath; ?>modul/chart/highcharts-export-clientside.js"></script>

  <script>
  $(".browser-support *[data-type]").each(function() {
    var jThis = $(this);
    if(Highcharts.exporting.supports(jThis.data("type"))) {
      jThis.addClass("text-success");
      jThis.html('<span class="glyphicon glyphicon-ok"></span>');
    }
    else {
      jThis.addClass("text-danger");
      jThis.html('<span class="glyphicon glyphicon-remove"></span>');
    }
  });
  </script>

  <script>

  
  $('#example-2').highcharts({
    title: {
      text: 'Pertumbuhan Data Arsip',
      x: -20 //center
    },
    subtitle: {
      text: '<?php if(!empty($tahunLap)){echo $tahunLap;}else{echo 'SEMUA TAHUN';}?>',   //text: '2017',
      x: -20
    },
    xAxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
      'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
      ]
    },
    yAxis: {
      title: {
        text: 'Jumlah Data'
      },
      plotLines: [{
        value: 0,
        width: 1,
        color: '#808080'
      }]
    },
    tooltip: {
      valueSuffix: ' File'
    },
    legend: {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
    },
    series: [{
      name: 'Jumlah Data',
	data: [<?=$mBlnData[1]?>, <?=$mBlnData[2]?>, <?=$mBlnData[3]?>, <?=$mBlnData[4]?>, <?=$mBlnData[5]?>, <?=$mBlnData[6]?>, <?=$mBlnData[7]?>, <?=$mBlnData[8]?>, <?=$mBlnData[9]?>, <?=$mBlnData[10]?>, <?=$mBlnData[11]?>, <?=$mBlnData[12]?>]
	  
    }]
  });
  </script>


