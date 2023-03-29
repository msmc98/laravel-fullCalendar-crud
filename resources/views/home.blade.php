@extends('app')

@section('content')

    <head>
        <style>
            .fc-scroller {
                overflow-y: hidden !important;
            }
        </style>
    </head>

    <body style="">
        <div class="container" class="">
            <div class="row">
                <div class="col-md-12 mt-5">
                    <button type="button" class="btn btn-primary mt-3 mb-3" data-bs-toggle="modal"
                        data-bs-target="#myModal">Create
                        Event</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Create Event</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('events.create') }}" method="POST" id="event-form">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="start">Start Date/Time</label>
                                            <input type="datetime-local" class="form-control" id="start" name="start"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="end">End Date/Time</label>
                                            <input type="datetime-local" class="form-control" id="end" name="end"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="type">Type</label>
                                            <select class="form-select" aria-label="Default select example"
                                                name="event_type_id" id="type">
                                                @foreach ($data['types'] as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save Event</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3" id='calendar'></div>
            </div>

        </div>
    </body>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const events = {!! $data['events'] !!};
            const types = {!! $data['types'] !!};

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {

                //initial config
                hiddenDays: [0, 6],
                slotMinTime: '07:00:00',
                slotMaxTime: '21:00:00',
                contentHeight: 750,
                locale: 'es',
                initialView: 'dayGridMonth', // timeGridWeek
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },

                //present events
                events: events.map((event) => {
                    return {
                        title: event.title,
                        start: event.start,
                        end: event.end,
                        id: event.id,
                        event_type_id: event.event_type_id,
                        backgroundColor: types.find((type) => type.id === event.event_type_id)
                            .background,
                        textColor: types.find((type) => type.id === event.event_type_id).text,
                        borderColor: types.find((type) => type.id === event.event_type_id).border,
                    }
                }),

                //select events
                editable: true,
                selectable: true,
                selectMirror: true,
                select: function(arg) {

                    let title = prompt('Event Title:')
                    let id = {!! Auth::user()->id !!}

                    if (title) {

                        fetch("{{ route('events.create') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                title,
                                start: (arg.startStr).substring(0, 10) + ' ' + (arg
                                    .startStr).substring(11, 19),
                                end: (arg.endStr).substring(0, 10) + ' ' + (arg.endStr)
                                    .substring(11, 19),
                                id,
                                event_type_id: 1,
                                apiFetch: true,
                            }),
                        }).then(function(response) {
                            response.json();

                            calendar.addEvent({
                                title: title,
                                start: arg.start,
                                end: arg.end,
                                //add event source id
                                id: response.id,
                                event_type_id: 1,
                            })

                            return;
                        }).then(function(data) {
                            console.log(data);
                        }).catch(function(error) {
                            console.log(error);
                        });
                    }
                    calendar.unselect()
                },

                //deleting events
                eventClick: function(arg) {

                    if (confirm('Are you sure you want to delete this event?')) {
                        // arg.event.remove()
                        fetch("eventos/" + arg.event.id, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                        }).then(function(response) {
                            response.json()
                            window.location.reload()
                            return;
                        }).then(function(data) {
                            console.log(data);
                        }).catch(function(error) {
                            console.log(error);
                        });
                    }
                },
            });
            calendar.render();
        });
    </script>
@endsection
