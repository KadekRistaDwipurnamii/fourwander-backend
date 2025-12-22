<h2>New Contact Message</h2>

<p><strong>Name:</strong> {{ $data['name'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>
<p><strong>Via:</strong> {{ strtoupper($data['via']) }}</p>

<hr>

<p>{{ $data['message'] }}</p>
