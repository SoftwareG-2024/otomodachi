# otomodachi
## 環境構築
### Windows
1. 公式サイトhttps://www.php.net/downloads.php からzipファイルをダウンロード
2. zipファイルを解凍し，任意のフォルダにphpフォルダを保存する ***この時，Cドライブに保存しないとデータベースの作成ができない***
### Mac
公式サイトhttps://www.php.net/downloads.php を参考にPHPをインストール
こちらを参照https://www.php.net/manual/ja/install.unix.php
### Linux(Debian系)
公式サイトhttps://www.php.net/downloads.php を参考にPHPをインストール
こちらを参照https://www.php.net/manual/ja/install.unix.debian.php
以下共通
4. `php.ini`を開く  
   (ない場合は，`php.ini-development`をコピーして拡張子を`.ini`に変更)
6. `php.ini`の中から`extension=pdo_sqlite`と`extension=sqlite3`の項目の`;`を消して保存する
7. `Visual Studio Code`(以下VSCode)を開く  
   (ダウンロードはこちら https://code.visualstudio.com/download )
9. 左側のタブ(default状態で)から拡張機能(Extensions)を開く
10. 検索ボックスに`PHP Server`と入れて検索，一番上に出てきたものをダウンロード&有効化

## 実行
1. プロジェクトのあるフォルダ(`otomodachi`)を`VSCode`で開く
2. `index.html`ファイルを開く
3. ソースコードの表示されている画面を右クリックして`PHP Server: Serve project`をクリック  
   (右下に`Server is already running`と出た場合は`PHP Server: Reload project`を選択する)
5. ブラウザ画面で実行される
