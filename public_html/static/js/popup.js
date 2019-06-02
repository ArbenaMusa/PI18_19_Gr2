function getAnnouncementContent(title, tag, time, content, filepath) {
  $('#popup8section div').hide();
  if (filepath) {
    $('#popup8section div').show();
  }
  $('#popup8section h3').html(title);
  $('#popup8section h4').html(tag);
  $('#popup8section span').html(time);
  $('#popup8section p').html(content);
  $('#popup8section a').attr("href", "/download_attachment.php?file=" + filepath + "&type=announcement");
}
function getQuestionsContent(name, title, time, content) {
  $('#popup9section h3').html(name);
  $('#popup9section h1').html(title);
  $('#popup9section span').html(time);
  $('#popup9section p').html(content);
}
