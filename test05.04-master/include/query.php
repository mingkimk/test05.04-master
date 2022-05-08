<?php

function ms_query($query,$database=null){

    if($database == null){
        $database = "aihomepage";
    }
    $connectionOptions =array(
        "database" => $database,
        "uid" => "sa",
        "pwd" => "my191101!!",
        'characterSet' => 'UTF-8'
    );
    $hostip ="114.108.167.82";

   // 데이터베이스 연결구
   $dbcon = sqlsrv_connect($hostip,$connectionOptions);

   $tsql = $query;
   try{
       $getProducts = sqlsrv_query($dbcon,$tsql);
       //--------전처리-----------            
       if($getProducts===false){
           if( ($errors = sqlsrv_errors() ) != null){  
               foreach( $errors as $error){  
                   $output['SQLSTATE'] = $error['SQLSTATE'];
                   $output['code'] = $error['code'];
                   $output['message'] = $error['message'];
               }  
           }  
           return $output;
       }


       if(preg_match('/select(.*)from/i', $query)){//selecet가 아닌경우 false 
           $rowcnt = 0;
           while ($row = sqlsrv_fetch_array($getProducts, SQLSRV_FETCH_ASSOC)){
               $output[$rowcnt] = $row;
               $rowcnt++;
           }
           $output['total_cnt'] = $rowcnt;
       }
       else if(preg_match('/DELETE(.*)/i',$query)){
           return false;
       }else{
           
           $cnt = sqlsrv_rows_affected($getProducts);
           if(sqlsrv_rows_affected($getProducts) == -1){
               $output = "없는 정보 입니다.";
           }else{
               $output['msg'] = "success";
               $output['chageCnt'] = $cnt;
           }
       }
       
       sqlsrv_free_stmt($getProducts);
       sqlsrv_close($dbcon);

   }catch(Exception $e){
       return false;
   }

   return $output;

}


function inputchk($input){
   $anti_injection_arr = array("\x00","\n","\r","\x1a","\<\?", '\?\>',"\<script","\\\\", '"',"'", "`",";","<",">","--");
   return str_replace($anti_injection_arr, "", addslashes(strip_tags(htmlspecialchars($input))));
}



?>