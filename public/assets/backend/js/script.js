/*
 Theme Name: Onlinedu 
 Theme URI: 
 Author: 
 Author URI: 
 Description: Onlinedu Responsive HTML5 Template
 Version: 1.0
 License:
 License URI: 
*/

/*==================================
   [Table of contents]
===================================
   01. Variables
   02. Nice Selects
  
*/

(function () {
    'use strict';
    /*------------------------------------------------------
    /  01. Variables
    /------------------------------------------------------*/

    var $niceSelect = $('.nice-control');

    // Nice Select
    if ($niceSelect.length > 0) {
        $('.nice-control').niceSelect();
    }

    // Sidebar Toggle 
    const sideToggle = $(".sidebar_toggle");
    const sideMenu = $(".sidebar");
    const sidebarOverlay = $(".sidebar-overlay");

    if (sideToggle.length) {
        sideToggle.on("click", function (event) {
            event.stopPropagation();
            sideMenu.toggleClass("sidebar_small");
            sideToggle.toggleClass("active");
            sidebarOverlay.toggleClass("active");
        });

        // 👉 Close menu when overlay is clicked
        sidebarOverlay.on("click", function () {
            sideMenu.removeClass("sidebar_small");
            sideToggle.removeClass("active");
            sidebarOverlay.removeClass("active");
        });
    }

    // Sidebar Menu
    $(window).on("load", function () {
        $('.navbar-content li.subMenu_dropdown > a').on('click', function (e) {
            e.preventDefault();

            var $this = $(this);
            var $parentLi = $this.parent();
            var $submenu = $this.siblings('ul');

            $parentLi.siblings('.subMenu_dropdown').removeClass('childShow').find('ul').slideUp();
            $parentLi.siblings('.subMenu_dropdown').find('> a').removeClass('active');

            $submenu.stop(true, true).slideToggle();
            $this.toggleClass('active');
            $parentLi.toggleClass('childShow');
        });
    });

    // Scrollbar
    new SimpleBar(document.getElementById('navbar'), { autoHide: true });

    // Range Slider
    var slider = new Slider('#range1', {
        id: 'range',
        tooltip: 'always',
        min: 0,
        max: 100,
        value: 40,
        formatter: function (value) {
            if (Array.isArray(value)) {
                return value[0] + '% - ' + value[1] + '%';
            }
            return value + '%';
        }
    });

    var slider = new Slider('#range2', {
        id: 'range',
        tooltip: 'always',
        min: 0,
        max: 100,
        value: 65,
        formatter: function (value) {
            if (Array.isArray(value)) {
                return value[0] + '% - ' + value[1] + '%';
            }
            return value + '%';
        }
    });

    var slider = new Slider('#range3', {
        id: 'range',
        tooltip: 'always',
        min: 0,
        max: 100,
        value: 20,
        formatter: function (value) {
            if (Array.isArray(value)) {
                return value[0] + '% - ' + value[1] + '%';
            }
            return value + '%';
        }
    });

    var slider = new Slider('#range4', {
        id: 'range',
        tooltip: 'always',
        min: 0,
        max: 100,
        value: 32,
        formatter: function (value) {
            if (Array.isArray(value)) {
                return value[0] + '% - ' + value[1] + '%';
            }
            return value + '%';
        }
    });

    // Sales Chart
    var income = [550, 220, 400, 700, 220, 500, 780, 500, 600, 180, 450, 150];
    var expense = [600, 1200, 0, 300, 620, 1200, 0, 200, 250, 320, 0, 360];

    var options = {
        series: [
            { name: 'Income', data: income },
            { name: 'Expense', data: expense }
        ],
        chart: {
            type: 'bar',
            height: 220,
            stacked: true,
            toolbar: { show: false }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '36%',
                borderRadius: 6,
                // borderRadiusApplication: 'last',
                // borderRadiusWhenStacked: 'end',
            }
        },
        colors: ['#ff8a00', '#fff0e6'],
        dataLabels: { enabled: false },
        stroke: {
            show: true,
            width: 1,
            colors: ['#fff1ea', '#0E0F14']
        },

        stroke: {
            show: true,
            width: 1,
            colors: ['#FF8926 ', '#FFEAD8']
        },

        fill: { opacity: 1 },
        dataLabels: { enabled: false },
        grid: {
            show: true,
            borderColor: '#E0E0E0',
            strokeDashArray: 6,
            padding: { left: 0, right: 6, top: 0, bottom: 0 }
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            axisBorder: { show: false },
            axisTicks: { show: false },
            labels: {
                style: { colors: '#747C7C', fontSize: '12px' }
            }
        },
        yaxis: {
            max: 2000,
            tickAmount: 5,
            labels: {
                style: { colors: '#747C7C', fontSize: '12px' },
                formatter: function (val) {
                    var labels = ['$0', '$200', '$500', '$1000', '$1500', '$2000'];
                    var step = 2000 / (labels.length - 1);
                    var idx = Math.round(val / step);
                    if (labels[idx] !== undefined) return labels[idx];
                    return '$' + val;
                }
            }
        },
        states: {
            hover: { filter: { type: 'none' } },
            active: { allowMultipleDataPointsSelection: false, filter: { type: 'none' } }
        },
        tooltip: {
            shared: true,
            intersect: false,
            x: {
                formatter: function (val) {
                    var map = {
                        'Jan': 'January 2029', 'Feb': 'February 2029', 'Mar': 'March 2029',
                        'Apr': 'April 2029', 'May': 'May 2029', 'Jun': 'June 2029',
                        'Jul': 'July 2029', 'Aug': 'August 2029', 'Sep': 'September 2029',
                        'Oct': 'October 2029', 'Nov': 'November 2029', 'Dec': 'December 2029'
                    };
                    return map[val] || val;
                }
            },
            y: {
                formatter: function (val) {
                    return '$' + Number(val).toLocaleString();
                }
            },
            style: {
                fontSize: '12px'
            }
        },
        legend: { show: false }
    };

    var chart = new ApexCharts(document.querySelector("#salesChart"), options);
    chart.render();

    // Sales Chart 02
    var income = [550, 220, 400, 700, 220, 500, 780, 500, 600, 180, 450, 150];
    var expense = [600, 1200, 0, 300, 620, 1200, 0, 200, 250, 320, 0, 360];

    var options = {
        series: [
            { name: 'Income', data: income },
            { name: 'Expense', data: expense }
        ],
        chart: {
            type: 'bar',
            height: 220,
            stacked: true,
            toolbar: { show: false }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '36%',
                borderRadius: 6,
                // borderRadiusApplication: 'last',
                // borderRadiusWhenStacked: 'end',
            }
        },
        colors: ['#12141B', '#F2F4F5'],
        dataLabels: { enabled: false },
        stroke: {
            show: true,
            width: 1,
            colors: ['#F2F4F5', '#0E0F14']
        },

        stroke: {
            show: true,
            width: 1,
            colors: ['#12141B ', '#E0E0E0']
        },

        fill: { opacity: 1 },
        dataLabels: { enabled: false },
        grid: {
            show: true,
            borderColor: '#E0E0E0',
            strokeDashArray: 6,
            padding: { left: 0, right: 6, top: 0, bottom: 0 }
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            axisBorder: { show: false },
            axisTicks: { show: false },
            labels: {
                style: { colors: '#747C7C', fontSize: '12px' }
            }
        },
        yaxis: {
            max: 2000,
            tickAmount: 5,
            labels: {
                style: { colors: '#747C7C', fontSize: '12px' },
                formatter: function (val) {
                    var labels = ['$0', '$200', '$500', '$1000', '$1500', '$2000'];
                    var step = 2000 / (labels.length - 1);
                    var idx = Math.round(val / step);
                    if (labels[idx] !== undefined) return labels[idx];
                    return '$' + val;
                }
            }
        },
        states: {
            hover: { filter: { type: 'none' } },
            active: { allowMultipleDataPointsSelection: false, filter: { type: 'none' } }
        },
        tooltip: {
            shared: true,
            intersect: false,
            x: {
                formatter: function (val) {
                    var map = {
                        'Jan': 'January 2029', 'Feb': 'February 2029', 'Mar': 'March 2029',
                        'Apr': 'April 2029', 'May': 'May 2029', 'Jun': 'June 2029',
                        'Jul': 'July 2029', 'Aug': 'August 2029', 'Sep': 'September 2029',
                        'Oct': 'October 2029', 'Nov': 'November 2029', 'Dec': 'December 2029'
                    };
                    return map[val] || val;
                }
            },
            y: {
                formatter: function (val) {
                    return '$' + Number(val).toLocaleString();
                }
            },
            style: {
                fontSize: '12px'
            }
        },
        legend: { show: false }
    };

    var chart = new ApexCharts(document.querySelector("#salesChart02"), options);
    chart.render();



})(jQuery)



const centerTextPlugin = {
    id: 'centerText',
    beforeDraw(chart, args, options) {
        const {
            ctx,
            chartArea: {
                width,
                height
            }
        } = chart;
        ctx.save();
        ctx.font = 'bold 14px Arial';
        ctx.fillStyle = '#000';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText(options.text, width / 2, height / 2);
    }
};

Chart.register(centerTextPlugin);

function createCircularChart(ctx, percent, color) {
    return new Chart(document.getElementById(ctx), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [30, 100 - 30],
                backgroundColor: [color, '#eee'],
                borderWidth: 3,
                borderColor: '#fff',
            }]
        },
        options: {
            cutout: '80%',
            rotation: -90,
            circumference: 360,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: false
                },
                centerText: {
                    text: percent + '%'
                }
            },
        },
    });
}

function generateCode() {
    let code = Math.random().toString(36).substring(2, 8).toUpperCase();
    document.getElementById('code-generate').value = code;
}

$(document).on("click", ".add-slot-btn", function () {
    let day = $(this).data("day");
    console.log("Creating routine for:", day);

    // Future: pass day into form
    // localStorage.setItem("selected_day", day);

    $("#routineCreateBtn button").click();
});


