<canvas id="myChart2" width="100%" height="20"></canvas>
<script>
    $(function () {
        var days = [];
        var data = [];
        @foreach($days as $value)
         {{ $value }}
         days.push( "{{ $value }}");
        @endforeach
        @foreach($num as $value)
         {{ $value }}
         data.push( "{{ $value }}");
        @endforeach 
        var ctx = document.getElementById("myChart2").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: days,
                datasets: [{
                    label: '人数/个',
                    data: data,
                    backgroundColor: [ 
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [ 
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    });
</script>