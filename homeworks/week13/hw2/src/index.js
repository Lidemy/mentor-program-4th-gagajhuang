import { getComments, addComments } from './api'
import { appendCommentToDOM } from './utils'
import { getForm, getLoadMoreButton } from './templates'
// import { formTemplate, getLoadMoreButton } from './templates'
import $ from 'jquery'



export function init(options) {
	//因 module 公用，須將變數跟 funcion 全部初始化
  let siteKey = "";
	let apiUrl = "";
	let containerElement = null;

	let lastId = null;
	let isEnd = false;
	let count = 5;

	let loadMoreClassName;
	let commentsClassName;
	let commentsSelector;
	let formClassName;
	let formSelector;

  siteKey = options.siteKey;
  apiUrl = options.apiUrl;
  // 避免重複出現衝突或 bug ，加入 siteKey 作區別
  loadMoreClassName = `${siteKey}-load-more`;//.load-more 替換
  commentsClassName = `${siteKey}-comments-block`;//顯示留言
  formClassName = `${siteKey}-add-comment`;//加入留言
  commentsSelector = '.' + commentsClassName; //.comments-block 替換
  formSelector = '.' + formClassName;//.add-comment 替換

  containerElement = $(options.containerSelector);
  containerElement.append(getForm(formClassName, commentsClassName));
  // containerElement.append(formTemplate);

  getNewComments();
  $(commentsSelector).on("click", "." + loadMoreClassName, () => {
    getNewComments();
  });

  $(formSelector).submit((e) => {
    e.preventDefault();
    //重構簡化
    const nickNameDOM = $(`${formSelector} input[name=nickname]`);
    const contentDOM = $(`${formSelector} textarea[name=content]`);
    const newComment = {
      site_key: siteKey,
      // nickname: $("input[name=nickname]").val(),
      // nickname: $(`${formSelector} input[name=nickname]`).val(),
      nickname: nickNameDOM.val(),
      content: contentDOM.val(),
      // 'id':
    };
    addComments(apiUrl, siteKey, newComment, data => {
    	if (!data.ok) {
        alert(data.message);
        return;
      }
      appendCommentToDOM($(commentsSelector), newComment, true);
      // $(`${formSelector} input[name=nickname]`).val("");
      nickNameDOM.val("");
      contentDOM.val("");
      window.location.reload();
    })
  });

  // 重複呼叫載入更多
	function getNewComments() {
	  $("." + loadMoreClassName).hide();
	  if (isEnd) {
	    return;
	  }
	  getComments(apiUrl, siteKey, lastId, (data) => {
	    //這邊 siteKey 記得改全域變數
	    //錯誤訊息
	    if (!data.ok) {
	      alert(data.message);
	      return;
	    }
	    const comments = data.comments;
	    for (let comment of comments) {
	      appendCommentToDOM($(commentsSelector), comment);
	    }
	    if (comments.length < count) {
	      //小於五筆就不顯示 btn
	      isEnd = true;
	      return;
	    } else {
	      lastId = comments[comments.length - 1].id;
	      //載入更多按鈕
	      const loadMoreButtonHTML = getLoadMoreButton(loadMoreClassName)
	      $(commentsSelector).append(loadMoreButtonHTML);
	    }
	  });
	}
}


