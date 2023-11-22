<?php

use App\Http\Controllers\Cadastro\BancoController;
use App\Http\Controllers\Cadastro\CategoriaController;
use App\Http\Controllers\Cadastro\ClienteController;
use App\Http\Controllers\Cadastro\ContaCorrenteController;
use App\Http\Controllers\Cadastro\FormaPagtoController;
use App\Http\Controllers\Cadastro\FornecedorController;
use App\Http\Controllers\Cadastro\ProdutoController;
use App\Http\Controllers\Cadastro\StatusController;
use App\Http\Controllers\Cadastro\TipoContaCorrenteController;
use App\Http\Controllers\Cadastro\TransportadoraController;
use App\Http\Controllers\Cadastro\UnidadeController;
use App\Http\Controllers\Cadastro\VendedorController;

use App\Http\Controllers\Composicao\ComposicaoProdutoController;

use App\Http\Controllers\Imagem\ImagemController;
use App\Http\Controllers\Imagem\ImagemProdutoController;

use App\Http\Controllers\Manifesto\DfeController;

use App\Http\Controllers\NotaFiscal\CertificadoDigitalController;
use App\Http\Controllers\NotaFiscal\EmitenteController;


use App\Http\Controllers\Compra\CompraController;
use App\Http\Controllers\Compra\DuplicataCompraController;
use App\Http\Controllers\Compra\ItemCompraController;

//use App\Http\Controllers\Estoque\EntradaController;
use App\Http\Controllers\Estoque\MovimentoController;
use App\Http\Controllers\Estoque\ProdutoEstoqueController;
//use App\Http\Controllers\Estoque\SaidaController;
use App\Http\Controllers\Etiqueta\EtiquetaController;
use App\Http\Controllers\Financeiro\CentroCustoController;
use App\Http\Controllers\Financeiro\ContaPagarController;
use App\Http\Controllers\Financeiro\ContaReceberController;
use App\Http\Controllers\Financeiro\DespesaFixaController;
use App\Http\Controllers\Financeiro\PagamentoController;
use App\Http\Controllers\Financeiro\PlanoContaController;
use App\Http\Controllers\Financeiro\RecebimentoController;
use App\Http\Controllers\Frente\FrenteVendaController;

use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\Grade\ItemVariacaoGradeController;
use App\Http\Controllers\Grade\ProdutoGradeController;
use App\Http\Controllers\Grade\VariacaoGradeController;
use App\Http\Controllers\LojaVirtual\LojaBannerController;

//use App\Http\Controllers\UtilController;
use App\Http\Controllers\HomeControlller;
//use App\Http\Controllers\Importacao\NfeEntradaController;

use App\Http\Controllers\Usuario\FuncaoController;
use App\Http\Controllers\Usuario\FuncaoPermissaoController;
use App\Http\Controllers\Usuario\FuncaoUsuarioController;
use App\Http\Controllers\Usuario\MenuController;
use App\Http\Controllers\Usuario\UsuarioController;


use App\Http\Controllers\LojaVirtual\LojaCategoriaController;
use App\Http\Controllers\LojaVirtual\LojaClienteController;
use App\Http\Controllers\LojaVirtual\LojaConfiguracaoController;
use App\Http\Controllers\LojaVirtual\LojaImagemProdutoController;
use App\Http\Controllers\LojaVirtual\LojaPedidoController;
use App\Http\Controllers\LojaVirtual\LojaProdutoController;
use App\Http\Controllers\LojaVirtual\LojaProdutoSemelhanteController;
use App\Http\Controllers\LojaVirtual\LojaSecaoController;
use App\Http\Controllers\LojaVirtual\LojaSecaoProdutoController;
use App\Http\Controllers\MercadoPago\BoletoController;
use App\Http\Controllers\MercadoPago\CartaoController;
use App\Http\Controllers\MercadoPago\MercadoPagoController;
use App\Http\Controllers\MercadoPago\PixController;
use App\Http\Controllers\NotaFiscal\ItemNotaFiscalController;
use App\Http\Controllers\NotaFiscal\NaturezaOperacaoController;
use App\Http\Controllers\NotaFiscal\NfeController;
use App\Http\Controllers\NotaFiscal\NfeDuplicataController;
use App\Http\Controllers\NotaFiscal\NfeReferenciadoController;
use App\Http\Controllers\NotaFiscal\NotaFiscalController;
use App\Http\Controllers\NotaFiscal\TributacaoController;
use App\Http\Controllers\PainelCadastroController;
use App\Http\Controllers\PainelVendaController;

use App\Http\Controllers\Venda\DuplicataController;
use App\Http\Controllers\Venda\ItemOrcamentoController;
use App\Http\Controllers\Venda\ItemVendaController;
use App\Http\Controllers\Venda\OrcamentoController;
use App\Http\Controllers\Venda\VendaController;

use App\Http\Controllers\PainelFrenteAdminController;
use App\Http\Controllers\PainelFrenteLojaController;
use App\Http\Controllers\Caixa\CaixaController;
use App\Http\Controllers\Caixa\EntradaController;
use App\Http\Controllers\Caixa\SaidaController;



use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  Route::get('/', [HomeControlller::class, "index"] )->name("home");


