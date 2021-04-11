# SwitchGame-List-Scraping

以下の2つのWikipediaにあるNintendo Switchにリリースしているソフトの情報をスクレイピングし、DBに情報をinsertする

※日本でリリースされたNintendo Switchゲームが対象範囲(北米や欧州のソフトは対応しておりません)

https://ja.wikipedia.org/wiki/Nintendo_Switch%E3%81%AE%E3%82%B2%E3%83%BC%E3%83%A0%E3%82%BF%E3%82%A4%E3%83%88%E3%83%AB%E4%B8%80%E8%A6%A7
https://ja.wikipedia.org/wiki/Nintendo_Switch%E3%83%80%E3%82%A6%E3%83%B3%E3%83%AD%E3%83%BC%E3%83%89%E3%82%BD%E3%83%95%E3%83%88%E3%81%AE%E3%82%BF%E3%82%A4%E3%83%88%E3%83%AB%E4%B8%80%E8%A6%A7

Scrap the information of the software released to Nintendo Switch in the following two Wikipedia and insert the information into the DB

https://ja.wikipedia.org/wiki/Nintendo_Switch%E3%81%AE%E3%82%B2%E3%83%BC%E3%83%A0%E3%82%BF%E3%82%A4%E3%83%88%E3%83%AB%E4%B8%80%E8%A6%A7
https://ja.wikipedia.org/wiki/Nintendo_Switch%E3%83%80%E3%82%A6%E3%83%B3%E3%83%AD%E3%83%BC%E3%83%89%E3%82%BD%E3%83%95%E3%83%88%E3%81%AE%E3%82%BF%E3%82%A4%E3%83%88%E3%83%AB%E4%B8%80%E8%A6%A7

※Nintendo Switch games released in Japan are covered (North American and European software are not supported)


# Features

- 年度別・パッケージまたはダウンロードソフトごとにWikipediaにあるswitchソフトの情報をスクレイピングする
- スクレイピングした情報はDBにinsertする
- 取得する情報は以下の通り
  - ゲーム発売日
  - パッケージソフト？ダウンロードソフト？アケアカソフト？のようなタイプを種別する
  - ゲームのタイトル
  - 販売メーカー
  - オンライン機能があるか
  - オンラインでランキング機能があるか
  - Joyconの横持ちに対応しているか
  - Nintendo eshopでダウンロード可能なソフトか 
  - CeroまたはIARCの年齢制限レーティング 
- 取得するゲーム種別は以下の通り
  - パッケージ販売ソフト
  - ダウンロード販売ソフト
  - アケアカソフト(アケアカNEOGEO、アーケードアーカイブス)
  - SEGAAGESソフト
  - 体験版ソフト
  - 無料ダウンロードソフト
  - CERO:Z、IARC:18+のソフト
- 配信が停止されてしまったソフトや本体同梱版のソフトは含んでおりません

<br>

- Scraping switch software information on Wikipedia for each package or download software
- Insert scraped information into DB
- Insert scraped information into DB
   - The information to be acquired is as follows
   - Game release date
   - Package software? Download software? Akeakasoft? Type a type like
   - Game title
   - Sales manufacturer
   - Is there an online function?
   - Is there a ranking function online?
   - Does it support Joycon's horizontal holding?
   - Is it software that can be downloaded from Nintendo eshop?
   - Cero or IARC age limit rating
- The game types to be acquired are as follows
   - Package sales software
   - Download sales software
   - Akeaka Soft (Akeaka NEOGEO, Arcade Archives)
   - SEGA AGES software
   - Trial version software
   - Free download software
   - CERO: Z, IARC: 18+ software
- Does not include software whose distribution has been stopped or software bundled with the main unit.


# Requirement
* PHP7
* Mysql
* phpQuery

# Author
* Dhiki(Infrastructure engineer & Video contributor)
* https://twitter.com/DHIKI_pico


# License
ご自由に使用いただいて構いません。

Feel free to use it.
