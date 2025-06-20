<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Eventi
        </h2>
    </x-slot>

    <div class="container-fluid border">
        <div class="card mt-4">
            <div class="card-body">
{{--                    <h5 class="card-title">Card title</h5>--}}
{{--                    <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>--}}
                <div class="row">
                    <div class="col-6">

                    </div>
                    <div class="col-6 text-end">
                        <a href="{{route('eventi.create')}}">
                            <button type="button" class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-circle-plus"></i> Nuovo
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="card mb-4">
            <div class="row mt-3">
                <div class="col-1"></div>

                <div class="col-10">
                    <table class="table table-hover table-striped table-bordered border" id="tabella">
                        <thead>
                            <tr>
                                <th class="bg-light"></th>
                                <th class="bg-light">Persona</th>
                                <th class="bg-light">Descrizione</th>
                                <th class="bg-light">Giorno/Ora</th>
                                <th class="bg-light">Creato</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($eventi as $i => $evento)
                                <tr>
                                    <td>
                                        <a href="{{route('eventi.edit',$evento)}}" class="btn btn-sm btn-outline-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalElimina{{$i}}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>

                                    <td>
                                        <span style="display:none;">{{$evento->persona}}</span>
                                        <badge class="badge" style="background:{{$evento->persona->colore}}">{{$evento->persona->nome}}</badge>
                                    </td>
                                    <td>{{$evento->descrizione}}</td>
                                    <td>
                                        <span style="display:none;">{{$evento->start}}</span>
                                        {{$evento->start?->format('d/m/Y H:i')}}
                                    </td>
                                    <td class="small text-secondary">
                                        <span style="display:none;">{{$evento->created_at}}</span>
                                        {{$evento->created_at?->format('d/m/Y H:i')}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-1"></div>
            </div>
        </div>
    </div>


    @section('modal')
        <!-- Modal Delete -->
        @foreach($eventi as $i => $evento)
            <div class="modal fade" id="modalElimina{{$i}}" tabindex="-1" aria-labelledby="modalElimina{{$i}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cancella evento</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('eventi.destroy',$evento)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                Vuoi davvero eliminare l'evento "{{$evento->descrizione}}" del {{$evento->start?->format('d/m/Y')}}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Chiudi</button>
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Elimina</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @stop

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#tabella').dataTable({
                    "responsive": true,
                    "bSort":true,
                    "pageLength": 10,
                    "paging": true,
                    "bPaginate":true,
                    "pagingType":"full_numbers",
                    "language": {
                        "lengthMenu": "Mostra _MENU_ record",
                        "zeroRecords": "Nessun risultato",
                        "info": "Pagina _PAGE_ di _PAGES_",
                        "infoEmpty": "Nessun risultato disponibile",
                        "infoFiltered": "(filtro di  _MAX_ record totali)",
                        "search": "",
                        "searchPlaceholder": "Cerca...",
                        "paginate": {
                            first:      '<<',
                            previous:   '‹',
                            next:       '›',
                            last:       '>>'
                        },
                    },
                    "columnDefs": [
                        {
                            "targets": 0,
                            'orderable': false,
                            "width": "90px",
                            "className": 'dt-center',
                        },
                        {
                            "targets": 1,
                            "width": "150px",
                        },
                        // {
                        //     "targets": [4,5,6,7,8,9],
                        //     "width": "30px",
                        //     "className": 'dt-center',
                        // },
                        // {
                        //     "targets": -1,
                        //     "width": "60px",
                        //     "className": 'dt-center',
                        //     'orderable': false
                        // },
                        {
                            "targets": 3,
                            "width": "120px",
                        },
                        {
                            "targets": 4,
                            "width": "100px",
                        },
                    ],
                    "order": [[1, 'desc']]
                });
            });
        </script>
    @stop
</x-app-layout>