//ROTAS DO SISTEMA
Route::get('/painelcadastro', [PainelCadastroController::class, "index"] )->name("painelcadastro");
Route::get("/painelvenda", [PainelVendaController::class, "index"])->name('painelvenda');
Route::get("/painelfrenteadmin", [PainelFrenteAdminController::class, "index"])->name('painelfrenteadmin');
Route::get("/painelfrenteloja", [PainelFrenteLojaController::class, "index"])->name('painelfrenteloja');

//Cadastros
Route::post("/categoria/salvarJs", [CategoriaController::class, "salvarJs"])->name('categoria.salvarJs');
Route::resource("/categoria", CategoriaController::class);

Route::resource("/unidade", UnidadeController::class);

Route::get("/produto/pesquisa",[ProdutoController::class,"pesquisa"])->name('produto.pesquisa');
Route::resource("/produto", ProdutoController::class);

Route::get("/cliente/pesquisa",[ClienteController::class,"pesquisa"])->name('cliente.pesquisa');
Route::resource("/cliente", ClienteController::class);

Route::get("/vendedor/pesquisa",[VendedorController::class,"pesquisa"])->name('vendedor.pesquisa');
Route::resource("/vendedor", VendedorController::class);

Route::get("/fornecedor/pesquisa",[FornecedorController::class,"pesquisa"])->name('fornecedor.pesquisa');
Route::resource("/fornecedor", FornecedorController::class);
Route::resource("/transportadora", TransportadoraController::class);
Route::resource("/contacorrente", ContaCorrenteController::class);
Route::resource("/banco", BancoController::class);
Route::resource("/tipocontacorrente", TipoContaCorrenteController::class);
Route::resource("/status", StatusController::class);
Route::resource("/formapagto", FormaPagtoController::class);

 /*
 Route::resource('/movimento',MovimentoController::class);
 Route::get("/entrada", [EntradaController::class,"index"])->name("entrada.index");
 Route::post("/entrada/salvarJs", [EntradaController::class,"salvarJs"])->name("entrada.salvarJs");

 Route::get("/saida", [SaidaController::class,"index"])->name("saida.index");
 Route::post("/saida/salvarJs", [SaidaController::class,"salvarJs"])->name("saida.salvarJs");

 Route::get("/produtoestoque/pesquisa",[ProdutoEstoqueController::class,"pesquisa"])->name('produtoestoque.pesquisa');
 Route::resource("/produtoestoque", ProdutoEstoqueController::class);
*/

 //Venda
 Route::post("/venda/finalizarVenda", [VendaController::class,"finalizarVenda"])->name("venda.finalizarVenda");
 Route::get('/venda/financeiro/{id}',[VendaController::class,'financeiro'])->name('venda.financeiro');
 Route::resource("/itemvenda", ItemVendaController::class);
 Route::post('/venda/atualizarDadosPagamentos',[VendaController::class,'atualizarDadosPagamentos'])->name('venda.atualizarDadosPagamentos');
 Route::get('/venda/detalhe/{id}',[VendaController::class,'detalhe'])->name('venda.detalhe');
 Route::resource("/venda", VendaController::class);

 Route::post('/duplicata/inserir',[DuplicataController::class,'inserir'])->name('duplicata.inserir');
 Route::post('/duplicata/salvarAlteracao',[DuplicataController::class,'salvarAlteracao'])->name('duplicata.salvarAlteracao');
 Route::get('/duplicata/excluir/{id}',[DuplicataController::class,'excluir'])->name('duplicata.excluir');

 Route::resource("/orcamento", OrcamentoController::class);
 Route::resource("/itemorcamento", ItemOrcamentoController::class);

 Route::post('/duplicataorcamento/inserir',[DuplicataOrcamentoController::class,'inserir'])->name('duplicata.inserir');
 Route::post('/duplicata/salvarAlteracao',[DuplicataController::class,'salvarAlteracao'])->name('duplicata.salvarAlteracao');
 Route::get('/duplicata/excluir/{id}',[DuplicataController::class,'excluir'])->name('duplicata.excluir');


// Compra
Route::get('/compra',[CompraController::class,'index'])->name('compra.index');
Route::get('/compra/create',[CompraController::class,'create'])->name('compra.create');
Route::post('/compra/salvar',[CompraController::class,'salvar'])->name('compra.salvar');
Route::post('/compra/salvarNfFiscal',[CompraController::class,'salvarNfFiscal'])->name('compra.salvarNfFiscal');
Route::get('/compra/detalhe/{id}',[CompraController::class,'detalhe'])->name('compra.detalhe');
Route::get('/compra/financeiro/{id}',[CompraController::class,'financeiro'])->name('compra.financeiro');
Route::get('/compra/lancarEstoque/{id}',[CompraController::class,'lancarEstoque'])->name('compra.lancarEstoque');
Route::get('/compra/estornarEstoque/{id}',[CompraController::class,'estornarEstoque'])->name('compra.estornarEstoque');
Route::get('/compra/excluir/{id}',[CompraController::class,'excluir'])->name('compra.excluir');
Route::get('/compra/emitirEntrada/{id}',[CompraController::class,'emitirEntrada'])->name('compra.emitirEntrada');
Route::get('/compra/edit/{id}',[CompraController::class,'edit'])->name('compra.edit');
Route::get('/compra/CompraNfe/{id}',[CompraController::class,'CompraNfe'])->name('compra.CompraNfe');
Route::post('/compra/finalizarCompra',[CompraController::class,'finalizarCompra'])->name('compra.finalizarCompra');
Route::get("/compra/filtro",[CompraController::class,"filtro"])->name('compra.filtro');
Route::resource("/compra", CompraController::class);
Route::resource("/itemcompra", ItemCompraController::class);

