<!-- Sidebar  -->
<nav id="sidebar">
	<div class="sidebar-header">
		<h5 style="color: white;">Events Platform</h5>
	</div>

	<ul class="list-unstyled components">
		<li>
			<a href="{{ route('dashboard') }}">Dashboard</a>
		</li>
		<li>
			<a href="{{ route('event') }}">Manage Events</a>
		</li>
		<li>
			<a href="{{ route('event.details') }}">Events Overview</a>
		</li>
		<li>
			<a href="{{ route('event.create') }}">Create Event</a>
		</li>
		<li>
			<a href="{{ route('ticket') }}">Tickets Overview</a>
		</li>
		<li>
			<a href="{{ route('ticket.create') }}">Create Ticket</a>
		</li>
		<li>
			<a href="{{ route('event.create_session') }}">Create Session</a>
		</li>
		<li>
			<a href="{{ route('event.create_channel') }}">Create Channel</a>
		</li>
		<li>
			<a href="{{ route('event.create_room') }}">Create Room</a>
		</li>
		<li>
			<a href="{{ route('event.room_capacity') }}">Room Capacity</a>
		</li>
        <li>
            <a href="{{ route('attendee.event_register') }}">Attendee event registration</a>
        </li>
    </ul>
</nav>
