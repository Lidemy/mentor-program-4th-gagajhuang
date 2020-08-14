## 什麼是 DOM？
DOM 全名為 Document Object Model 翻譯為文件物件模型，就是把一份 HTML 文件內的各個標籤，包括文字、圖片等等都定義成物件，而這些物件最終會形成一個樹狀結構。
![DOM](https://www.w3schools.com/js/pic_htmltree.gif)


在 DOM 中，每個 element 、 文字(text) 等等都是一個節點，而節點通常分成以下四種：
- Document
	指這份文件，也就是這份 HTML 檔的開端，所有的一切都會從 Document 開始往下進行。
- Element
	指文件內的各個標籤，因此像是 <div>、<p> 等等各種 HTML Tag 都是被歸類在 Element 裡面。
- Text
	就是指被各個標籤包起來的文字，舉例來說在 <h1>Hello World</h1> 中， Hello World 被 <h1> 這個 Element 包起來，因此 Hello World 就是此 Element 的 Text。
- Attribute
	指各個標籤內的相關屬性。

[參考資料](https://ithelp.ithome.com.tw/articles/10202689)

## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？
‵<button>aaa</button>‵
當我在 button 下 click 事件時，不僅 btn 本身會被觸發，連同上層的 body、html、window 都會被觸發 click　事件。
可分為三個階段： 
1. 捕獲（ Capture phase ） 
2. 元素本身（ Target ）
3. 冒泡（ Bubbling phase ）

![事件傳遞機制](https://static.coderbridge.com/img/techbridge/images/huli/event/eventflow.png)
- DOM 的事件在傳播時，會先從根節點開始往下傳遞到 target，這邊如果加上事件的話，就會處於CAPTURING_PHASE，捕獲階段。
- target 就是你所點擊的那個目標。
- 事件再往上從子節點一路逆向傳回去根節點，這時候就叫做 BUBBLING_PHASE ，也是大家比較熟知的冒泡階段。
[參考資料](https://blog.techbridge.cc/2017/07/15/javascript-event-propagation/)

## 什麼是 event delegation，為什麼我們需要它？
event delegation 事件代理：不須綁定每個物件，此種方式較有效率，最外層統一代理 => 冒泡效應。

## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？
1. preventDefault 阻止預設行為：最常使用在表單送出、超連結，阻止瀏覽器預設動作。
2. stopPropagation 阻止傳遞：當事件傳遞到目標上，就會終止，不會進行冒泡階段；如有重複兩個 EventListener ，只限定觸發一個則使用 e.stopImmediatePropagation()。