Route::post('/duplicatacompra/inserir',[DuplicataCompraController::class,'inserir'])->name('duplicatacompra.inserir');
Route::post('/duplicatacompra/salvarAlteracao',[DuplicataCompraController::class,'salvarAlteracao'])->name('duplicatacompra.salvarAlteracao');
Route::get('/duplicatacompra/excluir/{id}',[DuplicataCompraController::class,'excluir'])->name('duplicatacompra.excluir');


  //Financeiro
  Route::get('/contareceber/darBaixa/{id}',[ContaReceberController::class,'darBaixa'])->name('contareceber.darBaixa');
  Route::get('/contareceber/pagamentos/{id}',[ContaReceberController::class,'pagamentos'])->name('contareceber.pagamentos');
  Route::get("/contareceber/detalhe/{id}",[ContaReceberController::class,"detalhe"])->name("contareceber.detalhe");
  Route::post('/contareceber/receber',[ContaReceberController::class,'receber'])->name('contareceber.receber');
  Route::resource("/contareceber", ContaReceberController::class);

  Route::resource("/recebimento", RecebimentoController::class);

  Route::get("/contapagar/selecionarRelatorioSintetico",[ContaPagarController::class,"selecionarRelatorioSintetico"])->name('contapagar.selecionarRelatorioSintetico');
  Route::get("/contapagar/selecionarRelatorioAnalitico",[ContaPagarController::class,"selecionarRelatorioAnalitico"])->name('contapagar.selecionarRelatorioAnalitico');
  Route::get('/contapagar/relatorioSintetico',[ContaPagarController::class,'relatorioSintetico'])->name('contapagar.relatorioSintetico');
  Route::get('/contapagar/relatorioAnalitico',[ContaPagarController::class,'relatorioAnalitico'])->name('contapagar.relatorioAnalitico');
  Route::get("/contapagar/filtro",[ContaPagarController::class,"filtro"])->name("contapagar.filtro");
  Route::get("/contapagar/pormes",[ContaPagarController::class,"pormes"])->name("contapagar.pormes");
  Route::get("/contapagar/confirmarPagamento/{id}",[ContaPagarController::class,"confirmarPagamento"])->name("contapagar.confirmarPagamento");
  Route::get("/contapagar/detalhe/{id}",[ContaPagarController::class,"detalhe"])->name("contapagar.detalhe");
  Route::post("/contapagar/pagar/",[ContaPagarController::class,"pagar"])->name("contapagar.pagar");
  Route::resource("/contapagar",ContaPagarController::class);

  Route::get("/pagamento/filtro",[PagamentoController::class,"filtro"])->name("pagamento.filtro");
  Route::get("/pagamento/pormes",[PagamentoController::class,"pormes"])->name("pagamento.pormes");
  Route::resource("/pagamento",PagamentoController::class);



  // Nota Fiscal
  Route::get("/notafiscal/filtro",[NotaFiscalController::class,"filtro"])->name('notafiscal.filtro');
  Route::get('/notafiscal/excluir/{id}',[NotaFiscalController::class,'excluir'])->name('notafiscal.excluir');
  Route::get('/notafiscal/edit/{id}',[NotaFiscalController::class,'edit'])->name('notafiscal.edit');
  Route::get('/notafiscal/devolucaoVenda/{id}',[NotaFiscalController::class,'devolucaoVenda'])->name('notafiscal.devolucaoVenda');
  Route::get('/notafiscal/devolucaoCompra/{id}/{natureza_id}',[NotaFiscalController::class,'devolucaoCompra'])->name('notafiscal.devolucaoCompra');
  Route::get('/notafiscal',[NotaFiscalController::class,'index'])->name('notafiscal.index');
  Route::get('/notafiscal/create',[NotaFiscalController::class,'create'])->name('notafiscal.create');
  Route::get('/notafiscal/notaPorVenda',[NotaFiscalController::class,'notaPorVenda'])->name('notafiscal.notaPorVenda');
  Route::get('/notafiscal/salvarNfePorVenda/{id}/{natureza_id}',[NotaFiscalController::class,'salvarNfePorVenda'])->name('notafiscal.salvarNfePorVenda');
  Route::get('/notafiscal/salvarNfePorPedidoLoja/{id}/{natureza_id}',[NotaFiscalController::class,'salvarNfePorPedidoLoja'])->name('notafiscal.salvarNfePorPedidoLoja');
  Route::get('/notafiscal/salvarNfcePelaVenda/{id}/{natureza_id}',[NotaFiscalController::class,'salvarNfcePelaVenda'])->name('notafiscal.salvarNfcePelaVenda');

  Route::get('/notafiscal/salvarNfePorCompra/{id}',[NotaFiscalController::class,'salvarNfePorCompra'])->name('notafiscal.salvarNfePorCompra');
  Route::post('/notafiscal/salvar',[NotaFiscalController::class,'salvar'])->name('notafiscal.salvar');
  Route::post('/notafiscal/inserirAutorizado',[NotaFiscalController::class,'inserirAutorizado'])->name('notafiscal.inserirAutorizado');
  Route::get('/notafiscal/excluirAutorizado/{id}',[NotaFiscalController::class,'excluirAutorizado'])->name('notafiscal.excluirAutorizado');
  Route::post('/notafiscal/inserirReferenciado',[NotaFiscalController::class,'inserirReferenciado'])->name('notafiscal.inserirReferenciado');
  Route::get('/notafiscal/excluirReferenciado/{id}',[NotaFiscalController::class,'excluirReferenciado'])->name('notafiscal.excluirReferenciado');
  Route::get('/notafiscal/inutilizar',[NotaFiscalController::class,'inutilizar'])->name('notafiscal.inutilizar');
  Route::post('/notafiscal/criarNota',[NotaFiscalController::class,'criarNota'])->name('notafiscal.criarNota');
  Route::post('/notafiscal/atualizarDadosPagamentos',[NotaFiscalController::class,'atualizarDadosPagamentos'])->name('notafiscal.atualizarDadosPagamentos');
  Route::get('/notafiscal/salvarNfePorVendaJs/{id}',[NotaFiscalController::class,'salvarNfePorVendaJs'])->name('notafiscal.salvarNfePorVendaJs');
  Route::get('/notafiscal/calcularImpostos/{id}',[NotaFiscalController::class,'calcularImpostos'])->name('notafiscal.calcularImpostos');
  Route::get('/notafiscal/configurarProdutoNfe/{id}',[NotaFiscalController::class,'configurarProdutoNfe'])->name('notafiscal.configurarProdutoNfe');
  Route::post('/notafiscal/salvarSemCalculo',[NotaFiscalController::class,'salvarSemCalculo'])->name('notafiscal.salvarSemCalculo');
  Route::post('/notafiscal/cadastrarProduto',[NotaFiscalController::class,'cadastrarProduto'])->name('notafiscal.cadastrarProduto');
  Route::get('/notafiscal/edicaoLivre/{id}',[NotaFiscalController::class,'edicaoLivre'])->name('notafiscal.edicaoLivre');
  Route::get('/notafiscal/lerArquivo',[NotaFiscalController::class,'lerArquivo'])->name('notafiscal.lerArquivo');
  Route::get('/notafiscal/vincularProduto/{idproduto}/{idItem}',[NotaFiscalController::class,'vincularProduto'])->name('notafiscal.vincularProduto');
  Route::post('/notafiscal/importarNfe',[NotaFiscalController::class,'importarNfe'])->name('notafiscal.importarNfe');
  Route::resource("/notafiscal",NotaFiscalController::class);


  Route::post('/itemnotafiscal/inserir',[ItemNotaFiscalController::class,'inserir'])->name('itemnotafiscal.inserir');
  Route::get('/itemnotafiscal/excluir/{id}',[ItemNotaFiscalController::class,'excluir'])->name('itemnotafiscal.excluir');
  Route::get('/itemnotafiscal/detalhe/{id}',[ItemNotaFiscalController::class,'detalhe'])->name('itemnotafiscal.detalhe');
  Route::post('/itemnotafiscal/atualizar',[ItemNotaFiscalController::class,'atualizar'])->name('itemnotafiscal.atualizar');
  Route::post('/itemnotafiscal/recalcular',[ItemNotaFiscalController::class,'recalcular'])->name('itemnotafiscal.recalcular');
  Route::post('/itemnotafiscal/atualizarSemCalculo',[ItemNotaFiscalController::class,'atualizarSemCalculo'])->name('itemnotafiscal.atualizarSemCalculo');
  Route::post('/itemnotafiscal/inserirSemCalculo',[ItemNotaFiscalController::class,'inserirSemCalculo'])->name('itemnotafiscal.inserirSemCalculo');
  Route::get('/itemnotafiscal/excluirSemCalculo/{id}',[ItemNotaFiscalController::class,'excluirSemCalculo'])->name('itemnotafiscal.excluirSemCalculo');
  Route::resource("/itemnotafiscal",ItemNotaFiscalController::class);

