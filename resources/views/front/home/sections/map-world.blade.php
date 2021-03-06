<!--<div class="container">		-->
<div class="container">
<!-- section title -->
    <style>

        #regions_div {
            padding-top:20px;
            padding-bottom:20px;
        }

        .rating_scale {
            display: block;
            text-align: center;
            font-size: 0;
        }

        .btn-group {
            width: 100%;
            display:flex !important;
            flex-wrap:wrap;

        }

        .btn-group > .btn-scale, .btn-group > .btn-scale-group {
            border-radius: 5px;
            display: inline-block;
            box-sizing: border-box;
            padding: .8em;
            font-size: 14px;
            color: #EEEEEE;
            font-weight: 500;

        }

        .btn-group > .btn-set#scale-confirmed {
            background: #eee;
            font-size: 20px;
            font-weight: 700;
            color:#800000
        }

        .btn-group > .btn-set#scale-cured {
            background: #eee;
            font-size: 20px;
            font-weight: 700;
            color: #009900
        }

        .btn-group > .btn-set#scale-deaths {
            background: #eee;
            font-size: 20px;
            font-weight: 700;
            color:#555
        }
        .world-map-buttons nav {
            display: flex;
            justify-content: space-between;
        }

        .world-map-buttons button {
            flex:1;

            border-radius: 4px;
            display: inline-block;
            border: none;
            padding: 0.2rem;
            font-size: 18px;
            font-weight: 700;
            text-decoration: none;
            background: #eee;
            cursor: pointer;
            text-align: center;
            transition: background 250ms ease-in-out,
                        transform 150ms ease;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .world-map-buttons  button:hover,
        button:focus {
            background: #d5d5d5;
            outline: 0;
        }

        .world-map-buttons button:focus {
            background: #d8d8d8;
            outline: 0;
           /* box-shadow:1px 1px 4px 1px rgba(200,200,200,0.75);*/
        }

        .world-map-buttons button:active {
            background: #fff;
            outline: 0;
        }

        #scale-confirmed {
            color:#800000;
        }

        #scale-cured {
            color: #4aaf4c;
            margin-left: 1em;
            margin-right: 1em;
        }

        #scale-deaths {
            color:#555
        }

       #scale0 {
           background:#bbb;
       }



    </style>
    <h2 class="section-title wow fadeIn">{{ $form->view->getMenu()['LOCATION_MENU_WORLD']  }}</h2>
    <div class="spacer" data-height="60"></div>
    <div class="row" id='world-map-container'>
        <div class="col-md-12">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-light btn-scale-group btn-set active" id="scale-confirmed">
                    <input type="radio" name="options" checked>{{ $form->view->getMaps()['LOCATION_MAPS_CONFIRMED']  }}
                </label>
                <label class="btn btn-light btn-scale-group btn-set" id="scale-cured">
                    <input type="radio" name="options">{{ $form->view->getMaps()['LOCATION_MAPS_CURED']  }}
                </label>
                <label class="btn btn-light btn-scale-group btn-set" id="scale-deaths">
                    <input type="radio" name="options">{{ $form->view->getMaps()['LOCATION_MAPS_DEATHS']  }}
                </label>
            </div>

            <div id="regions_div"></div>

            <div class="btn-group btn-group-toggle btn-group-confirmed" data-toggle="buttons">
                <label class="btn btn-light btn-all btn-scale-group active" id="scale0">
                    <input type="radio" name="options"checked="">All
                </label>
                @foreach($form->maps->getScales('common') as $option => $estimation)
                <label class="btn btn-light btn-scale" data="{{ $option + 1 }}" id="scale{{ $option + 1 }}">
                    <input type="radio" name="options"><span>{{ $estimation['label'] }}</span>
                </label>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">

    </div>
</div>

<script type="text/javascript">

