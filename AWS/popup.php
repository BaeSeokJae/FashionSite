<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script src="https://code.jquery.com/jquery-1.11.2.js"></script>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta http-equiv="content-type" content="text/html" charset=UTF-8"/>
    <title>Seokjae</title>
<!--    <script type="text/javascript" src="/js/popup.js"></script>-->
    <script language="JavaScript">

        function setCookie(name, value, expiredays) {
            var date = new Date();
            date.setDate(date.getDate() + expiredays);
            document.cookie = escape(name) + "=" + escape(value) + "; expires=" + date.toUTCString();
        }

        function closePopup() {
            if (document.getElementById("check").value) {
                setCookie("popupYN", "N", 1);
            }
        }

    </script>
</head>
<body>
<table width="" border="0" cellpadding="0" cellspacing="0">
    <tbody><tr>
        <td>
            <img src="image/Event.png" width="100%" height="100%" border="0" onclick="http://seokjae.cf/board.php">
        </td>
    </tr>
    <tr>
        <td height="30" align="right" bgcolor="#000000">
            <table border="0" cellpadding="0" cellspacing="2">
                <form name="frm" method="post" action=""></form>
                <tbody><tr>
                    <td><input class="PopupCheck" type="checkbox" id="check" onclick="closePopup()"></td>
                    <td style="font-size:11px;color:#FFFFFF;">1일동안 이 창을 열지 않음</td>
                    <td style="font-size:11px;"><a href="javascript:self.close();" onfocus="this.blur()">[닫기]</a></td>
                </tr>
                </tbody></table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>