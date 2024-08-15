<style>
    @media print {
        @page {
    size: auto;
    margin: 5mm 5mm 0mm 5mm; 
}
        body * {
            visibility: hidden;
        }
        #reportContent,
        #reportContent * {
            visibility: visible;
        }
        #reportContent {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .custom-table {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        header, 
    /* Hide footer */
    footer,
    /* Hide URL */
    .url {
        display: none !important;
    }
    /* Remove default headers and footers */
    body::before,
    body::after {
        content: none !important;
    }
    }
</style>
<h2 class="text-center mb-4">Sales Report</h2>

<div class="row justify-content-center mb-4">
    <div class="col-md-3">
        <label for="dateFrom">From:</label>
        <input type="date" id="dateFrom" class="form-control">
    </div>
    <div class="col-md-3">
        <label for="dateTo">To:</label>
        <input type="date" id="dateTo" class="form-control">
    </div>
    <div class="col-md-2 d-flex align-items-end">
        <button id="generateReport" class="btn btn-primary">Generate Report</button>
    </div>
</div>

<div id="reportContent">
    <p class="text-center alert alert-secondary text-dark">Set date to view sales report</p>
</div>
<div class="row mb-4">
    <div class="col-md-12 text-start"> 
        <button onclick="window.print();" class="btn btn-primary">Print Sales Report</button>
    </div>
</div>
<script>
    document.getElementById('generateReport').addEventListener('click', function() {
    var dateFrom = document.getElementById('dateFrom').value;
    var dateTo = document.getElementById('dateTo').value;

    if (dateFrom && dateTo) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'generate_report.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('reportContent').innerHTML = xhr.responseText;
            }
        };
        xhr.send('dateFrom=' + dateFrom + '&dateTo=' + dateTo);
    } else {
        alert('Please select both dates.');
    }
});
</script>
