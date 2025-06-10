<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Profissional</title>
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

            <!-- Gráfico de Estados -->
            @if(isset($graficos['estados']))
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Estados de Origem</h3>
                </div>
                <div class="p-6">
                    <div style="height: 550px;">
                        {!! $graficos['estados']->container() !!}
                    </div>
                </div>
            </div>
            @endif
        </div>
        @endif
    </div>

    @if(!isset($erro))
    {!! $graficos['genero']->script() !!}
    @if(isset($graficos['estados']))
    {!! $graficos['estados']->script() !!}
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