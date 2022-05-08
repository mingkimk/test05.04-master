<?php
    /*
        ========================================
        REFERENCE 리스트 출력
        날짜   : 2022-05-03
        작성자 : 박민경
        ========================================
        input data {
            page , 
            pageSize ,
            searchString 
        }
     */
    include_once '..\include\query.php';

    isset($_REQUEST['page']) && $_REQUEST['page'] != "" && is_numeric($_REQUEST['page']) ? $nowPage = inputchk($_REQUEST['page']) : $nowPage = 1;
    isset($_REQUEST['pageSize']) && $_REQUEST['pageSize'] != "" && is_numeric($_REQUEST['pageSize']) ? $pageSize = inputchk($_REQUEST['pageSize']) : $pageSize = 20;
    !isset($_REQUEST['searchString']) ? $searchString = "" : $searchString = inputchk($_REQUEST['searchString']); //searchString
    if($searchString != ""){
        $searchData = " AND (title LIKE '%".$searchString."%'";
     
    }else{
        $searchData = "";
    }
    //$ReferProcess =ms-sql 에서 board table 에서 reference(2) count. 
    $ReferProcess = ms_query("SELECT count(*) as count FROM (select b1.*, b2.category from board b1, board_Detail b2 where b1.no = b2.no and board_Code='2') board ".$searchData);


    
    if($ReferProcess["total_cnt"] != 0){
        $intTotalCount = $ReferProcess[0]['count'];
        $intTotalPage = ceil(($intTotalCount/$pageSize));
    }else{
        $intTotalCount = 0;
        $intTotalPage = 1;
    } 
//
    // $SQL= "select b1.*, b2.category from board b1, board_Detail b2 where b1.no = b2.no and b1.board_Code='2'";
     // ================= 페이징 =================
   // $SQL = "SELECT * FROM (SELECT ROW_NUMBER() OVER(order by add_date DESC) as rownum,b1.*, b2.category FROM  board b1, board_Detail b2 where b1.no = b2.no and board_Code='2') recode WHERE recode.rownum BETWEEN ";
   $SQL = "SELECT * FROM (SELECT ROW_NUMBER() OVER(order by add_date DESC) as rownum,b1.*, b2.category,key_Point FROM  board b1, board_Detail b2 where b1.no = b2.no and board_Code='2') recode WHERE recode.rownum BETWEEN ";
    $SQL .= ($nowPage * $pageSize)-($pageSize-1) ." AND ".$nowPage * $pageSize."";

    $ReferProcessList = ms_query($SQL);
    $data = array();

    for($i=0; $i<$ReferProcessList['total_cnt']; $i++){
        $data[$i] = $ReferProcessList[$i];
        $data[$i]['add_Date'] = date_format($ReferProcessList[$i]['add_Date'],"Y-m-d H:i:s");
    }
    // ================= 출력할 데이터 가공셋 =================
    unset($ReferProcessList['total_cnt']);
    // ================= 출력 셋 =================
    $result['result_code'] = "00";
    $result['result_msg'] = "success";
    $result['intTotalCount'] = $intTotalCount;
    $result['intNowPage'] = $nowPage;
    $result['intTotalPage'] = $intTotalPage;
    $result['pageSize'] = $pageSize;
    $result['searchString'] = $searchString;
    $result['data'] = $data;
    
    echo json_encode($result,JSON_UNESCAPED_UNICODE);


?>