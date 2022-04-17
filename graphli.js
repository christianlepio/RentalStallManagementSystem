$.ajax({
    url: "includes/authsurvey.php",
    type: "GET",
    success: function(data){
        //console.log(data);

        var len = data.length;

        for(var i=0; i<len; i++){
            var sec = 'section'+i;
            var ctx = document.getElementById(sec).getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [data[i].cluster],
                    datasets: [{
                        label: 'Very Satisfied',
                        data: [data[i].vsatisfied],
                        backgroundColor: [
                            '#0d6efd'
                        ],
                        borderColor: [
                            '#0d6efd'
                        ],
                        borderWidth: 1,
                        barThickness: 25,
                    },
                    {
                        label: 'Satisfied',
                        data: [data[i].satisfied],
                        backgroundColor: [
                            '#ffc107'
                        ],
                        borderColor: [
                            '#ffc107'
                        ],
                        borderWidth: 1,
                        barThickness: 25,
                    },
                    {
                        label: 'Neutral',
                        data: [data[i].neutral],
                        backgroundColor: [
                            '#adb5bd'
                        ],
                        borderColor: [
                            '#adb5bd'
                        ],
                        borderWidth: 1,
                        barThickness: 25,
                    },
                    {
                        label: 'Disatisfied',
                        data: [data[i].disatisfied],
                        backgroundColor: [
                            '#dc3545'
                        ],
                        borderColor: [
                            '#dc3545'
                        ],
                        borderWidth: 1,
                        barThickness: 25,
                    }
                
                ]
                },
                
                options: {
                    
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                },
                //plugins: [ChartDataLabels]
            });
        }
    },
    error: function(data){
        console.log(data);
    }
});