// bar, horizontalBar, pie, line, doughnut, radar, polarArea

Chart.defaults.global.defaultFontSize = 21;
Chart.defaults.global.defaultFontColor = '#000';

function yearSells(ElementId,invitation,divers,title) {


    var config = {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Invitation",
                backgroundColor: 'rgba(244,64,54,1)',
                borderColor: 'rgba(244,64,54,1)',
                data: [invitation],
                fill: false,
                borderWidth: 8
            }, {
                label: "Diver",
                backgroundColor: 'rgba(5,146,10,1)',
                borderColor: '#00a516',
                data: [divers],
                borderWidth: 8,
                fill: false
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: title,
                fontSise: 29
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: false,
                        labelString: 'Value'
                    },
                    ticks: {
                        min: 0,
                        max: 100,

                        // forces step size to be 5 units
                        stepSize: 5
                    }
                }]
            }
        }
    };
    //
    var ctx = document.getElementById(ElementId).getContext("2d");
    window.myLine = new Chart(ctx, config);

}


/////////////////////////////////////////////////////////////////////////////////////////////////



function BalanceYear(ElementId) {


    var config = {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"],
            datasets:  [{
                label: "Invitation",
                backgroundColor: 'rgba(244,64,54,1)',
                borderColor: 'rgba(244,64,54,1)',
                data: [1, 21, 3, 4, 5, 26, 47, 8, 94, 65, 92, 91],
                fill: false,
                borderWidth: 8
            }, {
                label: "Diver",
                backgroundColor: 'rgba(5,146,10,1)',
                borderColor: '#00a516',
                data: [1, 28, 3, 4, 5, 96, 7, 8, 59, 0, 11, 12],
                borderWidth: 8,
                fill: false
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'ANTARES',
                fontSise: 29
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    },
                    ticks: {
                        min: 0,
                        max: 100,

                        // forces step size to be 5 units
                        stepSize: 5
                    }
                }]
            }
        }
    };
    //
    var ctx = document.getElementById(ElementId).getContext("2d");
    window.myLine = new Chart(ctx, config);

}


/////////////////////////////////////////////////////////////////////////////////////////////////


function monthSellsPie(ElementId) {


            var config = {
            type: 'doughnut',
            data: {
                labels: ["Invitation", "Divers"],
                datasets: [{
                    label: "Invitation",
                    backgroundColor:['rgba(244,64,54,1)','#04b11b'],
                    borderColor:['rgba(244,64,54,1)','#04b11b'],
                    data: [50, 50],
                    fill: false,
                    borderWidth:6
                }]
            },
            options: {
                responsive: true,
                title:{
                    display:true,
                    text:'ANTARES',
                    fontSise: 29
                },
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltips: {
                    mode: 'index',
                    intersect: true,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: false,
                        scaleLabel: {
                            display: false,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        scaleLabel: {
                            display: false,
                            labelString: 'Value'
                        },
                        ticks: {
                            min: 0,
                            max: 100,

                            // forces step size to be 5 units
                            stepSize: 5
                        }
                    }]
                }
            }
        };
        //
        var ctx = document.getElementById(ElementId).getContext("2d");
        window.myLine = new Chart(ctx, config);

    }


/////////////////////////////////////////////////////////////////////////////////////////////////


function balancePie(ElementId) {


            var config = {
            type: 'bar',
            data: {
                labels: ["Payed", "Unpayed", "Others"],
                datasets: [{
                    label: "Invitation",
                    backgroundColor: ['rgba(244,64,54,1)', '#04b11b', '#FF9800'],
                    borderColor: ['rgba(244,64,54,1)', '#04b11b', '#FF9800'],
                    data: [40, 35, 25],
                    fill: false,
                    borderWidth:6
                }]
            },
            options: {
                responsive: true,
                title:{
                    display:true,
                    text:'ANTARES',
                    fontSise: 29
                },
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltips: {
                    mode: 'index',
                    intersect: true,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: false,
                        scaleLabel: {
                            display: false,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        scaleLabel: {
                            display: false,
                            labelString: 'Value'
                        },
                        ticks: {
                            min: 0,
                            max: 100,

                            // forces step size to be 5 units
                            stepSize: 5
                        }
                    }]
                }
            }
        };
        //
        var ctx = document.getElementById(ElementId).getContext("2d");
        window.myLine = new Chart(ctx, config);

    }


    /////////////////////////////////////////////////////////////////////////////////////////////////

    //
    // function monthSellsPie(ElementId) {
    //
    //
    //             var config = {
    //             type: 'doughnut',
    //             data: {
    //                 labels: ["Invitation", "Divers"],
    //                 datasets: [{
    //                     label: "Invitation",
    //                     backgroundColor:['rgba(244,64,54,1)','#04b11b'],
    //                     borderColor:['rgba(244,64,54,1)','#04b11b'],
    //                     data: [50, 50],
    //                     fill: false,
    //                     borderWidth:6
    //                 }]
    //             },
    //             options: {
    //                 responsive: true,
    //                 title:{
    //                     display:true,
    //                     text:'ANTARES',
    //                     fontSise: 29
    //                 },
    //                 legend: {
    //                     display: true,
    //                     position: 'top'
    //                 },
    //                 tooltips: {
    //                     mode: 'index',
    //                     intersect: true,
    //                 },
    //                 hover: {
    //                     mode: 'nearest',
    //                     intersect: true
    //                 },
    //                 scales: {
    //                     xAxes: [{
    //                         display: false,
    //                         scaleLabel: {
    //                             display: false,
    //                             labelString: 'Month'
    //                         }
    //                     }],
    //                     yAxes: [{
    //                         display: false,
    //                         scaleLabel: {
    //                             display: false,
    //                             labelString: 'Value'
    //                         },
    //                         ticks: {
    //                             min: 0,
    //                             max: 100,
    //
    //                             // forces step size to be 5 units
    //                             stepSize: 5
    //                         }
    //                     }]
    //                 }
    //             }
    //         };
    //         //
    //         var ctx = document.getElementById(ElementId).getContext("2d");
    //         window.myLine = new Chart(ctx, config);
    //
    //     }
    //

    /////////////////////////////////////////////////////////////////////////////////////////////////


    function balancePie(ElementId) {



                      var config = {
                      type: 'pie',
                      data: {
                          labels: ["Invitation", "Divers"],
                          datasets: [{
                              label: "Invitation",
                              backgroundColor:['rgba(244,64,54,1)','#04b11b'],
                              borderColor:['rgba(244,64,54,1)','#04b11b'],
                              data: [70, 30],
                              fill: false,
                              borderWidth:6
                          }]
                      },
                      options: {
                          responsive: true,
                          title:  { display:false },
                          legend: { display: false },
                          tooltips: {
                              mode: 'index',
                              intersect: true,
                          },
                          hover: {
                              mode: 'nearest',
                              intersect: true
                          },

                      }
                  };
                  //
                  var ctx = document.getElementById(ElementId).getContext("2d");
                  window.myLine = new Chart(ctx, config);

        }
