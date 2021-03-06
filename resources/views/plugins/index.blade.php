<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>img-upload jQuery Plugin Demo</title>
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link href="css/img-upload.css" rel="stylesheet" type="text/css">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<style>
body { background-color:#fafafa;}
.container { margin:150px auto;}
</style>
</head>

<body>
<div id="jquery-script-menu">
<div class="jquery-script-center">
<ul>
<li><a href="https://www.jqueryscript.net/form/Image-Upload-Preview-Plugin-With-jQuery-Bootstrap-img-upload.html">Download This Plugin</a></li>
<li><a href="https://www.jqueryscript.net/">Back To jQueryScript.Net</a></li>
</ul>
<div class="jquery-script-ads"><script type="text/javascript"><!--
google_ad_client = "ca-pub-2783044520727903";
/* jQuery_demo */
google_ad_slot = "2780937993";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript" src="https://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>
<div class="jquery-script-clear"></div>
</div>
</div>
<div class="container">
            <header>
                <h1>img-upload jQuery Plugin Demo</h1>
            </header>
            <form>
                <div class="form-group">
                    <label>Select an image ...</label>
                    <div class="panel panel-default img-upload">
                        <div class="panel-heading">
                            <ul class="nav nav-pills">
                                <li class="img-file-btn active">
                                    <a href="javascript:;">File</a>
                                </li>
                                <li class="img-url-btn">
                                    <a href="javascript:;">URL</a>
                                </li>
                            </ul>
                        </div>
                        <div class="panel-body img-file-tab">
                            <div>
                                <span class="btn btn-default btn-file img-select-btn">
                                    <span>Browse</span>
                                    <input type="file" name="img-file-input">
                                </span>
                                <span class="btn btn-default img-remove-btn">Remove</span>
                            </div>
                        </div>
                        <div class="panel-body img-url-tab">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="http://example.com/image.jpg">
                                <span class="input-group-btn">
                                    <span class="btn btn-default img-select-btn">Submit</span>
                                </span>
                            </div>
                            <input type="hidden" name="img-url-input">
                        </div>
                    </div>
                </div>
            </form>
        </div>
 <script src="https://code.jquery.com/jquery-1.12.2.min.js"></script>
<script src="{{ asset('backend/plugins/bootstrap-image-upload/image-upload.js') }}"></script>
<script>
$('.img-upload').imgUpload();
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