Route::resource("/nfeduplicata", NfeDuplicataController::class);
Route::resource("/nfeautorizado", NfeAutorizadoController::class);
Route::resource("/nfereferenciado", NfeReferenciadoController::class);

  Route::get('/naturezaoperacao/listaProdutoTributacao/{tabela}/{id}',[NaturezaOperacaoController::class,'listaProdutoTributacao'])->name('naturezaoperacao.listaProdutoTributacao');
  Route::get('/naturezaoperacao/excluirProdutoTributacao/{tabela}/{id}',[NaturezaOperacaoController::class,'excluirProdutoTributacao'])->name('naturezaoperacao.excluirProdutoTributacao');
  Route::get('/naturezaoperacao/buscarCstIpi/{id}',[NaturezaOperacaoController::class,'buscarCstIpi'])->name('naturezaoperacao.buscarCstIpi');
  Route::get('/naturezaoperacao/buscarListaCfop/{id}',[NaturezaOperacaoController::class,'buscarListaCfop'])->name('naturezaoperacao.buscarListaCfop');
  Route::get('/naturezaoperacao/tributacao/{id}',[NaturezaOperacaoController::class,'tributacao'])->name('naturezaoperacao.tributacao');

  Route::get("/naturezaoperacao/tributacao/{id}", [NaturezaOperacaoController::class, "tributacoes"])->name("naturezaoperacao.tributacoes");
  Route::resource('/naturezaoperacao',NaturezaOperacaoController::class);

  Route::get('/tributacao/tornarPadrao/{id}',[TributacaoController::class,'tornarPadrao'])->name('tributacao.tornarPadrao');
  Route::post('/tributacao/inserirProduto',[TributacaoController::class,'inserirProduto'])->name('tributacao.inserirProduto');
  Route::get('/tributacao/listaProdutoTributacao/{id}',[TributacaoController::class,'listaProdutoTributacao'])->name('tributacao.listaProdutoTributacao');
  Route::get('/tributacao/excluirProdutoTributacao/{id}',[TributacaoController::class,'excluirProdutoTributacao'])->name('tributacao.excluirProdutoTributacao');
  Route::post('/tributacao/inserirEstado',[TributacaoController::class,'inserirEstado'])->name('tributacao.inserirEstado');
  Route::get('/tributacao/listaTributacaoEstado/{id}',[TributacaoController::class,'listaTributacaoEstado'])->name('tributacao.listaTributacaoEstado');
  Route::get('/tributacao/excluirEstadoTributacao/{id}',[TributacaoController::class,'excluirEstadoTributacao'])->name('tributacao.excluirEstadoTributacao');
  Route::post('/tributacao/inserirIva',[TributacaoController::class,'inserirIva'])->name('tributacao.inserirIva');
  Route::get('/tributacao/listaTributacaoIva/{id}',[TributacaoController::class,'listaTributacaoIva'])->name('tributacao.listaTributacaoIva');
  Route::get('/tributacao/excluirIvaTributacao/{id}',[TributacaoController::class,'excluirIvaTributacao'])->name('tributacao.excluirIvaTributacao');
  Route::resource('/tributacao',TributacaoController::class);

  Route::resource('/tributacaoproduto',TributacaoProdutoController::class);


  Route::post('/emitente/inserirAutorizado',[EmitenteController::class,'inserirAutorizado'])->name('emitente.inserirAutorizado');
  Route::get('/emitente/excluirAutorizado/{id}',[EmitenteController::class,'excluirAutorizado'])->name('emitente.excluirAutorizado');
  Route::resource('/emitente',EmitenteController::class);

  Route::post('/nfe/email',[NfeController::class,'email'])->name('nfe.email');
  Route::get('/nfe/verXML/{id}',[NfeController::class,'verXML'])->name('nfe.verXML');
  Route::get('/nfe/verXMLNormal/{id}',[NfeController::class,'verXMLNormal'])->name('nfe.verXMLNormal');
  Route::get('/nfe/danfe/{id}',[NfeController::class,'danfe'])->name('nfe.danfe');
  Route::get('/nfe/imprimirDanfePelaChave/{id}',[NfeController::class,'imprimirDanfePelaChave'])->name('nfe.imprimirDanfePelaChave');
  Route::get('/nfe/imprimirDanfePelaNfe/{id}',[NfeController::class,'imprimirDanfePelaNfe'])->name('nfe.imprimirDanfePelaNfe');
  Route::get('/nfe/imprimirDanfePelaVenda/{id}',[NfeController::class,'imprimirDanfePelaVenda'])->name('nfe.imprimirDanfePelaVenda');
  Route::get('/nfe/baixarXML/{id}',[NfeController::class,'baixarXML'])->name('nfe.baixarXML');
  Route::get('/nfe/baixarPdf/{id}',[NfeController::class,'baixarPdf'])->name('nfe.baixarPdf');
  Route::get('/nfe/transmitir/{id}',[NfeController::class,'transmitir'])->name('nfe.transmitir');
  Route::get('/nfe/transmitirJs/{id}',[NfeController::class,'transmitirJs'])->name('nfe.transmitirJs');
  Route::get('/nfe/transmitirNfePelaVendaJs/{id}',[NfeController::class,'transmitirNfePelaVendaJs'])->name('nfe.transmitirNfePelaVendaJs');
  Route::post('/nfe/cartaCorrecao',[NfeController::class,'cartaCorrecao'])->name('nfe.cartaCorrecao');
  Route::post('/nfe/inutilizarNfe',[NfeController::class,'inutilizarNfe'])->name('nfe.inutilizarNfe');
  Route::get('/nfe/imprimirCce/{id}',[NfeController::class,'imprimirCce'])->name('nfe.imprimirCce');
  Route::get('/nfe/consultarNfe/{id}',[NfeController::class,'consultarNfe'])->name('nfe.consultarNfe');
  Route::get('/nfe/simularDanfe/{id}',[NfeController::class,'simularDanfe'])->name('nfe.simularDanfe');
  Route::post('/nfe/cancelarNfe',[NfeController::class,'cancelarNfe'])->name('nfe.cancelarNfe');
  Route::get('/nfe/imprimircancelado/{id}',[NfeController::class,'imprimircancelado'])->name('nfe.imprimircancelado');

  Route::resource('/certificadodigital',CertificadoDigitalController::class);

  //Frente de Loja
  Route::resource("/vendaFrente",FrenteVendaController::class);




 //Frente de Loja
 Route::post('/vendafrente/inserirItem',[FrenteVendaController::class, 'inserirItem'])->name('vendafrente.inserirItem');
 Route::get('/vendafrente/excluirItem/{id}/{idVenda}',[FrenteVendaController::class, 'excluirItem'])->name('vendafrente.excluirItem');
 Route::post('/vendafrente/armazenarVenda',[FrenteVendaController::class, 'armazenarVenda'])->name('vendafrente.armazenarVenda');
 Route::post('/vendafrente/salvarPagamento',[FrenteVendaController::class, 'salvarPagamento'])->name('vendafrente.salvarPagamento');
 Route::get('/vendafrente/excluirDuplicata/{id}', [FrenteVendaController::class, 'excluirDuplicata'])->name('vendafrente.excluirDuplicata');
 Route::post('/vendafrente/finalizarVenda', [FrenteVendaController::class, 'finalizarVenda'])->name('vendafrente.finalizarVenda');
 Route::post('/vendafrente/cancelarVenda', [FrenteVendaController::class, 'cancelarVenda'])->name('vendafrente.cancelarVenda');
 Route::get('/vendafrente/cupom/{chave}', [FrenteVendaController::class, 'cupom'])->name('vendafrente.cupom');
 Route::get('/vendafrente/detalhes/{id}', [FrenteVendaController::class, 'detalhes'])->name('vendafrente.detalhes');
 Route::get('/vendafrente/ver', [FrenteVendaController::class, 'ver'])->name('vendafrente.ver');
 Route::post('/vendafrente/inserirCpfCnpj', [FrenteVendaController::class, 'inserirCpfCnpj'])->name('vendafrente.inserirCpfCnpj');
 Route::get('/vendafrente/gerarPeloId/{id}', [FrenteVendaController::class, 'gerarPeloId'])->name('vendafrente.gerarPeloId');

 Route::get('/vendafrente/pagamento/{id}',[FrenteVendaController::class, 'pagamento'])->name('vendafrente.pagamento');
 Route::post('/vendafrente/gerarCrediario',[FrenteVendaController::class, 'gerarCrediario'])->name('vendafrente.gerarCrediario');
 Route::post('/vendafrente/gerarPagamentoCartao',[FrenteVendaController::class, 'gerarPagamentoCartao'])->name('vendafrente.gerarPagamentoCartao');



