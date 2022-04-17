$.ajax({
    url: "includes/auth.php",
    type: "GET",
    success:function(data){
        //console.log(data);

        var values = {
            labels: [],
            available: [],
        }

        for(var i = 0 ; i < data.length ; i++){
            values.labels.push(data[i].cluster_distinct);
            values.available.push(data[i].countCluster);
        }

        //fetching data to chart js
        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: values.labels,
                datasets: [{
                    label: 'Available cluster/section',
                    data: values.available,
                    backgroundColor: [
                        'rgb(255,0,0)',
                        'rgb(128,0,0)',
                        'rgb(255,165,0)',
                        'rgb(255,215,0)',
                        'rgb(0,255,0)',
                        'rgb(135,206,235)',
                        'rgb(0,0,255)',
                        'rgb(25,25,112)',
                        'rgb(238,130,238)',
                        'rgb(139,0,139)',
                        'rgb(0,0,0)',
                        'rgb(128,128,128)',
                        'rgb(139,69,19)',
                        'rgb(255,20,147)',
                        'rgb(127,255,212)'
                    ],
                    borderColor: [
                        'rgb(255,255,255)'
                    ],
                    hoverOffset: 4,
                    
                }]
            },
            options: {
                /*scales: {
                    y: {
                        beginAtZero: true
                    }
                }*/
            }
        });
    },
    error:function(data){
        console.log(data);
    }
});
