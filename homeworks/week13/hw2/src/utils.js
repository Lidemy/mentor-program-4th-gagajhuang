export function escape(toOutput) {
  return toOutput.replace(/\&/g, "&amp;")
  .replace(/\</g, "&lt;")
  .replace(/\>/g, "&gt;")
  .replace(/\"/g, "&quot;")
  .replace(/\'/g, "&#x27")
  .replace(/\//g, "&#x2F");
}

export function appendCommentToDOM(commentsblock, comment, isPrepend) {
  const html = `
				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">${comment.id} ${escape(comment.nickname)}</h5>
				    <p class="card-text">${escape(comment.content)}</p>
				  </div>
				</div>
			`;
  //留言最新在上面
  if (isPrepend) {
    commentsblock.prepend(html);
  } else {
    commentsblock.append(html);
  }
}