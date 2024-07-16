function saveData() {
    // フォームからデータを取得
    var data = {
        date: document.getElementById('date').value,
        item: document.getElementById('item').value,
        amount: document.getElementById('amount').value,
        purpose: document.getElementById('purpose').value,
        memo: document.getElementById('memo').value
    };

    // データをlocalstorageに保存
    localStorage.setItem('myData', JSON.stringify(data));

    // Ajaxリクエストを作成
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../php/save_data.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // データを送信
    xhr.send('data=' + encodeURIComponent(JSON.stringify(data)));
}
