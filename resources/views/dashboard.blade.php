@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Dashboard</h5>
                <button class="btn btn-primary" onclick="calculateYesterdayTotal()">
                    <i class="bi bi-calculator"></i> Calculate Yesterday's Total
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Total Amount (Success Transactions)</th>
                                <th>Last Updated</th>
                            </tr>
                        </thead>
                        <tbody id="dashboardTable">
                            <!-- Data will be loaded here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function loadDashboardData() {
    axios.get('/api/dashboard-data')
        .then(response => {
            const tbody = document.getElementById('dashboardTable');
            if (response.data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="3" class="text-center">No data available</td></tr>`;
                return;
            }

            tbody.innerHTML = response.data.map(item => `
                <tr>
                    <td>${new Date(item.date).toLocaleDateString()}</td>
                    <td>$${parseFloat(item.total_amount).toFixed(2)}</td>
<td>${
    new Date(item.updated_at).toLocaleDateString('en-GB')
}</td>
                </tr>
            `).join('');
        })
        .catch(error => {
            console.error('Error loading dashboard data:', error);
        });
}

function calculateYesterdayTotal() {
    const button = event.target;
    const originalText = button.innerHTML;

    button.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Calculating...';
    button.disabled = true;

    axios.post('/api/calculate-yesterday')
        .then(response => {
            alert(response.data.message);
            loadDashboardData();
        })
        .catch(error => {
            console.error('Error calculating total:', error);
            alert('Error calculating total. Please try again.');
        })
        .finally(() => {
            button.innerHTML = originalText;
            button.disabled = false;
        });
}

// Initial load
loadDashboardData();
</script>
@endpush
