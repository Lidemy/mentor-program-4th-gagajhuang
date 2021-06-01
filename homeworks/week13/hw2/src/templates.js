// export const formTemplate = `
// 			<section>
// 				<form class="add-comment">
// 					<div class="form-group">
// 				    <label for="form-nickname">暱稱</label>
// 				    <input type="text" name="nickname" class="form-control" id="exampleInputEmail1">
// 				  </div>
// 				  <div class="form-group">
// 				    <label for="content-textarea">留言內容</label>
// 				    <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
// 				  </div>
// 				  <button type="submit" class="btn btn-primary">Submit</button>
// 				</form>
// 			</section>
// 			<section class="comments-block">
// 			</section>
// 		`

export function getLoadMoreButton(className){
	return `<button type="button" class="btn btn-dark ${className}">載入更多</button>`
}

export function getForm(className, commentsClassName){
	return `
			<section>
				<form class="${className}">
					<div class="form-group">
				    <label>暱稱</label>
				    <input type="text" name="nickname" class="form-control">
				  </div>
				  <div class="form-group">
				    <label>留言內容</label>
				    <textarea name="content" class="form-control" rows="3"></textarea>
				  </div>
				  <button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</section>
			<section class="${commentsClassName}">
			</section>
		`
}