/**
 * @Package: Apptora Dashboard
* @Version: 1.0.0
*/

jQuery(function($) {

    'use strict';

    var DASH_SETTINGS = window.DASH_SETTINGS || {};

    /*--------------------------------
        Chart Js Chart
     --------------------------------*/
    DASH_SETTINGS.chartJS = function() {



        if($("#ico-purchase-chartjs").length){
            /*Restaurant Revenue Chart*/
            var randomScalingFactor = function() {
                return Math.round(Math.random() * 100)
            };

            var ctx = document.getElementById("ico-purchase-chartjs").getContext('2d');

            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
              gradientStroke1.addColorStop(0, '#f9bb5e');  
              gradientStroke1.addColorStop(1, '#e45131'); 

            var barChartData = {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "sep"],
                options: {
                    scales: {
                        xAxes: [{
                            barPercentage: 0.1
                        }]
                    }
                },
                datasets: [{
                    fillColor: gradientStroke1,
                    strokeColor: "",
                    highlightFill: gradientStroke1,
                    data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
                }]

            }

            var ctxb = document.getElementById("ico-purchase-chartjs").getContext("2d");
            window.myBar = new Chart(ctxb).Bar(barChartData, {
                responsive: true
            });
        }

        /*Line Chart*/
        if($("#line-chartjs").length){
            var randomScalingFactor = function() {
                return Math.round(Math.random() * 100)
            };
            var lineChartData = {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August"],
                datasets: [{
                    label: "My First dataset",
                    fillColor: "rgba(63,81,181,0.5)",
                    strokeColor: "rgba(63,81,181,1)",
                    pointColor: "rgba(63,81,181,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(63,81,181,1)",
                    data: [20, 35, 30, 39, 29, 45, 35, 50]
                }],

            }

            var ctx = document.getElementById("line-chartjs").getContext("2d");
            window.myLine = new Chart(ctx).Line(lineChartData, {
                responsive: true
            });

        }

            if($("#pie-chartjs").length){
                /*PIE Chart*/


                var pieData = [{
                        value: 300,
                        color: "#E91E63",
                        highlight: "rgba(250,133,100,0.8)",
                        label: "Accent"
                    }, {
                        value: 150,
                        color: "rgba(63,81,181,1)",
                        highlight: "rgba(63,81,181,0.8)",
                        label: "Primary"
                    }, {
                        value: 50,
                        color: "#FFC107",
                        highlight: "#FFC870",
                        label: "Yellow"
                    }, {
                        value: 120,
                        color: "rgba(103,58,183,1.0)",
                        highlight: "rgba(103,58,183,0.8)",
                        label: "Purple"
                    }

                ];

                var ctx = document.getElementById("pie-chartjs").getContext("2d");
                window.myPie = new Chart(ctx).Pie(pieData);

        }

        if($("#donut-chartjs").length){

            /* Donut Chart*/

            var doughnutData = [{
                    value: 200,
                    color: "#E91E63",
                    highlight: "rgba(250,133,100,0.8)",
                    label: "Tablets"
                }, {
                    value: 250,
                    color: "#2acd72",
                    highlight: "rgba(44,188,108,0.65)",
                    label: "Desktop"
                }, {
                    value: 100,
                    color: "#eee",
                    highlight: "#e1dcdc",
                    label: "Others"
                }, {
                    value: 120,
                    color: "rgba(114,124,245,1)",
                    highlight: "rgba(114,124,245,0.8)",
                    label: "Mobile"
                }

            ];

            var ctxd = document.getElementById("donut-chartjs").getContext("2d");
            window.myDoughnut = new Chart(ctxd).Doughnut(doughnutData, {
                responsive: true
            });
        }



        if($("#polar-chartjs").length){
            /*Polar Chart*/

            var polarData = [{
                    value: 300,
                    color: "#E91E63",
                    highlight: "rgba(250,133,100,0.8)",
                    label: "Accent"
                }, {
                    value: 150,
                    color: "rgba(63,81,181,1)",
                    highlight: "rgba(63,81,181,0.8)",
                    label: "Primary"
                }, {
                    value: 50,
                    color: "#FFC107",
                    highlight: "#FFC870",
                    label: "Yellow"
                }, {
                    value: 120,
                    color: "rgba(103,58,183,1.0)",
                    highlight: "rgba(103,58,183,0.8)",
                    label: "Purple"
                }

            ];

            var ctxp = document.getElementById("polar-chartjs").getContext("2d");
            window.myPolarArea = new Chart(ctxp).PolarArea(polarData, {
                responsive: true
            });

        }




        if($("#radar-chartjs").length){


            /*Radar Chart*/
            var radarChartData = {
                labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
                datasets: [{
                    label: "My First dataset",
                    fillColor: "rgba(63,81,181,0.4)",
                    strokeColor: "rgba(63,81,181,1)",
                    pointColor: "rgba(63,81,181,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(63,81,181,1)",
                    data: [65, 59, 90, 81, 56, 55, 40]
                }, {
                    label: "My Second dataset",
                    fillColor: "rgba(103,58,183,0.4)",
                    strokeColor: "rgba(103,58,183,1.0)",
                    pointColor: "rgba(103,58,183,1.0)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(103,58,183,1.0)",
                    data: [28, 48, 40, 19, 96, 27, 100]
                }]
            };

            window.myRadar = new Chart(document.getElementById("radar-chartjs").getContext("2d")).Radar(radarChartData, {
                responsive: true
            });
        }

    };


    /*--------------------------------
        Morris Chart
     --------------------------------*/
    DASH_SETTINGS.chartMorris=function() {
        if($("#morris_stackedbar_graph").length) {
            /* Stacked Bar Graph*/
            // Use Morris.Bar
            Morris.Bar( {
                element: 'morris_stackedbar_graph', data: [ {
                    x: '2018 Q1', y: 3, z: 2, a: 3
                }
                , {
                    x: '2018 Q2', y: 2, z: null, a: 1
                }
                , {
                    x: '2018 Q3', y: 0, z: 2, a: 4
                }
                , {
                    x: '2018 Q4', y: 2, z: 4, a: 3
                }
                ], resize: true, redraw: true, xkey: 'x', ykeys: ['y', 'z', 'a'], labels: ['Y', 'Z', 'A'], barColors: ['#e8962e', '#3F51B5', '#f46e0f'], stacked: true
            }
            );
        }

        if($("#morris_line_graph").length) {
            /*Line Graph*/
            /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
            var day_data=[ {
                "period": "2018-10-01", "licensed": 5000, "sorned": 2660
            }
            , {
                "period": "2018-09-30", "licensed": 3784, "sorned": 1655
            }
            , {
                "period": "2018-09-29", "licensed": 2536, "sorned": 1732
            }
            , {
                "period": "2018-09-20", "licensed": 4782, "sorned": 2661
            }
            , {
                "period": "2018-09-19", "licensed": 2212, "sorned": 1230
            }
            , {
                "period": "2018-09-18", "licensed": 4898, "sorned": 2738
            }
            , {
                "period": "2018-09-17", "licensed": 3171, "sorned": 1238
            }
            , {
                "period": "2018-09-16", "licensed": 3171, "sorned": 2676
            }
            , {
                "period": "2018-09-15", "licensed": 3974, "sorned": 989
            }
            , {
                "period": "2018-09-10", "licensed": 4676, "sorned": 3100
            }
            ];
            Morris.Line( {
                element: 'morris_line_graph', data: day_data, resize: true, xkey: 'period', ykeys: ['licensed', 'sorned'], labels: ['Registered', 'Purchase'], lineColors: ['#e8962e', '#3F51B5'], pointFillColors: ['#f46e0f']
            }
            );
        }

        if($("#morris-area-chart").length) {
          
            Morris.Bar( {
                element: 'morris-area-chart',
                data: [ {
                        "period": "2018-09-27",
                        Total: 100,
                        Pending: 70,
                        Ready: 30
                    }, {
                        "period": "2018-09-24",
                        Total: 75,
                        Pending: 65,
                        Ready: 40
                    }, {
                        "period": "2018-09-21",
                        Total: 140,
                        Pending: 80,
                        Ready: 35
                    }, {
                        "period": "2018-09-19",
                        Total: 180,
                        Pending: 110,
                        Ready: 70
                    }, {
                        "period": "2018-09-16",
                        Total: 150,
                        Pending: 40,
                        Ready: 120
                    }, {
                        "period": "2018-09-13",
                        Total: 125,
                        Pending: 80,
                        Ready: 40
                    }, {
                        "period": "2018-09-10",
                        Total: 110,
                        Pending: 75,
                        Ready: 40
                    }

                ],
                xkey: 'period',
                ykeys: [ 'Total', 'Pending', 'Ready' ],
                labels: [ 'Total Earnings', 'Pending Earnings', 'Ready to Payout' ],
                pointSize: 3,
                fillOpacity: 0,
                barColors: [ '#26DAD2', '#4680ff', '#fc6180' ],
                behaveLikeLine: true,
                gridLineColor: '#e0e0e0',
                lineWidth: 3,
                hideHover: 'auto',
                lineColors: [ '#26DAD2', '#4680ff', '#fc6180' ],
                resize: true

            } 
            );
        }
    };

    /*--------------------------------
        Sparkline Chart
     --------------------------------*/
    DASH_SETTINGS.dbSparklineChart = function() {

        if ($.isFunction($.fn.sparkline)) {

            $('.db_dynamicbar').sparkline([6.2, 8.4, 8.8, 8, 9.2, 8.8, 8, 7.5, 5.2, 9.9, 9, 9, 8.4, 9, 8.8, 8, 9.5, 9.2, 9.9, 9, 9,8, 7.1, 9, 9, 9.5, 8, 9.5, 9.8], {
                type: 'bar',
                barColor: '#e77512',
                height: '80',
                barWidth: '10',
                barSpacing: 1,
            });

            $('.sparklinedash').sparkline([ 10, 5, 6, 10, 9, 12, 4, 9, 7.5, 5.2, 9.9, 9, 9, 8.4], {
                type: 'bar',
                height: '60',
                barWidth: '4',
                resize: true,
                barSpacing: '5',
                barColor: '#fb9678'
            });
            $('.sparklinedash2').sparkline([ 7, 5, 6, 10, 9, 12, 7, 9, 6.2, 8.4, 8.8, 8, 9.2, 8.8], {
                type: 'bar',
                height: '60',
                barWidth: '4',
                resize: true,
                barSpacing: '5',
                barColor: '#ab8ce4'
            });
            $(".crypto1").sparkline([2,4,4,6,8,5,6,4,8,6,6,2 ], {
                type: 'line',
                width: '100%',
                height: '60',
                lineColor: '#13dafe',
                fillColor: 'rgba(19, 218, 254, 0.3)',
                maxSpotColor: '#99d683',
                highlightLineColor: 'rgba(0, 0, 0, 0.2)',
                highlightSpotColor: 'rgba(0,0,0,.2)'
            });
            $('.crypto2').sparkline([0,13,10,14,15,10,18,20,19], {
                type: 'line',
                width: '100%',
                height: '60',
                lineColor: '#6164c1',
                fillColor: 'rgba(97, 100, 193, 0.3)',
                highlightLineColor: 'rgba(0,0,0,.1)',
                highlightSpotColor: 'rgba(0,0,0,.2)'
            });
            $(".crypto3").sparkline([0,2,8,6,8,5,6,4,8,6,6,2 ], {
                type: 'line',
                width: '100%',
                height: '60',
                lineColor: '#fa8282',
                fillColor: 'rgba(255,211,152,.8)',
                minSpotColor:'#13dafe',
                maxSpotColor: '#13dafe',
                highlightLineColor: 'rgba(0, 0, 0, 0.2)',
                highlightSpotColor: '#13dafe'
            });
            $(".crypto4").sparkline([3,7,5,6,8,7,6,7,8,6,6,9 ], {
                type: 'line',
                width: '100%',
                height: '60',
                lineColor: '#13dafe',
                fillColor: 'rgba(153,214,131,.7)',
                minSpotColor:'#13dafe',
                maxSpotColor: '#13dafe',
                highlightLineColor: 'rgba(0, 0, 0, 0.2)',
                highlightSpotColor: '#13dafe'
            });
             $('.sparkline15').sparkline([5, 6, 2, 8, 9, 4, 7, 10, 11, 12, 10, 9, 4, 7], {
                type: 'bar',
                height: '200',
                barWidth: '10',
                barSpacing: '10',
                barColor: '#13dafe'
            });

            $('.db_linesparkline').sparkline([2000, 3454, 5454, 2323, 3432, 2323, 3432, 4656, 2897, 3545, 4232, 5434, 4656, 4656, 2897, 3545, 4232, 5434, 4656, 2323, 3432, 4656, 2897, 3545, 4232, 5434, 4656, 3567, 4878, 3676, 3787], {
                type: 'line',
                width: '100%',
                height: '80',
                lineWidth: 2,
                lineColor: '#e77512',
                fillColor: 'rgba(255,255,255,0.2)',
                highlightSpotColor: '#3F51B5',
                highlightLineColor: '#3F51B5',
                spotRadius: 3,
            });

            $('.db_linesparkline2').sparkline([3545, 4232, 5434, 4656, 4656, 2897, 3545, 4232, 5434, 2000, 3454, 5454, 2323, 3432, 2323, 3432, 4656, 2897, 4656, 2323, 3432, 4656, 2897, 3545, 4232, 5434, 4656, 3567, 4878, 3676, 3787], {
                type: 'line',
                width: '100%',
                height: '80',
                lineWidth: 2,
                lineColor: '#ffb426',
                fillColor: 'rgba(255,255,255,0.2)',
                highlightSpotColor: '#ffb426',
                highlightLineColor: '#ffb426',
                spotRadius: 3,
            });


            // Bar + line composite charts
            $('.db_compositebar').sparkline([4, 6, 7, 7, 4, 3, 2, 4, 6, 7, 4, 6, 7, 7, 4, 3, 2, 4, 6, 7,7, 4, 3, 1, 4, 6, 5, 9], {
                type: 'bar',
                barColor: '#3F51B5',
                height: '80',
                barWidth: '10',
                barSpacing: 1,
            });

            $('.db_compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 8, 4, 7, 9, 4, 6, 7, 7, 4, 3, 2, 4, 6, 7, 9, 8, 8, 4, 2, 5, 6, 7], {
                composite: true,
                fillColor: 'rgba(103,58,183,0)',
                type: 'line',
                width: '100%',
                height: '80',
                lineWidth: 2,
                lineColor: '#ffb426',
                highlightSpotColor: '#E91E63',
                highlightLineColor: '#ffb426',
                spotRadius: 3,
            });

        }

    };




    /******************************
     initialize respective scripts 
     *****************************/
    $(document).ready(function() {
        DASH_SETTINGS.dbSparklineChart();
        DASH_SETTINGS.chartMorris();
    });

    $(window).resize(function() {
        DASH_SETTINGS.dbSparklineChart();
    });

    $(window).load(function() {
        DASH_SETTINGS.chartJS();
    });

});