<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row ap-hp-cards marbot20">

    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <span class="card-title"><?=$chart["fallar"]["all"]?></span> <span>Toplam Fallar</span>
                <p class="card-text">+<?=$chart["fallar"]["today"]?> Bugün</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <span class="card-title"><?=$chart["kredi"]["all"]?></span> <span>Satılan Kredi</span>
                <p class="card-text">+<?=$chart["kredi"]["today"]?> Bugün</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <span class="card-title"><?=$chart["uye"]["all"]?></span> <span>Toplam Üye</span>
                <p class="card-text">+<?=$chart["uye"]["today"]?> Bugün</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <span class="card-title"><?=$chart["hits"]["all"]?></span> <span>Toplam Ziyaret</span>
                <p class="card-text">+<?=$chart["hits"]["today"]?> Bugün</p>
            </div>
        </div>
    </div>

</div>

<div class="row marbot20">
    <div class="col-lg-6">
        <div class="row">
            <!--chart-->
            <div class="col-md-12">

                <div class="card border-light ">
                   <div class="card-header">Fallar tablosu</div>
                   <div class="card-body" style="height:400px">
                        <canvas id="home-page-chart"></canvas>
                        <div class="no_data" style="padding-top:173px">ŞU ANLIK HİÇ VERİ YOK</div>
                   </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <!--chart-->
            <div class="col-md-12">

                <div class="card border-light ">
                   <div class="card-header">Kredi tablosu</div>
                   <div class="card-body" style="height:400px">
                        <canvas id="home-page-chart2"></canvas>
                        <div class="no_data" style="padding-top:173px">ŞU ANLIK HİÇ VERİ YOK</div>
                   </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <!--chart-->
            <div class="col-md-12">

                <div class="card border-light ">
                   <div class="card-header">Üye tablosu</div>
                   <div class="card-body" style="height:400px">
                        <canvas id="home-page-chart3"></canvas>
                        <div class="no_data" style="padding-top:173px">ŞU ANLIK HİÇ VERİ YOK</div>
                   </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <!--chart-->
            <div class="col-md-12">

                <div class="card border-light ">
                   <div class="card-header">Ziyaret tablosu</div>
                   <div class="card-body" style="height:400px">
                        <canvas id="home-page-chart4"></canvas>
                        <div class="no_data" style="padding-top:173px">ŞU ANLIK HİÇ VERİ YOK</div>
                   </div>
                </div>

            </div>
        </div>
    </div>

</div>


