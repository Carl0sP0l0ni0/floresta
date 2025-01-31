@extends('admin.layout')
@section('title', 'Panel de administracion')
@section('section')
    <h2 class="mt-3 h4 text-center">resumen de los ultimos 7 dias</h2>
    <div>
        <canvas id="chartjs-render-monitor" class="w-100 pb-4 border-bottom"></canvas>
        <script src="{{ mix('/js/chart.min.js') }}"></script>
        <script>
            const ctx = document.getElementById('chartjs-render-monitor').getContext('2d')
            const labels = {!! json_encode($dates, JSON_UNESCAPED_SLASHES) !!};
            const data = {
                labels: labels,
                datasets: [
                    {
                        label: 'Ventas',
                        data: {!! json_encode($sales, JSON_UNESCAPED_SLASHES) !!},
                        backgroundColor: 'transparent',
                        borderColor: '#ff0039',
                        borderWidth: 4,
                        pointBackgroundColor: '#ff0039',
                        yAxisID: 'y1',
                    }, {
                        label: 'Valores',
                        data: {!! json_encode($values, JSON_UNESCAPED_SLASHES) !!},
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        borderWidth: 4,
                        pointBackgroundColor: '#007bff',
                        yAxisID: 'y',
                    }, {
                        label: 'Transações',
                        data: {!! json_encode($transactions, JSON_UNESCAPED_SLASHES) !!},
                        backgroundColor: 'transparent',
                        borderColor: '#ffff00',
                        borderWidth: 4,
                        pointBackgroundColor: '#ffff00',
                        yAxisID: 'y1',
                    }
                ]
            };

            const myChart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: {
                    responsive: true,
                    stacked: false,
                    scales: {
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            grid: {
                                drawOnChartArea: false,
                            },
                        },
                    }
                },
            });
        </script>
    </div>
    <div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead class="table-secondary">
                <tr>
                    <td>Dia</td>
                    <td>Ventas</td>
                    <td>Transaciones</td>
                    <td>Total</td>
                </tr>
                </thead>
                <tbody>
                @for($i = 0; $i < 7; $i++)
                    <tr>
                        <td>{{ $dates[$i] }}</td>
                        <td>{{ $sales[$i] }}</td>
                        <td>{{ $transactions[$i] }}</td>
                        <td>{{ 'S/. '.number_format($values[$i], 2, ',', '.') }}</td>
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
@endsection
