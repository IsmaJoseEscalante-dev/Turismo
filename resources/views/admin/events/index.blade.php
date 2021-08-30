@extends('layouts.admin')

@section('title', 'Eventos')

@section('style')
    <link href="{{ asset('plugins/FullCalendar/fullcalendar.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #a846ea;
        }
        .fc-unthemed td.fc-today{
            background-color: #e8d77a !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid" id="app">
        <h1>Eventos</h1>
        <div class="card">
            <div class="card-body">
                <div id="full-calendar"></div>
            </div>
        </div>

        <div class="modal fade" id="modalFullCalendar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleEvent"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="errors"></div>
                        <div class="form-group">
                            <label>titulo</label>
                            <input type="text" class="form-control" id="txtTitle" placeholder="Titulo del evento">
                        </div>
                        <input type="hidden" id="txtId">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Fecha inicio</label>
                                <input type="date" class="form-control" id="txtFechaInicio">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Fecha fin</label>
                                <input type="date" class="form-control" id="txtFechaFin">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Precio</label>
                                <input type="number" id="txtAmount" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Color</label>
                                <input type="color" class="form-control" value="#ff0000" id="txtColor">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Seleccionar Categoria</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    @foreach ($categories as $id => $category)
                                        <option value="{{ $id }}">{{ $category }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-12">
                                <label for="tours">Tours</label>
                                <div class="pb-2">
                                    <span class="btn btn-primary btn-sm select-all">Seleccionar Todo</span>
                                    <span class="btn btn-primary btn-sm deselect-all">Deseleccionar</span>
                                </div>
                                <select class="form-control select2 {{ $errors->has('tours') ? 'is-invalid' : '' }}"
                                    name="tours[]" id="txtTours" multiple>
                                    @foreach ($tours as $id => $tour)
                                        <option value="{{ $id }}">
                                            {{ $tour }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('tours'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('tours') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="txtDescription" class="form-control" name="description" rows="4"
                                placeholder="Descripcion del evento"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="addEvent">Agregar</button>
                        <button type="button" class="btn btn-warning" id="updateEvent">Editar</button>
                        <button type="button" class="btn btn-danger" id="destroyEvent">Borrar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/FullCalendar/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/FullCalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('plugins/FullCalendar/es.js') }}"></script>
    <script src="{{ asset('plugins/CKEditor/ckeditor.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/main2.js') }}"></script>
    <script>
        $(document).ready(function() {

            let editor;
            ClassicEditor
                .create(document.querySelector('#txtDescription'))
                .then(newEditor => {
                    editor = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });

            $('#full-calendar').fullCalendar({
                selectable: true,
                selectHelper: true,
                //editable: true,
                displayEventTime: false,
                events: '/api/events',
                header: {
                    left: 'prev,today,next',
                    center: 'title',
                    right: 'month,basicWeek,basicDay,agendaWeek,agendaDay'
                },
                dayClick: function(date) {
                    $('#addEvent').css("display", "block");
                    $('#updateEvent').css("display", "none");
                    $('#destroyEvent').css("display", "none");

                    cleanForm();
                    $('#titleEvent').html("crear evento");
                    $('#txtFechaInicio').val(date.format());
                    $('#modalFullCalendar').modal();
                },
                eventClick: function(calEvent) {
                    $('#addEvent').css("display", "none");
                    $('#updateEvent').css("display", "block");
                    $('#destroyEvent').css("display", "block");

                    $('#txtId').val(calEvent.id);
                    $('#titleEvent').html(calEvent.title);
                    $('#txtId').val(calEvent.id);
                    $('#txtTitle').val(calEvent.title);
                    $('#txtColor').val(calEvent.color);
                    $('#txtAmount').val(calEvent.amount);
                    $('#txtTours').val(calEvent.tours);
                    $('#txtDescription').val(editor.setData(calEvent.description));
                    $('#category_id').val(calEvent.category_id);
                    $('#txtFechaInicio').val(calEvent.start.format('Y-MM-DD'));
                    $('#txtFechaFin').val(calEvent.end.format('Y-MM-DD'));
                    $('#txtTours').val('');
                    $('#txtTours').trigger('change');
                    if (calEvent.tours.length) {
                        let array = [];
                        for (let i = 0; i < calEvent.tours.length; i++) {
                            array.push(calEvent.tours[i].pivot.tour_id);
                        }
                        $('#txtTours').val(array);
                        $('#txtTours').trigger('change');
                    } else {
                        console.log("no hay tours")
                    }
                    $('#modalFullCalendar').modal();
                },
                eventDrop: function(calEvent) {
                    $('#txtId').val(calEvent.id);
                    $('#txtTitle').val(calEvent.title);
                    $('#txtColor').val(calEvent.color);
                    $('#txtAmount').val(calEvent.amount);
                    $('#txtDescription').val(calEvent.description);
                    $('#txtFechaInicio').val(calEvent.start.format('Y-MM-DD'));
                    $('#txtFechaFin').val(calEvent.end.format('Y-MM-DD'));
                    recolectarDatosGUI();
                    addEvent('/api/events/' + newEvent.id, 'PUT', newEvent, true);
                },
                select: function(start, end) {
                    $('#addEvent').css("display", "block");
                    $('#updateEvent').css("display", "none");
                    $('#destroyEvent').css("display", "none");

                    $('#titleEvent').html("Crear evento");
                    cleanForm();
                    $('#txtFechaInicio').val(start.format());
                    $('#txtFechaFin').val(end.format());
                    $('#modalFullCalendar').modal();
                },
            });

            let newEvent;
            $('#addEvent').click(function() {
                recolectarDatosGUI();
                addEvent('/api/events', 'POST', newEvent);
            });

            $('#updateEvent').click(function() {
                recolectarDatosGUI();
                addEvent('/api/events/' + newEvent.id, 'PUT', newEvent);
            });

            $('#destroyEvent').click(function() {
                recolectarDatosGUI();
                addEvent('/api/events/' + newEvent.id, 'DELETE', newEvent);
            });

            function recolectarDatosGUI() {
                newEvent = {
                    id: $('#txtId').val(),
                    title: $('#txtTitle').val(),
                    slug: string_to_slug($('#txtTitle').val()),
                    start: $('#txtFechaInicio').val() + " 00:00:00",
                    color: $('#txtColor').val(),
                    amount: $('#txtAmount').val(),
                    tours: $('#txtTours').val(),
                    description: editor.getData(),
                    end: $('#txtFechaFin').val() + " 23:59:59",
                    category_id: $('#category_id').val()
                }
            }

            function addEvent(url, type, objEvent, modal) {
                $.ajax({
                    type: type,
                    url: url,
                    data: objEvent,
                    success: function() {
                        $('#errors').html("");
                        $('#full-calendar').fullCalendar('refetchEvents');
                        if (!modal) {
                            $('#modalFullCalendar').modal('toggle');
                        }
                    },
                    error: function(xhr, status, error){
                        $('#errors').html("");
                        var response = JSON.parse(xhr.responseText);
                        var errorString = '<div class="alert alert-danger"><ul>';
                        $.each( response.errors, function( key, value) {
                            errorString += '<li>' + value + '</li>';
                        });
                        errorString += '</ul></div>';
                        $("#errors").append(errorString);
                    }
                });
            }

            function cleanForm() {
                $('#txtId').val('');
                $('#txtTitle').val('');
                $('#txtColor').val('');
                $('#txtAmount').val('');
                $('#txtDescription').val('');
                $('#txtTours').val('');
                $('#txtTours').trigger('change');
                editor.setData("");
                $('#errors').html("");
            }

            function string_to_slug(str) {
                str = str.replace(/^\s+|\s+$/g, '');
                str = str.toLowerCase();

                //quita acentos, cambia la ñ por n, etc
                let from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
                let to = "aaaaeeeeiiiioooouuuunc------";

                for (let i = 0, l = from.length; i < l; i++) {
                    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                }

                str = str.replace(/[^a-z0-9 -]/g, '') // quita caracteres invalidos
                    .replace(/\s+/g, '-') // reemplaza los espacios por -
                    .replace(/-+/g, '-'); // quita las plecas

                return str;
            }
        });
    </script>
@endsection
