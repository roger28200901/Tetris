<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
<style>
input,select{
	border:1px solid black;
	padding:10px;
	background-color:#AEAEAE;
	color:#FFF;
	border-radius:5px;
	font-weight:700;
	font-size:36px;}
	
</style>
	<div style="border:1px solid black; width: 700px; height:350px; left:50%; top:50%; position:absolute; margin-left:-350px; margin-top:-175px;">
    	<span>
        	<a href="tetris.php">查看排行榜</a>
         </span>    
         	<h1>Module_C 俄羅斯方塊</h1>
            <hr>
            <p>
         <span style="position:absolute; left:10%; top:20%;">
        	<form action="tetris.php" method="post" >            
                <select name="level">
                	<option value="0">一般</option>
                    <option value="1">困難</option>
                </select>
           
                	<p>
                	<input type="submit" value="遊戲開始">
            </form>
       </span>
    </div>
</body>
</html>