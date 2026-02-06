@extends('layout')

@section('content')
    <h2>Companies</h2>

    <div class="mb-3">
        <input type="text" id="companyName" placeholder="Company Name" class="form-control mb-2">
        <input type="text" id="industry" placeholder="Industry" class="form-control mb-2">
        <input type="text" id="location" placeholder="Location" class="form-control mb-2">
        <button id="addCompanyBtn" class="btn btn-success">Add Company</button>
    </div>

    <hr>
    <h3>Company List</h3>
    <ul id="companyList" class="list-group"></ul>

    <script>
        const token = localStorage.getItem('token');

        async function fetchCompanies() {
            const res = await fetch('/companies', {
                headers: { 'Authorization': `Bearer ${token}` }
            });
            const companies = await res.json().catch(()=>[]);
            const list = document.getElementById('companyList');
            list.innerHTML = '';
            companies.forEach(c => {
                const li = document.createElement('li');
                li.className = 'list-group-item';
                li.innerHTML = `${c.name} - ${c.industry} - ${c.location}
            <button onclick="viewContacts(${c.id})" class="btn btn-sm btn-primary float-end">Contacts</button>`;
                list.appendChild(li);
            });
        }

        document.getElementById('addCompanyBtn').addEventListener('click', async () => {
            const res = await fetch('/companies', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({
                    name: document.getElementById('companyName').value,
                    industry: document.getElementById('industry').value,
                    location: document.getElementById('location').value
                })
            });
            if(res.ok) {
                fetchCompanies();
                alert('Company added!');
            } else {
                alert('Failed to add company');
            }
        });

        function viewContacts(companyId) {
            window.location.href = `/companies/${companyId}/contacts`;
        }

        fetchCompanies();
    </script>
@endsection
