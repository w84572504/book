<canvas id="myChart" width="100%" height="20"></canvas>

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
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: days,
                datasets: [{
                    label: '金额/元',
                    data: data,
                    backgroundColor: [ 
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [  
                        'rgba(75, 192, 192, 1)'
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