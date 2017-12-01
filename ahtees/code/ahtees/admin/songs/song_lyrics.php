<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<script language="javascript">
function closewindow()
{
	parent.parent.add_song_ext.lyrics.value=test.lyricenter.value;
	parent.parent.GB_hide();
}

function loadlyrics()
{
	document.test.lyricenter.value = parent.parent.add_song_ext.lyrics.value;
}
</script>

</head>

<body onload="loadlyrics();">
<form name="test" enctype="multipart/form-data" method="post">
<textarea cols="90" rows="30" name="lyricenter"><?php echo $_POST["lyricenter"]; ?></textarea><br />
<input type="button" value="submit lyrics" onclick="javascript:closewindow();"/>
</form>
</body>
</html>
