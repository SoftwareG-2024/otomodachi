document.getElementById('expense-form').addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(event.target);
    fetch('../php/data_entry.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            document.getElementById('expenses').innerHTML = data;
            event.target.reset();
        });
});
