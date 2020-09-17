<?php 

namespace App\Services\Notas;

use App\Services\Notas\PromessaPagamento\Abstracts\MarcarPromessaPagamentoServiceAbstract;
use Illuminate\Support\Facades\DB;

class MarcarPromessaPagamentoService extends MarcarPromessaPagamentoServiceAbstract
{
    /**
     * Processar a marcação da nota como prometida.
     *
     * @return boolean
     */
    public function handle(): bool
    {
        DB::transaction(function () {
            $nota = $this->buscarNota($this->idNota);
            $this->verificarEstado($nota);

            $cobranca = $this->criarCobranca($this->detalhesCobranca);
            $this->marcarPromessa($nota);
            $this->enviarEmailInformandoAgendamento($nota, $cobranca);
        });

        return true;
    }
}