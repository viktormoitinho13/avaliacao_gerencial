<x-app-layout>
    <div class="container d-flex justify-content-center align-items-stretch" style="margin-top: 3%;">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-12">
            <div class="mx-auto mt-auto bg-white rounded shadow card"
                style="border-color: #E2304E; background-color:#e3f0ff1a">
                <div class="text-center card-body ">
                    <div class="text-center row align-items-center">
                        <div class="text-center col-12">
                            @if (!empty($cabecalhoAnual))
                                <h2 class="mt-4">{{ $cabecalhoAnual[0]->CLASSIFICACAO }}</h2>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="container" style="height: 40em;">
                </div>
                        <div class="mx-2 mb-2 text-left">
                           <button onclick="history.go(-1)" class="text-white btn" style="background-color:#E2304E;"> <i class="fa fa-undo" aria-hidden="true"></i> Voltar</button>
                        </div>
                    
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts@5.5.0/dist/echarts.min.js"></script>
    <script type="text/javascript">
        var dom = document.getElementById('container');
        var myChart = echarts.init(dom, null, {
            renderer: 'canvas',
            useDirtyRect: false
        });

        var mediaAnual = @json($mediaAnual);
        var xAxisData = mediaAnual.map(item => item.ANO); // Use years as xAxis categories
        var isDrilldown = false;

        var option = {
            xAxis: {
                type: 'category',
                data: xAxisData, // Use years as xAxis categories
                axisTick: {
                    alignWithLabel: true
                },
                name: 'Anos', // Label for X axis
                nameLocation: 'middle',
                nameTextStyle: {
                    fontSize: 16,
                    padding: 20
                }
            },
            yAxis: {
                name: 'Média', // Label for Y axis
                nameLocation: 'middle',
                nameTextStyle: {
                    fontSize: 16,
                    padding: 40
                }
            },
            dataGroupId: '',
            animationDurationUpdate: 800,
            series: {
                type: 'bar',
                id: 'sales',
                data: mediaAnual.map(item => ({
                    value: item.MEDIA_ANO, // Use MEDIA_ANO as value
                    groupId: item.ANO // Use year as groupId
                })),
                itemStyle: {
                    color: '#E2304E', // Change this to your desired color
                    borderRadius: [10, 10, 0, 0], // Add border-radius to the bars
                    decal: {
                        symbol: 'rect',
                        symbolSize: 4,
                        color: 'rgba(0, 0, 0, 0.2)',
                        dashArrayX: [1, 0],
                        dashArrayY: [2, 5],
                        rotation: Math.PI / 4,
                        maxTileWidth: 8,
                        maxTileHeight: 8
                    }
                },
                label: {
                    show: true,
                    position: 'inside',
                    formatter: '{c}', // Use {c} to show the value
                    fontSize: 20,
                    color: '#000', // Cor do texto preto
                    backgroundColor: '#ecf0f1', // Fundo branco
                    padding: [10, 10], // Padding para distância da borda
                    borderRadius: 10, // Borda arredondada
                    borderWidth: 1, // Largura da borda
                    borderColor: '#000' // Cor da borda
                },
                universalTransition: {
                    enabled: true,
                    divideShape: 'clone'
                }
            }
        };

        const mesData = @json($cabecalhoAnual);

        myChart.on('click', function(event) {
            if (!isDrilldown && event.data) {
                isDrilldown = true; // Set to drilldown state
                var selectedYear = event.data.groupId;
                var monthlyData = mesData.filter(item => item.ANO === selectedYear)
                    .map(item => [item.MES, item.MEDIA]);

                myChart.setOption({
                    xAxis: {
                        data: monthlyData.map(item => item[0]),
                        name: 'Meses', // Update label for X axis
                    },
                    series: {
                        type: 'bar',
                        id: 'sales',
                        data: monthlyData.map(item => item[1]),

                        itemStyle: {
                            color: '#ff4d6b', // Change this to your desired color
                            borderRadius: [10, 10, 0, 0], // Add border-radius to the bars
                            decal: {
                                symbol: 'rect',
                                symbolSize: 4,
                                color: 'rgba(0, 0, 0, 0.2)',
                                dashArrayX: [1, 0],
                                dashArrayY: [2, 5],
                                rotation: Math.PI / 10,
                                maxTileWidth: 1,
                                maxTileHeight: 8
                            }
                        },
                        label: {
                            show: true,
                            position: 'inside',
                            formatter: '{c}', // Use {c} to show the value
                            fontSize: 20,
                            color: '#000', // Cor do texto preto
                            backgroundColor: '#ecf0f1', // Fundo branco
                            padding: [10, 10], // Padding para distância da borda
                            borderRadius: 10, // Borda arredondada
                            borderWidth: 1, // Largura da borda
                            borderColor: '#000' // Cor da borda
                        },

                        universalTransition: {
                            enabled: true,
                            divideShape: 'clone'
                        }
                    },
                    graphic: [{
                        type: 'text',
                        left: 10,
                        top: 20,
                        style: {
                            text: 'Anual',
                            fontSize: 18,
                            textAlign: 'end',
                            textVerticalAlign: 'top',
                            fill: '#000',
                            cursor: 'pointer'
                        },
                        onclick: function() {
                            myChart.setOption(option);
                            isDrilldown = false; // Reset to initial state
                            myChart.setOption({
                                graphic: []
                            });
                        }
                    }]
                });
            }
        });

        if (option && typeof option === 'object') {
            myChart.setOption(option);
        }

        window.addEventListener('resize', myChart.resize);
    </script>

</x-app-layout>
