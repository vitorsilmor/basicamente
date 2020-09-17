<?php 

namespace App\Services\Notas\PromessaPagamento\Contracts;

use App\Repositories\Contracts\ClienteRepository;
use App\Repositories\Contracts\CobrancaRepository;
use App\Repositories\Contracts\NotaRepository;

interface MarcarPromessaPagamentoService
{
    /**
     * Set instancia de Cobrança Repository
     *
     * @param  CobrancaRepository  $cobrancaRepository  Instancia de Cobrança Repository
     *
     * @return  self
     */ 
    public function setCobrancaRepository(CobrancaRepository $cobrancaRepository): MarcarPromessaPagamentoService;

    /**
     * Set instância de ClienteRepository
     *
     * @param  ClienteRepository  $clienteRepository  Instância de ClienteRepository
     *
     * @return  self
     */ 
    public function setClienteRepository(ClienteRepository $clienteRepository): MarcarPromessaPagamentoService;

    /**
     * Set instância de NotaRepository
     *
     * @param  NotaRepository  $notaRepository  Instância de NotaRepository
     *
     * @return  self
     */ 
    public function setNotaRepository(NotaRepository $notaRepository): MarcarPromessaPagamentoService;

    /**
     * Seta o ID da nota.
     *
     * @param integer $id
     * @return MarcarPromessaPagamentoService
     */
    public function setNota(int $id) : MarcarPromessaPagamentoService;

    /**
     * Set detalhes de cobrança.
     *
     * @param  array  $detalhesCobranca  Detalhes de cobrança.
     *
     * @return  self
     */ 
    public function setDetalhesCobranca(array $detalhesCobranca) : MarcarPromessaPagamentoService;
    
    /**
     * Executa o processo de marcação de nota como paga.
     *
     * @return boolean
     */
    public function handle() : bool;
}