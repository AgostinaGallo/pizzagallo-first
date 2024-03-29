<div class="modal fade-slide-in right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$usu->id}}"> {{-- El id de este modal hace referencia a una categoria especifica--}}

    {{Form::Open(array('action'=>array('UsuarioController@destroy',$usu->id),'method'=>'delete'))}}

        <div class="modal-dialog">
            <div class="modal-content">
                {{-- La X que me permite cerrar el modal--}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <h4 class="modal-title">Eliminar Usuario del sistema</h4>
                </div>

                <div class="modal-body">
                    <p>Confirme si desea eliminar usuario</p>
                </div>

                {{-- Botones Cancelar y Cerrar --}}
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                    <button type="submit" class="btn btn-primary">Confirmar</button>

                </div>

            </div>{{-- Fin modal-content --}}
        </div>{{-- Fin modal-dialog --}}


    {{Form::Close()}}
</div>