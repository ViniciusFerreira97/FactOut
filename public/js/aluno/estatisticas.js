$(document).ready(function () {

    var ctxD = document.getElementById("acertos_erros").getContext('2d');
    var myLineChart = new Chart(ctxD, {
      type: 'doughnut',
      data: {
        labels: ["Erros", "Acertos"],
        datasets: [{
          data: [7, 3],
          backgroundColor: ["#FF6961", "#81c784"],
          hoverBackgroundColor: ["#ff4444", "#77DD77"]
        }]
      },
      options: {
        responsive: true
      }
    });

    var ctxD = document.getElementById("taxaReal").getContext('2d');
    var myLineChart = new Chart(ctxD, {
      type: 'doughnut',
      data: {
        labels: ["Erros", "Acertos"],
        datasets: [{
          data: [7, 3],
          backgroundColor: ["#FF6961", "#81c784"],
          hoverBackgroundColor: ["#ff4444", "#77DD77"]
        }]
      },
      options: {
        responsive: true
      }
    });

    var ctxD = document.getElementById("taxaNominal").getContext('2d');
    var myLineChart = new Chart(ctxD, {
      type: 'doughnut',
      data: {
        labels: ["Erros", "Acertos"],
        datasets: [{
          data: [7, 3],
          backgroundColor: ["#FF6961", "#81c784"],
          hoverBackgroundColor: ["#ff4444", "#77DD77"]
        }]
      },
      options: {
        responsive: true
      }
    });

});