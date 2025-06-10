@extends('frontend.turismometro.layouts.app')

@section('title', __('Dashboard'))

@section('content')

        <!-- ===== Data Stats Start ===== -->
        <div class="mb-5 flex items-center justify-between">
          <div>
            <h2 class="mb-1.5 text-title-md2 font-bold text-black dark:text-white">
              Indicadores Externos
            </h2>
            
          </div>
          <div x-data="{openDropDown: false}" class="relative">
            
          </div>
        </div>

        <div class="flex flex-row w-full mb-4">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark w-full">
            
          
            <div class="flex flex-row gap-5.5 p-6.5">
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                  <div class="w-full xl:w-1/2">
                    <label class="mb-1 block text-sm font-medium text-black dark:text-white">
                      Período
                    </label>
                    <div
                      class="relative"
                      id="periodo-inicio"
                      data-te-input-wrapper-init>
                      <input
                        type="text"
                        name="periodo_inicio"
                        id="periodo_inicio"
                        class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                        value="{{ date('d/m/Y', strtotime('-7 days'))}}" />
                    </div>
                  </div>

                  <div class="w-full xl:w-1/2">
                    <label class="mb-1 block text-sm font-medium text-black dark:text-white">&nbsp;
                    </label>
                    <div
                      class="relative"
                      id="periodo-fim"
                      data-te-input-wrapper-init>
                      <input
                        type="text"
                        name="periodo_fim"
                        id="periodo_fim"
                        class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                        value="{{ date('d/m/Y')}}" />
                    </div>
                  </div>
                </div>

                <div>
                  <label class="mb-1 block text-sm font-medium text-black dark:text-white">
                    Região
                  </label>
                  <select
                    class="form-control"
                    name="choices-regiao"
                    id="choices-regiao"
                    placeholder="Selecione uma região"
                    multiple
                  >
                  </select>
                </div>

                <div>
                  <label class="mb-1 block text-sm font-medium text-black dark:text-white">
                    Roteiro/Segmento
                  </label>
                  <select
                    class="form-control"
                    name="choices-roteiro"
                    id="choices-roteiro"
                    placeholder="Selecione um roteiro"
                    multiple
                  >
                  </select>
                </div>

                <div>
                  <label class="mb-1 block text-sm font-medium text-black dark:text-white">
                    Município
                  </label>
                  <select
                    class="input-observatorio"
                    name="choices-municipio"
                    id="choices-municipio"
                    placeholder="Selecione um município"
                    multiple
                  >
                  </select>
                </div>
                <div>
                  <label class="mb-1 block text-sm font-medium text-black dark:text-white">
                    Porte
                  </label>
                  <input type="text"
                    class="input-observatorio"
                    name="porte-inicial"
                    id="porte-inicial"
                    />
                  
                  <input type="text"
                    class="input-observatorio"
                    name="porte-final"
                    id="porte-final"
                     />

                </div>

                <div>
                  <label class="mb-1 block text-sm font-medium text-black dark:text-white">
                    Preço Médio
                  </label>
                  <input type="text"
                    class="input-observatorio"
                    name="preco-medio-inicial"
                    id="preco-medio-inicial"
                    />
                  
                  <input type="text"
                    class="input-observatorio"
                    name="preco-medio-final"
                    id="preco-medio-final"
                     />

                </div>

                <div class="text-center sm:px-2 lg:px-2">
                    <button class="justify-center rounded bg-primary p-3 font-medium text-gray" id="btn-registrar" type="button">
                      Adicionar Coluna
                    </button>
                </div>

              </div>
            </div>
        </div>

        <div class="flex flex-row">
        
          <div class="flex flex-col w-full">
                <div class="col-span-12 rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-12 sm:w-4/4">
                  <div class="py-3 px-2 text-right">
                    <div>
                      <h2 class="mb-1.5 text-title-md2 font-bold text-black dark:text-white">
                        Quantidade Diária por Idade
                      </h2>
                      
                    </div>
                  </div>
                    
                  <div class="py-3 px-2">
                    <canvas id="chartQtdeIdade" width="400" height="200"></canvas>
                  </div>
                </div>

                <div class="col-span-12 rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-12 sm:w-4/4 mt-6">
                  <div class="py-3 px-2 text-right">
                    <div>
                      <h2 class="mb-1.5 text-title-md2 font-bold text-black dark:text-white">
                      Faturamento Diário por Idade
                      </h2>
                      
                    </div>
                  </div>
                    
                  <div class="py-3 px-2">
                    <canvas id="chartFaturamentoIdade" width="400" height="200"></canvas>
                  </div>
                </div>

                <div class="col-span-12 rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-12 sm:w-4/4 mt-6">
                  <div class="py-3 px-2 text-right">
                    <div>
                      <h2 class="mb-1.5 text-title-md2 font-bold text-black dark:text-white">
                      % Mercado por Idade
                      </h2>
                      
                    </div>
                  </div>
                    
                  <div class="py-3 px-2">
                    <canvas id="chartMercadoIdade" width="400" height="200"></canvas>
                  </div>
                </div>                

                <div class="col-span-12 rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-12 sm:w-4/4 mt-6">
                  <div class="py-3 px-2 text-right">
                    <div>
                      <h2 class="mb-1.5 text-title-md2 font-bold text-black dark:text-white">
                        Quantidade Diária por Tipo de Ingresso
                      </h2>
                      
                    </div>
                  </div>
                    
                  <div class="py-3 px-2">
                    <canvas id="chartQtdeTipo" width="400" height="200"></canvas>
                  </div>
                </div>

                <div class="col-span-12 rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-12 sm:w-4/4 mt-6">
                  <div class="py-3 px-2 text-right">
                    <div>
                      <h2 class="mb-1.5 text-title-md2 font-bold text-black dark:text-white">
                        Faturamento Diários por Tipo de Ingresso
                      </h2>
                      
                    </div>
                  </div>
                    
                  <div class="py-3 px-2">
                    <canvas id="chartFaturamentoTipo" width="400" height="200"></canvas>
                  </div>
                </div>

                <div class="col-span-12 rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-12 sm:w-4/4 mt-6">
                  <div class="py-3 px-2 text-right">
                    <div>
                      <h2 class="mb-1.5 text-title-md2 font-bold text-black dark:text-white">
                        % Mercado por Tipo de Ingresso
                      </h2>
                      
                    </div>
                  </div>
                    
                  <div class="py-3 px-2">
                    <canvas id="chartMercadoTipo" width="400" height="200"></canvas>
                  </div>
                </div>

          </div>


        </div>
        <!-- ===== Data Stats End ===== -->

        <div class="mt-7.5 grid grid-cols-12">
          
          
        </div>

