import $ from 'jquery';

export function getComments(apiUrl, site_key, before, cb) {
  let url = `${apiUrl}/api_comments.php?site_key=${site_key}`;
  if (before) {
    url += "&before=" + before;
  }

  $.ajax({
    url,
  }).done(function (data) {
    cb(data);
    // console.log(data)
  });
}

export function addComments(apiUrl, site_key, data, cb) {
	$.ajax({
    type: "POST",
    url: `${apiUrl}/api_add_comments.php`,
    data
  }).done(function (data) {
    cb(data)
  });
}