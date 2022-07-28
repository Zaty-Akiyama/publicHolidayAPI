# Google Calendarから祝日を取得する祝日APIを作成しました
https://github.com/Zaty-Akiyama/holiday_api_JP

当時はURLのルーティングなど知らなかったのでディレクトリを力技していて恥ずかしい。これも成長なので公開したままにしています。

# 祝日を返すAPI
REST方式で日本の祝日をJson形式で出力するAPIを作成するPHPプログラム
"(*)/yy/mm"から "app/holidays.php"にアクセスした後に Holidaysクラスを生成することで、YYYY-mm-ddに対応した祝日データを取得することができます。
取得できる祝日は現在2019年から2023年の5年間限定
## サンプルAPI

### 2019年から2023年の全てのデータを取得
https://zaty.jp/publicHoliday/api/

### 2020年の全てのデータを取得
https://zaty.jp/publicHoliday/api/20/

### 2021年5月のデータを取得
https://zaty.jp/publicHoliday/api/21/05/
