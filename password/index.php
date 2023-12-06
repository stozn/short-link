<!DOCTYPE HTML>
<html>
	<head>
	    <meta charset="utf-8">
	    <title>后台面板</title>
                    <link rel="shortcut icon" href="../asset/favicon.ico" type="image/x-icon"/> 
	</head>
</html>
<style>
    .table th {
        background-color: #1E90FF;
        color: #FFFFFF;
        width: 80%;
    }
    .table th:first-child { width: 8%;}
    .table th:nth-child(2) { width: 45%; }
    .table th:nth-child(3) { width: 15%; }
    .table th:last-child { width: 30%; }

    .table td {
        text-align: center;
    }

    .search-input {
        width: 85%;
        height: 30px;
        margin-right: 5px;
        padding: 0 10px;
        border: 3px solid #bdc3c7;
        border-radius: 5px 5px 5px 5px;
        color: #333;
    }

    .search-input:focus {
        border-color: #1BA1F8;
        transition: .2s border ease;
    }

    .input {
        height: 30px;
        padding: 0 10px;
        margin-right: 5px;
        border: 3px solid #bdc3c7;
        border-radius: 5px 5px 5px 5px;
        color: #333;
    }

    .input:focus {
        border-color: #1BA1F8;
        transition: .2s border ease;
    }

    .button {
        width: 90px;
        height: 38px;
        margin-right: 5px;
        border-radius: 5px 5px 5px 5px;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: .2s opacity ease;
    }

    .button:hover {
        opacity: .75;
    }

    .button:active {
        opacity: .9;
    }
</style>



<?php
    // 引入类
    require_once('../inc/require.php');

    // 新建对象
    $url = new url();

    // 处理清空逻辑
    if(isset($_POST['clean'])) {
        $url->clean_urls();
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    } else if(isset($_POST['search'])) {
        $keyword = $_POST['keyword'];
        $result = $url->db->query("urls WHERE url LIKE '%$keyword%'");
    } else if(isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $url->db->delete('urls', "WHERE id = '$id'"); 
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;        
    } else if(isset($_POST['add']) ) { 
        $id = $_POST['add'];
        $url_str = trim($_POST['url']);
        if(filter_var($url_str, FILTER_VALIDATE_URL)) {
            $url->db->insert('urls', 'id, url, ip, ua', "'$id', '$url_str', 'Admin', 'Admin'");
        }
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    } else {
        $result = $url->db->query('urls');
    }
?>

<form method="post">
 <p style="font-weight: bold; font-size: 3rem; display: flex; justify-content: center; align-items: center; color: #1BA1F8;">后台面板</p>
   <div style="display: flex; justify-content: flex-start; align-items: flex-start; margin-bottom: 10px;">
    <div style="display: flex; justify-content: flex-start; align-items: flex-start; margin-left: 40px; width: 70%;">
        <input class="input" type="text" name="add" style="width: 10%;" placeholder="ID">
        <input class="input" type="text" name="url" style="width: 50%;" placeholder="URL">
        <button class="button" style="background: #1BA1F8;">添加</button>
    </div>


    <div style="display: flex; justify-content: flex-start; align-items: flex-start;margin-right: 20px; width: 50%;">
        <input class="search-input" type="text" name="keyword" placeholder="请输入要搜索的URL" >
        <button class="button" type="submit" name="search" style="background: #1BA1F8;">搜索</button>
        <button class="button" type="submit" name="clean" style="background: #f00;">清空链接</button>
    </div>
   </div>
</form>



<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>URL</th>
            <th>IP</th>
            <th>User Agent</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(count($result) > 0) {
                foreach($result as $row) {
                echo "<tr><td>".$row['id']."</td><td><a href='".$row['url']."' target='_blank'>".$row['url']."</a></td><td>".$row['ip']."</td><td>".$row['ua']."</td><td><form method='post'><input type='hidden' name='delete' value='".$row['id']."'><button class='button' style='background: #f00; width:60px'>删除</button></form></td></tr>";

                }
            } else {
                echo "<tr><td colspan='4'>地址为空</td></tr>";
            }
        ?>
    </tbody>
</table>
