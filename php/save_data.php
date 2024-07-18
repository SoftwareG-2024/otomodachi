<?php
// データを受け取る
$data = json_decode($_POST['data'], true);

// DOMDocumentオブジェクトを作成
$dom = new DOMDocument('1.0', 'UTF-8');

// 日付から年と月を抽出
// $date = new DateTime($data['date']);
// $year = $date->format('Y');
// $month = $date->format('m');

// XMLファイルのパス（階層が一つ上）
$file = "../data/new_data.xml";

// XMLファイルが存在する場合、ファイルをロード
if (file_exists($file)) {
    $dom->load($file);
} 

// ルートエレメントを取得または作成
$root = $dom->documentElement ?: $dom->appendChild($dom->createElement('data'));

// 新しいデータを作成
$newData = $dom->createElement('item');
foreach ($data as $key => $value) {
    $element = $dom->createElement($key, htmlspecialchars($value));
    $newData->appendChild($element);
}

// 新しいデータを追加
$root->appendChild($newData);

// XMLを整形
$dom->formatOutput = true;

// 整形したXMLを保存（階層が一つ上）
$dom->save("../data/{new_data.xml");
?>
