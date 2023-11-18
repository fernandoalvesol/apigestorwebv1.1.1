<?php

namespace App\Observers;

use App\Models\IcmsEstado;
use App\Models\Nfe;
use App\Models\NfeItem;
use App\Models\Produto;
use App\Models\Tributacao;
use App\Models\TributacaoIva;
use App\Service\ItemNotaFiscalService;

class ItemNotaFiscalObserver
{
    public function creating(NfeItem $item){
            $produto        = Produto::find($item->cProd);
            $nfe            = Nfe::find($item->nfe_id);
            $tributacao     = Tributacao::getTributacaoPadrao($nfe->natureza_operacao_id, $produto->id);

            $item->cEAN         = ($produto->gtin) ? $produto->gtin :"SEM GTIN";
            $item->xProd        = tiraAcento($produto->nome);
            $item->NCM          = tira_mascara($produto->ncm);
            $item->cBenef       = $produto->cbenef; //incluido no layout 4.00
            $item->EXTIPI       = $produto->tipi;
            $item->CEST         = $produto->cest;
            $item->uCom         = tiraAcento($produto->unidade);
            $item->cEANTrib     = ($produto->gtin) ? $produto->gtin :"SEM GTIN";
            $item->xPed         = $item->nfe_id  ;
            $item->uTrib        = tiraAcento($produto->unidade);
            $item->qTrib        = $item->qCom;

            $item->vUnTrib      = $item->vUnCom;
            $item->indTot       = 1;

            $item->CFOP 		= ItemNotaFiscalService::buscaCfop($nfe, $tributacao);

            //Definindo a Alíquota do ICMS
            $cstIcms    = $tributacao->cstICMS;
            $icms_estado =  IcmsEstado::where(["uf_origem"=>$nfe->em_UF, "uf_destino"=>$nfe->destinatario->dest_UF])->first();
            if(!$icms_estado){
                throw new \Exception('Alíquota Icms Estado não encontrada');
            }
            $pICMS  = $icms_estado->aliquota_destino;
            $pICMSST= $icms_estado->aliquota_origem;
            $vPauta = $produto->vPauta;

            if($nfe->em_UF==$nfe->destinatario->dest_UF){
                if($produto->pIcms){
                    $pICMS=$produto->pIcms;
                }elseif($tributacao->pICMS){
                    $pICMS = $tributacao->pICMS;
                }
            }

            //Verificação do IVA para Cálculo da Substituição Tributária
            $array = ["10", "30", "70", "201", "202","203","90","500"];
            if (in_array($tributacao->cstICMS, $array)) {
                $iva = TributacaoIva::where(["tributacao_id" => $tributacao->id, "uf_origem"=>$nfe->em_UF,"uf_destino"=>$nfe->destinatario->DEST_UF])->first();
                if(!$iva){
                    $iva = TributacaoIva::where(["tributacao_id" => $tributacao->id, "uf_origem"=>$nfe->em_UF,"uf_destino"=>"TD"])->first();
                }
                if(!$iva){
                    if($tributacao->cstICMS!="90" && $tributacao->cstICMS!="500"){
                        throw new \Exception('É Obrigatório o Cadastro de IVA para este CST, vá em natureza da operação->tributações e cadastre-o');
                    }
                }

                if($iva){
                    $cstIcms        = $iva->cstIcms ? $iva->cstIcms : $tributacao->cstICMS;
                    $pICMS          = $iva->pIcmsInterestadual ? $iva->pIcmsInterestadual : $pICMS;
                    $pICMSST        = $iva->pIcmsIntra ? $iva->pIcmsIntra : $pICMSST;
                    if(!$vPauta){
                        $vPauta = $iva->preco_unit_Pauta_ST;
                    }
                }

            }else{
                $pICMSST = null;
            }




            $item->orig         = $produto->origem ;
            $item->cstICMS      = $cstIcms;
            $item->modBC		= $tributacao->modBC;
            $item->pRedBC		= $tributacao->pRedBC;
            $item->vBCICMS  	= $item->vProd + $item->vOutro + $item->vSeg + $item->vFrete;
            $item->pICMS		= $pICMS;
            $item->modBCST		= $iva->modBCST ?? "4";
            $item->valor_pauta	= $vPauta ;
            $item->qtde_pauta   = $item->quantidade;
            $item->pMVAST		= $iva->pMVAST ?? null;
            $item->pRedBCST		= $iva->pRedBCST ?? null;
            $item->pICMSST		= $pICMSST;
            $item->pBCop		= $tributacao->pBCOp;
            $item->UFST			= $tributacao->UFST;

            $item->motDesICMS	= $tributacao->motDesICMS;
            $item->pCredSN		= $nfe->em_pCredSN;
            $item->pDif			= $iva->pDifal ?? null;
            $item->vBCFCP		= $item->vBCICMS;
            $item->pFCP			= $tributacao->pFCP;
            $item->pFCPST		= $iva->pFCPST ?? null;

            $item->vBCSTRet		= $tributacao->vBCSTRet;
            $item->vICMSSTRet	= $tributacao->vICMSSTRet;
            $item->vBCSTDest	= $tributacao->vBCSTDest;
            $item->vICMSSTDest	= $tributacao->vICMSSTDest;
            $item->vBCFCPSTRet	= $tributacao->vBCFCPSTRet;
            $item->pFCPSTRet	= $tributacao->pFCPSTRet;
            $item->vFCPSTRet	= $tributacao->vFCPSTRet;


            //Cálculo do IPI
            $item->cstIPI         = $tributacao->cstIPI;
            $item->tipo_calc_ipi   = $tributacao->tipo_calc_ipi;
            $item->CNPJProd       = $tributacao->CNPJProd;
            $item->cSelo          = $tributacao->cSelo;
            $item->qSelo          = $tributacao->qSelo;
            $item->cEnq           = $tributacao->cEnq ? $tributacao->cEnq : "999" ;
            $item->vBCIPI         = $item->vProd + $item->vOutro + $item->vSeg + $item->vFrete;
            $item->pIPI           = $tributacao->pIPI;
            $item->qUnidIPI       = $tributacao->qUnidIPI;
            $item->vUnidIPI        = $tributacao->vUnidIPI;

            //Cálculo Pis
            $item->cstPIS         = $tributacao->cstPIS  			   ;
            $item->vBCPIS         = $item->vProd + $item->vOutro + $item->vSeg + $item->vFrete -$item->vDesc;
            $item->pPIS           = $tributacao->pPIS;
            $item->qBCProdPis     = $tributacao->qBCProd_pis;
            $item->vAliqProd_pis  = $tributacao->vAliqProd_pis;
            $item->tipo_calc_pis   = $tributacao->tipo_calc_pis;

            //Cálculo Cofins
            $item->cstCOFINS= $tributacao->cstCOFINS		   ;
            $item->vBCCOFINS        = $item->vProd + $item->vOutro + $item->vSeg + $item->vFrete -$item->vDesc;
            $item->pCOFINS          = $tributacao->pCOFINS;
            $item->qBCProdConfis    = $tributacao->qBCProdConfis;
            $item->vAliqProd_cofins = $tributacao->vAliqProd_cofins;
            $item->tipo_calc_cofins = $tributacao->tipo_calc_cofins;



    }

    public function created(NfeItem $item){
            $total_itens= NfeItem::where("nfe_id",$item->nfe_id)->sum("vProd");
            $nfe        = Nfe::find($item->nfe_id);
            $nfe->vProd = $total_itens;
            $nfe->save();
            ItemNotaFiscalService::ratearDados($nfe);

            ItemNotafiscalService::atualizarTotaisImpostosDaNota($nfe->id);
     }
}
