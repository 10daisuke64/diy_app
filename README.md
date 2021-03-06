# 卒制プロトタイプ

## 卒制の概要

- DIYでわからないことをプロに聞ける, DIYerとメンターとのマッチングサービス.
- MENTAのDIY特化版, というイメージ.

## 伝達事項

- サンプルユーザーのパスワードは全て「password」です.

## 今回の実装内容

- DIYerからの質問一覧にページネーション機能をつけた. しかし, 全件を取得した上で指定されたページ分のデータを出力しており, 効率の悪いやり方をしている気がするので今後改善したい.
- 講義で複数のデータベースを連結させる方法を学んだので実践してみた.
    - DIYerからの質問（questions_table）と 質問カテゴリー（categories_table）, その間に中間テーブル（question_category）がある. これらのテーブルをうまく連結し, カテゴリーリスト付きの質問一覧ページを作ろうとした. カテゴリーは複数選択可能.
    - まず質問を投稿する際にカテゴリーをチェックボックスで選択できるようにした. categories_tableから引っ張ってきているのでカテゴリーが増減しても大丈夫.
    - 投稿フォームを送信すると, questions_tableへの登録だけでなく, 中間テーブルに複数行INSERTされるようループ処理を施した.
    - あとは何度もエラーが起きつつも気合いでSELECT文を書いて, 欲しいデータを集めたテーブルを取得し, カテゴリーリスト付きアーカイブを作成した.
    - カテゴリーリストの処理や, 日付フォーマットの処理が使い回せるよう関数を作成するなど工夫した.
    - 苦労して実装できたが, 何かしら既存のCMS（ヘッドレスCMSなど）を導入すれば早かった？WordPressで組めば一瞬でできるよね？とか, フレームワークなら一瞬だよってパターン？ などと我に返ってしまった.
    - でも, よい講義内容の復習になりました.
    - でも, SQL文を自動で作ってくれるGUIツールあれば使いたいです.
- 質問をカテゴリーで絞り込めるようなソート機能も追加した.
- DIYer用のページなのか, メンター用なのか, 全員用なのかがわからなくなるので, かわいい猫ちゃんのヘッダー画像を色分けして付けた. 猫ちゃんには特に意味はない. オレンジ＝DIYer, ネイビー＝メンター, グレー＝全員.

## 今後の予定

- 質問投稿機能は大まかにできたので, 次は質問に対してメンターが提案しマッチングする, というコアな部分に取り掛かりたい.
- 質問投稿機能にできれば画像添付機能を追加したい.
