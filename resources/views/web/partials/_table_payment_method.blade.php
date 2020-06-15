<style>
    @media only screen and (max-width: 767px) {
        .table td {
            padding: 0.75px !important;
            vertical-align: middle !important;
        }

        .table th {
            padding: 0.65px !important;
            vertical-align: middle !important;
        }
    }

    .table th {
        vertical-align: middle !important;
    }
</style>
<div class="table-responsive">
    <table class="table table-bordered text-center" id="table_payment">
         <thead class="thead-light">
        <tr>
            <th>NUESTRAS CUENTAS</th>
            <th>
                NÚMERO DE CUENTA
            </th>
            <th>CÓDIGO INTERBANCARIO (CCI)
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <!--<td>NÚMERO DE CUENTA</td>-->
            <td><img src="{{ asset('assets/frutasencasa/tarjetas/bcp.png') }}"
                alt="Cuenta MiMercado.Delivery"></td>
            <td>57098451849065</td>
            <td>00257019845184906505</td>
        </tr>
        <tr>
            <td><img src="{{ asset('assets/frutasencasa/tarjetas/interbank.png') }}"
                alt="Cuenta MiMercado.Delivery"></td>
            <td>6003002477421</td>
            <td>00360000300247742145</td>
        </tr>
        </tbody>
    </table>
</div>