<script>


function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function checkCookie() {
  let user = getCookie("username");
  if (user != "") {
    alert("Welcome again " + user);
  } else {
    user = prompt("Please enter your name:", "");
    if (user != "" && user != null) {
      setCookie("username", user, 365);
    }
  }
}

function deleteFilter(index) {
  let turismometroFilter = getCookie('turismometroFilter');
  if (turismometroFilter != "") {
    turismometroFilter = JSON.parse(turismometroFilter);
    turismometroFilter.splice(index, 1);

    setCookie('turismometroFilter', JSON.stringify(turismometroFilter), 7);
    gerarGrafico(); 
  } 
}

function gerarGrafico() {
  const turismometroFilter = getCookie('turismometroFilter');
  if (turismometroFilter != '') {

    const filtros = JSON.parse(turismometroFilter);

    axios.post("{{ route('frontend.turismometro.atrativo.gerar-grafico-externo') }}", filtros)
      .then(function (response) {
        chartAtrativoQtdeIdade.data = response.data.quantitativoIdade;
        chartAtrativoQtdeIdade.update();

        chartAtrativoFaturamentoIdade.data = response.data.faturamentoIdade;
        chartAtrativoFaturamentoIdade.update();

        chartAtrativoMercadoIdade.data = response.data.mercadoIdade;
        chartAtrativoMercadoIdade.update();

        chartAtrativoQtdeTipo.data = response.data.quantitativoTipo;
        chartAtrativoQtdeTipo.update();

        chartAtrativoFaturamentoTipo.data = response.data.faturamentoTipo;
        chartAtrativoFaturamentoTipo.update();

        chartAtrativoMercadoTipo.data = response.data.mercadoTipo;
        chartAtrativoMercadoTipo.update();
      })
      .catch(function (error) {
        //console.log(error);
      });
/*
      const chartLegend = document.getElementById('chart-legend-grid');
      chartLegend.innerHTML = '';

      for (var j = 0; j < filtros.length; j++) {
        let divFiltro = '';

        divFiltro += "<div class='flex'><h5 class='mt-0 text-xl font-bold text-primary'>Coluna "+ (j+1) +" </h5>";

        divFiltro += '<a class="ml-auto p-1 rounded-lg bg-danger-100 text-base text-danger-700" href="#" id="btn-delete-filter-'+j+'" onclick="deleteFilter('+j+');return false;">'+
          '<span class="w-[1em] focus:opacity-100 disabled:pointer-events-none disabled:select-none disabled:opacity-25 [&.disabled]:pointer-events-none [&.disabled]:select-none [&.disabled]:opacity-25">'+
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">'+
              '<path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />'+
            '</svg>'+
          '</span>'+
        '</a></div>';
        
        if (filtros[j]['inicio'] && filtros[j]['inicio'].length > 0) {
          divFiltro += "<p class='text-md font-semibold'>Período</p>";
          divFiltro += "<p class='text-sm font-light'>" + filtros[j]['inicio'] + " - " + filtros[j]['fim'] + "</p>";
        }
        
        if (filtros[j]['municipio'] && filtros[j]['municipio'].length > 0) {
          divFiltro += "<p class='text-md font-semibold'>Municípios</p>";
          let strMun = '';
          filtros[j]['municipio'].map(function(entryMunicipio) {
            strMun += entryMunicipio.label + " | ";
          });
          divFiltro += "<p class='text-sm font-light'>"+strMun+"</p>";
        }

        if (filtros[j]['regiao'] && filtros[j]['regiao'].length > 0) {
          divFiltro += "<p class='text-md font-semibold'>Regiões</p>";
          let strRegiao = '';
          filtros[j]['regiao'].map(function(entryRegiao) {
            strRegiao += entryRegiao.label + " | ";
          });
          divFiltro += "<p class='text-sm font-light'>"+strRegiao+"</p>";
        }

        if (filtros[j]['roteiro'] && filtros[j]['roteiro'].length > 0) {
          divFiltro += "<p class='text-md font-semibold'>Roteiros</p>";
          let strRoteiro = '';
          filtros[j]['roteiro'].map(function(entryRoteiro) {
            strRoteiro += entryRoteiro.label + "<BR/>";
          });
          divFiltro += "<p class='text-sm font-light'>"+strRoteiro+"</p>";
        }

        chartLegend.innerHTML += "<div class='mb-12 md:mb-0 shadow-md p-3 bg-white'>" + divFiltro + "</div>";
      }
        */
    }
}

