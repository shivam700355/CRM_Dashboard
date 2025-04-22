@php
    $data = json_encode($data);
@endphp
<script>
    (function($) {
        'use strict';
        $(function() {
            Chart.defaults.global.legend.labels.usePointStyle = true;
            if ($("#traffic-chart").length) {
                var ctx = document.getElementById('traffic-chart').getContext('2d'); // Added ctx variable
                var gradientStrokeBlue = ctx.createLinearGradient(0, 0, 0, 181);
                gradientStrokeBlue.addColorStop(0, 'rgba(54, 215, 232, 1)');
                gradientStrokeBlue.addColorStop(1, 'rgba(177, 148, 250, 1)');
                var gradientLegendBlue =
                    'linear-gradient(to right, rgba(54, 215, 232, 1), rgba(177, 148, 250, 1))';

                var gradientStrokeRed = ctx.createLinearGradient(0, 0, 0, 50);
                gradientStrokeRed.addColorStop(0, 'rgba(255, 191, 150, 1)');
                gradientStrokeRed.addColorStop(1, 'rgba(254, 112, 150, 1)');
                var gradientLegendRed =
                    'linear-gradient(to right, rgba(255, 191, 150, 1), rgba(254, 112, 150, 1))';

                var gradientStrokeGreen = ctx.createLinearGradient(0, 0, 0, 300);
                gradientStrokeGreen.addColorStop(0, 'rgba(6, 185, 157, 1)');
                gradientStrokeGreen.addColorStop(1, 'rgba(132, 217, 210, 1)');
                var gradientLegendGreen =
                    'linear-gradient(to right, rgba(6, 185, 157, 1), rgba(132, 217, 210, 1))';

                var gradientStrokeYellow = ctx.createLinearGradient(0, 0, 0,
                    181); // Adjust start and end points as needed
                gradientStrokeYellow.addColorStop(0, 'rgba(255, 255, 153, 1)'); // Bright yellow
                gradientStrokeYellow.addColorStop(1, 'rgba(255, 213, 79, 1)'); // Golden yellow
                var gradientLegendYellow =
                    'linear-gradient(to right, rgba(255, 255, 153, 1), rgba(255, 213, 79, 1))';

                var trafficChartData = {
                    datasets: [{
                        data: {{$data}},
                        backgroundColor: [
                            gradientStrokeBlue,
                            gradientStrokeGreen,
                            gradientStrokeRed,
                            gradientStrokeYellow
                        ],
                        hoverBackgroundColor: [
                            gradientStrokeBlue,
                            gradientStrokeGreen,
                            gradientStrokeRed,
                            gradientStrokeYellow
                        ],
                        borderColor: [
                            gradientStrokeBlue,
                            gradientStrokeGreen,
                            gradientStrokeRed,
                            gradientStrokeYellow
                        ],
                        legendColor: [
                            gradientLegendBlue,
                            gradientLegendGreen,
                            gradientLegendRed,
                            gradientLegendYellow
                        ]
                    }],

                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: [
                        'Training',
                        'Consultancy',
                        'Retail',
                        'Finance'
                    ]
                };
                var trafficChartOptions = {
                    responsive: true,
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    },
                    legend: false,
                    legendCallback: function(chart) {
                        var text = [];
                        text.push('<ul>');
                        for (var i = 0; i < trafficChartData.datasets[0].data.length; i++) {
                            text.push('<li><span class="legend-dots" style="background:' +
                                trafficChartData.datasets[0].legendColor[i] +
                                '"></span>');
                            if (trafficChartData.labels[i]) {
                                text.push(trafficChartData.labels[i] + ': ');
                            }
                            text.push('<span class="float-right">' + trafficChartData.datasets[0]
                                .data[i] + "" + '</span>')
                            text.push('</li>');
                        }
                        text.push('</ul>');
                        return text.join('');
                    }
                };
                var trafficChartCanvas = $("#traffic-chart").get(0).getContext("2d");
                var trafficChart = new Chart(trafficChartCanvas, {
                    type: 'doughnut',
                    data: trafficChartData,
                    options: trafficChartOptions
                });
                $("#traffic-chart-legend").html(trafficChart.generateLegend());
            }
            if ($("#inline-datepicker").length) {
                $('#inline-datepicker').datepicker({
                    enableOnReadonly: true,
                    todayHighlight: true,
                });
            }
        });
    })(jQuery);
</script>
