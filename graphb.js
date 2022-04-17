$.ajax({
    url: "includes/authstats.php",
    type: "GET",
    success:function(data){
        console.log(data);

        var values = {
            year: [],
            labels: [],
            earnings: [],
        }

        for(var i = 0 ; i < data.length ; i++){
            values.year.push(data[i].years);
            values.labels.push(data[i].months);
            values.earnings.push(data[i].tototal);
        }

        //let months = values.labels.filter((item, i, ar) => ar.indexOf(item) === i);

        console.log(data);
        //console.log(values.earnings);

        //fetching data to chart js
        const ctx = document.getElementById('statsChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: values.labels,
                
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        let counter = values.year.filter((item, i, ar) => ar.indexOf(item) === i);
        //console.log(counter);

        for (let index = 0; index < counter.length; index++) {
         
            const newDataset = {
                label: counter[index],
                data: values.earnings,
                backgroundColor: 'rgba(54, 162, 235)',
                borderColor: 'rgba(54, 162, 235)',
                borderWidth: 1,
            };
            myChart.data.datasets.push(newDataset);
            myChart.update();
            
        }
        //console.log(values.earnings1);
    },
    error:function(data){
        console.log(data);
    }
});
/*
const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
const data = {
    labels: labels,
    datasets: [{
        label: 'Weekly Sales',
        data: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
        backgroundColor: [
            'rgba(255, 99, 132)',
            /*'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'*/
//        ],
//            borderColor: [
//            'rgba(255, 99, 132)',
            /*'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'*/
//        ],
//        borderWidth: 1        
//    }]
//};

//const config = {
//    type: 'bar', 
//    data,
//    options:{
//        scales: {
//            y:{
//                beginAtZero: true
//            }
//        }
//    }
//};

//const myChart = new Chart(
//    document.getElementById('statsChart'),
//    config
//);

/*const newDataset = {
    label: 'Dataset #' + (data.datasets.length + 1),
    data: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
    backgroundColor: 'rgba(54, 162, 235, 0.2)',
    borderColor: 'rgba(54, 162, 235, 1)',
    borderWidth: 1,
};
myChart.data.datasets.push(newDataset);
myChart.update();
*/