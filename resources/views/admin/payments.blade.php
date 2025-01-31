@extends('admin.layout')
@section('title', 'Pagamentos')
@section('section')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger text-center w-100 mb-3">{{ $error }}</div>
        @endforeach
    @endif
    @if(Session::has('success'))
        <div class="alert alert-success text-center w-100 mb-3">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="fw-bold table-secondary">
            <tr>
                <td>#</td>
                <td>Valor</td>
                <td>Mesa</td>
                <td>Cliente</td>
                <td>Pago en</td>
                <td>Data e hora</td>
            </tr>
            </thead>
            <tbody>
            @foreach($payments as $payment)
                <tr class="{{ $payment->getColor() }}">
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->getCurrentValue() }}</td>
                    <td>
                        <a href="{{ route('admin.tables') }}#table-{{ $payment->table_id }}"
                           class="text-decoration-none">
                            {{ $payment->table_id }}
                        </a>
                    </td>
                    <td>{{ $payment->client }}</td>
                    <td>{{ $payment->method }}</td>
                    <td>{{ $payment->getTime() }}</td>
                </tr>
            @endforeach
            @if (empty($payments[0]))
                <tr class="table-warning">
                    <td colspan="6">
                        ¡No se encontraron registros de pago para el período seleccionado!
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    {{ $payments->links() }}
@endsection
@section('plus')
    <form class="ms-2 col-lg-2 col-sm-3 col-5" id="form-select">
        <label for="period-payment" class="visually-hidden">Mostrar pagos de</label>
        <select class="form-select" id="period-payment" name="period-payment">
            <option value="" @selected(is_null(request('period-payment')))>
                Todo período
            </option>
            <option value="0" @selected(request('period-payment', 1) == 0)>hoy</option>
            <option value="-1" @selected(request('period-payment') == -1)>Ayer</option>
            <option value="7" @selected(request('period-payment') == 7)>Últimos 7 dias</option>
            <option value="30" @selected(request('period-payment') == 30)>Últimos 30 dias</option>
            <option value="60" @selected(request('period-payment') == 60)>Últimos 60 dias</option>
            <option value="90" @selected(request('period-payment') == 90)>Últimos 90 dias</option>
        </select>
    </form>
@endsection
