@section('page-title') Calendars @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Calendars</li>
    {{-- <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">About</li> --}}
@endsection

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card">
        {{-- <div class="card-header border-0 pt-6">
            <div class="card-title">Calendar</div>
        </div> --}}
        <div wire:ignore class="card-body pt-0">
            <div wire:ignore>
                <div id="calendar"></div>
            </div>

                <!-- Status Update Modal -->
                <div class="modal fade" id="statusModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header"><h5 class="modal-title">Update Status</h5></div>
                    <div class="modal-body">
                        <select id="statusSelect" class="form-control">
                            <option value="scheduled">Scheduled</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="saveStatusBtn">Save</button>
                    </div>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </div>
</div>

    @push('scripts')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet'/>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

<script>
document.addEventListener('livewire:init', function () {

    let calendarEl = document.getElementById('calendar');
    let calendar = new FullCalendar.Calendar(calendarEl,{
        initialView:'dayGridMonth',
        editable:true,
        eventDrop: function(info){
           @this.call('updateAppointment', info.event.id, info.event.startStr, info.event.start.toTimeString().slice(0,5));
        },
        eventClick: function(info){
            $('#statusModal').modal('show');
            let statusSelect = document.getElementById('statusSelect');
            statusSelect.value = info.event.extendedProps.status || 'scheduled';

            // $('#saveStatusBtn').off('click').on('click', function(){
            //    @this.call('updateAppointmentStatus', info.event.id, statusSelect.value);
            //     $('#statusModal').modal('hide');
            // });

            document.getElementById('saveStatusBtn').onclick = function(){
                 @this.call('updateAppointmentStatus', info.event.id, statusSelect.value);
                $('#statusModal').modal('hide');
            };
        }
    });

    calendar.render();

    Livewire.on('updateCalendar',(data)=>{
        calendar.removeAllEvents();
        calendar.addEventSource(data.events);
    });
});
</script>
    @endpush

