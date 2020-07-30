## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
- <article>:獨立的完整內容區塊
- <aside>:與頁面內容關聯度較低的其餘資訊
- <sup>:上標，右上角的註解可使用


## 請問什麼是盒模型（box model）
CSS 每個元素所框起來的區塊，能夠顯示所有在區塊的 padding、margin 等等。

## 請問 display: inline, block 跟 inline-block 的差別是什麼？
- inline:行內元素，元素大小依照內容呈現，且在同一行呈現內容，如設定 padding 及 margin，對於其他行不會造成位置上的影響。
- block:區塊元素，會換行且元素占滿一整行，設定 padding 及 margin 會造成其他行有所影響。
- inline-block:行內區塊，元素大小依照內容呈現，且在同一行呈現內容，但會有 block 的屬性(可設定 padding 及 margin)。

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？
- static:為預設值，不會被特別定位，跟著瀏覽器的預設。
- relative:相對定位，跟 static 沒有太大區別，區別在於可調整 top、right、bottom、left，且不影響其他元素。
- absolute:絕對定位，往上層元素找直到屬性 relative 為父層，依照父層進行位置設定，不影響其他元素。
- fixed:絕對定位，依照 viewport 調整元素位置，當螢幕滾動時會被固定在螢幕中。
- sticky:黏性定位，以往都需要使用 js 控制元素，當捲軸滾動到指定元素時，則會呈現像 fixed 一樣的效果
