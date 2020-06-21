## 跟你朋友介紹 Git

Git 指令 | 說明
-- | --
|git init | 初始化。<li>Git 即刻對這檔案做版本控制 (會出現隱藏資料夾 .git )</li>
|git status | 版本控制的狀態。
|git add | 決定是否加入版本控制，每修改一次就要做一次<li>git add  .(或資料夾名稱)：所有此資料夾下檔案加入版控</li><li>Untracked：不加入，Staged：加入版控</li><li>git rm --cached xxoo.xx(檔名)：移除版控</li>
|git commit | 新建/寫入版本。**(新增資料夾的概念，v01、v02、v03)**<br>Aborting commit due to empty commit message.（沒有東西所以沒有新建成功）<li>git commit -m “檔案名稱”</li><li >git status 確認把版空檔案加入新版本了(綠色狀態會不見)</li><li>git commit -m "版2、版3、版4..."</li>
|git log | 歷史紀錄。<li>git commit 設定的東西會在這裡保存，詳細記錄更新的版本(資料夾)</li><li>git log --oneline：簡化版紀錄 (簡短成七碼)</li>![簡碼](https://i.imgur.com/qtNuoVL.jpg)
|git checkout | 回到某個版本 -> git checkout *87b8c83*。<li>git checkout master：回到最新的狀態</li>
|.gitignore | 把不需要版控的檔案歸檔忽略。之後 git add 的時候就可以避開，不須一個一個手動加入，直接使用 git add  .(或資料夾名稱) 加入所有檔案。<li>touch |.gitignore</li><li>vim .gitignore</li><li>在 vim 裡面輸入檔名</li>
|git diff | 查看當次更改紀錄。

順序：改完檔案後 → git add 檔名 → git commit -m "版2、版3、版4..."
※ 技巧：`git add . + git commit -> git commit -am` （自動把檔案加入並 commit）

### Git 版控基本指令複習
* Step00 -> git init 
* Step01 -> .gitignore 把不需要的檔案排除版本控制(資料夾外)
* Step02 -> git add . (這時候不能 -am，因為還是新的檔案)
* Step03 -> git commit -am “版本名稱”
----- 專案建立後 -----
* Step04 -> 
    1. 新檔案： git add 檔案名稱 ，並重複 Step03
    2. 更改現有檔案：重複 Step03

---

### Git 的平行時空：branch
主幹：master

Git 指令 | 說明
-- | --
git branch -v | 看出現在有哪些 branch。
git branch xxx(檔名) | 建立新的 branch。
git branch -d xxx(檔名) | 刪除 branch。
git merge xxx(分支檔名) |合併 branch，需在 master 上下指令才有用；合併分支後，即可把分支刪除。

git checkout xxx(分支版本名稱)：切換版本指令
git commit -am xxx(分支版本名稱)：commit 上傳版本

####  ※ merge 遇到衝突怎辦?
1. 先查詢有哪些 branch
2. git merge 合併看結果是否有錯誤
3. 再來用 git status 查詢狀態
![步驟](https://i.imgur.com/YGcQdTZ.jpg)

遇到上述問題時：
1. 檔案會出現錯誤訊息，看檔案決定要保留那些東西
2. 手動更改衝突 (刪除錯誤資訊)，存檔
3. 存檔後 commit 為新的版本
4. git log 檢查是否有更新紀錄

![](https://i.imgur.com/i4eyzCi.jpg)

![](https://i.imgur.com/DkHv92B.jpg)
