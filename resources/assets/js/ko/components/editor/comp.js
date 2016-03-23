/**
 * Created by javier on 14/03/16.
 */
'use strict';

exports = EditorViewModel;

function EditorViewModel(params) {
    this.editando = false;
    this.contenido = params.contenido;
}