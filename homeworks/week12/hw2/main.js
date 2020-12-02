/*eslint-disable*/
let id = 1;
let todoCount = 0;
let uncompleteTodoCount = 0; // 未完成
const template = `
      <div class="todo list-group-item list-group-item-action justify-content-between align-items-center {todoClass}">
        <div class="todo__content-wrapper custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input check-todo" id="todo-{id}">
          <label class="todo__content custom-control-label" for="todo-{id}">{content}</label>
        </div>
        <button type="button" class="btn-delete btn btn-danger">刪除</button>
      </div>
    `;
// 解析 url 獲取 id
const searchParams = new URLSearchParams(window.location.search);
const todoId = searchParams.get("id");
if (todoId) {
  // http://localhost/gaga/week12-hw/hw2/
  $.getJSON("http://mentor-program.co/mtr04group3/gaga/week12/hw2/get_todo.php?id=" + todoId, function (data) {
    const todos = JSON.parse(data.data.todo);//network 裡面看資料
    //將資料呈現出來
    restoreTodos(todos);
  });
}

$(".btn-add").click(() => {
  addTodo();
});
$(".input-todo").keydown((e) => {
  if (e.key === "Enter") {
    addTodo();
  }
});

$(".todos").on("click", ".btn-delete", function (e) {
  $(e.target).parent().remove();
  todoCount--;
  // 先確認清單是否有 checked，如未勾選才需要--
  const isChecked = $(e.target).parent().find(".check-todo").is(":checked");
  if (!isChecked) {
    uncompleteTodoCount--;
  }
  updateCounter();
});

// 是否被勾選已完成
$(".todos").on("change", ".check-todo", function (e) {
  const isChecked = $(e.target).is(":checked");
  if (isChecked) {
    $(e.target).parents(".todo").addClass("checked"); //加入 class 以方便判斷"移除已完成待辦事項"
    uncompleteTodoCount--;
  } else {
    uncompleteTodoCount++;
    $(e.target).parents(".todo").removeClass("checked"); //加入 class 以方便判斷"移除已完成待辦事項"
  }
  updateCounter();
});

//移除已完成待辦事項
$(".clear-all").click(function (e) {
  $(".todo.checked").each(function (i, el) {
    todoCount--;
    $(el).remove();
  });
});

//拿取 data-filter 的值判斷並切換全部、已完成、未完成
$(".options").on("click", "div", (e) => {
  e.preventDefault();
  const target = $(e.target);
  const filter = target.attr("data-filter");
  if (filter === "all") {
    $(".todo").show();
  } else if (filter === "uncomplete") {
    $(".todo").show();
    $(".todo.checked").hide();
  } else {
    //done
    $(".todo").hide();
    $(".todo.checked").show();
  }
  //更換點擊切換的效果
  $(".options div.active").removeClass("active");
  target.addClass("active");
});

//將資料儲存至陣列，再存入資料庫
$(".btn-save").click(function (event) {
  let todos = [];
  $(".todo").each((index, el) => {
    const inputCheck = $(el).find(".check-todo"); // checkbox
    const label = $(el).find(".todo__content"); // 內容
    todos.push({
      id: inputCheck.attr("id").replace("todo-", ""),
      content: label.text(),
      isDone: inputCheck.is(":checked"),
    });

    const data = JSON.stringify(todos);
    $.ajax({
      type: "POST",
      // url: "http://localhost/gaga/week12-hw/hw2/add_todo.php",
      url: "http://mentor-program.co/mtr04group3/gaga/week12/hw2/add_todo.php",
      data: {
        todo: data,
      },
      success: function (res) {
        // console.log('res', res)
        const respId = res.id;
        window.location = "index.html?id=" + respId;
      },
      error: function () {
        alert("Erro");
      },
    });
  });
});

function addTodo() {
  const value = $(".input-todo").val();
  if (!value) return;
  $(".todos").append(
    template
      .replace("{content}", escape(value))
      // .replace('{id}',id)
      .replace(/{id}/g, id)
  );
  id += 1;
  todoCount++;
  uncompleteTodoCount++;
  updateCounter();
  $(".input-todo").val("");
}

function updateCounter() {
  $(".uncomplete-count").text(uncompleteTodoCount);
}

function escape(toOutput) {
  return toOutput.replace(/\&/g, "&amp;").replace(/\</g, "&lt;").replace(/\>/g, "&gt;").replace(/\"/g, "&quot;").replace(/\'/g, "&#x27").replace(/\//g, "&#x2F");
}

//將資料呈現出來
function restoreTodos(todos) {
  console.log(todos);
  //todo 儲存後，再新增 list 會造成 id 從頭計算，所以必須將 id 設為最後一個 id+1
  if (todos.length === 0) return;
  id = todos[todos.length - 1].id + 1;
  
  //從資料庫拿出來是陣列，所以要使用 for 取出
  for (let i = 0; i < todos.length; i++) {
    const todo = todos[i];
    $(".todos").append(
      template
        .replace("{content}", escape(todo.content)) //content 是在 95 行定義的
        .replace(/{id}/g, todo.id)
        .replace("{todoClass}", todo.isDone ? "checked" : "")
    );
    todoCount++;
    if (todo.isDone) {
    	$('#todo-' + todo.id).prop('checked', true)
    	// $('#todo-' + todo.id).attr('checked', 'checked')
    }
    if (!todo.isDone) {
      uncompleteTodoCount++;
    }
  }
  updateCounter();
}
