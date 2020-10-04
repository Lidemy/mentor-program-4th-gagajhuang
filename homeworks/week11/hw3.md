## 請說明雜湊跟加密的差別在哪裡，為什麼密碼要雜湊過後才存入資料庫
加密 Encryption：可以解密，一對一關係。明文 => 加密 => 密文
雜湊 hash：不能還原，多對一關係。明文 => hash => 文字

使用加密的話，假使被駭客入侵資料庫，是可以被反解密回來的，使用雜湊的話，基本上是無法還原的。


## `include`、`require`、`include_once`、`require_once` 的差別

引入檔案方式：include( ) 和 require( ) 的功能和使用方式都很相似。

require( )：引入的檔案一定要存在，否則會產生執行錯誤。
include( )：引入的檔案如果不存在，只會顯示警告訊息，php程式一樣可以繼續執行。
include_once( )、require_once( )：在為主體 PHP 檔案包含進來的檔案僅能一次，不會重覆包含。

## 請說明 SQL Injection 的攻擊原理以及防範方法
攻擊原理：駭客的填字遊戲，按照 SQL insert 語法就可模仿任何人發文。
解決方法：所有讀取資料庫的動作，都要加入 prepared statement，字串拼接改為問號。

引數有以下四種型別：
- i：integer（整型）
- d：double（雙精度浮點型）
- s：string（字串）
- b：BLOB（布林值）

## 請說明 XSS 的攻擊原理以及防範方法
攻擊原理：Cross-site Scripting，修補輸入特殊字元（如：html、script 等程式語法），可能會造成的網頁錯誤。
解決方法：需將使用者可輸入的所有地方都加入 htmlspecialchars。
`htmlspecialchars($str, ENT_QUOTES);`

## 請說明 CSRF 的攻擊原理以及防範方法
攻擊原理：Cross Site Request Forgery，就是在不同的 domain 底下卻能夠偽造出 「使用者本人發出的 request」。
解決方法：Double Submit Cookie，直接區分出這個 request 是不是從同樣的 domain 來。

不用把這個值寫在 session 以外，同時也讓 client side 設定一個名叫 csrftoken 的 cookie，值也是同一組 token。
```
Set-Cookie: csrftoken=fj1iro2jro12ijoi1
<form action="https://small-min.blog.com/delete" method="POST">
  <input type="hidden" name="id" value="3"/>
  <input type="hidden" name="csrftoken" value="fj1iro2jro12ijoi1"/>
  <input type="submit" value="刪除文章"/>
</form>
```

※chrome(51) 瀏覽器本身的防禦
SameSite cookie，在 Cookie 的 header 中多加上 SameSite。
```
Set-Cookie: session_id=vmcupz23o1; SameSite
```
