$.ajax({
    url: "includes/authprob.php",
    type: "GET",
    success: function(data){
        //console.log(data);

        var len = data.length;

        for(var i=0; i<len; i++){
            var sec = 'probsection'+i;
            //console.log(data[i].question);
            var ctx = document.getElementById(sec).getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Yes', 'No'],
                    datasets: [{
                        label: data[i].question,
                        data: [data[i].resyes, data[i].resno],
                        backgroundColor: [
                            '#0d6efd',
                            '#dc3545'
                        ],
                        borderColor: [
                            '#0d6efd',
                            '#dc3545'
                        ],
                        hoverOffset: 6,
                        //borderWidth: 1,
                        //barThickness: 25,
                    }/*,
                    {
                        label: 'No',
                        data: [data[i].resno],
                        backgroundColor: [
                            '#dc3545'
                        ],
                        borderColor: [
                            '#dc3545'
                        ],
                        borderWidth: 1,
                        barThickness: 25,
                    }*/
                
                ]
                },
                
                options: {
                    
                },
                plugins: [ChartDataLabels]
            });
        }
    },
    error: function(data){
        console.log(data);
    }
});