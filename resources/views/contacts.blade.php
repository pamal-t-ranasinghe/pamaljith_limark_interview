@extends('layout')

@section('content')
    <h2>Contacts</h2>

    <div class="mb-3">
        <input type="text" id="firstName" placeholder="First Name" class="form-control mb-2">
        <input type="text" id="lastName" placeholder="Last Name" class="form-control mb-2">
        <input type="email" id="email" placeholder="Email" class="form-control mb-2">
        <input type="text" id="title" placeholder="Title" class="form-control mb-2">
        <select id="seniority" class="form-control mb-2">
            <option value="">Select Seniority</option>
            <option value="junior">Junior</option>
            <option value="mid">Mid</option>
            <option value="senior">Senior</option>
        </select>
        <button id="addContactBtn" class="btn btn-success">Add Contact</button>
    </div>

    <hr>
    <div class="mb-3">
        <input type="text" id="search" placeholder="Search contacts..." class="form-control">
    </div>

    <ul id="contactList" class="list-group"></ul>

    <script>
        const token = localStorage.getItem('token');
        const companyId = {{ $company->id ?? 0 }};

        async function fetchContacts(query = '') {
            let url = `http://127.0.0.1:8000/api/companies/${companyId}/contacts`;
            if(query) url += `?q=${query}`;
            const res = await fetch(url, { headers: { 'Authorization': `Bearer ${token}` } });
            const data = await res.json();
            const list = document.getElementById('contactList');
            list.innerHTML = '';
            (data.data || []).forEach(c => {
                const li = document.createElement('li');
                li.className = 'list-group-item';
                li.textContent = `${c.first_name} ${c.last_name} - ${c.title} (${c.seniority}) - ${c.email}`;
                list.appendChild(li);
            });
        }

        document.getElementById('addContactBtn').addEventListener('click', async () => {
            const res = await fetch(`http://127.0.0.1:8000/api/companies/${companyId}/contacts`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({
                    first_name: document.getElementById('firstName').value,
                    last_name: document.getElementById('lastName').value,
                    email: document.getElementById('email').value,
                    title: document.getElementById('title').value,
                    seniority: document.getElementById('seniority').value
                })
            });
            if(res.ok) {
                fetchContacts();
                alert('Contact added!');
            } else {
                alert('Failed to add contact');
            }
        });

        document.getElementById('search').addEventListener('input', (e) => {
            fetchContacts(e.target.value);
        });

        fetchContacts();
    </script>
@endsection
