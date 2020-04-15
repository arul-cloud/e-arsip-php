  <!--<link rel="stylesheet" type="text/css" href="bootstrap.min.css" />-->
  <!--<link rel="stylesheet" type="text/css" href="modul/chart/bootstrap-theme.min.css" />-->

	<script type="text/javascript">
	function(){this.exportChart({type:"image/jpeg"})}}
	</script>


  <div class="highcharts-container" id="example-1"></div>

  <script src="modul/chart/jquery.min.js"></script>
  <script src="modul/chart/highcharts.js"></script>
  <script src="modul/chart/exporting.js"></script>
  <script src="modul/chart/canvas-tools.js"></script>
  <script src="modul/chart/export-csv.js"></script>
  <script src="modul/chart/jspdf.min.js"></script>

  <script src="modul/chart/highcharts-export-clientside.js"></script>

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
  
  $('#example-1').highcharts({
  chart: {
            type: 'column'
        },

    title: {
      text: '<?php echo $title;?>',
      x: -20 //center
    },
    subtitle: {
      text: '<?php echo $subtitle;?>',
      x: -20
    },
    xAxis: {
      categories: ['<?php echo $tahun1.'(1)';?>', '<?php echo $tahun1.'(2)';?>','<?php echo $tahun2.'(1)';?>', '<?php echo $tahun2.'(2)';?>']
    },
    yAxis: {
      title: {
        text: 'Persentase(%)'
      },
      plotLines: [{
        value: 0,
        width: 1,
        color: '#808080'
      }]
    },
    tooltip: {
      valueSuffix: '%'
    },
    legend: {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
    },
    series: [{
      name: '<?php echo $namaBar1;?>',
      data: [<?php echo $dt1Bar1;?>, <?php echo $dt1Bar2;?>, <?php echo $dt1Bar3;?>, <?php echo $dt1Bar4;?>]
    }, {
      name: '<?php echo $namaBar2;?>',
      data: [<?php echo $dt2Bar1;?>, <?php echo $dt2Bar2;?>, <?php echo $dt2Bar3;?>, <?php echo $dt2Bar4;?>]
    }, {
      name: '<?php echo $namaBar3;?>',
      data: [<?php echo $dt3Bar1;?>, <?php echo $dt3Bar2;?>, <?php echo $dt3Bar3;?>, <?php echo $dt3Bar4;?>]
    }]
  });
  </script>

</div>
