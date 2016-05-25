<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>upimgs.net</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	{!! Html::favicon('images/favicon.ico') !!}
    {!! Html::style('css/pomf.css') !!}
</head>
<body>
<div class="container">
    <div class="jumbotron">
    	<h1 onclick="moon()" id="ohayou">upimgs</h1>
    	<p class="lead">Limit is 100MiB</p>
        <noscript>
            <p class="alert alert-error"><strong>Enable JavaScript</strong> if you wanna use this site (damn the previous error was rude)</p>
        </noscript>
        <p id="no-file-api" class="alert alert-error">
            <strong>This site requires some cool Web 2.0 stuff</strong> Install the latest<a href="http://firefox.com/">Firefox</a> or <a href="http://chrome.google.com/">Chrome</a> and come back &lt;3
        </p>
        <a href="javascript:;" id="upload-btn" class="btn">Select <span>or drop</span> file(s)</a>
        <input type="file" id="upload-input" name="files[]" multiple data-max-size="100MiB">
        <ul id="upload-filelist"></ul>
    </div>
    {!! Html::script('js/zepto.js') !!}
    {!! Html::script('js/cheesesteak.js') !!}
    {!! Html::script('js/cabinet.js') !!}
    {!! Html::script('js/pomf.js') !!}
</div>
</body>
</html>
