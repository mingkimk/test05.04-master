<?php session_start();
$_SESSION['isLogin'] = 1;
// if($_SESSION['isLogin'] != 1){
//     header( 'Location: login.php' );
// }
?>
<div class="header">
    <div class="header-wrap">
        <a class="logo-title" href="reference_list.php">
            <h1>에이아이네트웍스 관리자페이지</h1>
        </a>
        <div class="fr user-info">
            <?=$_SESSION['name']?> 님
            <a class="logout" href="logout.php"><i class="fa fa-sign-out-alt"  aria-hidden="true" title="로그아웃"></i></a>
        </div>
    </div>
    <nav class="header-menu">
        <ul>
            <li <?php if(strpos($_SERVER['REQUEST_URI'],'pr_') > 0){ echo "class='active'"; }?> onclick="location.href='pr_list.php'">PR 리스트 관리</li>
            <?php if($_SESSION['userLevel'] == 1) { ?>
            <li <?php if(strpos($_SERVER['REQUEST_URI'],'view/reference_') > 0){ echo "class='active'"; }?> onclick="location.href='reference_list.php'">REFERENCE 리스트 관리</li>
            <?php }?>
        </ul>
    </nav>
</div>