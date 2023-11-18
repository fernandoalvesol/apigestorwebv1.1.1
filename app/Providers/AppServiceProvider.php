<?php

namespace App\Providers;

use App\Models\ItemVenda;
use App\Models\Venda;
use App\Observers\ItemVendaObserver;
use App\Observers\VendaObserver;

use App\Models\Compra;
use App\Models\GradeProduto;
use App\Models\ItemCompra;
use App\Models\NfeItem;
use App\Observers\CompraObserver;
use App\Observers\GradeProdutoObserver;
use App\Observers\ItemCompraObserver;
use App\Observers\ItemNotaFiscalObserver;

use App\Models\ContaPagar;
use App\Models\ContaReceber;
use App\Models\Pagamento;
use App\Models\Recebimento;

use App\Observers\ContaPagarObserver;
use App\Observers\ContaReceberObserver;
use App\Observers\PagamentoObserver;
use App\Observers\RecebimentoObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       // Venda::observe(VendaObserver::class);
       // ItemVenda::observe(ItemVendaObserver::class);

       // Compra::observe(CompraObserver::class);
       // ItemCompra::observe(ItemCompraObserver::class);

       // GradeProduto::observe(GradeProdutoObserver::class);

       // NfeItem::observe(ItemNotaFiscalObserver::class);
		// 
		// ContaReceber::observe(ContaReceberObserver::class);
       // ContaPagar::observe(ContaPagarObserver::class);
       // Pagamento::observe(PagamentoObserver::class);
       // Recebimento::observe(RecebimentoObserver::class);
    }
}
