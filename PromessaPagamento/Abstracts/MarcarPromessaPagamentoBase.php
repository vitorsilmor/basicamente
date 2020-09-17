<?php 

namespace App\Services\Notas\PromessaPagamento\Abstracts;

use App\Repositories\Contracts\ClienteRepository;
use App\Repositories\Contracts\CobrancaRepository;
use App\Repositories\Contracts\NotaRepository;
use App\Services\Notas\PromessaPagamento\Contracts\MarcarPromessaPagamentoService;

abstract class MarcarPromessaPagamentoBase implements MarcarPromessaPagamentoService
{
    /**
     * Instância de NotaRepository
     *
     * @var NotaRepository
     */
    protected NotaRepository $notaRepository;

    /**
     * Instância de ClienteRepository
     *
     * @var ClienteRepository
     */
    protected ClienteRepository $clienteRepository;

    /**
     * Instancia de Cobrança Repository
     *
     * @var CobrancaRepository
     */
    protected CobrancaRepository $cobrancaRepository;

    /**
     * ID da nota que será processada.
     *
     * @var integer
     */
    protected int $idNota;

    /**
     * Detalhes de cobrança.
     *
     * @var array
     */
    protected array $detalhesCobranca;

    /**
     * Seta o ID da nota.
     *
     * @param integer $id
     * @return MarcarPromessaPagamentoService
     */
    public function setNota(int $id) : MarcarPromessaPagamentoService
    {
        $this->idNota = $id;
        
        return $this;
    }
        
    /**
     * Set detalhes de cobrança.
     *
     * @param  array  $detalhesCobranca  Detalhes de cobrança.
     *
     * @return  self
     */ 
    public function setDetalhesCobranca(array $detalhesCobranca) : MarcarPromessaPagamentoService
    {
        $this->detalhesCobranca = $detalhesCobranca;

        return $this;
    }

    /**
     * Set instancia de Cobrança Repository
     *
     * @param  CobrancaRepository  $cobrancaRepository  Instancia de Cobrança Repository
     *
     * @return  self
     */ 
    public function setCobrancaRepository(CobrancaRepository $cobrancaRepository): MarcarPromessaPagamentoService
    {
        $this->cobrancaRepository = $cobrancaRepository;

        return $this;
    }

    /**
     * Set instância de ClienteRepository
     *
     * @param  ClienteRepository  $clienteRepository  Instância de ClienteRepository
     *
     * @return  self
     */ 
    public function setClienteRepository(ClienteRepository $clienteRepository): MarcarPromessaPagamentoService
    {
        $this->clienteRepository = $clienteRepository;

        return $this;
    }

    /**
     * Set instância de NotaRepository
     *
     * @param  NotaRepository  $notaRepository  Instância de NotaRepository
     *
     * @return  self
     */ 
    public function setNotaRepository(NotaRepository $notaRepository): MarcarPromessaPagamentoService
    {
        $this->notaRepository = $notaRepository;

        return $this;
    }
}