var chartAtrativoQtdeIdade;
var chartAtrativoFaturamentoIdade;
var chartAtrativoMercadoIdade;
var chartAtrativoQtdeTipo;
var chartAtrativoFaturamentoTipo;
var chartAtrativoMercadoTipo;

document.addEventListener('DOMContentLoaded', function () {
    gerarGrafico();

    const ctxQtdeIdade = document.getElementById('chartQtdeIdade');
    chartAtrativoQtdeIdade = new Chart(ctxQtdeIdade, {
      type: 'bar',
      data: [],
      options: {
        scales: {
          x: {
            stacked: true,
          },
          y: {
            stacked: true
          }
        }
      },
    });

    const ctxFaturamentoIdade = document.getElementById('chartFaturamentoIdade');
    chartAtrativoFaturamentoIdade = new Chart(ctxFaturamentoIdade, {
      type: 'bar',
      data: [],
      options: {
        scales: {
          x: {
            stacked: true,
          },
          y: {
            stacked: true
          }
        }
      },
    });

    const ctxMercadoIdade = document.getElementById('chartMercadoIdade');
    chartAtrativoMercadoIdade = new Chart(ctxMercadoIdade, {
      type: 'bar',
      data: [],
      options: {
        scales: {
          x: {
            stacked: true,
          },
          y: {
            stacked: true
          }
        },
        plugins: {
            legend: {
                onClick: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.dataset.label || '';

                        if (label) {
                            label += ': ';
                        }
                        if (context.parsed.y !== null) {
                            //label += new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(context.parsed.y);
                            label += new Intl.NumberFormat('pt-BR').format(context.parsed.y) + "%";
                        }
                        return label;
                    }
                }
            }
        },
      },
    });

    const ctxQtdeTipo = document.getElementById('chartQtdeTipo');
    chartAtrativoQtdeTipo = new Chart(ctxQtdeTipo, {
      type: 'bar',
      data: [],
      options: {
        scales: {
          x: {
            stacked: true,
          },
          y: {
            stacked: true
          }
        }
      },
    });

    const ctxFaturamentoTipo = document.getElementById('chartFaturamentoTipo');
    chartAtrativoFaturamentoTipo = new Chart(ctxFaturamentoTipo, {
      type: 'bar',
      data: [],
      options: {
        scales: {
          x: {
            stacked: true,
          },
          y: {
            stacked: true
          }
        }
      },
    });

    const ctxMercadoTipo = document.getElementById('chartMercadoTipo');
    chartAtrativoMercadoTipo = new Chart(ctxMercadoTipo, {
      type: 'bar',
      data: [],
      options: {
        scales: {
          x: {
            stacked: true,
          },
          y: {
            stacked: true
          }
        }
      },
    });


    const periodoInicio = document.getElementById('periodo-inicio');
    new Datepicker(periodoInicio, {
      confirmDateOnSelect: true,
    });

    const periodoFim = document.getElementById('periodo-fim');
    new Datepicker(periodoFim, {
      confirmDateOnSelect: true,
    });

    var choicesRegiao = new Choices('#choices-regiao', {
      allowHTML: true,
      removeItemButton: true,
      searchChoices: false,
      searchFloor: 3,
      searchPlaceholderValue: "Buscar região",
      noResultsText: 'Nenhum resultado encontrado',
          noChoicesText: 'Nenhuma opção para escolher',
          itemSelectText: 'Clique para selecionar',
    });

    var choicesRoteiro = new Choices('#choices-roteiro', {
      allowHTML: true,
      removeItemButton: true,
      searchChoices: false,
      searchFloor: 3,
      searchPlaceholderValue: "Buscar roteiro",
      noResultsText: 'Nenhum resultado encontrado',
          noChoicesText: 'Nenhuma opção para escolher',
          itemSelectText: 'Clique para selecionar',
    });

    var choicesMunicipio = new Choices('#choices-municipio', {
      allowHTML: true,
      removeItemButton: true,
      searchChoices: false,
      searchFloor: 3,
      searchPlaceholderValue: "Buscar município",
      noResultsText: 'Nenhum resultado encontrado',
          noChoicesText: 'Nenhuma opção para escolher',
          itemSelectText: 'Clique para selecionar',
    });


    choicesMunicipio.passedElement.element.addEventListener(
      "search", 
      async function (event) {
        let data = await axios.get(`/api/get-municipios?q=${event.detail.value}`)
            .then(function(data) {
              return data.data.data.map(function(item) {
                return { label:  item.nome_municipio + " - " + item.sigla, value: item.id };
              });
            });
        choicesMunicipio.clearChoices();
        choicesMunicipio.setChoices(data, "value", "label", false);
      }, 
      false
    );


    choicesRoteiro.passedElement.element.addEventListener(
      "search", 
      async function (event) {
        let data = await axios.get(`/api/get-roteiros?q=${event.detail.value}`)
            .then(function(data) {
              return data.data.data.map(function(item) {
                return { label:  item.nome, value: item.id };
              });
            });
        choicesRoteiro.clearChoices();
        choicesRoteiro.setChoices(data, "value", "label", false);
      }, 
      false
    );

    choicesRegiao.passedElement.element.addEventListener(
      "search", 
      async function (event) {
        let data = await axios.get(`/api/get-regioes?q=${event.detail.value}`)
            .then(function(data) {
              return data.data.data.map(function(item) {
                return { label:  item.nome, value: item.id };
              });
            });

        choicesRegiao.clearChoices();
        choicesRegiao.setChoices(data, "value", "label", false);
      }, 
      false
    );

    /*
    const btnGerarGrafico = document.getElementById('btn-gerar-grafico');
    btnGerarGrafico.addEventListener("click", function () {
      gerarGrafico();
    });
    */

    const btnRegistrar = document.getElementById('btn-registrar');
    btnRegistrar.addEventListener("click", function () {
      let turismometroFilter = getCookie('turismometroFilter');
      if (turismometroFilter != "") {
        turismometroFilter = JSON.parse(turismometroFilter);
      } else {
        turismometroFilter = [];
      }

      const municipioArray = [];
      choicesMunicipio.getValue().map(function(entryMunicipio) {
        municipioArray.push({'label': entryMunicipio.label,'value': entryMunicipio.value});
      });

      const regiaoArray = [];
      choicesRegiao.getValue().map(function(entryRegiao) {
        regiaoArray.push({'label': entryRegiao.label,'value': entryRegiao.value});
      });

      const roteiroArray = [];
      choicesRoteiro.getValue().map(function(entryRoteiro) {
        roteiroArray.push({'label': entryRoteiro.label,'value': entryRoteiro.value});
      });

      let objFilter = {
        'municipio': municipioArray,
        'regiao':regiaoArray,
        'roteiro':roteiroArray,
        'inicio':document.getElementById('periodo_inicio').value,
        'fim':document.getElementById('periodo_fim').value
      }

      //turismometroFilter.push(objFilter);
      setCookie('turismometroFilter', JSON.stringify(objFilter), 7);
      gerarGrafico(); 
    });

}, true);
</script>

@endsection

@push('after-scripts')
@endpush