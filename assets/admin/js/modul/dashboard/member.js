"use strict";

// Class definition
// console.log([40, 70, 80, 60, 50, 65, 60,1,2,10,20,50],grval);
var KTWidgets = function () {
    var initMixedWidget12 = function() {
        var charts = document.querySelectorAll('.mixed-widget-12-chart');

        var color;
        var strokeColor;
        var height;
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
        var options;
        var chart;

        [].slice.call(charts).map(function(element) {            
            height = parseInt(KTUtil.css(element, 'height'));

            var options = {
                series: [{
                    name: 'Banyak File',
                    data: grval
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'bar',
                    height: height,
                    toolbar: {
                        show: false
                    },
                    sparkline: {
                        enabled: true
                    },
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: ['30%'],
                        borderRadius: 2
                    }
                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 1
                },
                xaxis: {
                    categories: cat,
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    min: 0,
                    max: 100,
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                fill: {
                    type: ['solid', 'solid'],
                    opacity: [1, 1]
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function (val) {
                            return (val / 100 * total_file) + " File"
                        }
                    },
                    marker: {
                        show: false
                    }
                },
                colors: ['#ffffff', '#ffffff'],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    },
                    padding: {
                        left: 20,
                        right: 20
                    }
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render()
        });        
    } 
    // Public methods
    return {
        init: function () {
           
            initMixedWidget12();        
        }   
    }
}();
// Webpack support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = KTWidgets;
}

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTWidgets.init();
});