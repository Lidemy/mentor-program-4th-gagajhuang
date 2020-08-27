## 什麼是 Ajax？
非同步 JavaScript 及 XML（Asynchronous JavaScript and XML，AJAX）並不能稱做是種「技術」，描述一種使用數個既有技術的「新」方法。

這些技術包括 HTML 或 XHTML、層疊樣式表、JavaScript、文件物件模型、XML、XSLT 以及最重要的 XMLHttpRequest 物件。
當這些技術被結合在 Ajax 模型中，Web 應用程式便能快速、即時更動介面及內容，不需要重新讀取整個網頁，讓程式更快回應使用者的操作。

[參考網站](https://ithelp.ithome.com.tw/articles/10200409)

## 用 Ajax 與我們用表單送出資料的差別在哪？
- Ajax：使用 JS 發 request 不需換頁，而且透過瀏覽器還可以為我們電腦把關安全性。
- 表單：使用 JS 發 request 會跳頁。

## JSONP 是什麼？
跨來源請求除了 CORS 以外的另外一種方法，全名叫做：JSON with Padding，利用 <script> 的這個特性來達成跨來源請求的。

## 要如何存取跨網域的 API？
1. CORS：想開啟跨來源 HTTP 請求的話，Server 必須在 Response 的 Header 裡面加上 Access-Control-Allow-Origin: *。
2. JSONP <script>，範例如下
	```js
	<script src="https://another-origin.com/api/games"></script>
	<script>
	  console.log(response);
	</script>
	```

## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？
第四周使用 node.js 是直接在本機向 Sever 發出 Response，這周則是使用 JS 透過瀏覽器發出 Response，使用 node.js 並不會有跨領域（同源政策）的問題，所以當遇到存取問題時，需要透過 CROS 或 JSON 方法解決。
