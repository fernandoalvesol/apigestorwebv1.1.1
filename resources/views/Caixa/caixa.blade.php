@extends('template')
@section('conteudo')
    <div class="rows">
        <div class="col-12">
            <span class=" bg-title text-light text-uppercase h5 mb-0 text-branco">
                <svg class="icon cadastro" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.5 14.875H14.875M14.875 14.875H18.25M14.875 14.875V11.5M14.875 14.875V18.25M4 8.5H6.25C6.84674 8.5 7.41903 8.26295 7.84099 7.84099C8.26295 7.41903 8.5 6.84674 8.5 6.25V4C8.5 3.40326 8.26295 2.83097 7.84099 2.40901C7.41903 1.98705 6.84674 1.75 6.25 1.75H4C3.40326 1.75 2.83097 1.98705 2.40901 2.40901C1.98705 2.83097 1.75 3.40326 1.75 4V6.25C1.75 6.84674 1.98705 7.41903 2.40901 7.84099C2.83097 8.26295 3.40326 8.5 4 8.5ZM4 18.25H6.25C6.84674 18.25 7.41903 18.0129 7.84099 17.591C8.26295 17.169 8.5 16.5967 8.5 16V13.75C8.5 13.1533 8.26295 12.581 7.84099 12.159C7.41903 11.7371 6.84674 11.5 6.25 11.5H4C3.40326 11.5 2.83097 11.7371 2.40901 12.159C1.98705 12.581 1.75 13.1533 1.75 13.75V16C1.75 16.5967 1.98705 17.169 2.40901 17.591C2.83097 18.0129 3.40326 18.25 4 18.25ZM13.75 8.5H16C16.5967 8.5 17.169 8.26295 17.591 7.84099C18.0129 7.41903 18.25 6.84674 18.25 6.25V4C18.25 3.40326 18.0129 2.83097 17.591 2.40901C17.169 1.98705 16.5967 1.75 16 1.75H13.75C13.1533 1.75 12.581 1.98705 12.159 2.40901C11.7371 2.83097 11.5 3.40326 11.5 4V6.25C11.5 6.84674 11.7371 7.41903 12.159 7.84099C12.581 8.26295 13.1533 8.5 13.75 8.5Z"
                        stroke="#341008" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="row col-12">
                        <div class="col-4 titlefluxo">
                            <p>FLUXO DE CAIXA</p>
                            <p class="subtitlepes">Pesquise pela data | Forma de pagamento | Escritório</p>
                        </div>
                </div>
                <div class="row col-md-12">
                    <div class="col-md-6 pesquisarform">
                            <form action="{{ route('caixa.search') }}" method="POST" class="form form-inline">
                                @csrf
                                <input type="date" name="filter" placeholder="date" value="" class="form-control">
                                <button type="submit" class="btn btn-dark"><i class="fa fa-filter" aria-hidden="true"></i> Pesquisar</button>
                            </form>
                    </div>    
                    <div class="col-md-6 pesquisar">
                            <form action="{{ route('caixa.pesquisar') }}" method="POST" class="form form-inline">
                                @csrf
                                <input type="text" name="filtrar" placeholder="Digite a descrição" value="" class="form form-control">
                                <button type="submit" class="btn btn-dark"><i class="fa fa-filter" aria-hidden="true"></i> Pesquisar</button>
                            </form>
                    </div>                    
                </div>                        
                </div>
            </span>
        </div>                
    </div>       
        <div class="col-12">
            <div class="px-2">
                <div class="table table-dark tabelafluxo">
                    <table cellpadding="0" cellspacing="0" width="100%" class="">
                        <thead>
                            <tr>
                                <th align="center">Tipo</th>
                                <th align="left">Descrição</th>
                                <th align="left">Data</th>
                                <th align="left">Valor R$</th>
                                <th align="left">Plano de Conta</th>
                                <th align="left">Forma Pagto</th>
                                <th align="left">Escritorio</th>
                                <th align="left" width="10px">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($caixas as $caixa)
                                <tr>
                                    @if($caixa->tipo == 1)
                                        <td align="center">Entrada</td>
                                    @else
                                        <td align="center">Saida</td>
                                    @endif
                                    <td align="left">{{$caixa->descricao}}</td>
                                    <td align="left">{{date('d/m/y', strtotime($caixa->data))}}</td>
                                    <td>R$ &nbsp;{{$caixa->preco}}</td>                                    
                                    <td align="left">{{$caixa->operacao}}</td>
                                    <td align="left">{{$caixa->pagamento}}</td>
                                    <td align="left">{{$caixa->escritorio}}</td>
                                    <td style="width=10px;">
                                        <a href="{{route('caixa.edit', $caixa->id)}}" class="btn btn-editar"><i class="far fa-edit"></i>Editar</a>
                                        <a href="{{route('caixa.delete', $caixa->id)}}" class="btn btn-deletar"><i class="fas fa-trash-alt"></i>Deletar</a>
                                    </td>        
                                </tr>
                            @empty
                            <div style="text-align: center;">
                                    <h3><b>Caixa em branco</b></h3>
                            </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>                                                                                                                                                                                                                                                                          -->
        </div>
    </div>
@endsection
