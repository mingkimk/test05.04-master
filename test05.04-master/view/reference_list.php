<?php
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
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reference 리스트 관리</title>
    <link rel="stylesheet" type="text/css" href="common/css/default.css">
    <link rel="stylesheet" type="text/css" href="common/css/font.css">
    <link rel="stylesheet" type="text/css" href="common/css/layout.css">
    <link rel="stylesheet" type="text/css" href="common/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    <script type="text/javascript" src="common/js/jquery-3.4.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include('layout/header.php'); ?>
    <div class="content">
        <div class="content-wrap">
            <div class="data-header-wrap">
                <div class="data-tit">Reference 리스트</div>
                <div class="data-info">
                    <?php echo $result->{'intTotalPage'}; ?> 페이지 중 <?php echo $page; ?> 페이지
                    <div class="config">
                        <select onchange="$('input[name=pageSize]').val($(this).val());$('#paging-frm').submit();">
                            <option value="10" <?php if ($pageSize == 10) echo "selected"; ?>>10개씩 보기</option>
                            <option value="20" <?php if ($pageSize == 20) echo "selected"; ?>>20개씩 보기</option>
                            <option value="30" <?php if ($pageSize == 30) echo "selected"; ?>>30개씩 보기</option>
                            <option value="40" <?php if ($pageSize == 40) echo "selected"; ?>>40개씩 보기</option>
                            <option value="50" <?php if ($pageSize == 50) echo "selected"; ?>>50개씩 보기</option>
                        </select>
                        <div class="search-wrap">
                            <form action="reference_list.php" method="post">
                                <input type="text" name="searchString" value="<?= $searchString ?>">
                                <input type="hidden" name="page" value="<?= $page ?>">
                                <input type="hidden" name="pageSize" value="<?= $pageSize ?>">
                                <button class="fa fa-search" type="submit"></button>
                            </form>
                        </div>
                        <button class="reg-btn" onclick="location.href='reference_insert.php'">등록</button>  
                      <!--  <button class="reg-btn" onclick="reg_btn();">등록</button> -->
                    </div>
                </div>
            </div>
            <table class="col-table clickable">
                <colgroup>
                    <col width="5%">
                    <col width="10%">
                    <col width="25%">
                    <col width="*">
                    <col width="*">

                </colgroup>
                <thead>
                    <tr>
                        <td>No</td>
                        <td>분류</td>
                        <td>제목</td>
                        <td>KEY POINT</td>
                        <td>작성일자</td>
                        <td>작성자</td>

                </thead>
                <tbody>
                    <?php
                    foreach($data as $item){
                    ?>
                        <tr onclick="view_list('<?= $item->{'no'} ?>')">
                            <td><?= $item->{'no'} ?></td>
                            <td>
                                <?php if ($item->{'category'} == 1) { ?>
                                    Business
                                <?php } else if ($item->{'category'} == 2) { ?>
                                    R&D
                                <?php } ?>
                            </td>
                            <td><?= $item->{'title'} ?></td>
                            <td>
                                <?= $item->{'key_Point'} ?>

                        
                        </td>
                            <td><?= $item->{'add_Date'} ?></td>
                            <td><?= $item->{'add_User_Id'} ?></td>


                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <form id="header-frm" action="reference_detail.php" method="get">
                <input type="hidden" name="no">
            </form>
            <form id="paging-frm" action="reference_list.php" method="post">
                <input type="hidden" name="page" value="<?= $page ?>">
                <input type="hidden" name="pageSize" value="<?= $pageSize ?>">
            </form>
            <div class="paging">
                <a class="paging-btn first-btn" onclick="paging(1);"><i class="fas fa-angle-double-left"></i></a>
                <?php if ($page == 1) { ?>
                    <a class="paging-btn prev-btn" onclick="Swal.fire({ title: '첫번째 페이지입니다.', timer: 800, showConfirmButton: false });"><i class="fas fa-angle-left"></i></a>
                <?php } else { ?>
                    <a class="paging-btn prev-btn" onclick="paging('<?= ($page - 1) ?>');"><i class="fas fa-angle-left"></i></a>
                    <?php }
                for ($i = $page - 4; $i <= $page + 2 || $i <= 5; $i++) {
                    if ($i < 1 || $i > $lastPage || ($i < $lastPage - 4 && $i < $page - 2)) {
                    } else {
                    ?>
                        <a class="paging-btn <?php if ($i == $page) {
                                                    echo 'active';
                                                } ?>" onclick="paging('<?= $i ?>')"><?= $i ?></a>
                    <?php }
                }
                if ($page != $lastPage) { ?>
                    <a class="paging-btn next-btn" onclick="paging('<?= ($page + 1) ?>');"><i class="fas fa-angle-right"></i></a>
                <?php } else { ?>
                    <a class="paging-btn next-btn" onclick="Swal.fire({ title: '마지막 페이지입니다.', timer: 800, showConfirmButton: false });"><i class="fas fa-angle-right"></i></a>
                <?php } ?>
                <a class="paging-btn last-btn" onclick="paging('<?= $lastPage ?>');"><i class="fas fa-angle-double-right"></i></a>
            </div>
        </div>
    </div>
</body>
<script>
    function view_list(no){
        $('input[name=no]').val(no);
        $('#header-frm').submit();
    }
</script>
</html>