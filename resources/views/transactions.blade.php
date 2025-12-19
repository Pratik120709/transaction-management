@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Transactions</h5>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" id="searchTransactionId" class="form-control" placeholder="Search Transaction ID">
            </div>
            <div class="col-md-3">
                <select id="searchStatus" class="form-select">
                    <option value="all">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="failed">Failed</option>
                    <option value="success">Success</option>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody id="transactionsTable">
                    <!-- Data will be loaded here -->
                </tbody>
            </table>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <span class="me-2">Show</span>
                    <select id="limit" class="form-select form-select-sm w-auto">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="ms-2">entries</span>
                </div>
            </div>
            <div class="col-md-6">
                <nav>
                    <ul class="pagination justify-content-end" id="pagination">
                        <!-- Pagination will be generated here -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let currentPage = 1;
let limit = 10;
let searchTransactionId = '';
let searchStatus = 'all';

function loadTransactions(page = 1) {
    const skip = (page - 1) * limit;

    axios.get('/api/transactions', {
        params: {
            skip: skip,
            limit: limit,
            search_transaction_id: searchTransactionId,
            search_status: searchStatus
        }
    })
    .then(response => {
        const { transactions, total } = response.data;
        const totalPages = Math.ceil(total / limit);

        // Update table
        const tbody = document.getElementById('transactionsTable');
        tbody.innerHTML = transactions.map(transaction => `
            <tr>
                <td>${transaction.transaction_id}</td>
                <td>${transaction.name}</td>
                <td>${transaction.email}</td>
                <td>$${parseFloat(transaction.amount).toFixed(2)}</td>
                <td>
                    <span class=" text-uppercase p-2 badge bg-${getStatusColor(transaction.status)}">
                        ${transaction.status}
                    </span>
                </td>
                <td>${new Date(transaction.created_at).toLocaleString()}</td>
            </tr>
        `).join('');

        // Update pagination
        updatePagination(page, totalPages);
    })
    .catch(error => {
        console.error('Error loading transactions:', error);
    });
}

function getStatusColor(status) {
    switch(status) {
        case 'success': return 'success';
        case 'failed': return 'danger';
        case 'pending': return 'warning';
        default: return 'secondary';
    }
}

function updatePagination(currentPage, totalPages) {
    const pagination = document.getElementById('pagination');
    let html = '';

    // Previous button
    html += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="loadTransactions(${currentPage - 1})">Previous</a>
    </li>`;

    // Page numbers
    for (let i = 1; i <= totalPages; i++) {
        if (i === 1 || i === totalPages || (i >= currentPage - 2 && i <= currentPage + 2)) {
            html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="#" onclick="loadTransactions(${i})">${i}</a>
            </li>`;
        } else if (i === currentPage - 3 || i === currentPage + 3) {
            html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
    }

    // Next button
    html += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="loadTransactions(${currentPage + 1})">Next</a>
    </li>`;

    pagination.innerHTML = html;
}

// Event Listeners
document.getElementById('searchTransactionId').addEventListener('input', function(e) {
    searchTransactionId = e.target.value;
    loadTransactions(1);
});

document.getElementById('searchStatus').addEventListener('change', function(e) {
    searchStatus = e.target.value;
    loadTransactions(1);
});

document.getElementById('limit').addEventListener('change', function(e) {
    limit = parseInt(e.target.value);
    loadTransactions(1);
});

// Initial load
loadTransactions(1);
</script>
@endpush
