/**
* Theme: Minton Admin Template
* Author: Coderthemes
* Component: Sparkline Chart
*
*/
$( document ).ready(function() {
    
var lineas;
var totall;    
var tematicas;
var totalt;  
var carrera;
var totaluc;
$.post("./form/estadisticas/funciones.php", {}, function (resp) {
       var data = JSON.parse(resp);
        var arr =data.total_x_linea;
         totall=data.total_x_linea.total;
         lineas=data.total_x_linea.linea;
         
         totalt=data.total_x_tematica.totalt;
         tematicas=data.total_x_tematica.tematica; 
         
         totaluc=data.total_x_usuario_x_carrera.totaluc;
         carrera=data.total_x_usuario_x_carrera.carrera;  
         
//         alert(totaluc);
        $('#total_x_linea').sparkline(totall, {
        type: 'pie',
        width: '200px',
        height: '200px',
        sliceColors: ['#5d3092', '#4dc9ec', '#9de49d', '#9074b1', '#66aa00', '#dd4477', '#0099c6'],
        borderWidth: 7,
        borderColor: '#f5f5f5',
        tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{value}})',
        tooltipValueLookups: {
            names: lineas
        }
        });

        $('#total_x_tematica').sparkline(totalt, {
        type: 'pie',
        width: '200px',
        height: '200px',
        sliceColors: ['#5d3092', '#4dc9ec', '#9de49d', '#9074b1', '#66aa00', '#dd4477', '#0099c6'],
        borderWidth: 7,
        borderColor: '#f5f5f5',
        tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{value}})',
        tooltipValueLookups: {
            names: tematicas
        }
        });    
        $('#total_x_usuario_x_carrera').sparkline(totaluc, {
            type: 'bar',
            height: '165',
            barWidth: '10',
            barSpacing: '3',
            barColor: '#3bafda',
            tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{value}})',
        tooltipValueLookups: {
            names: carrera
        }            
            
        });        
    })
    
    var DrawSparkline = function() {
        $('#sparkline1').sparkline([0, 23, 43, 35, 44, 45, 56, 37, 40], {
            type: 'line',
            width: $('#sparkline1').width(),
            height: '165',
            chartRangeMax: 50,
            lineColor: '#3bafda',
            fillColor: 'rgba(59,175,218,0.3)',
            highlightLineColor: 'rgba(0,0,0,.1)',
            highlightSpotColor: 'rgba(0,0,0,.2)',
        });

        $('#sparkline1').sparkline([25, 23, 26, 24, 25, 32, 30, 24, 19], {
            type: 'line',
            width: $('#sparkline1').width(),
            height: '165',
            chartRangeMax: 40,
            lineColor: '#00b19d',
            fillColor: 'rgba(0, 177, 157, 0.3)',
            composite: true,
            highlightLineColor: 'rgba(0,0,0,.1)',
            highlightSpotColor: 'rgba(0,0,0,.2)',
        });


//"value", "percent" (number between 0 and 100), "color" 



    };


    DrawSparkline();

    var resizeChart;

    $(window).resize(function(e) {
        clearTimeout(resizeChart);
        resizeChart = setTimeout(function() {
            DrawSparkline();
        }, 300);
    });
});