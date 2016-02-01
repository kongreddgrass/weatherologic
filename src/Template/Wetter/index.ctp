
<div style="text-align: center; margin: 20px; padding: 10px;  background: #f5f5f5; border: 1px solid #FFF; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; box-shadow: 1px 2px 4px rgba(0,0,0,.4);">
  <div style="background-color: #FDFDEF; border: 1px solid #EBE9C5; border-radius: 4px; padding: 10px;">Kurzinfos:<br /></div><br />
  <div style="padding-bottom:10px;">
    <div style="width: 33%; height: 170px; background-color: #FDFDEF; border: 1px solid #EBE9C5; border-radius: 4px; padding: 10px; display: inline-block; float: left;">
      <div>Der wärmste Tag war am <?= $waermster_time ?> mit <?= $waermster_max ?> Grad.</div>
      <div>Der kälteste  Tag war am <?= $kaeltester_time ?> mit <?= $kaeltester_max ?> Grad.</div>
    </div>
    <div style="width: 33%; background-color: #FDFDEF; border: 1px solid #EBE9C5; border-radius: 4px; padding: 10px; display: inline-block; margin: 0 auto;">
      <div style="width: 30%; height: 148px; background-color: #FFFFFF; border: 1px solid #EBE9C5; border-radius: 4px; padding: 3px; display: inline-block; float: left;">
        Samstag<br />
        <?php echo $this->Html->image('wettericons/1_klare_nacht.png', ['alt' => 'CakePHP']); ?>
      </div>
      <div style="width: 30%; height: 140px; background-color: #FFFFFF; border: 1px solid #EBE9C5; border-radius: 4px; padding: 5px; display: inline-block; margin: 0 auto;">
        Sonntag<br />
        <?php echo $this->Html->image('wettericons/1_tag_sonnig.png', ['alt' => 'CakePHP']); ?>
      </div>
      <div style="width: 30%; height: 140px; background-color: #FFFFFF; border: 1px solid #EBE9C5; border-radius: 4px; padding: 5px; display: inline-block; float: right;">
        Montag<br />
        <?php echo $this->Html->image('wettericons/7_schnee.png', ['alt' => 'CakePHP']); ?>
      </div>
    </div>
    <div style="width: 33%; height: 170px; background-color: #FDFDEF; border: 1px solid #EBE9C5; border-radius: 4px; padding: 10px; display: inline-block; float:right;">
      <div style="padding:10px; margin:10px;"><?php echo $this->Html->image('wettericons/thermometer_heiss.png', ['alt' => 'CakePHP', 'height' => '28px']); ?>Der wärmste Tag war am <?= $waermster_time ?> mit <?= $waermster_max ?> Grad.</div>
      <div style="padding:10px; margin:10px;"><?php echo $this->Html->image('wettericons/thermometer_kalt.png', ['alt' => 'CakePHP', 'height' => '28px', 'width' => '28px']); ?>&nbsp;Der kälteste  Tag war am <?= $kaeltester_time ?> mit <?= $kaeltester_max ?> Grad.</div>
    </div>
  </div>
</div>

<div style="text-align: center; margin: 20px; padding: 10px;  background: #f5f5f5; border: 1px solid #FFF; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; box-shadow: 1px 2px 4px rgba(0,0,0,.4);">
  <div style="background-color: #FDFDEF; border: 1px solid #EBE9C5; border-radius: 4px; padding: 10px;">Messverlauf der letzen vier Stunden:<br /></div><br />
    <div id="container1" style="float:left;"></div>
    <div id="container2" style="float:left;"></div>
    <div id="container3" style="float:left;"></div>
    <div style="clear: both;"></div>
</div>


<script>
$(function () {
    $('#container1').highcharts({
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Feuchtigkeit'
        },
        xAxis: {
            categories: [<?= $verlauf_aktuell_tage ?>]
        },
        yAxis: {
            title: {
                text: 'Feuchtigkeit'
            },
            labels: {
                formatter: function () {
                    return this.value + '%';
                }
            }
        },
        credits: {
            enabled: false
        },
        tooltip: {
            crosshairs: true,
            shared: true
        },
        plotOptions: {
            spline: {
                marker: {
                    radius: 4,
                    lineColor: '#666666',
                    lineWidth: 1
                }
            }
        },
        series: [{
            name: 'Feuchtigkeit',
            marker: {
                symbol: 'square'
            },
            data: [<?= $verlauf_aktuell_humidity ?>]

        }]
    });
});