</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    function checkFit(scale, type, label, item) {
        let axisValue = 0;
        if (scale === 0) {
            axisValue = item[type].scale;
        } else if (scale > 0 && scale === item[type].scale) {
            axisValue = item[type].scale;
        }

        mapsData.push([
            item.location,
            axisValue,
            label + ': ' + item[type].value,
        ]);
    }

    function resetMapsData(test, draw = true) {
        mapsData = [];
        worldData.forEach(function (item) {
            checkFit(test.scale, test.type, test.label, item)
        });

        if (draw === true) {
            drawRegionsMap();
        }
    }

    function changeMapsData(type) {
        if (type === 'cured') {
            useScale.scale = 0;
            useScale.type = 'cured';
            useScale.label = "{{ $form->view->getMaps()['LOCATION_MAPS_CURED']  }}";
            useScale.colors = [
                '#EEEEEE','#D6E5D6','#BEDBBE',
                '#A7D2A7','#8FC88F','#77BF77',
                '#5FB65F','#47AC47','#30A330',
                '#189918','#009000'
            ];
            $(".btn-scale").each(function() {
                var scaleIndex = parseInt($(this).attr('data'));
                $('span', this).text(scaleLabels.common[scaleIndex - 1]);
                $(this).css('backgroundColor', useScale.colors[scaleIndex]);
            });
            resetMapsData(useScale);
        } else if (type === 'deaths') {
            useScale.scale = 0;
            useScale.type = 'deaths';
            useScale.label = "{{ $form->view->getMaps()['LOCATION_MAPS_DEATHS']  }}";
            useScale.colors = [
                '#EEEEEE','#DDDDDD','#CBCBCB',
                '#BABABA','#A9A9A9','#989898',
                '#868686','#757575','#646464',
                '#525252','#414141'
            ];
            $(".btn-scale").each(function() {
                var scaleIndex = parseInt($(this).attr('data'));
                $('span', this).text(scaleLabels.deaths[scaleIndex - 1]);
                $(this).css('backgroundColor', useScale.colors[scaleIndex]);
            });
            resetMapsData(useScale);
        } else {
            useScale.scale = 0;
            useScale.type = 'confirmed';
            useScale.label = "{{ $form->view->getMaps()['LOCATION_MAPS_CONFIRMED']  }}";
            useScale.colors = [
                '#EEEEEE','#E4C8C8','#D9B2B2',
                '#CE9C9C','#C38585','#B86F6F',
                '#AC5959','#A14343','#962C2C',
                '#8B1616','#800000'
            ];
            $(".btn-scale").each(function() {
                var scaleIndex = parseInt($(this).attr('data'));
                $('span', this).text(scaleLabels.common[scaleIndex - 1]);
                $(this).css('backgroundColor', useScale.colors[scaleIndex]);
            });
            resetMapsData(useScale);
        }
    }
    var worldData = {!! json_encode($form->maps->getWorld()) !!};
    var scaleLabels = {
        common: [
            '1 - 500',
            '501 - 1k',
            '1k - 5k',
            '5k - 10k',
            '10k - 50k',
            '50k - 100k',
            '100k - 250k',
            '250k - 500k',
            '500k - 1m',
            '1m+',
        ],
        deaths: [
            '1 - 50',
            '51 - 100',
            '101 - 500',
            '501 - 1k',
            '1k - 5k',
            '5k - 10k',
            '10k - 25k',
            '25k - 50k',
            '50k - 100k',
            '100k+',
        ]
    };
    var useScale = {
        scale: 0,
        type: "confirmed",
        label: "{{ $form->view->getMaps()['LOCATION_MAPS_CONFIRMED']  }}",
        colors: [
            '#EEEEEE','#E4C8C8','#D9B2B2',
            '#CE9C9C','#C38585','#B86F6F',
            '#AC5959','#A14343','#962C2C',
            '#8B1616','#800000'
        ]
    };
    for(let i = 0; i < document.querySelectorAll('.btn-scale').length; i += 1){
        document.querySelectorAll('.btn-scale')[i].style.backgroundColor = useScale.colors[i+1];
    }
    var mapsData = [];
    resetMapsData(useScale, false);

    google.charts.load('current', {
        'packages': ['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
    });
    google.charts.setOnLoadCallback(drawRegionsMap);

    function drawRegionsMap() {
    //    var data = google.visualization.arrayToDataTable(mapsData);
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Country'); // Implicit domain label col.
        data.addColumn('number', 'Value'); // Implicit series 1 data col.
        data.addColumn({type:'string', role:'tooltip'}); //
    /*     data.addRows([
             [{v:"br",f:"Olympia"},1,"Casos ativos: 18313"],
             [{v:"ua",f:"Seattle"},8,"5000"]
         ]);*/

       data.addRows(mapsData);

        var options = {
            title: 'Casos ativos do coronavirus no mundo',
            //    colors: ['#e4c8c8', '#800000'],
            colorAxis: {
                colors: useScale.colors,
                minValue: '0',
                maxValue: '10'
                // values: ['123', '1155','212312','51233','1234','1235','12516','1237','1328','51239']
            },
            backgroundColor: '#f9f9ff',
            legend: 'none'
        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
        chart.draw(data, options);
    }

    $(document).ready(function(){
        $("#scale-confirmed").click(function() {
            changeMapsData('confirmed');
        });
        $("#scale-cured").click(function() {
            changeMapsData('cured');
        });
        $("#scale-deaths").click(function() {
            changeMapsData('deaths');
        });

        //On button click, load new data
        $("#scale0").click(function() {
            useScale.scale = 0;
            resetMapsData(useScale);
        });
        $(".btn-scale").click(function() {
            let element = $(this);
            useScale.scale = parseInt(element.attr('data'));
            resetMapsData(useScale);
        });
    });
</script>

