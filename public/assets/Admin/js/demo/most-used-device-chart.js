document.addEventListener('DOMContentLoaded', ()=> {
  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';

  // Pie Chart Example
  let ctx = document.querySelector("#most-used-device");

  let myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ["Android", "iOS", "Windows"],
      datasets: [{
        data: [55, 14, 6],
        backgroundColor: ['#4e73df', '#1cc88a', '#d466cd'],
        hoverBackgroundColor: ['#2e59d9', '#17a673', '#d466cd'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },

    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 20,
      },
      legend: {
        display: true
      },
      cutoutPercentage: 70,
    },
  });
})