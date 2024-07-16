<?php
// XMLファイルのパスのパターン
$pattern = "../data/*_data.xml";

// パターンに一致するファイル名を取得
$files = glob($pattern);

// 各ファイルを処理
foreach ($files as $file) {
    // XMLファイルをロード
    $xml = simplexml_load_file($file);

    // HTMLを出力
    echo '<table class="table">';
    echo '<tr><th>日付</th><th>項目</th><th>金額</th><th>用途</th><th>メモ</th></tr>';
    foreach ($xml->item as $item) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($item->date) . '</td>';
        echo '<td>' . ($item->item == '0' ? '支出' : '収入') . '</td>';
        echo '<td>' . htmlspecialchars($item->amount) . '</td>';
        echo '<td>' . htmlspecialchars($item->purpose) . '</td>';
        echo '<td>' . htmlspecialchars($item->memo) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}
?>
