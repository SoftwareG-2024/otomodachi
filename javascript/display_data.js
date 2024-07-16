window.onload = function () {
    // Ajaxリクエストを作成
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/get_list.php', true);

    // データを取得
    xhr.onload = function () {
        if (this.status == 200) {
            // データを取得
            var data = this.responseText;

            // データを表示
            document.getElementById('table').innerHTML = data;
        } else {
            console.error('Failed to get the data.');
        }
    };

    // エラーハンドリング
    xhr.onerror = function () {
        console.error('Failed to get the data.');
    };

    // リクエストを送信
    xhr.send();
};