//Loja Virtual
Route::resource('/lojaconfiguracao',LojaConfiguracaoController::class);
Route::resource('/lojabanner',LojaBannerController::class);
Route::resource('/lojacliente',LojaClienteController::class);
Route::resource('/lojaitempedido',LojaItemPedidoController::class);

Route::resource('/lojapedido',LojaPedidoController::class);
Route::resource('/lojaimagemproduto',LojaImagemProdutoController::class);
Route::resource('/lojaproduto',LojaProdutoController::class);
Route::resource('/lojacategoria',LojaCategoriaController::class);
Route::resource('/lojasecao',LojaSecaoController::class);
Route::resource('/lojasecaoproduto',LojaSecaoProdutoController::class);
Route::resource('/lojaprodutosemelhante',LojaProdutoSemelhanteController::class);
Route::get('/lojapedido/cupom/{id}',[LojaPedidoController::class, 'cupom'])->name('lojapedido.cupom');


  //Grade produto
  Route::post('/variacaograde/salvarJs',[VariacaoGradeController::class,'salvarJs'])->name('variacaograde.salvarJs');
  Route::resource('/variacaograde', VariacaoGradeController::class);

  Route::resource('/produtograde', ProdutoGradeController::class);
  Route::get('/itemvariacaograde/lista/{linha_id}/{coluna_id}/{produto_id}',[ItemVariacaoGradeController::class,'lista'])->name('itemvariacaograde.lista');
  Route::post('/itemvariacaograde/salvarJs',[ItemVariacaoGradeController::class,'salvarJs'])->name('itemvariacaograde.salvarJs');
  Route::resource('/itemvariacaograde', ItemVariacaoGradeController::class);


  //Imagem Produto
  Route::get('/imagem/produto/{id}',[ImagemController::class,'produto'])->name('imagem.produto');
  Route::get('/imagem/listaproduto',[ImagemController::class,'listaproduto'])->name('imagem.listaproduto');
  Route::resource('/imagem',ImagemController::class);
  Route::resource('/imagemproduto',ImagemProdutoController::class);

  //Composição Produto
  Route::get('/composicaoproduto/listaproduto',[ComposicaoProdutoController::class,'listaproduto'])->name('composicaoproduto.listaproduto');
  Route::get('/composicaoproduto/produto/{id}',[ComposicaoProdutoController::class,'produto'])->name('composicaoproduto.produto');
  Route::resource('/composicaoproduto',ComposicaoProdutoController::class);


  Route::resource('/produtograde', ProdutoGradeController::class);
  Route::get('/produtograde/grade/{id}',[ProdutoGradeController::class,'grade'])->name('produtograde.grade');

  Route::post('/grade/alterarCodigoBarra',[GradeController::class,'alterarCodigoBarra'])->name('grade.alterarCodigoBarra');
  //Route::post('/grade/gradeParaEntradaSaida',[GradeController::class,'gradeParaEntradaSaida'])->name('grade.gradeParaEntradaSaida');
  Route::post('/grade/gradeComMovimento',[GradeController::class,'gradeComMovimento'])->name('grade.gradeComMovimento');
  Route::post('/grade/gradeTempComMovimento',[GradeController::class,'gradeTempComMovimento'])->name('grade.gradeTempComMovimento');
  Route::post('/grade/gerar',[GradeController::class,'gerar'])->name('grade.gerar');
  Route::post('/grade/inserirEstoque',[GradeController::class,'inserirEstoque'])->name('grade.inserirEstoque');
  Route::get('/grade/listaJs/{produto_id}',[GradeController::class,'listaJs'])->name('grade.listaJs');
  Route::resource("/grade",GradeController::class);

  // Etiqueta
  Route::get('/etiqueta',[EtiquetaController::class,'index'])->name('etiqueta.index');
  Route::get('/etiquetaVarejo', [EtiquetaController::class, 'etiquetaVarejo'])->name('etiqueta.etiquetaVarejo');
  Route::get('/etiquetaVarejoAtacado', [EtiquetaController::class, 'etiquetaVarejoAtacado'])->name('etiqueta.etiquetaVarejoAtacado');
  Route::get('/etiquetaComum', [EtiquetaController::class, 'etiquetaComum'])->name('etiqueta.etiquetaComum');
  Route::get('/etiquetaPromocao', [EtiquetaController::class, 'etiquetaPromocao'])->name('etiqueta.etiquetaPromocao');
  Route::get('/etiquetaLoja', [EtiquetaController::class, 'etiquetaLoja'])->name('etiqueta.etiquetaLoja');

  Route::resource('/tabelapreco', TabelaPrecoController::class);

  /*
  //Nfe Entrada - Importação de XML
  Route::get('/nfeentrada/produtos/{id?}',[NfeEntradaController::class,'produtos'])->name('nfeentrada.produtos');
  Route::get('/nfeentrada/filtro',[NfeEntradaController::class,'filtro'])->name('nfeentrada.filtro');
  Route::get('/nfeentrada/ver/{id}',[NfeEntradaController::class,'ver'])->name('nfeentrada.ver');
  Route::get('/nfeentrada/vincularProduto/{idproduto}/{idItem}',[NfeEntradaController::class,'vincularProduto'])->name('nfeentrada.vincularProduto');
  Route::post('/nfeentrada/darEntrada',[NfeEntradaController::class,'darEntrada'])->name('nfeentrada.darEntrada');
  Route::get('/nfeentrada/excluir/{id}',[NfeEntradaController::class,'excluir'])->name('nfeentrada.excluir');
  Route::get('/nfeentrada/buscar/{id}',[NfeEntradaController::class,'buscar'])->name('nfeentrada.buscar');
  Route::get('/nfeentrada/index',[NfeEntradaController::class,'index'])->name('nfeentrada.index');
  Route::post('/nfeentrada/atualizarProduto',[NfeEntradaController::class,'atualizarProduto'])->name('nfeentrada.atualizarProduto');
  Route::post('/nfeentrada/cadastrarProduto',[NfeEntradaController::class,'cadastrarProduto'])->name('nfeentrada.cadastrarProduto');

  Route::post('/nfeentrada/importar',[NfeEntradaController::class,'importar'])->name('nfeentrada.importar');
  Route::get('/nfeentrada/lerArquivo',[NfeEntradaController::class,'lerArquivo'])->name('nfeentrada.lerArquivo');
*/

  //Manifesto
  Route::resource('/emitente',EmitenteController::class);
  Route::resource('/certificadodigital',CertificadoDigitalController::class);

  Route::get("/dfe/novaConsulta/{cnpj}", [DfeController::class, "novaConsulta"])->name('dfe.novaConsulta');
  Route::get("/dfe/download/{chave}", [DfeController::class, "download"])->name('dfe.download');
  Route::get("/dfe/downloadXml/{chave}", [DfeController::class, "downloadXml"])->name('dfe.downloadXml');
  Route::get("/dfe/imprimirDanfe/{chave}", [DfeController::class, "imprimirDanfe"])->name('dfe.imprimirDanfe');
  Route::get("/dfe/manifestar", [DfeController::class, "manifestar"])->name('dfe.manifestar');
  Route::get("/dfe/emitentes", [DfeController::class, "emitentes"])->name('dfe.emitentes');
  Route::resource('/dfe', DfeController::class);


  //Controle de Usuarios
