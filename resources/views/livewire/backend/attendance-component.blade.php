<div>
<h4>My Attendance</h4>

@if(session()->has('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session()->has('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="mb-3">
@if(!$checkInTime)
<button wire:click="checkIn" class="btn btn-success">Check In</button>
@else
<span>Check In: {{ $checkInTime }}</span>
@endif

@if($checkInTime && !$checkOutTime)
<button wire:click="checkOut" class="btn btn-danger">Check Out</button>
@elseif($checkOutTime)
<span>Check Out: {{ $checkOutTime }}</span>
@endif
</div>

<table class="table table-bordered">
<thead>
<tr>
<th>Date</th>
<th>Check In</th>
<th>Check Out</th>
<th>Total Hours</th>
<th>Status</th>
</tr>
</thead>
<tbody>
@foreach($attendances as $att)
<tr>
<td>{{ $att->date }}</td>
<td>{{ $att->check_in }}</td>
<td>{{ $att->check_out ?? '-' }}</td>
<td>{{ $att->total_hours ?? '-' }}</td>
<td>{{ ucfirst($att->status) }}</td>
</tr>
@endforeach
</tbody>
</table>

{{ $attendances->links() }}
</div>