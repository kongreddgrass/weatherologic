<br />

<div style="text-align: center; margin: 20px; padding: 10px;  background: #f5f5f5; border: 1px solid #FFF; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; box-shadow: 1px 2px 4px rgba(0,0,0,.4);">
  <div style="background-color: #FDFDEF; border: 1px solid #EBE9C5; border-radius: 4px; padding: 10px;">Messverlauf vom letzen Jahr:<br /></div><br />
  <div id="wrapper" style="width: 1570px; display: block; margin-left: auto; margin-right: auto;">
    <div style="float:left; margin:5px;">Feuchtigkeitsverlauf:<br /><canvas id="canvas_1" width="500" height="400"></canvas></div>
    <div style="float:left; margin:5px;">Temperaturverlauf:<br /><canvas id="canvas_2" width="500" height="400"></canvas></div>
    <div style="float:left; margin:5px;">Druckverlauf:<br /><canvas id="canvas_3" width="500" height="400"></canvas></div>
    <div style="clear: both;"></div>
  </div>
<br />
<script>
  // var randomScalingFactor = function(){ return Math.round(Math.random()*50)};
  var lineChartData_1 = {
    labels : [<?= $verlauf_jahr_tage ?>],
    datasets : [
      {
        label: "My First dataset",
        fillColor : "rgba(220,220,220,0.2)",
        strokeColor : "#1f8eff",
        pointColor : "#1265bb",
        pointStrokeColor : "#fff",
        pointHighlightFill : "#fff",
        pointHighlightStroke : "rgba(220,220,220,1)",
        data : [<?= $verlauf_jahr_humidity ?>]
      },
    ]

  }
  var lineChartData_2 = {
    labels : [<?= $verlauf_jahr_tage ?>],
    datasets : [
      {
        label: "My First dataset",
        fillColor : "rgba(220,220,220,0.2)",
        strokeColor : "#5995d8",
        pointColor : "#325379",
        pointStrokeColor : "#fff",
        pointHighlightFill : "#fff",
        pointHighlightStroke : "rgba(220,220,220,1)",
        data : [<?= $verlauf_jahr_items ?>]
      },
    ]

  }
  var lineChartData_3 = {
    labels : [<?= $verlauf_jahr_tage ?>],
    datasets : [
      {
        label: "My First dataset",
        fillColor : "rgba(220,220,220,0.2)",
        strokeColor : "#99c1ea",
        pointColor : "#5a7fa6",
        pointStrokeColor : "#fff",
        pointHighlightFill : "#fff",
        pointHighlightStroke : "rgba(220,220,220,1)",
        data : [<?= $verlauf_jahr_bars ?>]
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
</script>
