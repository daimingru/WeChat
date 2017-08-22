<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title></title>
</head>
<body>
<script src="/Public/jquery.min.js"></script>
<script>
var url = 'https://www.aparesse.com/index.php?m=Home&c=WeChat&a=index';
$.ajax({
    type: "GET",
    url: '/index.php?m=Home&c=WeChat&a=index',
    dataType: "json"
})
.done(function(json){
  console.log(json);
})
</script>
</body>
</html>