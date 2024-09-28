<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<style>
    
.admin-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 70vh;
}

</style>
<div class="admin-container">
<h2>Verify Visitor Pass</h2>

<form id="verify-form">
    @csrf
    <input type="text" id="qr-data" placeholder="Scan QR Code">
    <button type="submit">Verify</button>
</form>

<div id="verification-result"></div>
</div>

<script>
document.getElementById('verify-form').addEventListener('submit', function(e) {
e.preventDefault();

fetch('/admin/verify-pass', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
    body: JSON.stringify({
        qrData: document.getElementById('qr-data').value
    })
})
.then(response => response.json())
.then(data => {
    if (data.valid) {
        document.getElementById('verification-result').innerHTML = `
            <h3>Valid Pass</h3>
            <p>Name: ${data.user.name}</p>
            <p>Email: ${data.user.email}</p>
        `;
    } else {
        document.getElementById('verification-result').innerHTML = '<h3>Invalid Pass</h3>';
    }
});
});
</script>

</x-app-layout>