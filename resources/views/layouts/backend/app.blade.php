<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    @yield('title')
    @include('layouts.backend.partials.style')
    @yield('css')
</head>
<body class="">

    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->  
    @include('layouts.backend.partials.sidenav')
    @include('layouts.backend.partials.header')

    <!-- [ Main Content ] start --> 
    @yield('content')
    <!-- [ Main Content ] end -->
    @include('layouts.backend.partials.script')

    <!-- Apex Chart -->
    <script src="{{asset('backend/js/plugins/apexcharts.min.js')}}"></script>

    <script>
        // [ revenue-map ] start
        $(function() {
            var options = {
                chart: {
                    height: 200,
                    type: 'line',
                    toolbar: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 3,
                    curve: 'smooth'
                },
                series: [{
                    name: 'Sales',
                    data: [20, 50, 30, 60, 30, 50, 40]
                }, {
                    name: 'Amount',
                    data: [40, 20, 50, 15, 40, 65, 20]
                }],
                xaxis: {
                    type: 'datetime',
                    categories: ['1/11/2019', '2/11/2019', '3/11/2019', '4/11/2019', '5/11/2019', '6/11/2019', '7/11/2019'],
                },
                colors: ['#448aff', '#9ccc65'],
                fill: {
                    type: 'solid',
                },
                markers: {
                    size: 5,
                    colors: ['#448aff', '#9ccc65'],
                    opacity: 0.9,
                    strokeWidth: 2,
                    hover: {
                        size: 7,
                    }
                },
                grid: {
                    borderColor: '#e2e5e885',
                },
                yaxis: {
                    min: 10,
                    max: 70,
                }
            };
            var chart = new ApexCharts(document.querySelector("#collected-chart"), options);
            chart.render();
        });
        // [ revenue-map ] end 

        // [ Transection ] start
        $(function() {
            var options1 = {
                chart: {
                    type: 'bar',
                    height: 100,
                    sparkline: {
                        enabled: true
                    }
                },
                colors: ["#4680ff"],
                plotOptions: {
                    bar: {
                        columnWidth: '80%'
                    }
                },
                series: [{
                    data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54]
                }],
                labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                xaxis: {
                    crosshairs: {
                        width: 1
                    },
                },
                tooltip: {
                    fixed: {
                        enabled: false
                    },
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                            formatter: function(seriesName) {
                                return 'Amount'
                            }
                        }
                    },
                    marker: {
                        show: false
                    }
                }
            }
            new ApexCharts(document.querySelector("#transactions1"), options1).render();
            var options2 = {
                chart: {
                    type: 'bar',
                    height: 100,
                    sparkline: {
                        enabled: true
                    }
                },
                colors: ["#ff5252"],
                plotOptions: {
                    bar: {
                        columnWidth: '80%'
                    }
                },
                series: [{
                    data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54]
                }],
                labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                xaxis: {
                    crosshairs: {
                        width: 1
                    },
                },
                tooltip: {
                    fixed: {
                        enabled: false
                    },
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                            formatter: function(seriesName) {
                                return 'Sales'
                            }
                        }
                    },
                    marker: {
                        show: false
                    }
                }
            }
            new ApexCharts(document.querySelector("#transactions2"), options2).render();
        });
        // [ Transection ] end
    </script>
    @yield('script')
</body> 
</html>
