<?php
$ci = get_instance();
?>

<div class="card card-custom mb-8 mb-lg-0" style="background-color: #ffffff;">
    <div class="card-body">
        <div class="text-center">
            <div id="chart"></div>
        </div>
    </div>
</div>





<script>
FusionCharts.ready(function() {
    var myChart = new FusionCharts({
        type: "column3d",
        renderAt: "chart",
        width: "100%",
        "height": "350",
        dataFormat: "json",
        dataSource: {
            chart: {
                caption: "<b>Indeks Kesadaran Keamanan Siber</b>",
                subcaption: "",
                showvalues: "1",
                decimals: "2",
                theme: "umber",
                "bgColor": "#ffffff"
            },
            data: [<?php echo $get_data_chart ?>]
        }
    });
    myChart.render();
});
</script><?php /**PATH C:\Users\IT\Documents\Htdocs MAMP\surveiku_skks\application\views/dashboard/chart_survei.blade.php ENDPATH**/ ?>