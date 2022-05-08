<?php
/*
reference 상세보기 페이지
*/
include_once '..\include\parser.php';


isset($_REQUEST['page']) && $_REQUEST['page'] != "" && is_numeric($_REQUEST['page']) ? $page = $_REQUEST['page'] : $page = 1;
isset($_REQUEST['pageSize']) && $_REQUEST['pageSize'] != "" && is_numeric($_REQUEST['pageSize']) ? $pageSize = $_REQUEST['pageSize'] : $pageSize = 20;
isset($_REQUEST['searchString']) && $_REQUEST['searchString'] != "" ? $searchString = $_REQUEST['searchString'] : $searchString = '';

$path = "getReferenceList.php";
$params = "page=" . $page . "&pageSize=" . $pageSize;
$result = json_decode(getJson($host, $path, $params));

$data = $result->{'data'};
$page = $result->{'intNowPage'};
$pageSize = $result->{'pageSize'};
$lastPage = $result->{'intTotalPage'};


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reference 상세보기</title>
    <link rel="stylesheet" type="text/css" href="common/css/default.css">
    <link rel="stylesheet" type="text/css" href="common/css/font.css">
    <link rel="stylesheet" type="text/css" href="common/css/layout.css">
    <link rel="stylesheet" type="text/css" href="common/css/style.css">
    <link rel="stylesheet" type="text/css" href="common/css/test.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    <script type="text/javascript" src="common/js/jquery-3.4.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include('layout/header.php'); ?>
    <div class="content">
        <div class="content-wrap">
            <div class="data-header -wrap">
                <div class="data-tit">Reference 상세보기</div>

                <table style="padding-top:50px" align=center width=700 border=0 cellpadding=2>
                    <tr>
                        <td height=5 align=center bgcolor=#0D5CB9></td>
                        <table class="table2">
                            <tr>
                                <td>분류</td>
                                <td><?= $item->{'add_User_Id'} ?></td>
                            </tr>
                            <tr>
                                <td>작성자</td>
                                <td><?= $item->{'add_User_Id'} ?></td>
                            </tr>

                            <tr>
                                <td>제목</td>
                                <td> <?= $item->{'title'} ?></td>
                            </tr>

                            <tr>
                                <td>내용</td>
                                <td> <?= $item->{'content'} ?></td>
                            </tr>

                            <tr>
                                <td>Key Point</td>
                                <td> <?= $item->{'key_Point'} ?></td>
                            </tr>
                        </table>
                        </td>
                    </tr>
                </table>
                <div class="btn">
                    <div class="btn-group">
                        <button class="btn-lg btn-bg-darkgray modal_close" style="width:20%">취소</button>
                        <button class="btn-lg btn-bg-blue" style="width:20%" onclick="prcsDataOtp_mdf();">수정</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    // function prcsDataOtp_mdf(){  }
</script>

</html>