Route::resource('/permissao', FuncaoPermissaoController::class);
Route::post('/funcao/salvarJs',[FuncaoController::class,'salvarJs'])->name('funcao.salvarJs');
Route::any('funcao/{id}/vincular',[FuncaoController::class,'vincular'])->name('funcao.vincular');
Route::get('/funcao/permissao/{id}',[FuncaoController::class,'permissao'])->name('funcao.permissao');
Route::get('/funcao/menu/{id}/{id_menu?}',[FuncaoController::class,'menu'])->name('funcao.menu');
Route::resource('/funcao', FuncaoController::class);


Route::post('/funcao/{id}/permissao',[FuncaoPermissaoController::class,'vincularPermissao'])->name('funcao.vincularPermissao');
Route::post('/funcao/{id}/menu',[FuncaoPermissaoController::class,'vincularMenu'])->name('funcao.vincularMenu');

Route::post('/funcaopermissao/salvar',[FuncaoPermissaoController::class,'salvar'])->name('funcaopermissao.salvar');
Route::resource('/funcaopermissao', FuncaoPermissaoController::class);
Route::resource('/funcaousuario', FuncaoUsuarioController::class);

Route::get('/usuario/funcoes/{id}', [UsuarioController::class,'funcoes'])->name('usuario.funcoes');
Route::resource("/usuario", UsuarioController::class);
Route::resource("/menu", MenuController::class);