$(function () {
    $('#container2').highcharts({
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Temperatur'
        },
        xAxis: {
            categories: [<?= $verlauf_aktuell_tage ?>]
        },
        yAxis: {
            title: {
                text: 'Temperatur'
            },
            labels: {
                formatter: function () {
                    return this.value + '°';
                }
            }
        },
        credits: {
            enabled: false
        },
        tooltip: {
            crosshairs: true,
            shared: true
        },
        plotOptions: {
            spline: {
                marker: {
                    radius: 4,
                    lineColor: '#666666',
                    lineWidth: 1
                }
            }
        },
        series: [{
            name: 'Temperatur',
            marker: {
                symbol: 'square'
            },
            data: [<?= $verlauf_aktuell_items ?>]

        }]
    });
});

$(function () {
    $('#container3').highcharts({
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Luftdruck'
        },
        xAxis: {
            categories: [<?= $verlauf_aktuell_tage ?>]
        },
        yAxis: {
            title: {
                text: 'Luftdruck'
            },
            labels: {
                formatter: function () {
                    return this.value + '°';
                }
            }
        },
        credits: {
            enabled: false
        },
        tooltip: {
            crosshairs: true,
            shared: true
        },
        plotOptions: {
            spline: {
                marker: {
                    radius: 4,
                    lineColor: '#666666',
                    lineWidth: 1
                }
            }
        },
        series: [{
            name: 'Luftdruck',
            marker: {
                symbol: 'square'
            },
            data: [<?= $verlauf_aktuell_bars ?>]

        }]
    });
});
</script>

<!-- <script>
  // var randomScalingFactor = function(){ return Math.round(Math.random()*50)};
  var lineChartData_1 = {
    labels : [<?= $verlauf_aktuell_tage ?>],
    datasets : [
      {
        label: "My First dataset",
        fillColor : "rgba(220,220,220,0.2)",
        strokeColor : "#1f8eff",
        pointColor : "#1265bb",
        pointStrokeColor : "#fff",
        pointHighlightFill : "#fff",
        pointHighlightStroke : "rgba(220,220,220,1)",
        data : [<?= $verlauf_aktuell_humidity ?>]
      },
    ]

  }
  var lineChartData_2 = {
    labels : [<?= $verlauf_aktuell_tage ?>],
    datasets : [
      {
        label: "My First dataset",
        fillColor : "rgba(220,220,220,0.2)",
        strokeColor : "#5995d8",
        pointColor : "#325379",
        pointStrokeColor : "#fff",
        pointHighlightFill : "#fff",
        pointHighlightStroke : "rgba(220,220,220,1)",
        data : [<?= $verlauf_aktuell_items ?>]
      },
    ]

  }
  var lineChartData_3 = {
    labels : [<?= $verlauf_aktuell_tage ?>],
    datasets : [
      {
        label: "My First dataset",
        fillColor : "rgba(220,220,220,0.2)",
        strokeColor : "#99c1ea",
        pointColor : "#5a7fa6",
        pointStrokeColor : "#fff",
        pointHighlightFill : "#fff",
        pointHighlightStroke : "rgba(220,220,220,1)",
        data : [<?= $verlauf_aktuell_bars ?>]
      },
    ]

  }

window.onload = function(){
  var ctx_1 = document.getElementById("canvas_1").getContext("2d");
  window.myLine = new Chart(ctx_1).Line(lineChartData_1), {
    responsive: false
  };
  var ctx_2 = document.getElementById("canvas_2").getContext("2d");
  window.myLine = new Chart(ctx_2).Line(lineChartData_2), {
    responsive: false
  };
  var ctx_3 = document.getElementById("canvas_3").getContext("2d");
  window.myLine = new Chart(ctx_3).Line(lineChartData_3), {
    responsive: false
  };
}
</script> -->
