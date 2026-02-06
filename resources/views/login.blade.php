@extends('layout')

@section('content')
    <h2>Login</h2>
    <div class="mb-3">
        <input type="email" id="email" class="form-control" placeholder="Enter your email">
    </div>
    <button id="loginBtn" class="btn btn-primary">Login</button>

    <script>
        document.getElementById('loginBtn').addEventListener('click', async () => {
            const email = document.getElementById('email').value;
            const res = await fetch('/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ email })
            });
            const data = await res.json();
            if (data.token) {
                localStorage.setItem('token', data.token);
                alert('Login successful!');
                window.location.href = '/companies';
            } else {
                alert(data.error || 'Login failed');
            }
        });
    </script>
@endsection
