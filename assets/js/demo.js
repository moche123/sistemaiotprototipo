type = ['','info','success','warning','danger'];
tempactual = document.getElementById('tempactual')
humedactual = document.getElementById('humedactual')

demo = {
    initPickColor: function(){
        $('.pick-class-label').click(function(){
            var new_class = $(this).attr('new-class');
            var old_class = $('#display-buttons').attr('data-class');
            var display_div = $('#display-buttons');
            if(display_div.length) {
            var display_buttons = display_div.find('.btn');
            display_buttons.removeClass(old_class);
            display_buttons.addClass(new_class);
            display_div.attr('data-class', new_class);
            }
        });
    },

    checkScrollForTransparentNavbar: debounce(function() {
            $navbar = $('.navbar[color-on-scroll]');
            scroll_distance = $navbar.attr('color-on-scroll') || 500;

            if($(document).scrollTop() > scroll_distance ) {
                if(transparent) {
                    transparent = false;
                    $('.navbar[color-on-scroll]').removeClass('navbar-transparent');
                    $('.navbar[color-on-scroll]').addClass('navbar-default');
                }
            } else {
                if( !transparent ) {
                    transparent = true;
                    $('.navbar[color-on-scroll]').addClass('navbar-transparent');
                    $('.navbar[color-on-scroll]').removeClass('navbar-default');
                }
            }
    }, 17),

   

    initChartist: function(){
     
        
         var dataSales = {
          labels: [],
          series: [[]]
         };
         var dataSales2 = {
          labels: [],
          series: [[]]
         };
         function reload(){
          dataSales.labels=[]
          dataSales.series = [[]]
          dataSales2.labels=[]
          dataSales2.series = [[]]
          
          fetch('http://localhost/iot/datos.php')           
          .then(res => res.json())
          .then(datos=>{
           
              if(datos.length>=10){
                inicio = datos.length-9
                dataSales.series = [[]]
               
              }
             
              for (let index = inicio; index < datos.length; index++) {
                  let tiempo = (datos[index].fecha).substring(10,16)
                 
                  dataSales.labels.push(tiempo)
                  dataSales2.labels.push(tiempo)
                  dataSales.series.forEach(element => {
                      element.push(datos[index].temperatura)
                 
                  });
                  dataSales2.series.forEach(element => {
                    element.push(datos[index].humedad)
               
                });             
                  
              }
              
              var optionsSales = {
                lineSmooth: false,
                low: 0,
                high: 100,
                showArea: true,
                height: "245px",
                axisX: {
                  showGrid: false,
                },
                lineSmooth: Chartist.Interpolation.simple({
                  divisor: 2
                }),
                showLine: false,
                showPoint: false,
              };
      
              var responsiveSales = [
                ['screen and (max-width: 640px)', {
                  axisX: {
                    labelInterpolationFnc: function (value) {
                      return value[0];
                    }
                  }
                }]
              ];
             
              tempactual.innerHTML = datos[datos.length-1].temperatura+" °C"
              humedactual.innerHTML = datos[datos.length-1].humedad+"%"
              Chartist.Line('#chartHours', dataSales, optionsSales, responsiveSales)
              Chartist.Line('#chartHours2', dataSales2, optionsSales, responsiveSales)

          })
         
        }
        reload()
         setInterval(() => {
          reload()
          console.log('actualizo')
        }, 5000);
       
         
      
       


        var data = {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          series: [
            [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895],
            [412, 243, 280, 580, 453, 353, 300, 364, 368, 410, 636, 695]
          ]
        };

        var options = {
            seriesBarDistance: 10,
            axisX: {
                showGrid: false
            },
            height: "245px"
        };

        var responsiveOptions = [
          ['screen and (max-width: 640px)', {
            seriesBarDistance: 5,
            axisX: {
              labelInterpolationFnc: function (value) {
                return value[0];
              }
            }
          }]
        ];

        Chartist.Bar('#chartActivity', data, options, responsiveOptions);

        var dataPreferences = {
            series: [
                [25, 30, 20, 25]
            ]
        };

        var optionsPreferences = {
            donut: true,
            donutWidth: 40,
            startAngle: 0,
            total: 100,
            showLabel: false,
            axisX: {
                showGrid: false
            }
        };

        Chartist.Pie('#chartPreferences', dataPreferences, optionsPreferences);

        Chartist.Pie('#chartPreferences', {
          labels: ['62%','32%','6%'],
          series: [62, 32, 6]
        });
    },

    initGoogleMaps: function(){
        var myLatlng = new google.maps.LatLng(40.748817, -73.985428);
        var mapOptions = {
          zoom: 13,
          center: myLatlng,
          scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
          styles: [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}]

        }
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            title:"Hello World!"
        });

        // To add the marker to the map, call setMap();
        marker.setMap(map);
    },



}
