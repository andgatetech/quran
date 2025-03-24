window.addEventListener('load', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        // Automatically dismiss after 5 seconds
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});



document.getElementById('inputMethod').addEventListener('change', function() {
    if (this.value === 'manual') {
        document.getElementById('manualForm').classList.remove('d-none');
        document.getElementById('bulkForm').classList.add('d-none');
    } else {
        document.getElementById('manualForm').classList.add('d-none');
        document.getElementById('bulkForm').classList.remove('d-none');
    }
});