<script type="text/javascript">
    var homepagechart;
    var homepagechart2;
    var homepagechart3;
    var homepagechart4;

    $(document).ready(function(){

        gchart = [];
        gchart.push(homepagechart);
        gchart.push(homepagechart2);
        gchart.push(homepagechart3);
        gchart.push(homepagechart4);

        $.ajax({
            url: '<?=base_url()?>admin/get_chart_data/',
            contentType: false,
            processData: false,
            success: function( data){

              loadchart(data);
              loadkredichart(data);
              loaduyelerchart(data);
              loadhitschart(data);

            },
            error: function( e ){
                console.log( e );
            }
        });
    });

    function loadchart(data)
    {
      try{
          homepagechart.destroy();
      }catch(err){}

      if (data == "no_data")
      {
          $("#home-page-chart").hide();
          $("#home-page-chart").parent().find(".no_data").show();
          return;
      }

      data = JSON.parse(data);

      var labels = [];
      var cdata = [];

      if (data.fallar !== "no_data")
      {
          for (var i = 0; i < data.fallar.length; i++)
          {
              labels.push(data.fallar[i][1]);
              cdata.push(data.fallar[i][0]);
          }

          $("#home-page-chart").show();
          $("#home-page-chart").parent().find(".no_data").hide();

          homepagechart = new Chart(document.getElementById('home-page-chart'), {
              "type": "line",
              "data": {
                  "labels": labels,
                  "datasets": [{
                      "data": cdata,
                      "fill": true,
                      "borderColor": "#007bff",
                      "backgroundColor": "#82beff",
                      "lineTension": 0,
                  }]
              },
              "options": {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                  yAxes: [{
                      gridLines: {
                          color: "rgba(0, 0, 0, 0)",
                      },
                      ticks: {
                          stepSize: 1
                      } 
                  }]
              }
              }
          });
      }else{
          $("#home-page-chart").hide();
          $("#home-page-chart").parent().find(".no_data").show();
      }    
    }

    function loadkredichart(data)
    {
      try{
          homepagechart2.destroy();
      }catch(err){}

      if (data == "no_data")
      {
          $("#home-page-chart2").hide();
          $("#home-page-chart2").parent().find(".no_data").show();
          return;
      }

      data = JSON.parse(data);

      var labels = [];
      var cdata = [];

      if (data.kredi !== "no_data")
      {
          for (var i = 0; i < data.kredi.length; i++)
          {
              labels.push(data.kredi[i][1]);
              cdata.push(data.kredi[i][0]);
          }

          $("#home-page-chart2").show();
          $("#home-page-chart2").parent().find(".no_data").hide();

          homepagechart2 = new Chart(document.getElementById('home-page-chart2'), {
              "type": "line",
              "data": {
                  "labels": labels,
                  "datasets": [{
                      "data": cdata,
                      "fill": true,
                      "borderColor": "#137128",
                      "backgroundColor": "#28a745",
                      "lineTension": 0,
                  }]
              },
              "options": {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                  yAxes: [{
                      gridLines: {
                          color: "rgba(0, 0, 0, 0)",
                      },
                      ticks: {
                          stepSize: 500
                      } 
                  }]
              }
              }
          });
      }else{
          $("#home-page-chart2").hide();
          $("#home-page-chart2").parent().find(".no_data").show();
      }    
    }

    function loaduyelerchart(data)
    {
      try{
          homepagechart3.destroy();
      }catch(err){}

      if (data == "no_data")
      {
          $("#home-page-chart3").hide();
          $("#home-page-chart3").parent().find(".no_data").show();
          return;
      }

      data = JSON.parse(data);

      var labels = [];
      var cdata = [];

      if (data.uyeler !== "no_data")
      {
          for (var i = 0; i < data.uyeler.length; i++)
          {
              labels.push(data.uyeler[i][1]);
              cdata.push(data.uyeler[i][0]);
          }

          $("#home-page-chart3").show();
          $("#home-page-chart3").parent().find(".no_data").hide();

          homepagechart3 = new Chart(document.getElementById('home-page-chart3'), {
              "type": "line",
              "data": {
                  "labels": labels,
                  "datasets": [{
                      "data": cdata,
                      "fill": true,
                      "borderColor": "#d09f0d",
                      "backgroundColor": "#ffc107",
                      "lineTension": 0,
                  }]
              },
              "options": {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                  yAxes: [{
                      gridLines: {
                          color: "rgba(0, 0, 0, 0)",
                      },
                      ticks: {
                          stepSize: 10
                      } 
                  }]
              }
              }
          });
      }else{
          $("#home-page-chart3").hide();
          $("#home-page-chart3").parent().find(".no_data").show();
      }    
    }

    function loadhitschart(data)
    {
      try{
          homepagechart4.destroy();
      }catch(err){}

      if (data == "no_data")
      {
          $("#home-page-chart4").hide();
          $("#home-page-chart4").parent().find(".no_data").show();
          return;
      }

      data = JSON.parse(data);

      var labels = [];
      var cdata = [];

      if (data.hits !== "no_data")
      {
          for (var i = 0; i < data.hits.length; i++)
          {
              labels.push(data.hits[i][1]);
              cdata.push(data.hits[i][0]);
          }

          $("#home-page-chart4").show();
          $("#home-page-chart4").parent().find(".no_data").hide();

          homepagechart2 = new Chart(document.getElementById('home-page-chart4'), {
              "type": "line",
              "data": {
                  "labels": labels,
                  "datasets": [{
                      "data": cdata,
                      "fill": true,
                      "borderColor": "#941c28",
                      "backgroundColor": "#dc3545",
                      "lineTension": 0,
                  }]
              },
              "options": {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                  yAxes: [{
                      gridLines: {
                          color: "rgba(0, 0, 0, 0)",
                      },
                      ticks: {
                          stepSize: 10
                      } 
                  }]
              }
              }
          });
      }else{
          $("#home-page-chart4").hide();
          $("#home-page-chart4").parent().find(".no_data").show();
      }    
    }
</script>
