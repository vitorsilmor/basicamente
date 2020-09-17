<?php 

namespace App\Services\Notas\PromessaPagamento\Abstracts;

use App\Nota;
use App\Cobranca;
use App\NotaEstado;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notas\PromessaPagamentoNotaMail;

abstract class MarcarPromessaPagamentoServiceAbstract extends MarcarPromessaPagamentoBase
{
    /**
     * Busca uma nota.
     *
     * @param integer $id
     * @return Nota
     */
    protected function buscarNota() : Nota
    {
        $nota = $this->notaRepository->getNota($this->idNota);
        
        if(is_null($nota))
            throw new \Exception("Esta nota não existe");

        return $nota;
    }

    /**
     * Retorna uma exceção caso o estado da nota não seja o correto para encerramento.
     *
     * @param Nota $nota
     * @return void
     */
    protected function verificarEstado(Nota $nota)
    {
        $estado = $nota->nota_estado_id;

        if($estado == NotaEstado::VENCIDA)
            return;

        throw new \Exception("Esta nota não está vencida. Portanto, não é possível alterar com uma promessa de pagamento.");
    }   

    /**
     * Cria uma cobrança.
     *
     * @param array $detalhes
     * @return Cobranca
     */
    protected function criarCobranca(array $detalhes) : Cobranca 
    {
        $cobranca = $this->cobrancaRepository->createCobranca($detalhes);

        if(!isset($cobranca->id)) throw new \Exception("A cobrança não foi criada.");

        return $cobranca;
    }

    /**
     * Marca uma nota com promessa de pagamento.
     *
     * @param Nota $nota
     * @return void
     */
    protected function marcarPromessa(Nota $nota)
    {
        $marcouComoPromessa = $this->notaRepository->marcarPromessaPagamento($nota->id);

        if(!$marcouComoPromessa) 
            throw new \Exception("Não foi possível marcar a promessa de pagamento");
    }

    /**
     * Envia o e-mail confirmando o pagamento.
     *
     * @param Nota $nota
     * @return void
     */
    protected function enviarEmailInformandoAgendamento(Nota $nota, Cobranca $cobranca)
    {
        $emailFinanceiroPrincipal = $this->clienteRepository->getEmailFinanceiroPrincipal($nota->cliente_id);

        if(getenv('APP_ENV') == 'production'){
            Mail::to($emailFinanceiroPrincipal)
                ->cc(getenv('EMAIL_CC_SISTEMA'))
                ->send(new PromessaPagamentoNotaMail($nota, $cobranca));

            return;
        }

        Mail::to(getenv('EMAIL_CC_SISTEMA'))->send(new PromessaPagamentoNotaMail($nota, $cobranca));
    }
}