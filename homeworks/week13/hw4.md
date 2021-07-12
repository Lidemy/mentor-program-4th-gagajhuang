## Webpack 是做什麼用的？可以不用它嗎？

##### Webpack 是做什麼用的？
 - 在 browser 上執行 require的功能，瀏覽器原生也支援了 Import, export，稱之為 ES Modules。
 - Webpack 也可引入 jQuery、API、CSS，也為模組打包器（image/video/js/scss）。
##### 可以不用它嗎？
 - 適合用於規模較大，較多人開發/維護使用。
 - Webpack 可解決多人開發時，使用共同的 library，不僅管理上方便，修改及維護也是可以更快速的進行，不必擔心每個人使用外連 library 而導致衝突或是不熟悉該 library 的狀況。

## gulp 跟 webpack 有什麼不一樣？
- gulp 為任務管理器：gulp 無法做到 bundler 但使用 plugin webpack 就可，可做任何事情，多個 task，為 task manager。，
- webpack 為打包工具：webpack 是 bundler，需經過 loader 載入，無法做到 task ，現多為前端技術使用。

## CSS Selector 權重的計算方式為何？
前陣子剛好看到這個圖，覺得非常的適用XD
[圖片來源](https://muki.tw/tech/css-specificity-document/)
![](https://muki.tw/wordpress/wp-content/uploads/2015/07/CSS-Specificity-full.png)

 - inline style > ID > Class > Element > *
 - inline style 權重大於上述
 - !important 是大魔王！可覆蓋過所有的 css，但盡量不要使用。
