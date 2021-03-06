<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>REFERENCE 리스트 관리</title>
	<link rel="stylesheet" type="text/css" href="common/css/default.css">
	<link rel="stylesheet" type="text/css" href="common/css/font.css">
	<link rel="stylesheet" type="text/css" href="common/css/layout.css">
	<link rel="stylesheet" type="text/css" href="common/css/style.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
	<script type="text/javascript" src="common/js/jquery-3.4.1.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- include libraries(jQuery, bootstrap) -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<!-- include summernote css/js -->
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<body>
	<?php include('layout/header.php'); ?>
	<div class="content">
		<div class="content-wrap">
			<div class="data-header -wrap">
				<div class="data-tit">REFERENCE 등록</div>
				<form method="post" action="reference_insert.php">
				<table style="padding-top:50px" align=center width=700 border=0 cellpadding=2>
					<td height=5 align=center bgcolor=#0D5CB9></td>
					<tbody>
						<tr>
							<td bgcolor=white>
								<table class="table2">
									<tr>
										<th>분류</th>
										<td>
											<select name="assort">
												<option value>분류선택</option>
												<option value="1">Business</option>
												<option value="2">R&D</option>
											</select>
										</td>
									</tr>
									<tr>
										<th>제목</th>
										<td><input type=text name=title size=100></td>
									</tr>
									<tr>

										<th>내용</th>
										<td>
											<textarea id="summernote" name=content cols=185 rows=15></textarea>
										</td>
									

									</tr>
									<tr>
										<th>Key Point</th>
										<td><textarea name=contents></textarea></td>
									</tr>
									<tr>
										<th>이미지</th>
										<td colspan="3">
											<div id="pic" style="display: block">
												<input class="box" type="file" name="pic" size="40" maxlength="100">
										</td>
									</tr>

								</table>
							</td>
						</tr>
					</tbody>
				</table>
				</form>
				<div class="btn">
					<div class="btn-group">
						<button id="add" class="btn-lg btn-bg-blue" style="width:20%" type="submit" onclick="listRegist();">등록</button>
						<button class="btn-lg btn-bg-darkgray modal_close" style="width:20%">취소</button>
					</div>
				</div>
			</div>

		</div>
</body>
<script>
	//html summernote 에디터
	$(document).ready(function() {
		$('#summernote').summernote();
	});

	function listRegist() {

		if ($('input[name=test_date]').val() == "") {
			Swal.fire('실험일은 필수 항목입니다.', '', 'warning');
			return false;
		} else if ($('input[name=test_manager]').val() == "") {
			Swal.fire('실험자는 필수 항목입니다.', '', 'warning');
			return false;
		} else if ($('input[name=ch_count]').val() == "") {
			Swal.fire('사용채널 수는 필수 항목입니다.', '', 'warning');
			return false;
		}

		var data = $("#prcsRegFrm").serialize();

		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: "post",
			url: "../interface/getUpdateEBeamPro.php",
			dataType: "json",
			data: data,
			success: function(res) {
				console.log(res);
				if (res.result_code == "00") {
					Swal.fire({
						title: '공정 정보가 정상적으로 등록되었습니다.',
						text: "",
						icon: 'success',
						showDenyButton: false,
						showCancelButton: false,
						confirmButtonText: '확인',
						reverseButtons: false,
						allowOutsideClick: true,
					}).then(function(result) {
						console.log(result)
						if (result.value) {
							$(".modal").hide();
							$('body').css('overflow', 'auto');
							location.reload();
						} else if (result.dismiss === Swal.DismissReason.cancel) {

						}
					});
				} else {
					Swal.fire(res.result_msg, '', 'warning');
				}
			},
			error: function(resp) {
				console.log(resp)
			}
		});
	}
</script>

</html>