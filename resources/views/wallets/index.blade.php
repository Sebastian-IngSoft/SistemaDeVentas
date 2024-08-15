@extends('adminlte::page')

@section('title', 'Caja')

@section('content_header')
    <h1>Caja</h1>
@stop

@section('content')
    <div class="d-flex my-4">
        <div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#deposit">
                Depositar dinero a caja
            </button>

        </div>
        <div class="ml-auto">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#withdraw">
                Retirar dinero de la caja
            </button>

        </div>
    </div>

    <!-- Modal de deposito-->
    <div class="modal fade" id="deposit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Depositar dinero</h1>
                </div>
                <form action="{{ route('wallet.deposit') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="stock_inicial">Dinero depositado</label>
                        <input type="number" name="deposit" class="form-control" aria-label="Sizing example input"
                            onkeypress="validarNumero(event)" oninput="validarNumeroOnInput(this)"
                            aria-describedby="inputGroup-sizing-default" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal de retiro-->
    <div class="modal fade" id="withdraw" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Retirar dinero</h1>
                </div>
                <form action="{{ route('wallet.withdraw') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="stock_inicial">Dinero retirado</label>
                        <input type="number" name="withdraw" class="form-control" aria-label="Sizing example input"
                            onkeypress="validarNumero(event)" oninput="validarNumeroOnInput(this)"
                            aria-describedby="inputGroup-sizing-default" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#Operacion</th>
                <th scope="col">Saldo</th>
                <th scope="col">Flujo</th>
                <th scope="col">Fecha</th>
                <th scope="col">Motivo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wallets as $wallet)
                <tr>
                    <td>{{ $wallet->id }}</td>
                    {{--logica para campo SALDO--}}
                    @if ($wallet->balance < 0)
                        <td class="text-danger">
                            S/. {{ $wallet->balance }}
                        </td>
                    @else
                        <td class="">
                            S/. {{ $wallet->balance }}
                        </td>
                    @endif
                    {{--logica para campo flujo--}}

                    @if ($wallet->flow < 0)
                        <td class="text-danger">
                            S/. {{ $wallet->flow }}
                        </td>
                    @else
                        <td class="">
                            S/. {{ $wallet->flow }}
                        </td>
                    @endif
                    <td>{{ $wallet->created_at }}</td>
                    <td>
                        {{--Logica para campo MOTIVO--}}
                        @if ($wallet->walletable_type == 'App\Models\User'){{--que hacer cuando es usuario--}}
                            Operación de usuario {{ $wallet->walletable->name?? 'retirado' }}
                        @elseif ($wallet->walletable_type == 'App\Models\Ticket'){{--que hacer cuando es boleta--}}
                            <a href="{{ route('ticket.show', $wallet->walletable->id) }}" class="text-dark">
                                Boleta #{{ $wallet->walletable->id }} <i class="far fa-share-square"></i>
                            </a>
                        @endif
                    </td>


                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $wallets->links() }}
@stop

@section('css')

@stop

@section('js')
    @vite(['resources/js/app.js', 'resources/js/bootstrap.bundle.min.js'])
@stop
