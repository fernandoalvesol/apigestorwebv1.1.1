<?php


use App\Models\Cliente;
use App\Models\Emitente;
use App\Models\Fornecedor;
use App\Models\NaturezaOperacao;
use App\Models\Nfe;
use App\Models\NfeDestinatario;
use App\Models\NfeEntrada;
use App\Models\NfeEntradaDuplicata;
use App\Models\NfeEntradaItem;
use App\Models\NfeItem;
use App\Models\NfeReferenciado;
use App\Models\Produto;
use App\Models\ProdutoFornecedor;
use App\Models\Tributacao;
use App\Models\TributacaoProduto;
use App\Service\ConstanteService;
use App\Service\ItemNotafiscalService;
use App\Service\NotaFiscalOperacaoService;

function lerXml($xmlOrigem){
    $xml     = simplexml_load_file($xmlOrigem);
    if(isset($xml->NFe)){
        $xml_nfe = $xml->NFe->infNFe;
    }elseif($xml->infNFe){
        $xml_nfe = $xml->infNFe;
    }


    $identificacao      = $xml_nfe->ide;
    $emitenteXml        = $xml_nfe->emit;
    $produtosXml        = $xml_nfe->det ;
    $totais             = $xml_nfe->total ;
    $transportadoraNfe  = $xml_nfe->transp;

    $intermediarioXml   = $xml_nfe->Intermed ?? null;
    $infAdicXml         = $xml_nfe->infAdic ?? null;
    $duplicataXml       = $xml_nfe->cobr->dup ?? null;
    $pagamentoXml       = $xml_nfe->pag ?? null;
    $totalXml           = ($totais->ICMSTot) ?? null;

    $chaveNfe=  $xml_nfe->attributes()->Id;
    $chave   = substr($chaveNfe, 3, 44);

    //Dados de Identificação
    $nfe            = new \stdClass();
    $nfe->cUF       = $identificacao->cUF;
    $nfe->chave     = $chave;
    $nfe->cNF       = $identificacao->cNF;
    $nfe->natOp     = $identificacao->natOp;
    $nfe->modelo	= $identificacao->mod 			;
    $nfe->serie 	= $identificacao->serie 		;
    $nfe->nNF 		= $identificacao->nNF 			;
    $nfe->dhEmi 	= $identificacao->dhEmi 		;
    $nfe->dhSaiEnt 	= $identificacao->dhSaiEnt 		;
    $nfe->tpNF 		= $identificacao->tpNF 			;
    $nfe->idDest 	= $identificacao->idDest 		;
    $nfe->cMunFG 	= $identificacao->cMunFG 		;
    $nfe->tpImp 	= $identificacao->tpImp 		;
    $nfe->tpEmis 	= $identificacao->tpEmis 		;
    $nfe->cDV 		= $identificacao->cDV 			;
    $nfe->tpAmb 	= $identificacao->tpAmb 		;
    $nfe->finNFe 	= $identificacao->finNFe 		;
    $nfe->indFinal 	= $identificacao->indFinal 		;
    $nfe->indPres 	= $identificacao->indPres 		;
    $nfe->indIntermed = $identificacao->indIntermed 	;
    $nfe->procEmi 	= $identificacao->procEmi 		;
    $nfe->verProc 	= $identificacao->verProc 		;
    $nfe->dhCont 	= ($identificacao->dhCont) ?? null 		;
    $nfe->xJust 	= ($identificacao->xJust) ?? null 		;
    $nfe->modFrete 	= ($transportadoraNfe->modFrete) ?? null 		;

    $emitente               = new \stdClass();
    $emitente->CNPJ         = ($emitenteXml->CNPJ) ? $emitenteXml->CNPJ : $emitenteXml->CPF;
    $emitente->xNome        = $emitenteXml->xNome;
    $emitente->xFant        = $emitenteXml->xFant;
    $emitente->xLgr         = $emitenteXml->enderEmit->xLgr;
    $emitente->nro          = $emitenteXml->enderEmit->nro;
    $emitente->xBairro      = $emitenteXml->enderEmit->xBairro;
    $emitente->UF           = $emitenteXml->enderEmit->UF;
    $emitente->xCpl         = ($emitenteXml->xCpl) ?? null;
    $emitente->fone         = ($emitenteXml->enderEmit->fone) ?? null;
    $emitente->CEP          = $emitenteXml->enderEmit->CEP;
    $emitente->cMun         = $emitenteXml->enderEmit->cMun;
    $emitente->IE           = ($emitenteXml->IE) ?? null;
    $emitente->email        = ($emitenteXml->email) ?? null;
    $emitente->xMun         = $emitenteXml->enderEmit->xMun;

    //Tranportadora
    $transportadora = new stdClass();
    $transportadora->CNPJ        = $transportadoraNfe->transporta->CNPJ ?? null ;
    $transportadora->xNome       = $transportadoraNfe->transporta->xNome ?? null;
    $transportadora->xEnder      = $transportadoraNfe->transporta->xEnder ?? null;
    $transportadora->xMun        = $transportadoraNfe->transporta->xMun ?? null;
    $transportadora->UF          = $transportadoraNfe->transporta->UF ?? null;
    $transportadora->IE          = $transportadoraNfe->transporta->IE ?? null;

    //Volume
    $volume = new stdClass();
    $volume->qVol               = $transportadoraNfe->vol->qVol ?? null;
    $volume->esp                = $transportadoraNfe->vol->esp ?? null;
    $volume->marca              = $transportadoraNfe->vol->marca ?? null;
    $volume->pesoL              = $transportadoraNfe->vol->pesoL ?? null;
    $volume->pesoB              = $transportadoraNfe->vol->pesoB ?? null;

    //Veículo
    $veiculo = new stdClass();
    $veiculo->placa             = $transportadoraNfe->veicTransp->placa ?? null;
    $veiculo->UF                = $transportadoraNfe->veicTransp->UF ?? null;
    $veiculo->RNTC              = $transportadoraNfe->veicTransp->RNTC  ?? null;

    //Reboque
    $reboque = new stdClass();
    $reboque->placa = $transportadoraNfe->reboque->placa ?? null;
    $reboque->UF    = $transportadoraNfe->reboque->UF ?? null;
    $reboque->RNTC  = $transportadoraNfe->reboque->RNTC  ?? null;

    //Vagão
    $vagaoBalsa = new stdClass();
    $vagaoBalsa->vagao         = $transportadoraNfe->vagao->vagao  ?? null;
    $vagaoBalsa->balsa         = $transportadoraNfe->vagao->balsa  ?? null;
    $vagaoBalsa->nLacre        = $transportadoraNfe->lacres->nLacre   ?? null;



    $intermediario = new stdClass();
    $intermediario->CNPJ                = $intermediarioXml->CNPJ    ?? null;
    $intermediario->idCadIntTran        = $intermediarioXml->idCadIntTran    ?? null;

    $observacao             = new stdClass();
    $observacao->infAdFisco = $infAdicXml->infAdFisco ?? null;
    $observacao->infCpl     = $infAdicXml->infCpl  ?? null;


    //Totais da Nota
    $total = new stdClass();
    $total->vFrete        = ($totalXml->vFrete) ?? null 	;
    $total->vSeg          = ($totalXml->vSeg) ?? null 	;
    $total->vNF           = ($totalXml->vNF) ?? null 	;
    $total->vOrig         = ($totalXml->vOrig) ?? null 	;
    $total->vLiq          = ($totalXml->vLiq) ?? null 	;
    $total->vBC           = ($totalXml->vBC) ?? null 	;
    $total->vICMS         = ($totalXml->vICMS) ?? null 	;
    $total->vICMSDeson    = ($totalXml->vICMSDeson) ?? null 	;
    $total->vFCP          = ($totalXml->vFCP) ?? null 	;
    $total->vBCST         = ($totalXml->vBCST) ?? null 	;
    $total->vST           = ($totalXml->vST) ?? null 	;
    $total->vFCPST        = ($totalXml->vFCPST) ?? null 	;
    $total->vFCPSTRet     = ($totalXml->vFCPSTRet) ?? null 	;
    $total->vProd         = ($totalXml->vProd) ?? null 	;
    $total->vFrete        = ($totalXml->vFrete) ?? null 	;
    $total->vSeg          = ($totalXml->vSeg) ?? null 	;
    $total->vDesc         = ($totalXml->vDesc) ?? null 	;
    $total->vII           = ($totalXml->vII) ?? null 	;
    $total->vIPI          = ($totalXml->vIPI) ?? null 	;
    $total->vIPIDevol     = ($totalXml->vIPIDevol) ?? null 	;
    $total->vPIS          = ($totalXml->vPIS) ?? null 	;
    $total->vCOFINS       = ($totalXml->vCOFINS) ?? null 	;
    $total->vOutro        = ($totalXml->vOutro) ?? null 	;
    $total->vNF           = ($totalXml->vNF) ?? null 	;
    $total->vTotTrib      = ($totalXml->vTotTrib) ?? null 	;


    //Produtos
    $produtos = array() ;
    foreach($produtosXml as $item) {
        $produto            = new \stdClass();
        $produto->item      = $item->attributes()->nItem;
        $produto->cProd     =   $item->prod->cProd;
        $produto->xProd		=	str_replace("'", "", $item->prod->xProd);
        $produto->cEAN		=	($item->prod->cEAN) ?? null;
        $produto->cBarra	=	($item->prod->cBarra) ?? null;
        $produto->xProd		=	$item->prod->xProd;
        $produto->NCM		=	$item->prod->NCM;
        $produto->cBenef	=	($item->prod->cBenef) ?? null;
        $produto->EXTIPI	=	($item->prod->EXTIPI) ?? null;
        $produto->CFOP		=	$item->prod->CFOP;
        $produto->uCom		=	$item->prod->uCom;
        $produto->qCom		=	$item->prod->qCom;
        $produto->vUnCom	=	$item->prod->vUnCom;
        $produto->vProd		=	$item->prod->vProd;
        $produto->CEST		=	$item->prod->CEST ?? null;
        $produto->cEANTrib	=	($item->prod->cEANTrib) ?? null;
        $produto->cBarraTrib=	($item->prod->cBarraTrib) ?? null;
        $produto->uTrib		=	$item->prod->uTrib;
        $produto->qTrib		=	$item->prod->qTrib;
        $produto->vUnTrib	=	$item->prod->vUnTrib;
        $produto->vFrete	=	($item->prod->vFrete) ? $item->prod->vFrete : 0;
        $produto->vSeg		=	($item->prod->vSeg) ? $item->prod->vSeg : 0;
        $produto->vDesc		=	($item->prod->vDesc) ? $item->prod->vDesc : 0;
        $produto->vOutro	=	($item->prod->vOutro) ? $item->prod->vOutro : 0;
        $produto->indTot	=	($item->prod->indTot) ?? null;
        $produto->xPed		=	($item->prod->xPed) ?? null;
        $produto->nItemPed	=	($item->prod->nItemPed) ?? null;
        $produto->nFCI		=	($item->prod->nFCI) ?? null;

        //IMPOSTOS
        $icms00 = $item->imposto->ICMS->ICMS00 ?? null;
        $icms10 = $item->imposto->ICMS->ICMS10 ?? null;
        $icms20 = $item->imposto->ICMS->ICMS20 ?? null;
        $icms30 = $item->imposto->ICMS->ICMS30 ?? null;
        $icms40 = $item->imposto->ICMS->ICMS40 ?? null;
        $icms50 = $item->imposto->ICMS->ICMS50 ?? null;
        $icms51 = $item->imposto->ICMS->ICMS51 ?? null;
        $icms60 = $item->imposto->ICMS->ICMS60 ?? null;
        $icms70 = $item->imposto->ICMS->ICMS70 ?? null;
        $icms90 = $item->imposto->ICMS->ICMS90 ?? null;
        $ICMSST = $item->imposto->ICMS->ICMSST ?? null;
        $ICMSSN101 = $item->imposto->ICMS->ICMSSN101 ?? null;
        $ICMSSN102 = $item->imposto->ICMS->ICMSSN102 ?? null;
        $ICMSSN900 = $item->imposto->ICMS->ICMSSN900 ?? null;
        $IPI      = $item->imposto->IPI ?? null;
        $PIS      = $item->imposto->PIS ?? null;
        $PISST    = $item->imposto->PISST ?? null;
        $COFINS   = $item->imposto->COFINS ?? null;
        $COFINSST = $item->imposto->COFINSST ?? null;

        $icms       = new stdClass();
        $ipi        = new stdClass();
        $pis        = new stdClass();
        $pisSt      = new stdClass();
        $cofins     = new stdClass();
        $cofinsSt   = new stdClass();


        if($icms00){
            $icms->orig    = $item->imposto->ICMS->ICMS00->orig;
            $icms->cstICMS = $item->imposto->ICMS->ICMS00->CST;
            $icms->modBC   = $item->imposto->ICMS->ICMS00->modBC ?? null;
            $icms->vBCICMS = $item->imposto->ICMS->ICMS00->vBC;
            $icms->pICMS   = $item->imposto->ICMS->ICMS00->pICMS;
            $icms->vICMS   = $item->imposto->ICMS->ICMS00->vICMS;

            $icms->pFCP    = $item->imposto->ICMS->ICMS00->pFCP ?? null;
            $icms->vFCP    = $item->imposto->ICMS->ICMS00->vFCP ?? null;
        }

        if($icms10){
            $icms->orig    = $item->imposto->ICMS->ICMS10->orig;
            $icms->cstICMS = $item->imposto->ICMS->ICMS10->CST;
            $icms->modBC   = $item->imposto->ICMS->ICMS00->modBC ?? null;
            $icms->vBCICMS = $item->imposto->ICMS->ICMS10->vBC;
            $icms->pICMS   = $item->imposto->ICMS->ICMS10->pICMS;
            $icms->vICMS   = $item->imposto->ICMS->ICMS10->vICMS;

            $icms->vBCFCP  = $item->imposto->ICMS->ICMS10->vBCFCP ?? null;
            $icms->pFCP    = $item->imposto->ICMS->ICMS10->pFCP ?? null;
            $icms->vFCP    = $item->imposto->ICMS->ICMS10->vFCP ?? null;
            $icms->modBCST = $item->imposto->ICMS->ICMS10->modBCST ?? null;
            $icms->pMVAST  = $item->imposto->ICMS->ICMS10->pMVAST ?? null;
            $icms->pRedBCST= $item->imposto->ICMS->ICMS10->pRedBCST ?? null;
            $icms->vBCST   = $item->imposto->ICMS->ICMS10->vBCST ?? null;
            $icms->pICMSST = $item->imposto->ICMS->ICMS10->pICMSST ?? null;
            $icms->vBCFCPST= $item->imposto->ICMS->ICMS10->vBCFCPST ?? null;
            $icms->pFCPST  = $item->imposto->ICMS->ICMS10->pFCPST ?? null;
            $icms->vFCPST  = $item->imposto->ICMS->ICMS10->vFCPST ?? null;
        }

        if($icms20){
            $icms->orig    = $item->imposto->ICMS->ICMS20->orig;
            $icms->cstICMS = $item->imposto->ICMS->ICMS20->CST;
            $icms->modBC   = $item->imposto->ICMS->ICMS20->modBC ?? null;
            $icms->pRedBC  = $item->imposto->ICMS->ICMS20->pRedBC ?? null;
            $icms->vBCICMS = $item->imposto->ICMS->ICMS20->vBC;
            $icms->pICMS   = $item->imposto->ICMS->ICMS20->pICMS;
            $icms->vICMS   = $item->imposto->ICMS->ICMS20->vICMS;

            $icms->vBCFCP  = $item->imposto->ICMS->ICMS20->vBCFCP ?? null;
            $icms->pFCP    = $item->imposto->ICMS->ICMS20->pFCP ?? null;
            $icms->vFCP    = $item->imposto->ICMS->ICMS20->vFCP ?? null;

            $icms->vICMSDeson = $item->imposto->ICMS->ICMS20->vICMSDeson ?? null;
            $icms->motDesICMS = $item->imposto->ICMS->ICMS20->motDesICMS ?? null;
        }

        if($icms30){
            $icms->orig    = $item->imposto->ICMS->ICMS30->orig;
            $icms->cstICMS = $item->imposto->ICMS->ICMS30->CST;
            $icms->modBCST   = $item->imposto->ICMS->ICMS30->modBCST ?? null;
            $icms->pMVAST  = $item->imposto->ICMS->ICMS30->pMVAST ?? null;
            $icms->pRedBCST = $item->imposto->ICMS->ICMS30->pRedBCST;
            $icms->vBCST   = $item->imposto->ICMS->ICMS30->vBCST;
            $icms->pICMSST   = $item->imposto->ICMS->ICMS30->pICMSST;
            $icms->vICMSST  = $item->imposto->ICMS->ICMS30->vICMSST ?? null;

            $icms->vBCFCPST    = $item->imposto->ICMS->ICMS30->vBCFCPST ?? null;
            $icms->pFCPST    = $item->imposto->ICMS->ICMS30->pFCPST ?? null;
            $icms->vFCPST    = $item->imposto->ICMS->ICMS30->vFCPST ?? null;

            $icms->vICMSDeson = $item->imposto->ICMS->ICMS30->vICMSDeson ?? null;
            $icms->motDesICMS = $item->imposto->ICMS->ICMS30->motDesICMS ?? null;
        }

        if($icms40){
            $icms->cstICMS = $item->imposto->ICMS->ICMS40->CST;

            $icms->vICMSDeson = $item->imposto->ICMS->ICMS40->vICMSDeson ?? null;
            $icms->motDesICMS = $item->imposto->ICMS->ICMS40->motDesICMS ?? null;
        }

        if($icms50){
            $icms->cstICMS = $item->imposto->ICMS->ICMS50->CST;

            $icms->vICMSDeson = $item->imposto->ICMS->ICMS50->vICMSDeson ?? null;
            $icms->motDesICMS = $item->imposto->ICMS->ICMS50->motDesICMS ?? null;
        }

        if($icms51){
            $icms->orig    = $item->imposto->ICMS->ICMS51->orig;
            $icms->cstICMS = $item->imposto->ICMS->ICMS51->CST;
            $icms->modBC   = $item->imposto->ICMS->ICMS51->modBC ?? null;
            $icms->pRedBC   = $item->imposto->ICMS->ICMS51->pRedBC ?? null;
            $icms->vBC   = $item->imposto->ICMS->ICMS51->vBC ?? null;
            $icms->pICMS   = $item->imposto->ICMS->ICMS51->pICMS ?? null;
            $icms->vICMSOp   = $item->imposto->ICMS->ICMS51->vICMSOp ?? null;
            $icms->pDif   = $item->imposto->ICMS->ICMS51->pDif ?? null;
            $icms->vICMSDif   = $item->imposto->ICMS->ICMS51->vICMSDif ?? null;
            $icms->vICMS   = $item->imposto->ICMS->ICMS51->vICMS ?? null;

            $icms->vBCFCP   = $item->imposto->ICMS->ICMS51->vBCFCP ?? null;
            $icms->pFCP   = $item->imposto->ICMS->ICMS51->pFCP ?? null;
            $icms->vFCP   = $item->imposto->ICMS->ICMS51->vFCP ?? null;
        }

        if($icms60){
            $icms->orig    = $item->imposto->ICMS->ICMS60->orig;
            $icms->cstICMS = $item->imposto->ICMS->ICMS60->CST;

            $icms->vBCSTRet = $item->imposto->ICMS->ICMS60->vBCSTRet ?? null;
            $icms->pST = $item->imposto->ICMS->ICMS60->pST ?? null;
            $icms->vICMSSubstituto = $item->imposto->ICMS->ICMS60->vICMSSubstituto ?? null;
            $icms->vICMSSTRet = $item->imposto->ICMS->ICMS60->vICMSSTRet ?? null;

            $icms->vBCFCPSTRet = $item->imposto->ICMS->ICMS60->vBCFCPSTRet ?? null;
            $icms->pFCPSTRet = $item->imposto->ICMS->ICMS60->pFCPSTRet ?? null;
            $icms->vFCPSTRet = $item->imposto->ICMS->ICMS60->vFCPSTRet ?? null;

            $icms->pRedBCEfet = $item->imposto->ICMS->ICMS60->pRedBCEfet ?? null;
            $icms->vBCEfet = $item->imposto->ICMS->ICMS60->vBCEfet ?? null;
            $icms->pICMSEfet = $item->imposto->ICMS->ICMS60->pICMSEfet ?? null;
            $icms->vICMSEfet = $item->imposto->ICMS->ICMS60->vICMSEfet ?? null;

        }

        if($icms70){
            $icms->orig    = $item->imposto->ICMS->ICMS70->orig;
            $icms->cstICMS = $item->imposto->ICMS->ICMS70->CST;

            $icms->modBC = $item->imposto->ICMS->ICMS70->modBC ?? null;
            $icms->pRedBC = $item->imposto->ICMS->ICMS70->pRedBC ?? null;
            $icms->vBC = $item->imposto->ICMS->ICMS70->vBC ?? null;
            $icms->pICMS = $item->imposto->ICMS->ICMS70->pICMS ?? null;
            $icms->vICMS = $item->imposto->ICMS->ICMS70->vICMS ?? null;

            $icms->vBCFCP = $item->imposto->ICMS->ICMS70->vBCFCP ?? null;
            $icms->pFCP = $item->imposto->ICMS->ICMS70->pFCP ?? null;
            $icms->vFCP = $item->imposto->ICMS->ICMS70->vFCP ?? null;
            $icms->modBCST = $item->imposto->ICMS->ICMS70->modBCST ?? null;
            $icms->pMVAST = $item->imposto->ICMS->ICMS70->pMVAST ?? null;
            $icms->pRedBCST = $item->imposto->ICMS->ICMS70->pRedBCST ?? null;
            $icms->vBCST = $item->imposto->ICMS->ICMS70->vBCST ?? null;
            $icms->pICMSST = $item->imposto->ICMS->ICMS70->pICMSST ?? null;
            $icms->vICMSST = $item->imposto->ICMS->ICMS70->vICMSST ?? null;

            $icms->vBCFCPST = $item->imposto->ICMS->ICMS70->vBCFCPST ?? null;
            $icms->pFCPST = $item->imposto->ICMS->ICMS70->pFCPST ?? null;
            $icms->vFCPST = $item->imposto->ICMS->ICMS70->vFCPST ?? null;

            $icms->vICMSDeson = $item->imposto->ICMS->ICMS70->vICMSDeson ?? null;
            $icms->motDesICMS = $item->imposto->ICMS->ICMS70->motDesICMS ?? null;

        }

        if($icms90){
            $icms->orig    = $item->imposto->ICMS->ICMS90->orig;
            $icms->cstICMS = $item->imposto->ICMS->ICMS90->CST;

            $icms->modBC = $item->imposto->ICMS->ICMS90->modBC ?? null;
            $icms->vBC = $item->imposto->ICMS->ICMS90->vBC ?? null;
            $icms->pRedBC = $item->imposto->ICMS->ICMS90->pRedBC ?? null;
            $icms->pICMS = $item->imposto->ICMS->ICMS90->pICMS ?? null;
            $icms->vICMS = $item->imposto->ICMS->ICMS90->vICMS ?? null;

            $icms->modBCST = $item->imposto->ICMS->ICMS90->modBCST ?? null;
            $icms->pMVAST = $item->imposto->ICMS->ICMS90->pMVAST ?? null;
            $icms->pRedBCST = $item->imposto->ICMS->ICMS90->pRedBCST ?? null;
            $icms->vBCST = $item->imposto->ICMS->ICMS90->vBCST ?? null;
            $icms->pICMSST = $item->imposto->ICMS->ICMS90->pICMSST ?? null;
            $icms->vICMSST = $item->imposto->ICMS->ICMS90->vICMSST ?? null;

            $icms->vBCFCPST = $item->imposto->ICMS->ICMS90->vBCFCPST ?? null;
            $icms->pFCPST = $item->imposto->ICMS->ICMS90->pFCPST ?? null;
            $icms->vFCPST = $item->imposto->ICMS->ICMS90->vFCPST ?? null;

            $icms->vICMSDeson = $item->imposto->ICMS->ICMS90->vICMSDeson ?? null;
            $icms->motDesICMS = $item->imposto->ICMS->ICMS90->motDesICMS ?? null;

        }
        if($ICMSST){
            $icms->orig    = $item->imposto->ICMS->ICMSST->orig;
            $icms->cstICMS = $item->imposto->ICMS->ICMSST->CST;
            $icms->vBCSTRet   = $item->imposto->ICMS->ICMSST->vBCSTRet ?? null;
            $icms->pST   = $item->imposto->ICMS->ICMSST->pST ?? null;
            $icms->vICMSSubstituto   = $item->imposto->ICMS->ICMSST->vICMSSubstituto ?? null;
            $icms->vICMSSTRet   = $item->imposto->ICMS->ICMSST->vICMSSTRet ?? null;

            $icms->vBCFCPSTRet   = $item->imposto->ICMS->ICMSST->vBCFCPSTRet ?? null;
            $icms->pFCPSTRet   = $item->imposto->ICMS->ICMSST->pFCPSTRet ?? null;
            $icms->vFCPSTRet   = $item->imposto->ICMS->ICMSST->vFCPSTRet ?? null;
            $icms->vBCSTDest   = $item->imposto->ICMS->ICMSST->vBCSTDest ?? null;
            $icms->vICMSSTDest   = $item->imposto->ICMS->ICMSST->vICMSSTDest ?? null;

            $icms->pRedBCEfet   = $item->imposto->ICMS->ICMSST->pRedBCEfet ?? null;
            $icms->vBCEfet   = $item->imposto->ICMS->ICMSST->vBCEfet ?? null;
            $icms->pICMSEfet   = $item->imposto->ICMS->ICMSST->pICMSEfet ?? null;
            $icms->vICMSEfet   = $item->imposto->ICMS->ICMSST->vICMSEfet ?? null;

        }

        if($ICMSSN101){
            $icms->orig    = $item->imposto->ICMS->ICMSSN101->orig;
            $icms->cstICMS = $item->imposto->ICMS->ICMSSN101->CSOSN;
            $icms->pCredSN = $item->imposto->ICMS->ICMSSN101->pCredSN ?? null;
            $icms->vCredICMSSN = $item->imposto->ICMS->ICMSSN101->vCredICMSSN ?? null;
        }

        if($ICMSSN102){
            $icms->orig    = $item->imposto->ICMS->ICMSSN102->orig;
            $icms->cstICMS = $item->imposto->ICMS->ICMSSN102->CSOSN;
        }

        if($ICMSSN900){
            $icms->orig    = $item->imposto->ICMS->ICMSSN900->orig;
            $icms->cstICMS = $item->imposto->ICMS->ICMSSN900->CSOSN;

            $icms->modBC   = $item->imposto->ICMS->ICMSSN900->modBC ?? null;
            $icms->vBCICMS = $item->imposto->ICMS->ICMSSN900->vBC ?? null;
            $icms->pRedBC   = $item->imposto->ICMS->ICMSSN900->pRedBC ?? null;
            $icms->pICMS   = $item->imposto->ICMS->ICMSSN900->pICMS ?? null;
            $icms->vICMS   = $item->imposto->ICMS->ICMSSN900->vICMS ?? null;

            $icms->modBCST   = $item->imposto->ICMS->ICMSSN900->modBCST ?? null;
            $icms->pMVAST   = $item->imposto->ICMS->ICMSSN900->pMVAST ?? null;
            $icms->pRedBCST   = $item->imposto->ICMS->ICMSSN900->pRedBCST ?? null;
            $icms->vBCST   = $item->imposto->ICMS->ICMSSN900->vBCST ?? null;
            $icms->pICMSST   = $item->imposto->ICMS->ICMSSN900->pICMSST ?? null;
            $icms->vICMSST   = $item->imposto->ICMS->ICMSSN900->vICMSST ?? null;

            $icms->vBCFCPST   = $item->imposto->ICMS->ICMSSN900->vBCFCPST ?? null;
            $icms->pFCPST   = $item->imposto->ICMS->ICMSSN900->pFCPST ?? null;
            $icms->vFCPST   = $item->imposto->ICMS->ICMSSN900->vFCPST ?? null;

            $icms->pCredSN   = $item->imposto->ICMS->ICMSSN900->pCredSN ?? null;
            $icms->vCredICMSSN   = $item->imposto->ICMS->ICMSSN900->vCredICMSSN ?? null;
        }

        if($IPI){
            $ipi->CNPJProd = $item->imposto->IPI->CNPJProd ?? null;
            $ipi->cSelo = $item->imposto->IPI->cSelo ?? null;
            $ipi->qSelo = $item->imposto->IPI->qSelo ?? null;
            $ipi->cEnq = $item->imposto->IPI->cEnq ?? null;

            if(isset($item->imposto->IPI->IPITrib)){
                $ipi->cstIPI = $item->imposto->IPI->IPITrib->CST ?? null;
                $ipi->vBCIPI = $item->imposto->IPI->IPITrib->vBC ?? null;
                $ipi->pIPI   = $item->imposto->IPI->IPITrib->pIPI ?? null;
                $ipi->vIPI   = $item->imposto->IPI->IPITrib->vIPI ?? null;

                $ipi->qUnid   = $item->imposto->IPI->IPITrib->qUnid ?? null;
                $ipi->vUnid   = $item->imposto->IPI->IPITrib->vUnid ?? null;
                $ipi->vIPI   = $item->imposto->IPI->IPITrib->vIPI ?? null;
                $ipi->vIPI   = $item->imposto->IPI->IPITrib->vIPI ?? null;
            }

            if(isset($item->imposto->IPI->IPINT)){
                $ipi->cstIPI = $item->imposto->IPI->IPINT->CST;
            }
        }

        if($PIS){
            if(isset($item->imposto->PIS->PISAliq)){
                $pis->cstPIS = $item->imposto->PIS->PISAliq->CST ?? null;
                $pis->vBCPIS = $item->imposto->PIS->PISAliq->vBC ?? null;
                $pis->pPIS   = $item->imposto->PIS->PISAliq->pPIS ?? null;
                $pis->vPIS   = $item->imposto->PIS->PISAliq->vPIS ?? null;
            }

            if(isset($item->imposto->PIS->PISQtde)){
                $pis->cstPIS = $item->imposto->PIS->PISQtde->CST ?? null;
                $pis->qBCProdPis = $item->imposto->PIS->PISQtde->qBCProd ?? null;
                $pis->vAliqProd_pis   = $item->imposto->PIS->PISQtde->vAliqProd ?? null;
                $pis->vPIS   = $item->imposto->PIS->PISQtde->vPIS ?? null;
            }

            if(isset($item->imposto->PIS->PISNT)){
                $pis->cstPIS = $item->imposto->PIS->PISNT->CST ?? null;
            }

            if(isset($item->imposto->PIS->PISOutr)){
                $pis->cstPIS    = $item->imposto->PIS->PISOutr->CST ?? null;
                $pis->vBCPIS    = $item->imposto->PIS->PISOutr->vBC ?? null;
                $pis->pPIS      = $item->imposto->PIS->PISOutr->pPIS ?? null;
                $pis->qBCProdPis   = $item->imposto->PIS->PISOutr->qBCProd ?? null;
                $pis->vAliqProd_pis = $item->imposto->PIS->PISOutr->vAliqProd ?? null;
                $pis->vPIS      = $item->imposto->PIS->PISOutr->vIPI ?? null;
            }

        }

        if($PISST){
            $pisSt->vBCPISST = $item->imposto->PISST->vBC ?? null;
            $pisSt->pPISST = $item->imposto->PISST->pPIS ?? null;
            $pisSt->qBCProdPisST = $item->imposto->PISST->qBCProd ?? null;
            $pisSt->vAliqProd_pisst = $item->imposto->PISST->vAliqProd ?? null;
            $pisSt->vPISST = $item->imposto->PISST->vPIS ?? null;
        }

        if($COFINS){
            if(isset($item->imposto->COFINS->COFINSAliq)){
                $cofins->cstCOFINS = $item->imposto->COFINS->COFINSAliq->CST ?? null;
                $cofins->vBCCOFINS = $item->imposto->COFINS->COFINSAliq->vBC ?? null;
                $cofins->pCOFINS   = $item->imposto->COFINS->COFINSAliq->pCOFINS ?? null;
                $cofins->vCOFINS   = $item->imposto->COFINS->COFINSAliq->vCOFINS ?? null;
            }

            if(isset($item->imposto->COFINS->COFINSQtde)){
                $cofins->cstCOFINS = $item->imposto->COFINS->COFINSQtde->CST ?? null;
                $cofins->qBCProdConfis = $item->imposto->COFINS->COFINSQtde->qBCProd ?? null;
                $cofins->vAliqProd_cofins   = $item->imposto->COFINS->COFINSQtde->vAliqProd ?? null;
                $cofins->vCOFINS   = $item->imposto->COFINS->COFINSQtde->vCOFINS ?? null;
            }

            if(isset($item->imposto->COFINS->COFINSNT)){
                $cofins->cstCOFINS = $item->imposto->COFINS->COFINSNT->CST ?? null;
            }

            if(isset($item->imposto->COFINS->COFINSOutr)){
                $cofins->cstCOFINS    = $item->imposto->COFINS->COFINSOutr->CST ?? null;
                $cofins->vBCCOFINS    = $item->imposto->COFINS->COFINSOutr->vBC ?? null;
                $cofins->pCOFINS      = $item->imposto->COFINS->COFINSOutr->pCOFINS ?? null;
                $cofins->qBCProdConfis       = $item->imposto->COFINS->COFINSOutr->qBCProd ?? null;
                $cofins->vAliqProd_cofins     = $item->imposto->COFINS->COFINSOutr->vAliqProd ?? null;
                $cofins->vCOFINS      = $item->imposto->COFINS->COFINSOutr->vCOFINS ?? null;
            }

        }

        if($COFINSST){
            $cofinsSt->vBCCOFINSST     = $item->imposto->COFINSST->vBC ?? null;
            $cofinsSt->pCOFINSST       = $item->imposto->COFINSST->pCOFINS ?? null;
            $cofinsSt->qBCProdConfisST = $item->imposto->COFINSST->qBCProd ?? null;
            $cofinsSt->vAliqProd_cofinsst = $item->imposto->COFINSST->vAliqProd ?? null;
            $cofinsSt->vCOFINSST       = $item->imposto->COFINSST->vCOFINS ?? null;
        }

        $produtos[]   = (object) array(
            "produto"   => $produto,
            "icms"      => $icms,
            "ipi"       => $ipi,
            "pis"      => $pis,
            "pisSt"      => $pisSt,
            "cofins"      => $cofins,
            "cofinsSt"      => $cofinsSt,
        );
    }

    //Duplicatas

    $duplicatas = array();
    if($duplicataXml){
        foreach ($duplicataXml as $dup){
            $duplicata          = new \stdClass();
            $duplicata->nDup    = ($dup->nDup) ?? null;
            $duplicata->dVenc   = ($dup->dVenc) ?? null;
            $duplicata->vDup    = ($dup->vDup) ?? null;
            $duplicatas[]       = $duplicata;
        }
    }


    $nota = new stdClass();
    $nota->identificacao    = $nfe;
    $nota->emitente         = $emitente;
    $nota->transportadora   = $transportadora;
    $nota->volume           = $volume;
    $nota->veiculo          = $veiculo;
    $nota->reboque          = $reboque;
    $nota->vagaoBalsa       = $vagaoBalsa;
    $nota->intermediario    = $intermediario;
    $nota->observacao       = $observacao;
    $nota->total            = $total;
    $nota->produtos         = $produtos;
    $nota->duplicatas       = $duplicatas;
    $nota->tPag             = $pagamentoXml->detPag->tPag ?? null;


    return $nota;
}




