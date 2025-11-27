<h2>Messages</h2>

@foreach ($messages as $msg)
    <p><strong>{{ $msg->name }}</strong> ({{ $msg->email }})</p >
    <p>{{ $msg->message }}</p >
    <p>{{ $msg->created_at }}</p >
    <hr>
@endforeach