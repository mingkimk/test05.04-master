<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset = 'utf-8'>
        <!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>
<script>
        $(document).ready(function() {
  $('#summernote').summernote();
});
</script>

<body>




<div class="outer">
        <table  style="padding-top:50px" align = center width=700 border=0 cellpadding=2 >
                <tr>
                        <td height=20 align= center bgcolor=#ccc><font color=white> 글쓰기</font></td>
                </tr>
                <tr>
                        <td bgcolor=white>
                        <form method="post" action="test.php">
                <table class = "table2">
                        <tr>
                        <td>작성자</td>
                        <td><input type = text name = name size=20> </td>
                        </tr>
 
                        <tr>
                        <td>제목</td>
                        <td colspan="2">
                        <textarea id="summernote" name="memo"></textarea>
                             
                        </tr>
 
                        <tr>
                        <td>내용</td>
                        <td><textarea id ="summernote" name = content cols=85 rows=15></textarea></td>
                        </tr>
 
                        <tr>
                        <td>비밀번호</td>
                        <td><input type = password name = pw size=10 maxlength=10></td>
                        </tr>
                        </table>
                </form>
 
                        <center>
                        <input type = "submit" value="작성">
                        </center>
                </td>
                </tr>
        </table>
</div>
</body>
</html>


