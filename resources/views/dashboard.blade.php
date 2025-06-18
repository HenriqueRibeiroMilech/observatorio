<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Observatório</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Observatório Serra Gaúcha</h1>
                    <p class="text-sm text-gray-500">Dashboard de Análise de Dados</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2 bg-gray-50 rounded-lg p-1">
                        <input
                            type="number"
                            id="idInput"
                            value="{{ $id }}"
                            placeholder="Digite o ID"
                            class="w-32 px-4 py-2 bg-white border border-gray-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <button
                            onclick="trocarId()"
                            class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-semibold rounded-md hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-sm hover:shadow-md">
                            🔍 Analisar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(isset($erro))
        <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
            <div class="text-red-800">{{ $erro }}</div>
        </div>
        @else


        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Gráfico de Gênero -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Distribuição por Gênero</h3>
                </div>
                <div class="p-6">
                    <div style="height: 550px;">
                        {!! $graficos['genero']->container() !!}
                    </div>
                </div>
            </div>

            @if(isset($graficos['faixaEtaria']))
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Distribuição por Faixa Etária</h3>
                </div>
                <div class="p-6">
                    <div style="height: 550px;">
                        {!! $graficos['faixaEtaria']->container() !!}
                    </div>
                </div>
            </div>
            @endif

            @if(isset($graficos['formacaoEscolar']))
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Distribuição por Formação Escolar</h3>
                </div>
                <div class="p-6">
                    <div style="height: 550px;">
                        {!! $graficos['formacaoEscolar']->container() !!}
                    </div>
                </div>
            </div>
            @endif

            @if(isset($graficos['rendaPessoal']))
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Distribuição por Renda Pessoal</h3>
                </div>
                <div class="p-6">
                    <div style="height: 550px;">
                        {!! $graficos['rendaPessoal']->container() !!}
                    </div>
                </div>
            </div>
            @endif

            @if(isset($graficos['profissoes']))
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Distribuição por Profissão</h3>
                </div>
                <div class="p-6">
                    <div style="height: 550px;">
                        {!! $graficos['profissoes']->container() !!}
                    </div>
                </div>
            </div>
            @endif

            <!-- Gráfico de Estados -->
            @if(isset($graficos['estadosBarra']))
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Estados de Origem</h3>
                </div>
                <div class="p-6">
                    <div style="height: 550px;">
                        {!! $graficos['estadosBarra']->container() !!}
                    </div>
                </div>
            </div>
            @endif

            @if(isset($graficos['estadosPizza']))
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Estados de Origem</h3>
                </div>
                <div class="p-6">
                    <div style="height: 550px;">
                        {!! $graficos['estadosPizza']->container() !!}
                    </div>
                </div>
            </div>
            @endif

            @if(isset($graficos['paisBarra']))
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">País de Residência</h3>
                </div>
                <div class="p-6">
                    <div style="height: 550px;">
                        {!! $graficos['paisBarra']->container() !!}
                    </div>
                </div>
            </div>
            @endif

            @if(isset($graficos['paisPizza']))
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">País de Residência</h3>
                </div>
                <div class="p-6">
                    <div style="height: 550px;">
                        {!! $graficos['paisPizza']->container() !!}
                    </div>
                </div>
            </div>
            @endif

            @if(isset($graficos['municipios']))
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Município de Residência</h3>
                </div>
                <div class="p-6">
                    <div style="height: 550px;">
                        {!! $graficos['municipios']->container() !!}
                    </div>
                </div>
            </div>
            @endif

            @if(isset($graficos['conhecimentoPrevio']))
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Conhecimento Prévio do Destino</h3>
                </div>
                <div class="p-6">
                    <div style="height: 550px;">
                        {!! $graficos['conhecimentoPrevio']->container() !!}
                    </div>
                </div>
            </div>
            @endif

            @if(isset($graficos['fontesReferencia']))
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Fontes de Referência (Menções Múltiplas)</h3>
                </div>
                <div class="p-6">
                    <div style="height: 550px;">
                        {!! $graficos['fontesReferencia']->container() !!}
                    </div>
                </div>
            </div>
            @endif

            @if(isset($graficos['interesses']))
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Interesses nesta viagem (Menções Múltiplas)</h3>
                </div>
                <div class="p-6">
                    <div style="height: 550px;">
                        {!! $graficos['interesses']->container() !!}
                    </div>
                </div>
            </div>
            @endif

            @if(isset($graficos['acesso']))
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Acesso ao Destino (Menções Múltiplas)</h3>
                </div>
                <div class="p-6">
                    <div style="height: 550px;">
                        {!! $graficos['acesso']->container() !!}
                    </div>
                </div>
            </div>
            @endif

            @if(isset($graficos['transporteDestino']))
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Transporte no Destino (Menções Múltiplas)</h3>
                </div>
                <div class="p-6">
                    <div style="height: 550px;">
                        {!! $graficos['transporteDestino']->container() !!}
                    </div>
                </div>
            </div>
            @endif

            @if(isset($graficos['nota']))
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Nota Geral</h3>
                </div>
                <div class="p-6">
                    <div style="height: 550px;">
                        {!! $graficos['nota']->container() !!}
                    </div>
                </div>
            </div>
            @endif


            
        </div>
        @endif
    </div>

    @if(!isset($erro))
    @if(isset($graficos['faixaEtaria']))
    {!! $graficos['genero']->script() !!}
    @endif

    @if(isset($graficos['faixaEtaria']))
    {!! $graficos['faixaEtaria']->script() !!}
    @endif

    @if(isset($graficos['formacaoEscolar']))
    {!! $graficos['formacaoEscolar']->script() !!}
    @endif

    @if(isset($graficos['rendaPessoal']))
    {!! $graficos['rendaPessoal']->script() !!}
    @endif

    @if(isset($graficos['profissoes']))
    {!! $graficos['profissoes']->script() !!}
    @endif

    @if(isset($graficos['estadosBarra']))
    {!! $graficos['estadosBarra']->script() !!}
    @endif
    
    @if(isset($graficos['estadosPizza']))
    {!! $graficos['estadosPizza']->script() !!}
    @endif

    @if(isset($graficos['paisPizza']))
    {!! $graficos['paisPizza']->script() !!}
    @endif
    
    @if(isset($graficos['paisBarra']))
    {!! $graficos['paisBarra']->script() !!}
    @endif
    
    @if(isset($graficos['municipios']))
    {!! $graficos['municipios']->script() !!}
    @endif

    @if(isset($graficos['conhecimentoPrevio']))
    {!! $graficos['conhecimentoPrevio']->script() !!}
    @endif

    @if(isset($graficos['fontesReferencia']))
    {!! $graficos['fontesReferencia']->script() !!}
    @endif
    
    @if(isset($graficos['interesses']))
    {!! $graficos['interesses']->script() !!}
    @endif

    @if(isset($graficos['acesso']))
    {!! $graficos['acesso']->script() !!}
    @endif

    @if(isset($graficos['transporteDestino']))
    {!! $graficos['transporteDestino']->script() !!}
    @endif

    @if(isset($graficos['nota']))
    {!! $graficos['nota']->script() !!}
    @endif

    @endif

    <script>
        function trocarId() {
            const novoId = document.getElementById('idInput').value;
            if (novoId) {
                window.location.href = '/dashboard/' + novoId;
            }
        }

        document.getElementById('idInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                trocarId();
            }
        });
    </script>
</body>

</html>