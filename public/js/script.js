let ctx = document.getElementById('myChart').getContext('2d');
let labels = ['Trabajos Activos', 'Trabajos Finalizados', 'Trabajos en Proceso'];
let colorHex = ['#FFC300','#C70039','#900C3F'];

let myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        datasets: [{
            data: [30, 20 ,10],
            backgroundColor: colorHex
        }],
        labels: labels
    },
    options: {
        responsive: true
    }
})