//Financeiro
Route::get('/contareceber/darBaixa/{id}',[ContaReceberController::class,'darBaixa'])->name('contareceber.darBaixa');
Route::get('/contareceber/pagamentos/{id}',[ContaReceberController::class,'pagamentos'])->name('contareceber.pagamentos');
Route::get("/contareceber/detalhe/{id}",[ContaReceberController::class,"detalhe"])->name("contareceber.detalhe");
Route::post('/contareceber/receber',[ContaReceberController::class,'receber'])->name('contareceber.receber');
Route::resource("/contareceber", ContaReceberController::class);

Route::resource("/recebimento", RecebimentoController::class);

Route::get("/contapagar/selecionarRelatorioSintetico",[ContaPagarController::class,"selecionarRelatorioSintetico"])->name('contapagar.selecionarRelatorioSintetico');
Route::get("/contapagar/selecionarRelatorioAnalitico",[ContaPagarController::class,"selecionarRelatorioAnalitico"])->name('contapagar.selecionarRelatorioAnalitico');
Route::get('/contapagar/relatorioSintetico',[ContaPagarController::class,'relatorioSintetico'])->name('contapagar.relatorioSintetico');
Route::get('/contapagar/relatorioAnalitico',[ContaPagarController::class,'relatorioAnalitico'])->name('contapagar.relatorioAnalitico');
Route::get("/contapagar/filtro",[ContaPagarController::class,"filtro"])->name("contapagar.filtro");
Route::get("/contapagar/pormes",[ContaPagarController::class,"pormes"])->name("contapagar.pormes");
Route::get("/contapagar/confirmarPagamento/{id}",[ContaPagarController::class,"confirmarPagamento"])->name("contapagar.confirmarPagamento");
Route::get("/contapagar/detalhe/{id}",[ContaPagarController::class,"detalhe"])->name("contapagar.detalhe");
Route::post("/contapagar/pagar/",[ContaPagarController::class,"pagar"])->name("contapagar.pagar");
Route::resource("/contapagar",ContaPagarController::class);

