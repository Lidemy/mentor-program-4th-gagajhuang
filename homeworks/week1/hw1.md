## 交作業流程

### 設定專案
-------------
1. 寫作業前先開一個 branch： `git branch week01branch `。
2. 切換到該分支：`git checkout week01branch`。
  **※步驟1、2合併：git checkout -b wee01branch**。
3. 可以開始寫作業囉！可使用 git diff  查看是否有修改。
4. 全部作業寫完再上傳到 git：`git commit -am "week01 完成"`。
 
### 交作業
------------- 
1. 將本地的 branch 推到遠端：`git push origin wee1`。
2. 到 Github 上面的 Pull requests，會出現提示並點擊【Compare & pull request】，如沒有出現提示，請自行選擇【new pull request】，creat pull request。
3. 將 week1 合併到 master，順便輸入文字敘述。
4. 到學習系統 -> 作業列表 -> 新增作業 -> 輸入 pull request(PR) 的網址 **_一定要是PR的連結_**。
5. 助教會幫忙點 merge 完成作業(不要自己點)。
6. merged 後切換到 master 將遠端的最新 master 抓下來同步本機：`git pull origin master`。
7. 刪除本機 branch：`git branch -d week1`。
8. 查看剩下那些 branch：`git branch -v`。

### 特殊情形：更新到最新狀態，與我的 master 同步
------------- 
1. 同步 Huli 的 mentor-Program-4th 最新資訊。
2. 先 checkout master。
3. 確認是否所有檔案都有 commit：`git status`。
4. 先將最新資訊拉到本機：`git pull **clone 的網址** master`。
5. 再將它更新到遠端：`git push origin master`。
