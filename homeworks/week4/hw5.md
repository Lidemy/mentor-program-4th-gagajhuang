## 請以自己的話解釋 API 是什麼
API(Application Programming Interface) 應用程式介面。一般的 API 為 Web API，拿來作為交換資料的東西。
當雙方需要資訊交流，比如對方需要自己的資料，或是自己需要對方的資料，API 就是這其中的媒介/介面。
餐廳服務生就是 API，負責在顧客跟廚房間的資料溝通，顧客點餐後 -> 「經由服務生」 傳遞給廚房餐點需求 -> 再由廚房將所需要的餐點 「藉由服務生」 遞送給顧客。
[影片連結](https://www.youtube.com/watch?v=zvKadd9Cflc)


## 請找出三個課程沒教的 HTTP status code 並簡單介紹
- 422 Unprocessable Entity：請求格式正確，但是由於含有語意錯誤(或輸入錯誤)，無法回應。\
- 431 Request Header Fields Too Large：伺服器不願處理請求，因為一個或多個頭欄位過大。[53]
- 511 Network Authentication Required：客戶端需要進行身分驗證才能獲得網路存取權限，旨在限制用戶群存取特定網路。

## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。

| 說明     | Method | path       | 參數                   | 範例             |
|--------|--------|------------|----------------------|----------------|
| 獲取所有餐廳 | GET | /restaurants | 限制回傳資料數量 | /restaurants?_limit=5 |
| 獲取單一特定餐廳 | GET | /restaurants/id | 無 | 無 |
| 新增餐廳 | POST | /restaurants | name: 餐廳名稱 | 無 |
| 刪除餐廳 | DELETE | /restaurants/id | 無 | 無 |
| 更改餐廳資訊 | PATCH | /restaurants/id | name: 餐廳名稱 | 無 |