Route::get("/pagamento/filtro",[PagamentoController::class,"filtro"])->name("pagamento.filtro");
Route::get("/pagamento/pormes",[PagamentoController::class,"pormes"])->name("pagamento.pormes");
Route::resource("/pagamento",PagamentoController::class);

Route::resource("/planoconta",PlanoContaController::class);
Route::resource("/centrocusto",CentroCustoController::class);
Route::resource("/despesafixa",DespesaFixaController::class);


//Mercado Pago
Route::get('/cartao/ver/{id}',[CartaoController::class, 'ver'])->name('cartao.ver');
Route::get('/pix/ver/{id}',[PixController::class, 'ver'])->name('pix.ver');
Route::get('/boleto/ver/{id}',[BoletoController::class, 'ver'])->name('boleto.ver');
Route::get('/mercadopago/pagar/{id}',[MercadoPagoController::class, 'pagar'])->name('mercadopago.pagar');
Route::get('mercadopago/',[MercadoPagoController::class, 'index'])->name('mercadopago.index');


// Etiqueta
Route::get('/etiqueta',[EtiquetaController::class,'index'])->name('etiqueta.index');
Route::get('/etiquetaVarejo', [EtiquetaController::class, 'etiquetaVarejo'])->name('etiqueta.etiquetaVarejo');
Route::get('/etiquetaVarejoAtacado', [EtiquetaController::class, 'etiquetaVarejoAtacado'])->name('etiqueta.etiquetaVarejoAtacado');
Route::get('/etiquetaComum', [EtiquetaController::class, 'etiquetaComum'])->name('etiqueta.etiquetaComum');
Route::get('/etiquetaPromocao', [EtiquetaController::class, 'etiquetaPromocao'])->name('etiqueta.etiquetaPromocao');
Route::get('/etiquetaLoja', [EtiquetaController::class, 'etiquetaLoja'])->name('etiqueta.etiquetaLoja');

Route::get("/util/buscarcnpj/{cnpj}", [UtilController::class, "buscarCNPJ"])->name("buscarCNPJ");

//ROTA FLUXO DE CAIXA
Route::get('/caixa', [CaixaController::class, 'index'])->name('caixa.index');
//Rota de saidas do caixa
Route::get('/saida', [SaidaController::class, 'index'])->name('saida.index');
Route::post('/saidas.store', [SaidaController::class, 'store'])->name('saidas.store');
//Rota de entradas do caixa
Route::get('/entrada', [EntradaController::class, 'index'])->name('entrada.index');
Route::post('/store', [EntradaController::class, 'store'])->name('entrada.store');


});

require __DIR__.'/auth.php';

